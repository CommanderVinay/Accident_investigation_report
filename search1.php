<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "incident_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form submitted
if (isset($_POST['search'])) {
    $accidentType = $_POST['accidentType'] ?? '';
    $status = $_POST['status'] ?? '';

    // Build query with filters
    $sql = "SELECT date, name, employee_id, department, incident, incident_location, accident_type, status
            FROM incident_reports
            WHERE 1=1";

    if (!empty($accidentType)) {
        $sql .= " AND accident_type LIKE '%" . $conn->real_escape_string($accidentType) . "%'";
    }
    if (!empty($status)) {
        $sql .= " AND status LIKE '%" . $conn->real_escape_string($status) . "%'";
    }

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Employee ID</th>
                    <th>Department</th>
                    <th>Incident</th>
                    <th>Location</th>
                    <th>Accident Type</th>
                    <th>Status</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['date']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['employee_id']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['incident']}</td>
                    <td>{$row['incident_location']}</td>
                    <td>{$row['accident_type']}</td>
                    <td>{$row['status']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
}

$conn->close();
?>
