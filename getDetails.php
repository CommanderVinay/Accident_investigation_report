<?php
require_once 'logIn.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = "SELECT * FROM incident_reports WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No record found"]);
    }
} else {
    echo json_encode(["error" => "No ID provided"]);
}


?>