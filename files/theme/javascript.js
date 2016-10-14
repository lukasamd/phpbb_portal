$(document).ready(function()
{ 
  /*if (document.documentElement.clientWidth >= 1245)
  {
    $("#container").css("width", "1200px");
  }
  */
  



  /* Auto zwijanie nawigacji */
  function hideNavigation() {
    $(".expandBlock").css("display", "none");
  }
  hideNavigation();
  
  
  /* Szybkie dodawanie komentarzy */
  $("#commentSubmit").on('click', function(ev) {
    ev.preventDefault();
    $("#commentReply").html('<img src="images/loading.gif" alt="Loading" />');

    $.ajax({
      type: "POST",
      url: "index.php?module=XMLHttp_Comment&action=add",
      data: (
      {
        commentSubmit : '1',
        commentItemId : $("input[name='commentItemId']").val(),
        commentItemType : $("input[name='commentItemType']").val(),
        commentEmail : $("input[name='commentEmail']").val(),
        commentNick : $("input[name='commentNick']").val(),
        commentMessage : $("#commentMessage").val(),
        creation_time : $("input[name='creation_time']").val(),
        form_token : $("input[name='form_token']").val(), 
      }),
      success: function(msg) {
        reply = jQuery.parseJSON(msg);

        if (reply.error == 1) {
          $("#commentReply").html('<h4 class="komunikat-bad">' + reply.info + '</h4>');
        } else {
        
            // Hide no comments info
            if ($(".noCommentsInfo").length) {
                $(".noCommentsInfo").fadeOut();
            }
        
          $("#commentReply").html('<h4 class="komunikat-ok">' + reply.info + '</h4>');
          $('#listComments').append($(reply.comment).fadeIn(2000));
          
          var targetOffset = ($('#listComments li:last').offset().top) - 300;
          $('html,body').animate({scrollTop: targetOffset}, 1000);
          $("#formComment").remove(); 
          
          if (reply.error == 0) {
            //$("#nocomments").remove();
          }  
        }
      }
    });
  }); 
  
  
  /* Report comments */  
  $(".commentReport").hide();
  $("#listComments li").hover(
    function () {
      $(this).children(".commentReport").show("fast");
    }, 
    function () {
      $(this).children(".commentReport").hide("fast");
    }
  );

  $(".commentReport > a").on('click', function(ev) {
    ev.preventDefault();
    
    var cid = $(this).parents("li").attr("id");
    cid = cid.split("comment",2);
    cid = cid[1];
    
    parent = $(this).parents("span"); 
    parent.html('<img src="images/loading.gif" alt="Loading" />');
    
    $.ajax({
      type: "POST",
      url: "index.php?module=XMLHttp_Comment&action=report",
      data: (
      {
        commentId : cid,
      }),
      success: function(msg) {
				parent.remove();
      }
    });
  });


  /* Poprawa tla pod linkami-obrazkami */
  $("a > img").parent().addClass("img");


  /* Obrazki z odpowiednim efektem otwierania */
  /*
  $("a.fancybox").fancybox({
			'imageScale': false,
			'zoomOpacity': true,
			'padding': 2,
			'zoomSpeedIn': 700,
			'zoomSpeedOut': 700,
			'zoomSpeedChange': 100,
			'overlayShow': true,
			'overlayColor': "#000",
			'overlayOpacity': 0.5,
			'enableEscapeButton': true,
			'showCloseButton': true,
			'hideOnOverlayClick': true,
			'hideOnContentClick': false,
			'frameWidth':  560,
			'frameHeight':  340,
			'callbackOnStart': null,
			'callbackOnShow': null,
			'callbackOnClose': null,
			'centerOnScroll': true
  });
  */
  
  


  /* Rozwijana nawigacja w menu */
  $(".expand").toggle(function() {
    $(this).nextAll(".expandBlock").show("fast");
  },function() {
    $(this).nextAll(".expandBlock").hide("fast");  
  });
  

  /* Odtwarzacz multimedialny odpowiadajacy za odtwarzanie muzyki */
  $("a.odtwarzacz").click( function() {
    window.open("includes/odtwarzacz_mp3/","MusicBoxFlashPlayer","width=300,height=300,top=30,left=30,menubar=no,toolbar=no,location=no,directories=no,status=no,scrollbars=no,resizable=no,fullscreen=no,channelmode=no").focus();
    return false;
  });  

  
  /* Dodanie brakujacego elementu alt do obrazkow */

  $("img").each(function(index) {
    var img = $(this);
    if (!img.attr("alt") || img.attr("alt") == "")
    {
      img.attr("alt", "Obrazek-" + index);
    }
   });

  
  
  

  
  
  /* Newsletter */
  $('.email_email').blur(function() {
    if($(this).val() == '') {
      $(this).val('Twój adres E-Mail'); 
    }
  });
  $('.email_email').focus(function() {
    if($(this).val() == 'Twój adres E-Mail') {
      $(this).val(''); 
    }
  });
  
  $("#email_fieldset > .button").on('click', function(ev)
  {
    ev.preventDefault();
    
    var akcja = $(this).val();
    var email = $(".email_email").val();
    var odpowiedz = '';
    var message = $("#email-message"); 
    
    message.css("display", "block");
    message.html('<img src="images/loading.gif" alt="Loading" />');
    message.removeClass();

    $.post('includes/modules/newsletter.php', {'submit': '1', 'email': email, 'akcja': akcja, 'typ': 'ajax'}, function(data) {
      data = jQuery.parseJSON(data);
      if (data.error == true) {
        message.addClass('komunikat-bad');
      } else {
        message.addClass('komunikat-ok');
        $("#email_form").css("display", "none");
        $("#newsletter-title").css("display", "none");
      }

      message.html(data.message);
    });
  });

  
  
/*  
var galleries = $('.programGallery').adGallery(); 
$('#switch-effect').change(
  function() {
    galleries[0].settings.effect = $(this).val();
    return false;
  }
);
$('#toggle-slideshow').click(
  function() {
    galleries[0].slideshow.toggle();
    return false;
  }
);
$('#toggle-description').click(
  function() {
    if(!galleries[0].settings.description_wrapper) {
      galleries[0].settings.description_wrapper = $('#descriptions');
    } else {
      galleries[0].settings.description_wrapper = false;
    }
    return false;
  }
);
*/

    /* Animation for quick login form */
    $('#quickLoginBox').hide();
    $("#loginlink").click(function(ev)
    {
        ev.preventDefault();
        $(this).remove();
        $('#quickLinks').hide();
        $('#quickLoginBox').show().css("text-indent", "0");
    });
  

});




