$("document").ready(function() {
    $(".actionApply").click(function(evt){
        evt.preventDefault();

        var id = $(this).attr("id").split("_")[1];
        var link = $("#applyLink_" + id).attr("href");
        $("#applyLink_" + id).removeAttr("href");
        var button = $(this).find("button");
        console.log(button);
        $(button).addClass("disabled");

        $.ajax({
            url: link,
            type: "POST",
            dataType: "text",
            success: function(result){
                console.log(result);
                $("#applyButton_" + id).addClass("hidden");
                $("#cancelButton_" + id).removeClass("hidden");
            },
            error: errorFn,
            complete: function(xhr, result) {
                $("#applyLink_" + id).attr("href", link);
                $(button).removeClass("disabled");
            }
        });
    });

    $(".actionCancel").click(function(evt){
        evt.preventDefault();

        var id = $(this).attr("id").split("_")[1];
        var link = $("#cancelLink_" + id).attr("href");

        $("#cancelLink_" + id).removeAttr("href");
        var button = $(this).find("button");
        $(button).addClass("disabled");

        $.ajax({
            url: link,
            type: "POST",
            dataType: "text",
            success: function(result){
                console.log(result);
                $("#applyButton_" + id).removeClass("hidden");
                $("#cancelButton_" + id).addClass("hidden");
            },
            error: errorFn,
            complete: function(xhr, result) {
                $("#cancelLink_" + id).attr("href", link);
                $(button).removeClass("disabled");
            }
        });
    });
});

function errorFn(xhr, status, strErr) {
    console.log("Error.");

}