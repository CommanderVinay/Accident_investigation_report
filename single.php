<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "incident_db";


    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

        $id=$_GET['id'];
    $sql = "SELECT * FROM incident_reports WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

?>

<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="style.css" />

    </head>
    <body>
        <section>
            <div class="container">
                <div class="">
                    <div class="">
                        <h2><?php echo $row['name']?></h2>
                        <h2><?php echo $row['empid']?></h2>
                        <?php
                            echo"<a href='export.php?id=".$row['id']."'>PDF</a>";
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </body> 

</html>
