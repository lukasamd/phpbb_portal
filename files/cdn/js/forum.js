/* jQuery.TextareaResizer */
(function($){var textarea,staticOffset;var iLastMousePos=0;var iMin=32;var grip;$.fn.TextAreaResizer=function(){return this.each(function(){textarea=$(this).addClass('processed'),staticOffset=null;$(this).wrap('<div class="resizable-textarea"><span></span></div>').parent().append($('<div class="grippie"></div>').bind("mousedown",{el:this},startDrag));var grippie=$('div.grippie',$(this).parent())[0];grippie.style.marginRight=(grippie.offsetWidth-$(this)[0].offsetWidth)+'px'})};function startDrag(e){textarea=$(e.data.el);textarea.blur();iLastMousePos=mousePosition(e).y;staticOffset=textarea.height()-iLastMousePos;textarea.css('opacity',0.25);$(document).mousemove(performDrag).mouseup(endDrag);return false}function performDrag(e){var iThisMousePos=mousePosition(e).y;var iMousePos=staticOffset+iThisMousePos;if(iLastMousePos>=(iThisMousePos)){iMousePos-=5}iLastMousePos=iThisMousePos;iMousePos=Math.max(iMin,iMousePos);textarea.height(iMousePos+'px');if(iMousePos<iMin){endDrag(e)}return false}function endDrag(e){$(document).unbind('mousemove',performDrag).unbind('mouseup',endDrag);textarea.css('opacity',1);textarea.focus();textarea=null;staticOffset=null;iLastMousePos=0}function mousePosition(e){return{x:e.clientX+document.documentElement.scrollLeft,y:e.clientY+document.documentElement.scrollTop}}})(jQuery);

/**
* Cookie plugin mini
*
* Copyright (c) 2006 Klaus Hartl (stilbuero.de)
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
**/
jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options.expires=-1}var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000))}else{date=options.expires}expires='; expires='+date.toUTCString()}var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('')}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break}}}return cookieValue}};


