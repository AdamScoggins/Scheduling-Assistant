// Add jQuery as a script
var jqueryScript = document.createElement('script');
jqueryScript.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
jqueryScript.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(jqueryScript);

// Send an AJAX request to main.php to add a new task
// into the JSON document
function addTask() {
    // TODO: Get all the variables here
    var timestamp = Date.now();
    var date = document.getElementById('date').value;
    var time_required = document.getElementById('time_required').value;
    var title = document.getElementById('title').value;
    var description = document.getElementById('description').value;

    // Make an AJAX request to create a new task
    $.post("php/main.php",
        {
            action: 'add',
            timestamp: timestamp,
            date: date,
            time_required: time_required,
            title: title,
            description: description
        },
        function (data, status) {
            // data holds the resulting data from the php
            // status is the status of the request
            if (status != 'success') {
                alert('There was an error with the given request.');
                return;
            }

            var resultObj = JSON.parse(data);
            console.log(resultObj);

            // There will either be an error or a success message
            if (resultObj.error != null) {
                alert(resultObj.error);
            } else {
                alert(resultObj.message);
            }
        });

    // Stops the web-page from redirecting
    return false;
}