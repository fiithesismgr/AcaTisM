jQuery(window).load(function() {

    $("#activityPage_1 > ul > li > a").click(function () { // binding onclick

        if ($(this).parent().hasClass('selected')) {
            $(".projectList .selected .projectHeader img").attr("src","/tw_acatism/web/images/down.png");
            $(".projectList .selected .projectContent").slideUp(100); // hiding popups
            $(".projectList .selected").removeClass("selected");
        } else {
            $(".projectList .selected .projectHeader img").attr("src","/tw_acatism/web/images/down.png");
            $(".projectList .selected .projectContent").slideUp(100); // hiding popups
            $(".projectList .selected").removeClass("selected");

            if ($(this).next(".projectContent").length) {
                $(this).parent().addClass("selected"); // display popup
                $(".projectList .selected .projectHeader img").attr("src","/tw_acatism/web/images/up.png");
                $(".projectList .selected .projectContent").slideDown(200);
            }
        }
    });

});
