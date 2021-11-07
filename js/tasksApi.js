// Add jQuery as a script
var jqueryScript = document.createElement('script');
jqueryScript.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
jqueryScript.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(jqueryScript);

// Send an AJAX request to main.php to add a new task
// into the JSON document
function addTask() {
    var action = 'add';
    var timestamp = Date.now();
    var date = document.getElementById('date').value;
    var time_required = document.getElementById('time_required').value;
    var title = document.getElementById('title').value;
    var description = document.getElementById('description').value;

    console.log('Starting ajax request');
    // Make an AJAX request to create a new task
    // $.post("php/tasks.php",

    //     {
    //         action,
    //         timestamp,
    //         date,
    //         time_required,
    //         title,
    //         description
    //     },
    //     function (data, status) {
    //         // data holds the resulting data from the php
    //         // status is the status of the request
    //         if (status != 'success') {
    //             alert('There was an error with the given request.');
    //             console.log('AJAX status is: unsuccessful');
    //             return;
    //         }

    //         var resultObj = JSON.parse(data);
    //         console.log(resultObj);

    //         // There will either be an error or a success message
    //         if (resultObj.error != null) {
    //             console.log(resultObj.error);
    //             alert(resultObj.error);
    //         } else {
    //             alert(resultObj.message);
    //         }
    //     });

    //     console.log('Finished ajax request');
    // Stops the web-page from redirecting
    //return false;

    // new
    $.ajax({
        type: "POST",
        url: "php/tasks.php",
        data: {
            action,
            timestamp,
            date,
            time_required,
            title,
            description
        },
        headers: { "Access-Control-Allow-Origin": "*" },
        success: function (data, status) {
            // data holds the resulting data from the php
            // status is the status of the request
            if (status != 'success') {
                alert('There was an error with the given request.');
                console.log('AJAX status is: unsuccessful');
                return;
            }

            var resultObj = JSON.parse(data);
            console.log(resultObj);

            // There will either be an error or a success message
            if (resultObj.error != null) {
                console.log(resultObj.error);
                alert(resultObj.error);
            } else {
                alert(resultObj.message);
            }
        }
    });

    return false;
}

function getTasks() {
    var action = 'getTasks';

    $.post("php/tasks.php",
        { action },
        function (data, status) {
            if (status != 'success') {
                alert('There was an error with the given request.');
                console.log('AJAX status is: unsuccessful');
                return false;
            }

            var resultObj = JSON.parse(data);
            console.log(resultObj);

            // There is either an error or a tasks property
            if (resultObj.error != null) {
                alert(resultObj.error);
                console.log(resultObj.error);
            } else {
                var tasks = resultObj.tasks;
                return tasks;
            }
        });

}