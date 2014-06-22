// on tasks Creation Form, if requireFile check box is not checked, then requireFileFormat checkbox can't be checked


// on document load
$("document").ready(function() {

    // requireFileFormat checkbox initially disabled
    $("#task_requireFileFormat").attr('disabled','disabled');

    // on requireFile checkbox change
    $("#task_requireFile").change(function() {

            // if is checked, requireFileFormat checkbox becomes active
            if ( $(this).prop('checked') == true )
                $("#task_requireFileFormat").removeAttr('disabled');

            // else if is unchecked, requireFileFormat checkbox becomes innactive
            else
                $("#task_requireFileFormat").attr('disabled','disabled');

        }
    );

});


