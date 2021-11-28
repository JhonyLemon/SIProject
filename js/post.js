var id='';
var answerComment;

function onAddComment(event)
{
  id='';
  event.preventDefault();

  data = new FormData(event.target);

  SendPOST(data);
  
}

function onVoteComment(event)
{
  event.preventDefault();
  var element=event.target.elements['ID'];

  element.disabled=false;
  var str=event.target.id.split('.');
  
  element.value=id+str[str.length - 1];

  data = new FormData(event.target);

  element.disabled=true;

  SendPOST(data);
  
}

function onAnswer(event)
{
  event.preventDefault();
  var element=event.target.elements['ID'];

  var str=event.target.id.split('.');
  
  element.disabled=false;
  element.value=str[str.length - 1];

  data = new FormData(event.target);

  element.disabled=true;

  if(typeof answerComment!=='undefined')
  {
    answerComment.style.display="block";
    var form=document.getElementById("AnswerComment."+answerComment.id);
    form.style.display="none";
    for(i=1; i<form.elements.length; i++)
      form.elements[i].disabled=true;
  }

  SendPOST(data);
  
}

function onClick(event)
{
  event.preventDefault();
 
  var element=document.getElementById("hiddenaction");

  element.disabled=false;
  if(id=='')
  element.value=event.target.id;
  else
  element.value=id;

  data = new FormData(document.getElementById('hiddenactionform'));

  element.disabled=true;

  SendPOST(data);

}

function onClickCommentVote(event)
{
  id=event.target.id; 
}

function onClickAnswerComment(event)
{
  if(typeof answerComment!=='undefined')
  {
    answerComment.style.display="block";
    var form=document.getElementById("AnswerComment."+answerComment.id);
    form.style.display="none";
    for(i=1; i<form.elements.length; i++)
      form.elements[i].disabled=true;
  }
  answerComment=event.target;
  answerComment.style.display="none";
  var form=document.getElementById("AnswerComment."+answerComment.id);
  form.style.display="block";
  for(i=1; i<form.elements.length; i++)
    form.elements[i].disabled=false;
}


function onClickModal(event)
{
  id=event.target.id;
  var element = document.createElement("p");
  var node = document.createTextNode('Are you sure you want to '+id+' post');
  element.id='temp';
  element.appendChild(node);
  document.getElementById('actionModalContent').appendChild(element);
  document.getElementById('actionModal').style.display = "block";
  
}
function onClickX() 
{
  document.getElementById('actionModal').style.display = "none";
  document.getElementById('temp').remove();
}

window.onclick = function(event) 
{
  if (event.target == document.getElementById('actionModal')) {
    document.getElementById('actionModal').style.display = "none";
    document.getElementById('temp').remove();
  }
}


function GetNextURL()
{
  try{
  return document.getElementById('nextPost').action;
  }
  catch(e)
  {
    return 0;
  }
}

function GetPreviousURL()
{
  try{
  return document.getElementById('previousPost').action;
}
catch(e)
{
  return 0;
}
}

function SendPOST(data)
{
  $.ajax({
    url  : window.location.href,  //your page
    type: "POST",                   // Type of request to be send, called as method
    data:  data,     // Data sent to server, a set of key/value pairs representing form fields and values
    contentType: false,             // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
    cache: false,                   // To unable request pages to be cached
    processData:false,              // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
    success: function(data)         // A function to be called if request succeeds
    {
      var next=GetNextURL();
      var previous=GetPreviousURL();
      if(id=='delete')
      {
      id='';
      if(next!=0)
      window.location.replace(next);
      else if(previous!=0)
      window.location.replace(previous);
      else
      window.location.replace("index.php?action=home");
      }
      else if(id=='validate')
      {
      id='';
      if(next!=0)
      window.location.replace(next);
      else if(previous!=0)
      window.location.replace(previous);
      else
      window.location.replace(window.location.href.replace('valid=0','valid=1'));
      }
      else
      {
        id='';
        $("html").html(data);
      }
    }
});
}