(function($) {
   $(function() {
      $(window).scroll(function () {
         if ($(this).scrollTop() > 150) {
            $('header').addClass('add-bgcolor-header')
         }
         if ($(this).scrollTop() < 150) {
            $('header').removeClass('add-bgcolor-header')
         }
      });
   });
})( jQuery );