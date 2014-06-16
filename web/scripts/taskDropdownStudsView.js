jQuery(window).load(function() {

    $("#activityPage_2 > ul > li > a").click(function () { // binding onclick

        if ($(this).parent().hasClass('selected')) {
            $(".taskList .selected .taskHeader img").attr("src","/tw_acatism/web/images/down.png");
            $(".taskList .selected .taskContent").slideUp(100); // hiding popups
            $(".taskList .selected").removeClass("selected");
        } else {
            $(".taskList .selected .taskHeader img").attr("src","/tw_acatism/web/images/down.png");
            $(".taskList .selected .taskContent").slideUp(100); // hiding popups
            $(".taskList .selected").removeClass("selected");

    if ($(this).next(".taskContent").length) {
    $(this).parent().addClass("selected"); // display popup
    $(".taskList .selected .taskHeader img").attr("src","/tw_acatism/web/images/up.png");
    $(".taskList .selected .taskContent").slideDown(200);
     }
}
});

});