/*  Additional functions */
$(document).ready(function() 
{

    /* Resultion test */
    /*
    if ($(window).width() < 1200)
    {
        $("#sidebar").css('display', 'none');
        $("#mainPage").css('margin-right', '0');
    }
    */

    var collapsedList = jQuery.cookie('collapsed');
    var collapsedForums= new Array();
    var collapsedName = '';
  
    if (collapsedList == null || collapsedList == "")
    {
        collapsedList = "";
    }
    else
    {
        collapsedForums = collapsedList.split(",");
        for(var i in collapsedForums)
        {
            collapsedName = collapsedForums[i]; 
            collapsedForums[collapsedName] = collapsedForums[i];
            $("#" + collapsedName).children(".panelMain").hide();
            $("#c" + collapsedName).removeClass("collapse-normal").addClass("collapse-close");
        }
    }

  $('.collapse').click(function() 
  {
    var parentElement = $(this).parents(".contentPanel");
    var parentId = parentElement.attr("id");
    
    if ($(this).hasClass("collapse-close"))
    {
			for(var i in collapsedForums)
			{
				if (collapsedForums[i] == parentId) 
			  {
					collapsedForums.splice(i, 1);
					break;
			  }
			}

      $(this).removeClass("collapse-close").addClass("collapse-normal");
    }
    else
    {
    	collapsedForums.push(parentId);
      $(this).removeClass("collapse-normal").addClass("collapse-close");
    }
    parentElement.children(".panelMain").slideToggle('slow');
    
    collapsedList = collapsedForums.join(","); 
    jQuery.cookie('collapsed', collapsedList);
  });

  
  /* Animation for quick login form */
  $('#quickLoginBox').hide();
  $("#loginlink").click(function(ev)
  {
    ev.preventDefault();
    $(this).remove();
    $('#quickLoginBox').show().css("text-indent", "0");
  });
  
  
  $(".forumList > li").hover(
    function () {
      $(this).find(".forumNumbers").show();
    }, 
    function () {
      $(this).find(".forumNumbers").hide();
    }
  );
  
  
  /* Mark forums read */ 
  $(".ajaxMarkRead").click(function() 
  {
    var markElement = $(this);
    
    $.ajax({
      type: "POST",
      url: "xmlhttp.php?action=markRead&hash=" + phpbb_hash_code,
      data: (
      {
        f : $(this).attr('id'),
        src : $(this).attr('src'),
      }),
      success: function(msg) {
        reply = jQuery.parseJSON(msg);

        if (reply.error == 1) {
          return;
        } else {
            var new_src = stripslashes(reply.src);
            markElement.removeClass('ajaxMarkRead').attr('src', new_src);
        }
      }
    });
  }); 


  
  /* Editbox actions */
  var editbox_visible = 0;
  $(".quickMenu").on('click', function(ev) 
  {
    ev.preventDefault();

    if (window.editbox_visible == 1)
    {
      window.editbox_visible = 0;
    }
    else
    {
      window.editbox_visible = 1;
    }
    $(this).nextAll(".quickMenuBox").slideToggle('medium');
  });
  
  $(document).click(function(event) 
  {
    if (window.editbox_visible == 1 && !$(event.target).hasClass('quickMenu') && !$(event.target).parent().hasClass('quickMenu')) 
    {
      $(".quickMenuBox").hide("fast");
      window.editbox_visible = 0;
    }
  });

    

    /*
  $('html').on('click', function() 
  {
    if (window.editbox_visible == 1)
    {
      $(this).nextAll(".editbox_options").hide("fast");
      window.editbox_visible = 0;
    }
  });
  */

  
  /* Go to pageheader animation */
  $("a.top").attr('href', 'javascript:void(0);');  
  $('a.top').click(function()
  {  
     $('html, body').animate({scrollTop:0}, 'slow');  
  });  


  /* Textarea-resizer plugin */
  $('textarea.inputbox:not(.processed)').TextAreaResizer();
  
  
  /* Auto-scale too big images */
  /*
  $('.postbody img').each(function() {
      var img = $(this);
      
      $(this).load(function()
      {
        if ( img.width() > 500 || img.height() > 300)
        {
          $(img).replaceWith('<a href="' + img.attr("src") + '" title="Naciśnij aby zobaczyć cały obrazek" target="_blank"><img src="' + img.attr("src") + '" style="max-width:500px; max-height:300px;" /><br />Kliknij aby powiększyć</a>');
        }
      });
  });
	*/  
});



