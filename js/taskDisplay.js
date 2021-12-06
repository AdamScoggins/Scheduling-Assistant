var currentMonth = 12;
var currentDate = new Date("2021-12-01");

function displayTask(taskNumber) {
  taskInfo = getTasks()[taskNumber];
  title = taskInfo.title;
  timeRequired = taskInfo.time_required;
  desc = taskInfo.description;
  date = taskInfo.date;
  day = date.charAt(8);
  projectID = "project2"

  selectedDay = document.getElementById("calendar").getElementsByTagName("li")[parseInt(day)];
  selectedDay.innerHTML = parseInt(day)+1+"<br>"+title+"<br>"+desc+"<br>"+timeRequired+" hours to completion";
  selectedDay.onmouseover = "mouseOver(project2)";
  selectedDay.onmouseout = "mouseOut(project2)";
  selectedDay.id = "project2";
  //todo:update mouseOver() and mouseOut()
}
function displayAllTasks() {
  taskList = getTasks();
  //console.log(taskList);
  for (i in taskList) {
    title = taskList[i].title;
    timeRequired = taskList[i].time_required;
    desc = taskList[i].description;
    date = taskList[i].date;

    if (date.charAt(8) == "0")
      day = parseInt(date.charAt(9));
    else
      day = parseInt(date.charAt(8)+date.charAt(9));
      console.log(date.substring(0,4));
      console.log(currentDate.getFullYear());
    if ((date.substring(5,7) == currentDate.getMonth()+1) && (date.substring(0,4) == currentDate.getFullYear() )) {
      selectedDay = document.getElementById("calendar").getElementsByTagName("li")[day-1];
      if (desc != "") {
        selectedDay.innerHTML = day+"<br>"+title+"<br>"+desc+"<br>"+timeRequired+" hours";
      }
      else
      selectedDay.innerHTML = day+"<br>"+title+"<br>"+timeRequired+" hours left<br><br>";
    }
  }
}

function displayMonth(month) {
  //Update calendar header to display current month
  document.getElementById("calendarHeader").innerHTML = month.toLocaleString("en-US", { month: "long" });
  //Get last day of month
  lastDay = new Date(month.getYear(),month.getMonth()+1,0).getDate();
  //Go from first day of month to last day of month and populate calendar with dates
  for (let i = 0; i < 31; i++) {
    selectedDay = document.getElementById("calendar").getElementsByTagName("li")[i];
    selectedDay.innerHTML = i+1+"<br><br><br><br>";
    if (i >= lastDay) {
      selectedDay.innerHTML = "";
    }
  }
}

function startup() {
  displayMonth(new Date());
  displayAllTasks();
  currentDate = new Date();
}

function incrementMonth(increment) {
    currentMonth = currentMonth + increment;
    currentDate = new Date("2021",currentMonth,"03");
    displayMonth(currentDate);
    displayAllTasks();
}
