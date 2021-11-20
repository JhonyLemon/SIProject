
function onClick(event)
{
  event.preventDefault();
 
  var element=document.getElementById("hiddenaction");

  element.disabled=false;
  element.value=event.target.id;

  data = new FormData(document.getElementById('hiddenactionform'));

  element.disabled=true;

  $.ajax({
    url  : window.location.href,  //your page
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
