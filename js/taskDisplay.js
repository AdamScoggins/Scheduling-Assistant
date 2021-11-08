function mouseOver() {
  document.getElementById("project1").style.color = "#63ca00";
  document.getElementById("project1").innerHTML =
  "Example title<br>A project.<br>10 hours to completion";
}
function mouseOut() {
  document.getElementById("project1").style.color = "black";
  document.getElementById("project1").innerHTML =
  "1<br>Example Title";
}
function assignTask(taskNumber) {
  taskInfo = JSON.parse(return getTasks()[taskNumber]);
  console.log(taskInfo)
}
