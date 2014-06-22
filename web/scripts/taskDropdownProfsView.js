// task dropdown for ProfView

// on window load
jQuery(window).load(function() {

    // on task click
    $("#activityPage_3 > ul > li > a").click(function () {

        // closing the task
        if ($(this).parent().hasClass('selected')) {
            $(".taskList .selected .taskHeader img").attr("src","/tw_acatism/web/images/down.png"); // changing the arrow on down
            $(".taskList .selected .taskContent").slideUp(100); // sliding up
            $(".taskList .selected").removeClass("selected"); // task is no longer selected
        } else {

            // closing the other ones
            $(".taskList .selected .taskHeader img").attr("src","/tw_acatism/web/images/down.png");
            $(".taskList .selected .taskContent").slideUp(100);
            $(".taskList .selected").removeClass("selected");


    // opening the task
    if ($(this).next(".taskContent").length) {
    $(this).parent().addClass("selected"); //  task is selected
    $(".taskList .selected .taskHeader img").attr("src","/tw_acatism/web/images/up.png"); // changing the arrow on up
    $(".taskList .selected .taskContent").slideDown(200); // sliding down
     }
}
});

});
