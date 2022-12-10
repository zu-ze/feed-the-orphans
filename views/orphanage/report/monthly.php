<?php 

// var_dump($sent, $approved);
// exit;

// echo Application::$ROOT_PATH;
// exit;

require_once(Application::$ROOT_PATH.'/public/vendor/fpdf/fpdf/fpdf.php');

$pdf = new FPDF('p', 'mm', 'A4');

$pdf->AddPage();

$pdf->Image(Application::$ROOT_PATH.'/public/images/mzunilogo.png', 85, 10, -200);

$pdf->SetFont('Arial', 'B', 14);

// cell(width, height, text, border, endline, [align])
$pdf->cell( 60, 40, "", 0, 1 );
$pdf->cell(190, 7.5, $test, 0, 1, 'C'); 
$pdf->cell( 60, 7.5, "", 0, 1 );


$pdf->SetFont('Arial', '', 12);

$pdf->cell(60, 7.5, Application::$app->session->getOrphanage()->name , 0, 1); 

$pdf->cell(60, 7.5, date('Y-m-d'), 0, 1);


$pdf->SetFont('Arial', '', 12);

$pdf->cell( 60, 7.5, "", 0, 1 );

$pdf->SetFont('Arial', 'B', 14);

$pdf->cell( 190, 7.5, date('F').' '.date('Y')." Report", 0, 1, 'C' );

$pdf->SetFont('Arial', '', 12);

$pdf->cell( 60, 7.5, "", 0, 1 );

// Table Header
$pdf->cell( 60, 7.5, "", 0, 0 );
$pdf->cell( 60, 7.5, "Number of Donations", 1, 0 , 'C');
$pdf->cell( 60, 7.5, "Amount(MK)", 1, 1, 'C' );
// Row 1
$pdf->cell( 60, 7.5, "Sent Donations", 0, 0, 'R' );
$pdf->cell( 60, 7.5, $sent['count'] , 1, 0, 'R' );
$pdf->cell( 60, 7.5, $sent['amount'] , 1, 1, 'R' );
// Row 2
$pdf->cell( 60, 7.5, "Approved Donations", 0, 0, 'R' );
$pdf->cell( 60, 7.5, $approved['count'] , 1, 0, 'R' );
$pdf->cell( 60, 7.5, $approved['amount'] , 1, 1, 'R' );
// Row 3
$pdf->cell( 60, 7.5, "", 0, 0 );
$pdf->cell( 60, 7.5, "Uncounted Inflow", 0, 0, 'R' );
$pdf->cell( 60, 7.5, $sent['amount'] - $approved['amount'] , 1, 1, 'R' );

$pdf->cell( 60, 7.5, "", 0, 1 );
$pdf->cell( 60, 7.5, ''/*"New donars: "*/, 0, 1 );
$pdf->cell( 60, 7.5, ''/*"Total donars: "*/, 0, 1 );

$pdf->cell( 60, 100, "", 0, 1 );

$pdf->cell( 190, 7.5, "Copyright FTO ". date('Y') , 0, 1, 'C' );

$pdf->Output('I', 'MonthlyReport-'.date("F")."-".date("Y-m-d-h-i-s"));

?>