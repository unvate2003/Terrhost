//Top Up
$(document).ready(function() {
    $(window).scroll(function() {
      if ($(this).scrollTop() > 600) {
        $('#top-up').fadeIn();
      } else {
        $('#top-up').fadeOut();
      }
    });
    // scroll body to 0px on click
    $('#top-up').click(function() {
      $('body,html').animate({
        scrollTop: 0
      }, 400);
      return false;
    });
});