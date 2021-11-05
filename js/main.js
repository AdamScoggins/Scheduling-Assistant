// Add jQuery as a script
var jqueryScript = document.createElement('script');
jqueryScript.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
jqueryScript.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function addTask() {
    // TODO: Get all the variables here
    var timestamp = Date.now();
    var day;
    var month;
    var year;
    var time_required;
    var title;
    var description;

    // Make an AJAX request to create a new task
    $.post("php/main.php",
        {
            timestamp: timestamp,
            day: day,
            month: month,
            year: year,
            time_required: time_required,
            title: title,
            description: description
        },
        function (data, status) {
            // data holds the resulting data from the php
            // status is the status of the request
        });
    // 
}