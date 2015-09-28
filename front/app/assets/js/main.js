window.onload = function() {

    // Change elements when the scroll its down
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 120) {
            $(".nav-bar").addClass("nav-bar-active");
        }else {
            $(".nav-bar").removeClass("nav-bar-active");
        }
    });
    var $mask = '<div class="opacity-products"></div>';
    // Add a mask when the hover is active
    $('.box-product').hover(function(){

        if (!$(this).hasClass('active')) {
          $(this).addClass('active');
        }

        if ($(this).hasClass('active')) {
            $(this).append($mask);
        }else{
          $(this).remove('opacity-products');
        }
    });
}
