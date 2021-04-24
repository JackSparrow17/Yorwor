$(document).ready(function() {
    $('.Open').click(function() {
        $('.Open').hide();
        $('.Close').css("display", "flex");

        for (i = 0; i < 101; I++) {
            $('.Navigation').css("left", "0px");
            $('.Navigation').css("transition", "0.3s ease-out");
        }
    });

    $('.Close').click(function() {
        $('.Close').hide();
        $('.Open').css("display", "flex");

        for (i = 0; i < 101; I++) {
            $('.Navigation').css("left", " -100%");
            $('.Navigation').css("transition", "0.3s");
        }
    });
});