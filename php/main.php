<?php
// This file returns a JSON encoded array as a result

    // This is where the code begins execution
    if (!isset($_POST['action'])) {
        $result = array('error' => 'There is no action in the given request.');
        echo json_encode($result);
        return;
    }

    // Each post request should have an action
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

        addTask($_POST['timestamp'], $_POST['day'], $_POST['month'], $_POST['year'], $_POST['time_required'], $_POST['title'], $_POST['description']);
    }
    
    function addTask($timestamp, $day, $month, $year, $timeRequired, $title, $description) {
        $file = "data.json";

        try {
            // Get the file contents and convert it to JSON
            $fileData = file_get_contents($file);
            $arrayData = json_decode($fileData, true);
            $newTask = array('timestamp' => $timestamp, 
                                'day' => $day,
                                'month' => $month,
                                'year' => $year,
                                'time_required' => $timeRequired,
                                'title' => $title,
                                'description' => $description);

            // Add the new task into the array then encode it into JSON
            array_push($arrayData, $newTask);
            $fileData = json_encode($arrayData);

            // Attempt to replace the contents of the file with the added task
            if (file_put_contents($file, $fileData)) {
                $result = array('message' => 'Task added successfully!');
                echo json_encode($result);
            } else {
                $result = array('error' => 'Task could not be added.');
                echo json_encode($result);
            }
        } catch (Exception $e) {
            $result = array('error' => $e->getMessage());
            echo json_encode($result);
        }
    }
?>