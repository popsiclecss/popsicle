$(document).ready(function(e) {
  $(".toggle-desktop").on('click', function(e){
    $(".desktop-navbar").css({
      "width":'100%',
      'display':"flex",
      "z-index":"999"
    })
    if ($(".desktop-navbar").is(":visible")) {
      $(".background-opacized").removeClass("d-none");
    }
  });

  $(".background-opacized").on('click', function(e) {
    if ($(".desktop-navbar").is(":visible")) {
      $(".desktop-navbar").css("display","none");
      $(this).addClass("d-none");
    }
  });
});
