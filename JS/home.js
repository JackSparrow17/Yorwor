$(document).ready(function() {
    $("#Filter").click(function() {
        $('.Search-Categories').show();
        $('#Mask').show();
    });

    $('#Mask').click(function() {
        $('.Search-Categories').hide();
        $('#Mask').hide();
    });

    $('#closeMenu').click(function() {
        var parentDiv = $('#closeMenu').parent.attr('class');
        alert(parentDiv);
    });
});