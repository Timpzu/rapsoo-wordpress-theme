$(document).ready(function () {
    let contrast = localStorage.getItem('contrast');
    if (contrast !== '') {
        $('body').addClass(contrast);
    }

    $("#invert_colors").click(function () {
        $('body').toggleClass("dark");
        if ($('body').hasClass('dark')) {
            localStorage.setItem('contrast', 'dark');
        } else {
            localStorage.setItem('contrast', '');
        }
    });
    $("#format_size").click(function () {
        $('body').toggleClass("large");
    });

    var card = $("div.cards a");
    var categories = $("#categories");
    var numResults = card.not(".hidden").length;

    $("#sr-results").append("<p>Showing: " + numResults + " results.</p>");

    categories.change(function () {
        card.each(function () {
            if (!$(this).hasClass(categories.val())) {
                $(this).addClass("hidden");
            } else {
                $(this).removeClass("hidden");
            }
        })
        var numResults = card.not(".hidden").length;
        $("#sr-results p:first").replaceWith("<p role='alert'>Showing: " + numResults +
            " results.");
    });
});