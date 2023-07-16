jQuery(document).ready(function($) {
    // AJAX request to fetch project data.

    $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: {
        action: 'my_ajax_endpoint',
        },
     
        success: function(response) {

            console.log('AJAX request successful:', response);

            if (response.success) {
                var projects = response.data;

                // Handle the retrieved projects data here.
                console.log('Projects:', projects);
                //console.log(projects);
            } else {
                console.error('Error occurred while fetching projects.');
            }
        },
        error: function(xhr, textStatus, error) {
            console.error('AJAX request failed: ' + error);
        }
    });


});
