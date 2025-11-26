(($) => {
  $(document).ready(function() {

    $(".menu-toggle").click( function (){
      $(this).next().toggleClass("open");
      $(this).toggleClass("open");

      $(this).children().toggleClass("hds-icon--angle-up");

      $(this).attr("aria-expanded", function (i, attr) {
        return attr == "true" ? "false" : "true";
      });
    });

  });
})(jQuery);
