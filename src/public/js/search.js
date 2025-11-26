(($) => {
  $(document).ready(function() {

    $(".search-open").click(function() {
      $('.search-box').attr("aria-expanded", function (i, attr) {
        return attr == "true" ? "false" : "true";
      });
      // $('.search-box').toggle('fast');
      $('.search-box').addClass('open');
      $('#s').focus();
      $(".search-open").blur();
      $('.search-open .fa-search, .search-open .fa-times').toggle();
    });

    $('.search-open').keypress(function (e) {
      var key = e.which;
      if(key == 13)  {
        $('.search-open').click();
        $(this).addClass('remove-focus');
        // return false;
      }
    });

  });
})(jQuery);
