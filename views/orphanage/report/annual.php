<?php 

// echo '<pre>';
// var_dump($months);
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

$pdf->cell( 190, 7.5, date('Y')." Annual Report", 0, 1, 'C' );

$pdf->SetFont('Arial', '', 12);

$pdf->cell( 60, 7.5, "", 0, 1 );

$cal = array(
    1 => 'jan',
    2 => 'feb',
    3 => 'mar',
    4 => 'apr',
    5 => 'may',
    6 => 'jun',
    7 => 'jul',
    8 => 'aug',
    9 => 'sep',
    10 => 'oct',
    11 => 'nov',
    12 => 'dec'
);

// Table Header
$pdf->cell( 20, 7.5, "Month", 1, 0 );
$pdf->cell( 36, 7.5, "Sent Donations", 1, 0 );
$pdf->cell( 36, 7.5, "Sent Amount(Mk)", 1, 0 );
$pdf->cell( 45, 7.5, "Approved Donations", 1, 0 );
$pdf->cell( 45, 7.5, "Approved Amount(MK)", 1, 1 );

$sentCountTotal = 0;
$sentAmountTotal = 0;
$approvedCountTotal = 0;
$approvedAmountTotal = 0;
// Row 1
foreach ($months as $month => $details) {
    $pdf->cell( 20, 7.5, $cal[$month], 1, 0, 'C' );
    $pdf->cell( 36, 7.5, $details['sent']['count'], 1, 0, 'R' );
    $pdf->cell( 36, 7.5, $details['sent']['amount'] ?? '0.00', 1, 0, 'R' );
    $pdf->cell( 45, 7.5, $details['approved']['count'], 1, 0, 'R' );
    $pdf->cell( 45, 7.5, $details['approved']['amount'] ?? '0.00', 1, 1, 'R' );
    $sentCountTotal += $details['sent']['count'] ?? 0;
    $sentAmountTotal += $details['sent']['amount'] ?? 0;
    $approvedCountTotal += $details['approved']['count'] ?? 0;
    $approvedAmountTotal += $details['approved']['amount'] ?? 0;
}
$pdf->cell( 20, 7.5, 'Total', 0, 0, 'R' );
$pdf->cell( 36, 7.5, $sentCountTotal, 1, 0, 'R' );
$pdf->cell( 36, 7.5, $sentAmountTotal, 1, 0, 'R' );
$pdf->cell( 45, 7.5, $approvedCountTotal, 1, 0, 'R' );
$pdf->cell( 45, 7.5, $approvedAmountTotal, 1, 1, 'R' );


$pdf->cell( 60, 7.5, "", 0, 1 );
$pdf->cell( 60, 7.5, ''/*"New donars: "*/, 0, 1 );
$pdf->cell( 60, 7.5, ''/*"Total donars: "*/, 0, 1 );

$pdf->cell( 60, 35, "", 0, 1 );

$pdf->cell( 190, 7.5, "Copyright FTO ". date('Y') , 0, 1, 'C' );




$pdf->Output('I', 'AnnualReport-'.date("Y-m-d-h-i-s"));

?>