<?php
//including the database connection file
include("scripts/config.php");

//getting id of the data from url
$id = $_GET['id'];

//updating the row from table
$update = mysqli_query($conn, "UPDATE tasks SET completed=1 WHERE taskid=$id");


$conn->close();

//redirecting to the display page (index.php in our case)
header("Location:main.php");
header("Refresh:0");
?>
