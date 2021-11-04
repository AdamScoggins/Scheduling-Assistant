<?php
// This file returns a JSON encoded array as a result

    // This is where the code begins execution
    if (!isset($_GET['action'])) {
        $result = array('error' => 'There is no action in the given request.');
        echo json_encode($result);
        return;
    }

    // Each GET request should have an action
    // The 'add' action is for adding a new task. This requires:
    // Timestamp, day, month, year, time_required, title, and description
    if ($_GET['action'] == 'add') {

        // If there are missing variables, return an error
        if (!isset($_GET['timestamp']) || !isset($_GET['day']) || !isset($_GET['month']) || !isset($_GET['year']) ||
            !isset($_GET['time_required']) || !isset($_GET['title']) || !isset($_GET['description'])) {
                $result = array('error' => 'There are missing variables.');
                echo json_encode($result);
                return;
        }

        addTask($_GET['timestamp'], $_GET['day'], $_GET['month'], $_GET['year'], $_GET['time_required'], $_GET['title'], $_GET['description']);
    }
    
    function addTask($timestamp, $day, $month, $year, $timeRequired, $title, $description) {
        $file = "data.json";

        try {
            // Get the file contents and convert it to JSON
            $fileData = file_get_contents($file);
            $arrayData = json_decode($fileData, true);

            // If there is no data present, create a new array
            if ($arrayData == null) {
                $arrayData = array();
            }

            // Create the new task array
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