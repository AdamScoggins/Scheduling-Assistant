<?php
// This file returns a JSON encoded array as a result

    // Each post should have an action
    if (isset($_POST['action'])) {

        // The 'add' action is for adding a new task. This requires:
        // Timestamp, day, month, year, time_required, title, and description
        if ($_POST['action'] == 'add') {
            // If there are missing variables, return an error
            if (!isset($_POST['timestamp']) || !isset($_POST['day']) || !isset($_POST['month']) || !isset($_POST['year']) ||
                !isset($_POST['time_required']) || !isset($_POST['title']) || !isset($_POST['description'])) {
                    $result = array('error' => 'There are missing variables.');
                    echo json_encode($result);
                    return;
                }
        }
    }

?>