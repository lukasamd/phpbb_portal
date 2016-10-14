/*  Additional functions */
$(document).ready(function() 
{
  /* Animation for quick login form */
  $('#quickLoginBox').hide();
  $("#loginlink").click(function(ev)
  {
    ev.preventDefault();
    $(this).remove();
    $('#quickLoginBox').show().css("text-indent", "0");
  });
  
});