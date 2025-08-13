<?php
require('fpdf.php');

// Get submitted data (assuming POST)
$incidentType = $_POST['incidentType'] ?? '';
$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';
$name = $_POST['name'] ?? '';
$empid = $_POST['empid'] ?? '';
$gender = $_POST['gender'] ?? '';
$department = $_POST['department'] ?? '';
$contact_name = $_POST['contact_name'] ?? '';
$shift_leader = $_POST['shift_leader'] ?? '';
$plant = $_POST['plant'] ?? '';
$incident_location = $_POST['incident_location'] ?? ($_POST['other_location'] ?? '');
$machine = $_POST['machine'] ?? '';
$manager = $_POST['manager'] ?? '';
$shift = $_POST['shift'] ?? '';
$accidentType = $_POST['accidentType'] ?? ($_POST['other_comment'] ?? '');
$bodyPart = $_POST['bodyPart'] ?? ($_POST['other_body_part'] ?? '');
$ppe = $_POST['ppe'] ?? '';
$ppe_text = $_POST['ppe_text'] ?? '';
$medicalTreatment = $_POST['medicalTreatment'] ?? '';
$hospital_details = $_POST['hospital_details'] ?? '';
$containment_action = $_POST['containment_action'] ?? '';
$why_problem = $_POST['why_problem'] ?? '';
$whyReason1 = $_POST['whyReason1'] ?? '';
$whyReason2 = $_POST['whyReason2'] ?? '';
$whyReason3 = $_POST['whyReason3'] ?? '';
$whyReason4 = $_POST['whyReason4'] ?? '';
$whyReason5 = $_POST['whyReason5'] ?? '';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Incident/Accident/Injury & Ill Health Report',0,1,'C');
$pdf->SetFont('Arial','',12);

// Table-like output
$pdf->Cell(60,8,'Incident Type:',0,0); $pdf->Cell(0,8,$incidentType,0,1);
$pdf->Cell(60,8,'Date:',0,0); $pdf->Cell(0,8,$date,0,1);
$pdf->Cell(60,8,'Time:',0,0); $pdf->Cell(0,8,$time,0,1);
$pdf->Cell(60,8,'Employee Name:',0,0); $pdf->Cell(0,8,$name,0,1);
$pdf->Cell(60,8,'Employee ID:',0,0); $pdf->Cell(0,8,$empid,0,1);
$pdf->Cell(60,8,'Gender:',0,0); $pdf->Cell(0,8,$gender,0,1);
$pdf->Cell(60,8,'Department:',0,0); $pdf->Cell(0,8,$department,0,1);
$pdf->Cell(60,8,'Contact Name:',0,0); $pdf->Cell(0,8,$contact_name,0,1);
$pdf->Cell(60,8,'Shift Leader:',0,0); $pdf->Cell(0,8,$shift_leader,0,1);
$pdf->Cell(60,8,'Plant Location:',0,0); $pdf->Cell(0,8,$plant,0,1);
$pdf->Cell(60,8,'Incident Location:',0,0); $pdf->Cell(0,8,$incident_location,0,1);
$pdf->Cell(60,8,'Machine:',0,0); $pdf->Cell(0,8,$machine,0,1);
$pdf->Cell(60,8,'Manager:',0,0); $pdf->Cell(0,8,$manager,0,1);
$pdf->Cell(60,8,'Shift:',0,0); $pdf->Cell(0,8,$shift,0,1);
$pdf->Cell(60,8,'Accident Type:',0,0); $pdf->Cell(0,8,$accidentType,0,1);
$pdf->Cell(60,8,'Affected Body Part:',0,0); $pdf->Cell(0,8,$bodyPart,0,1);
$pdf->Cell(60,8,'PPE Used:',0,0); $pdf->Cell(0,8,$ppe.' ('.$ppe_text.')',0,1);
$pdf->Cell(60,8,'Medical Treatment:',0,0); $pdf->Cell(0,8,$medicalTreatment.($hospital_details ? ' ('.$hospital_details.')' : ''),0,1);
$pdf->Cell(60,8,'Immediate Containment Action:',0,0); $pdf->Cell(0,8,$containment_action,0,1);
$pdf->Cell(60,8,'5 Why Problem:',0,0); $pdf->Cell(0,8,$why_problem,0,1);
$pdf->Cell(60,8,'Why 1:',0,0); $pdf->Cell(0,8,$whyReason1,0,1);
$pdf->Cell(60,8,'Why 2:',0,0); $pdf->Cell(0,8,$whyReason2,0,1);
$pdf->Cell(60,8,'Why 3:',0,0); $pdf->Cell(0,8,$whyReason3,0,1);
$pdf->Cell(60,8,'Why 4:',0,0); $pdf->Cell(0,8,$whyReason4,0,1);
$pdf->Cell(60,8,'Why 5:',0,0); $pdf->Cell(0,8,$whyReason5,0,1);

$pdf->Output('D', 'incident_report_preview.pdf');
exit;
?>
