var $ =jQuery.noConflict();
$(document).ready(function() {
    $("#session_date").datepicker();   
    $("#session_start_time").timepicker();
    $("#session_end_time").timepicker();
    
    $("#session_conference").on('change', function() {	    
            var conference = $(this).val();
           
            if(conference != "") {
                var conference_data = {"action": "get_tracks", "conference":conference}; 
                $.ajax({
                    type: 'POST',   // Adding Post method
                    url: ajaxurl, // Including ajax file
                    data: conference_data, // Sending data dname to post_word_count function.
                    success: function(data){ // Show returned data using the function.
                         //alert(data);
                         //console.log(data);
                         $("#session_tracks_container").html(data);
                    }
                });
            }
    });
    
    $("#meta_inner_session").sortable({
            helper: function(e, ui) {
                ui.children().each(function() {
                    $(this).width($(this).width());
                });
                return ui;
            },
            scroll: true,
            stop: function(event, ui) {
                                      
            }
        });
});


