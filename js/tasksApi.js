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
    $.post("php/tasks.php",

        {
            action,
            timestamp,
            date,
            time_required,
            title,
            description
        },
        function (data, status) {
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
        });

    console.log('Finished ajax request');
    // Stops the web-page from redirecting
    return false;
}

function fetchTasks() {
    var action = 'getTasks';

    // $.ajax("php/tasks.php",
    //     { action },
    //     function (data) {
    //         var resultObj = JSON.parse(data);

    //         // There is either an error or a tasks property
    //         if (resultObj.error != null) {
    //             alert(resultObj.error);
    //             console.log(resultObj.error);
    //         } else {
    //             var tasks = resultObj.tasks;
    //             console.log(tasks);
    //             return tasks;
    //         }
    //     });

    $.ajax({
        url: 'php/tasks.php',
        type: 'POST',
        data: { action },
        success: function (data) {
            var resultObj = JSON.parse(data);

            // There is either an error or a tasks property
            if (resultObj.error != null) {
                alert(resultObj.error);
                console.log(resultObj.error);
            } else {
                var tasks = resultObj.tasks;
                console.log(tasks);
                storeTasks(tasks);
            }
        }
    });
}

// Handles the fetchTasks ajax result data by setting tasks in local storage
function storeTasks(tasks) {
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

function getTasks() {
    return localStorage.getItem('tasks');
}