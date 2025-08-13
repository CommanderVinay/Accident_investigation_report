<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "incident_db";


    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM incident_reports";
    $result = $conn->query($sql);
    echo"<table>
        <tr>
            <th>Incident</th>
            <th>Name </th>
            <th>Emp ID</th>
            <th>View</th>
        </tr>";
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>".$row['incident']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['empid']."</td>
                    <td><a href='single.php?id=".$row['id']."'>View</a></td>
                </tr>
            ";
            
        }
        } else {
        echo "0 results";
        }

        echo"</table>";
        $conn->close();
?>