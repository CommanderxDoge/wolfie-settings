jQuery(document).ready(function($){ 
	function setCookie(name, val, days, path, domain, secure) {
    if (navigator.cookieEnabled) { //czy ciasteczka są włączone
      const cookieName = encodeURIComponent(name);
      const cookieVal = encodeURIComponent(val);
      let cookieText = cookieName + "=" + cookieVal;

      if (typeof days === "number") {
        const data = new Date();
        data.setTime(data.getTime() + (days * 24*60*60*1000));
        cookieText += "; expires=" + data.toGMTString();
      }

      if (path) {
        cookieText += "; path=" + path;
      }
      if (domain) {
        cookieText += "; domain=" + domain;
      }
      if (secure) {
        cookieText += "; secure";
      }

      document.cookie = cookieText;
    }
  }
  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  $('.wolfie-tabs li').click(function(){
    $('.wolfie-tabs li').removeClass('active');
    $(this).addClass('active');
    var tabName = $(this).data('tab');
    $('.wolfie_tab_container').removeClass('active');
    $('.'+tabName).addClass('active');
    console.log(tabName)
  });
  $('#submit').click(function(){
    var activeSection = $('.wolfie-tabs li.active').data('tab');
    setCookie('wolfie-settings', activeSection);
  });
  var cookie = getCookie('wolfie-settings');
  console.log(cookie);
  if(cookie){
    setTimeout(function(){
     $('.wolfie-tabs li[data-tab="'+cookie+'"]').trigger('click');
   }, 100)
  }
  if( $('.colorpicker').length ){
    $('.colorpicker').wpColorPicker();
  }
});