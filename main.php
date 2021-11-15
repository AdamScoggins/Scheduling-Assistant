<?php
session_start();
include("scripts/config.php");


if(!isset($_SESSION['username'] ) ){
  header("Location:index.php");
}


$mysqli = mysqli_connect('localhost', 'root', '', 'schedulingAssistant');
$current_user = strval($_SESSION['username']);
$all_tasks = mysqli_query($mysqli, "SELECT * FROM tasks WHERE username='$current_user' and completed=0 ORDER BY year ASC,month ASC,day ASC;");

if(isset($_POST['newtask'])){
	$title = mysqli_real_escape_string($mysqli, $_POST['tasktitle']);
  $description = mysqli_real_escape_string($mysqli, $_POST['description']);
  $time_required = mysqli_real_escape_string($mysqli, $_POST['time_required']);
  $date = mysqli_real_escape_string($mysqli, $_POST['date']);
  $orderdate = explode('-', $date);
  $year = $orderdate[0];
  $month   = $orderdate[1];
  $day  = $orderdate[2];
	$same_task = mysqli_query($mysqli,"SELECT * FROM tasks WHERE username='$current_user' and title='$title' and description='$description' and timeRequired='$time_required' and day=$day and month=$month and year=$year;");

	if (!$same_task || mysqli_num_rows($same_task) == 0){

    if(empty($title) || empty($description) || empty($time_required) ) {
        echo "error";
    } else {
      $newTask = mysqli_query($mysqli, "INSERT INTO tasks(username,title,description,timeRequired,day,month,year,completed) VALUES('$current_user','$title','$description','$time_required',$day,$month,$year,0)");

      if(!$newTask){
        echo '<script>alert("Task Id Already Exist. Data Not inserted")</script>';
      }

      $mysqli->close();
      header("Refresh:0");

      }

	}
	else{
    echo '<script>alert("Same Task Already Exist.")</script>';
		$mysqli->close();
		header("Refresh:0");
	}

}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Scheduling Assistant</title>
  <link rel="shortcut icon" type="image/ico" href="images/favicon.ico"/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">

  <!-- Bootstrap Stylesheets  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


  <!-- jquey and ajax Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <script type="text/javascript" src="js/tasksApi.js"></script>
  <script type="text/javascript" src="js/taskDisplay.js"></script>

</head>


<body>



  <section class="colored-section" id="title">

  <div class="container-fluid">

    <!-- Nav Bar -->

    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="">TS-Assistant</a>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarToggler">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#addnewtask">Add New Tasks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#yourtasks">Your Tasks</a>
          </li>

          <li class="nav-item">
              <a class="nav-link" href="scripts/logout.php">
                <button class="btn btn-warning"> Logout</button>
              </a>
          </li>

        </ul>

      </div>

    </nav>



    <div class="row">

      <div class="col-lg-6">
        <?php echo "<h1> Welcome ".ucfirst($_SESSION['username'])."</h1>";?>
        <!-- <h1 class="med-heading">Task Scheduling Assistant</h1> -->
        <h4 class="sub-heading">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
          </h4>
      </div>

      <div class="col-lg-6">
        <img class="title-image" src="images/task.jpg" alt="Task Management">
      </div>

    </div>




  </div>

</section>




<!-- Add New Task -->

<section class="white-section" id="addnewtask">
  <div class="container-fluid">

 <h1> Add New Task</h1>



<form id="AddNewTaskForm" method="post" name="AddNewTaskForm"">




    <div class="col-lg-12 task_detais">
        <b>Task Name : </b>
    </div>
    <div class="col-lg-12">
        <input required align="left" placeholder="Enter Task Name" type="text" name="tasktitle" id="tasktitle"> <br/><br/>
    </div>




    <div class="col-lg-12 task_detais">
        <b>Task Description : </b>
    </div>

    <div class="col-lg-12 ">
      <textarea required type="text" rows="5"  placeholder="Enter Task Description" name="description" id="description"></textarea>
        <br><br>
    </div>


    <div class="col-lg-12 task_detais">
        <b>Time Required : </b>
    </div>
    <div class="col-lg-12">
      <input required type="number" name="time_required" id="time_required" placeholder="Enter Task Required Time" min="1" max="9999">
        <br><br>
    </div>

    <div class="col-lg-12 task_detais">
        <b>Date: </b>
    </div>
    <div class="col-lg-12">
      <input required type="date" name="date" id="date">
        <br><br>
    </div>







  <button type="submit" class="btn btn-dark btn-md" name="newtask" id="TaskSubmit">Submit</button>

</form>

</div>

</section>



<!-- task tracker -->


<section class="colored-section" id="yourtasks">

<div class="container-fluid">



  <div class="row">

    <div class="col-lg-6 col-md-12 col-sm-12">
      <h1 class="med-heading">Task Tracker</h1>
    </div>

<!-- task 1 -->

<?php
while($res = mysqli_fetch_array($all_tasks)) {
  echo "<div class='col-lg-12 user_tasks'>";
  echo "<center>

  <div><a href=\"TaskEdit.php?id=$res[taskid]\"><button class='btn btn-warning'>Update</button></a> ||
  <a href=\"TaskDelete.php?id=$res[taskid]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button class='btn btn-warning'>Delete</button></a> ||
  <a href=\"TaskComplete.php?id=$res[taskid]\" onClick=\"return confirm('Are you sure you to mark task as completed?')\"><button class='btn btn-warning'>Mark As Completed</button></a></div>
  </center>
  ";

    echo "<div>";
    echo "<b>".'Title :'."</b>";
        echo "<p>".$res['title']. "</p>";
    echo "</div>";

    echo "<div>";
    echo "<b>".'Description :'."</b>";
        echo "<p>".$res['description']. "</p>";
    echo "</div>";

    echo "<div>";
    echo "<b>".'Time Required :'."</b>";
        echo "<p>".$res['timeRequired'].' hr'."</p>";
    echo "</div>";

    echo "<div>";
    echo "<b>".'Date :'."</b>";
        echo "<p>".$res['day'].'/'.$res['month'].'/'.$res['year']."</p>";
    echo "</div>";



  echo "</div>";

}
$mysqli->close();

?>

  </div>

</div>

</section>










<!-- footer -->

<footer class="white-section" id="footer">

<div class="container-fluid">
  <a href="https://www.youtube.com/" target="_blank"><i class="social-icon fab fa-facebook"></i></a>
  <a href="https://www.youtube.com/" target="_blank"><i class="social-icon fab fa-twitter"></i></a>
  <a href="https://www.youtube.com/" target="_blank"><i class="social-icon fab fa-instagram"></i></a>
  <a href="https://www.youtube.com/" target="_blank"><i class="social-icon fas fa-envelope"></i></a>
  <p class="footer-text">© Copyright 2021 || Task Scheduling</p>
</div>
</footer>


</body>

</html>
