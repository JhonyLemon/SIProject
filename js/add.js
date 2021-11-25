var max_size=1024*1024*100;
var size=0;


document.addEventListener("DOMContentLoaded", onLoad);

function getExtension(filename)
{
  var parts = filename.split('/');
  return parts[parts.length - 1];
}

function isImage(filename) 
{
  var ext = getExtension(filename);
  switch (ext.toLowerCase()) 
  {
    case 'jpg':
    case 'jpeg':
    case 'gif':
    case 'bmp':
    case 'png':
      return true;
  }
  return false;
}

function addTextarea(parentNode,value)
{
  var element = document.createElement("textarea");
  element.setAttribute("name","desc[]");
  element.setAttribute("rows",4);
  element.setAttribute("cols",50);
  element.value=value;
  parentNode.appendChild(element);
  parentNode.appendChild(document.createElement("br"));

  var hidden = document.createElement("textarea");
  hidden.name="descriptions[]";
  hidden.value=value;
 // hidden.setAttribute("disabled", "true");
  document.getElementById("hidden").appendChild(hidden);
}
function addImage(parentNode,element,input)
{
  addFile(input,parentNode);
  element.src = URL.createObjectURL(input.files[0]);
  element.setAttribute("width", "320");
  element.setAttribute("height", "240");
  parentNode.appendChild(element);
  parentNode.appendChild(document.createElement("br"));
}
function revokeObject(element)
{
  element.onload = function() 
  {
    URL.revokeObjectURL(element.src)
  }
}

function addFile(input,parentNode)
{
  var hidden = input.cloneNode();
  hidden.name="files[]";
  hidden.setAttribute("disabled", "true");
  document.getElementById("hidden").appendChild(hidden);
}

function onChange()
{
  var input = document.getElementById('file');
  var description = document.getElementById('description'); 
  size = size+input.size;
  if(input!=null && (max_size>size || input.size!=0))
  {
    var parentNode = document.getElementById("preview");
    if(isImage(input.files[0].type))
    {
      var element = document.createElement("img");
      addImage(parentNode,element,input);
      addTextarea(parentNode,description.value);
      description.value=null;
      revokeObject(element);
    }
    else
    {
      alert("Nieobsługiwany typ pliku");
    }
    input.value=null;
  }
  else
  {
    size = size - input.size;
    alert("Plik jest za duży. Maksymalny rozmiar pliku to 100MB");
    input.value=null;
  }
}

function onLoad()
{
  document.getElementById("form").addEventListener('submit', onSubmit);
  document.getElementById("file").addEventListener('change',onChange);
}

function onSubmit(event)
{
  event.preventDefault();
  var title=document.getElementById("title");
  var elements=document.getElementById("hidden").elements;
  if(title.value!="" && elements.length>1)
  {
  
  document.getElementById("hiddentitle").value=title.value;
  title.value='';

  var desc=document.getElementsByName("desc[]");

  var description=document.getElementsByName("descriptions[]");

  for(i=0; i<desc.length; i++)
    description[i].value=desc[i].value;

  for(i=0; i<elements.length; i++)
    elements[i].disabled=false;

  data = new FormData(document.getElementById("hidden"));

  for(i=0; i<elements.length; i++)
    elements[i].disabled=true;

  $.ajax({
    url  : "index.php?action=add",  //your page
    type: "POST",                   // Type of request to be send, called as method
    data:  data,     // Data sent to server, a set of key/value pairs representing form fields and values
    contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
    cache: false,                   // To unable request pages to be cached
    processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
    success: function(data)         // A function to be called if request succeeds
    {
        $("html").html(data);
    }
});

  }
  else
    alert("Coś poszło nie tak");
    return false;
}
