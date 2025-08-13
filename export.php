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
require('fpdf.php');

// New object created and constructor invoked
$pdf = new FPDF();

// Add new pages. By default no pages available.
$pdf->AddPage();

// Set font format and font-size
$pdf->SetFont('Times', 'B', 20);

// Framed rectangular area
$pdf->Cell(176, 5, "".$row['name']."", 0, 0, 'C');

// Set it new line
$pdf->Ln();

// Set font format and font-size
$pdf->SetFont('Times', 'B', 12);

// Framed rectangular area
$pdf->Cell(176, 10, 'A Computer Science Portal for geek!', 0, 0, 'C');

// Close document and sent to the browser
$pdf->Output();

?>