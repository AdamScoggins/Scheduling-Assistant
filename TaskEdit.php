<?php
// including the database connection file
include("scripts/config.php");

if(isset($_POST['update'])){

  $title = mysqli_real_escape_string($conn, $_POST['tasktitle']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $time_required = mysqli_real_escape_string($conn, $_POST['time_required']);
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $orderdate = explode('-', $date);
  $year = $orderdate[0];
  $month   = $orderdate[1];
  $day  = $orderdate[2];


	// checking empty fields
  if(empty($title) || empty($description) || empty($time_required) ) {
      echo "error";

	} else {
    $compareid=$_GET['id'];

    $update = mysqli_query($conn, "UPDATE tasks SET taskid='$compareid',title='$title',description='$description',timeRequired='$time_required',day='$day',month='$month',year='$year' WHERE taskid=$compareid");

		if(!$update){
			echo '<script>alert("Data Not Updated")</script>';
		}
		$conn->close();
		//redirectig to the display page. In our case, it is index.php
		header("Location: main.php");
	}
}
?>


<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM tasks WHERE taskid=$id");

while($res = mysqli_fetch_array($result)){
	$title = $res['title'];
	$description = $res['description'];
	$timeRequired = $res['timeRequired'];
	$day = $res['day'];
  $month = $res['month'];
  $year = $res['year'];
  $currDate = strval($year)."/".strval($month)."/".strval($day);
  


}
$conn->close();
?>


<html>
<head>
	<title>Update Data</title>
  <link rel="shortcut icon" type="image/ico" href="./images/favicon.ico"/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">

  <!-- CSS Stylesheets -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <!-- Bootstrap Scripts -->


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




</head>

<body>

  <section class="white-section" id="addnewtask">
    <div class="container-fluid">

   <h1> Update The Task</h1>



  <form id="AddNewTaskForm" method="post" name="AddNewTaskForm"">



      <div class="col-lg-12 task_detais">
          <b>Task Name : </b>
      </div>
      <div class="col-lg-12">
          <input required align="left" placeholder="Enter Task Name" type="text" name="tasktitle" id="tasktitle" value="<?php echo $title;?>"> <br/><br/>
      </div>




      <div class="col-lg-12 task_detais">
          <b>Task Description : </b>
      </div>

      <div class="col-lg-12 ">
        <textarea required type="text" rows="5"  placeholder="Enter Task Description" name="description" id="description" > <?=$description?> </textarea>
          <br><br>
      </div>


      <div class="col-lg-12 task_detais">
          <b>Time Required : </b>
      </div>
      <div class="col-lg-12">
        <input required type="number" name="time_required" id="time_required" placeholder="Enter Task Required Time" min="1" max="9999" value="<?php echo $timeRequired;?>">
          <br><br>
      </div>

      <div class="col-lg-12 task_detais">
          <b>Date: </b>
      </div>
      <div class="col-lg-12">
        <input required type="date" name="date" id="date" value="<?php echo date('Y-m-d',strtotime($currDate)) ?>" >
          <br><br>
      </div>







    <button type="submit" class="btn btn-dark btn-md" name="update" id="update">Submit</button>

  </form>

  </div>

  </section>








</body>
</html>
