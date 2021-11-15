<?php
//including the database connection file
include("scripts/config.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM tasks WHERE taskid=$id");

$conn->close();

//redirecting to the display page (index.php in our case)
header("Location:main.php");
header("Refresh:0");
?>
