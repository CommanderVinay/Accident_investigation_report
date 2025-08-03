<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "incident_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

///// Variables
// $name =$_POST['name'];
// $department =$_POST['department'];
// $empid =$_POST['empid'];

// Get all form variables
$incident = $_POST['incident'];
$date = $_POST['date'];
$time = $_POST['time'];
$name = $_POST['name'];
$empid = $_POST['empid'];
$gender = $_POST['gender'];
$department = $_POST['department'];
$contact_name = $_POST['contact_name'];
$shift_leader = $_POST['shift_leader'];
$plant = $_POST['plant'];
$incident_location = $_POST['incident_location'];
$other_location = $_POST['other_location'];
$machine = $_POST['machine'];
$manager = $_POST['manager'];
$shift = $_POST['shift'];
$accidentType = $_POST['accidentType'];
$fireClass = isset($_POST['fireClass']) ? $_POST['fireClass'] : '';
$other_comment = isset($_POST['other_comment']) ? $_POST['other_comment'] : '';
$bodyPart = $_POST['bodyPart'];
$other_body_part = isset($_POST['other_body_part']) ? $_POST['other_body_part'] : '';
$ppe = $_POST['ppe'];
$ppe_text = $_POST['ppe_text'];
$medicalTreatment = $_POST['medicalTreatment'];
$hospital_details = isset($_POST['hospital_details']) ? $_POST['hospital_details'] : '';
$containment_action = $_POST['containment_action'];
$why_problem = $_POST['why_problem'];
$whyReason1 = isset($_POST['whyReason1']) ? $_POST['whyReason1'] : '';
$whyReason2 = isset($_POST['whyReason2']) ? $_POST['whyReason2'] : '';
$whyReason3 = isset($_POST['whyReason3']) ? $_POST['whyReason3'] : '';
$whyReason4 = isset($_POST['whyReason4']) ? $_POST['whyReason4'] : '';
$whyReason5 = isset($_POST['whyReason5']) ? $_POST['whyReason5'] : '';




// Example SQL (add all fields you want to save)
$sql = "INSERT INTO incident_reports (
  incident, date, time, name, empid, gender, department, contact_name, shift_leader, plant, incident_location, other_location, machine, manager, shift, accidentType, fireClass, other_comment, bodyPart, other_body_part, ppe, ppe_text, medicalTreatment, hospital_details, containment_action, why_problem, whyReason1, whyReason2, whyReason3, whyReason4, whyReason5
) VALUES (
  '$incident', '$date', '$time', '$name', '$empid', '$gender', '$department', '$contact_name', '$shift_leader', '$plant', '$incident_location', '$other_location', '$machine', '$manager', '$shift', '$accidentType', '$fireClass', '$other_comment', '$bodyPart', '$other_body_part', '$ppe', '$ppe_text', '$medicalTreatment', '$hospital_details', '$containment_action', '$why_problem', '$whyReason1', '$whyReason2', '$whyReason3', '$whyReason4', '$whyReason5'
)";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);