/* Compatibility */
function flipBox(b){var a;if(document.images["b_"+b].src.indexOf("_on")==-1){a=document.images["b_"+b].src.replace("_off","_on");document.getElementById("box_"+b).style.display="none";if(document.getElementById("box_"+b+"_diff")){document.getElementById("box_"+b+"_diff").style.display="block"}document.images["b_"+b].src=a;disply="none";now=new Date();now.setTime(now.getTime()+1000*60*60*24*365);expire=(now.toGMTString());document.cookie="fusion_box_"+b+"="+escape(disply)+"; expires="+expire}else{a=document.images["b_"+b].src.replace("_on","_off");document.getElementById("box_"+b).style.display="block";if(document.getElementById("box_"+b+"_diff")){document.getElementById("box_"+b+"_diff").style.display="none"}document.images["b_"+b].src=a;disply="block";now=new Date();now.setTime(now.getTime()+1000*60*60*24*365);expire=(now.toGMTString());document.cookie="fusion_box_"+b+"="+escape(disply)+"; expires="+expire}}
function addText(f,i,a,e){if(e==undefined){e="inputform"}if(f==undefined){f="message"}element=document.forms[e].elements[f];element.focus();if(document.selection){var c=document.selection.createRange();var h=c.text.length;c.text=i+c.text+a;return false}else{if(element.setSelectionRange){var b=element.selectionStart,g=element.selectionEnd;var d=element.scrollTop;element.value=element.value.substring(0,b)+i+element.value.substring(b,g)+a+element.value.substring(g);element.setSelectionRange(b+i.length,g+i.length);element.scrollTop=d;element.focus()}else{var d=element.scrollTop;element.value+=i+a;element.scrollTop=d;element.focus()}}}
function insertText(f,h,e){if(e==undefined){e="inputform"}if(document.forms[e].elements[f].createTextRange){document.forms[e].elements[f].focus();document.selection.createRange().duplicate().text=h}else{if((typeof document.forms[e].elements[f].selectionStart)!="undefined"){var a=document.forms[e].elements[f];var g=a.selectionEnd;var d=a.value.length;var c=a.value.substring(0,g);var i=a.value.substring(g,d);var b=a.scrollTop;a.value=c+h+i;a.selectionStart=c.length+h.length;a.selectionEnd=c.length+h.length;a.scrollTop=b;a.focus()}else{document.forms[e].elements[f].value+=h;document.forms[e].elements[f].focus()}}}
function show_hide(a){document.getElementById(a).style.display=document.getElementById(a).style.display=="none"?"block":"none"}
function correctPNG(){if(navigator.appName=="Microsoft Internet Explorer"&&navigator.userAgent.indexOf("Opera")==-1){for(var g=0;g<document.images.length;g++){var d=document.images[g];var f=d.src.toUpperCase();if(f.substring(f.length-3,f.length)=="PNG"){var b=(d.id)?"id='"+d.id+"' ":"";var e=(d.className)?"class='"+d.className+"' ":"";var h=(d.title)?"title='"+d.title+"' ":"title='"+d.alt+"' ";var c="display:inline-block;"+d.style.cssText;if(d.align=="left"){c="float:left;"+c}if(d.align=="right"){c="float:right;"+c}if(d.parentElement.href){c="cursor:hand;"+c}var a="<span "+b+e+h+' style="width:'+d.width+"px; height:"+d.height+"px;"+c+";filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+d.src+"', sizingMethod='scale');\"></span>";d.outerHTML=a;g=g-1}}}}
function getStyle(c,b){if(typeof c=="string"){var a=document.getElementById(c)}else{var a=c}if(a.currentStyle){var d=a.currentStyle[b]}else{if(window.getComputedStyle){var d=document.defaultView.getComputedStyle(a,null).getPropertyValue(b)}}return d};
/***********************************************
* Drop Down/ Overlapping Content- © Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for legal use.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/
function getposOffset(a,d){var c=(d=="left")?a.offsetLeft:a.offsetTop;var b=a.offsetParent;while(b!=null){if(getStyle(b,"position")!="relative"){c=(d=="left")?c+b.offsetLeft:c+b.offsetTop}b=b.offsetParent}return c}function overlay(e,d,a){if(document.getElementById){var c=document.getElementById(d);c.style.display=(c.style.display!="block")?"block":"none";var b=getposOffset(e,"left")+((typeof a!="undefined"&&a.indexOf("right")!=-1)?-(c.offsetWidth-e.offsetWidth):0);var f=getposOffset(e,"top")+((typeof a!="undefined"&&a.indexOf("bottom")!=-1)?e.offsetHeight:0);c.style.left=b+"px";c.style.top=f+"px";return false}else{return true}}function overlayclose(a){document.getElementById(a).style.display="none"}NewWindowPopUp=null;function OpenWindow(d,c,a,b){if(NewWindowPopUp!=null){NewWindowPopUp.close();NewWindowPopUp=null}if(b==false){wtop=0;wleft=0}else{wtop=(screen.availHeight-a)/2;wleft=(screen.availWidth-c)/2}NewWindowPopUp=window.open(d,"","toolbar=no,menubar=no,location=no,personalbar=no,scrollbars=yes,status=no,directories=no,resizable=yes,height="+a+",width="+c+",top="+wtop+",left="+wleft+"");NewWindowPopUp.focus()}function resize_forum_imgs(){var f;var e;if(self.innerWidth){e=self.innerWidth}else{if(document.documentElement&&document.documentElement.clientWidth){e=document.documentElement.clientWidth}else{if(document.body){e=document.body.clientWidth}else{e=1000}}}if(e<=800){f=200}else{if(e<1152){f=300}else{if(e>=1152){f=400}}}for(var c=0;c<document.images.length;c++){var b=document.images[c];if(b.className!="forum-img"){continue}var j=b.height;var a=b.width;var d=false;if(a<=j){if(j>f){b.height=f;b.width=a*(f/j);d=true}}else{if(a>f){b.width=f;b.height=j*(f/a);d=true}}var h=b.parentNode;var g=h.parentNode;if(h.className!="forum-img-wrapper"){continue}if(d){h.style.display="inline";if(g.tagName!="A"){h.onclick=new Function("OpenWindow('"+b.src+"', "+(a+40)+", "+(j+40)+", true)");h.onmouseover="this.style.cursor='pointer'"}}else{h.style.display="inline"}}return true}function onload_events(){resize_forum_imgs();correctPNG()}window.onload=onload_events;


/* Confirm delete alert */
function ConfirmDelete(element) {
	return confirm("Czy na pewno chcesz usunąć " + element + " ?");
}