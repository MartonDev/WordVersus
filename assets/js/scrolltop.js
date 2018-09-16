(function ($) {

  $(document).ready(function () {

      $(window).scroll(function () {

        if (!($(this).scrollTop() > 100)) {

          $("#scrollTop").addClass("bounceOutDown");
          $("#scrollTop").removeClass("bounceInUp");

        }else {

          $("#scrollTop").addClass("bounceInUp");
          $("#scrollTop").removeClass("bounceOutDown");

        }

    });

  });

})(jQuery);