function stripslashes (str) {
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Ates Goral (http://magnetiq.com)
    // +      fixed by: Mick@el
    // +   improved by: marrtins
    // +   bugfixed by: Onno Marsman
    // +   improved by: rezna
    // +   input by: Rick Waldron
    // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
    // +   input by: Brant Messenger (http://www.brantmessenger.com/)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: stripslashes('Kevin\'s code');
    // *     returns 1: "Kevin's code"
    // *     example 2: stripslashes('Kevin\\\'s code');
    // *     returns 2: "Kevin\'s code"
    return (str + '').replace(/\\(.?)/g, function (s, n1) {
        switch (n1) {
        case '\\':
            return '\\';
        case '0':
            return '\u0000';
        case '':
            return '';
        default:
            return n1;
        }
    });
}


/**
* phpBB3 forum functions
*/
function popup(url,width,height,name){if(!name){name='_popup'}window.open(url.replace(/&amp;/g,'&'),name,'height='+height+',resizable=yes,scrollbars=yes, width='+width);return false}function jumpto(){var page=prompt(jump_page,on_page);if(page!==null&&!isNaN(page)&&page==Math.floor(page)&&page>0){var seo_page=(page-1)*per_page;var anchor='';var anchor_parts=base_url.split('#');if(anchor_parts[1]){base_url=anchor_parts[0];anchor='#'+anchor_parts[1]}if(seo_page>0){var phpEXtest=false;if(base_url.indexOf('?')>=0||(phpEXtest=base_url.match(/\.php$/i))){document.location.href=base_url.replace(/&amp;/g,'&')+(phpEXtest?'?':'&')+'start='+seo_page+anchor}else{var ext=base_url.match(/\.[a-z0-9]+$/i);if(ext){document.location.href=base_url.replace(/\.[a-z0-9]+$/i,'')+seo_delim_start+seo_page+ext+anchor}else{var slash=base_url.match(/\/$/)?'':'/';document.location.href=base_url+slash+seo_static_pagination+seo_page+seo_ext_pagination+anchor}}}else{document.location.href=base_url+anchor}}}function phpbb_seo_href(){var current_domain=document.domain.toLowerCase();if(!current_domain||!document.getElementsByTagName)return;if(seo_external_sub&&current_domain.indexOf('.')>=0){current_domain=current_domain.replace(new RegExp(/^[a-z0-9_-]+\.([a-z0-9_-]+\.([a-z]{2,6}|[a-z]{2,3}\.[a-z]{2,3}))$/i),'$1')}if(seo_ext_classes){var extclass=new RegExp("(^|\s)("+seo_ext_classes+")(\s|$)")}if(seo_hashfix){var basehref=document.getElementsByTagName('base')[0];if(basehref){basehref=basehref.href;var hashtest=new RegExp("^("+basehref+"|)#[a-z0-9_-]+$");var current_href=document.location.href.replace(/#[a-z0-9_-]+$/i,"")}else{seo_hashfix=false}}var hrefels=document.getElementsByTagName("a");var hrefelslen=hrefels.length;for(var i=0;i<hrefelslen;i++){var el=hrefels[i];var hrefinner=el.innerHTML.toLowerCase();if(el.onclick||(el.href=='')||(el.href.indexOf('javascript')>=0)||(el.href.indexOf('mailto')>=0)||(hrefinner.indexOf('<a')>=0)){continue}if(seo_hashfix&&el.hash&&hashtest.test(el.href)){el.href=current_href+el.hash}if(seo_external){if((el.href.indexOf(current_domain)>=0)&&!(seo_ext_classes&&extclass.test(el.className))){continue}el.onclick=function(){window.open(this.href);return false}}}}if(seo_external||seo_hashfix){onload_functions.push('phpbb_seo_href()')}function marklist(id,name,state){var parent=document.getElementById(id);if(!parent){eval('parent = document.'+id)}if(!parent){return}var rb=parent.getElementsByTagName('input');for(var r=0;r<rb.length;r++){if(rb[r].name.substr(0,name.length)==name){rb[r].checked=state}}}function viewableArea(e,itself){if(!e)return;if(!itself){e=e.parentNode}if(!e.vaHeight){e.vaHeight=e.offsetHeight;e.vaMaxHeight=e.style.maxHeight;e.style.height='auto';e.style.maxHeight='none';e.style.overflow='visible'}else{e.style.height=e.vaHeight+'px';e.style.overflow='auto';e.style.maxHeight=e.vaMaxHeight;e.vaHeight=false}}function dE(n,s,type){if(!type){type='block'}var e=document.getElementById(n);if(!s){s=(e.style.display==''||e.style.display==type)?-1:1}e.style.display=(s==1)?type:'none'}function subPanels(p){var i,e,t;if(typeof(p)=='string'){show_panel=p}for(i=0;i<panels.length;i++){e=document.getElementById(panels[i]);t=document.getElementById(panels[i]+'-tab');if(e){if(panels[i]==show_panel){e.style.display='block';if(t){t.className='activetab'}}else{e.style.display='none';if(t){t.className=''}}}}}function printPage(){if(is_ie){printPreview()}else{window.print()}}function displayBlocks(c,e,t){var s=(e.checked==true)?1:-1;if(t){s*=-1}var divs=document.getElementsByTagName("DIV");for(var d=0;d<divs.length;d++){if(divs[d].className.indexOf(c)==0){divs[d].style.display=(s==1)?'none':'block'}}}function selectCode(a){var e=a.parentNode.parentNode.getElementsByTagName('CODE')[0];if(window.getSelection){var s=window.getSelection();if(s.setBaseAndExtent){s.setBaseAndExtent(e,0,e,e.innerText.length-1)}else{if(window.opera&&e.innerHTML.substring(e.innerHTML.length-4)=='<BR>'){e.innerHTML=e.innerHTML+'&nbsp;'}var r=document.createRange();r.selectNodeContents(e);s.removeAllRanges();s.addRange(r)}}else if(document.getSelection){var s=document.getSelection();var r=document.createRange();r.selectNodeContents(e);s.removeAllRanges();s.addRange(r)}else if(document.selection){var r=document.body.createTextRange();r.moveToElementText(e);r.select()}}function play_qt_file(obj){var rectangle=obj.GetRectangle();if(rectangle){rectangle=rectangle.split(',');var x1=parseInt(rectangle[0]);var x2=parseInt(rectangle[2]);var y1=parseInt(rectangle[1]);var y2=parseInt(rectangle[3]);var width=(x1<0)?(x1*-1)+x2:x2-x1;var height=(y1<0)?(y1*-1)+y2:y2-y1}else{var width=200;var height=0}obj.width=width;obj.height=height+16;obj.SetControllerVisible(true);obj.Play()}function is_node_name(elem,name){return elem.nodeName&&elem.nodeName.toUpperCase()==name.toUpperCase()}function is_in_array(elem,array){for(var i=0,length=array.length;i<length;i++)if(array[i]===elem)return i;return-1}function find_in_tree(node,tag,type,class_name){var result,element,i=0,length=node.childNodes.length;for(element=node.childNodes[0];i<length;element=node.childNodes[++i]){if(!element||element.nodeType!=1)continue;if((!tag||is_node_name(element,tag))&&(!type||element.type==type)&&(!class_name||is_in_array(class_name,(element.className||element).toString().split(/\s+/))>-1)){return element}if(element.childNodes.length)result=find_in_tree(element,tag,type,class_name);if(result)return result}}var in_autocomplete=false;var last_key_entered='';function phpbb_check_key(event){if(event.keyCode&&(event.keyCode==40||event.keyCode==38))in_autocomplete=true;if(in_autocomplete){if(!last_key_entered||last_key_entered==event.which){in_autocompletion=false;return true}}if(event.which!=13){last_key_entered=event.which;return true}return false}function submit_default_button(event,selector,class_name){if(!event.which&&((event.charCode||event.charCode===0)?event.charCode:event.keyCode))event.which=event.charCode||event.keyCode;if(phpbb_check_key(event))return true;var current=selector['parentNode'];while(current&&(!current.nodeName||current.nodeType!=1||!is_node_name(current,'form'))&&current!=document)current=current['parentNode'];var input_tags=current.getElementsByTagName('input');current=false;for(var i=0,element=input_tags[0];i<input_tags.length;element=input_tags[++i]){if(element.type=='submit'&&is_in_array(class_name,(element.className||element).toString().split(/\s+/))>-1)current=element}if(!current)return true;current.focus();current.click();return false}function apply_onkeypress_event(){if(jquery_present){jQuery('form input[type=text], form input[type=password]').on('keypress',function(e){var default_button=jQuery(this).parents('form').find('input[type=submit].default-submit-action');if(!default_button||default_button.length<=0)return true;if(phpbb_check_key(e))return true;if((e.which&&e.which==13)||(e.keyCode&&e.keyCode==13)){default_button.click();return false}return true});return}var input_tags=document.getElementsByTagName('input');for(var i=0,element=input_tags[0];i<input_tags.length;element=input_tags[++i]){if(element.type=='text'||element.type=='password'){element.onkeypress=function(evt){submit_default_button((evt||window.event),this,'default-submit-action')}}}}var jquery_present=typeof jQuery=='function';