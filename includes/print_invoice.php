<?php

require('fpdf.php');
use Carbon\Carbon;


    class PDF extends FPDF {
// Page header
        function Header()
        {
            $basePath = __DIR__.'/../';

            // Logo
            $this->Image($basePath.'public/img/header.jpg',50,6,100);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Ln(20);
        }

// Page footer
        function Footer()
        {
            $this->Line(5,245,205,245);
            $this->SetY(-50);
            $this->SetX(50);
            $this->Cell(50,3,'PLEASE NOTE THAT THIS IS A C.O.D INVOICE AND IS PAYABLE IMMEDIATELY',0,0,'L');
            $this->SetY(-45);
            $this->SetX(55);
            $this->Cell(50,3,'PLEASE EMAIL PROOF OF PAYMENT TO ACCOUNT2@NAMEX.CO.ZA',0,0,'L');
            $this->SetY(-35);
            $this->SetX(5);
            $this->Cell(50,3,'BANK DETAILS',1,0,'C');
            $this->SetY(-30);
            $this->SetX(5);
            $this->Cell(50,3,'NEDBANK - BUSINESS EAST RAND',0,0,'L');
            $this->SetY(-25);
            $this->SetX(5);
            $this->Cell(50,3,'ACCOUNT NUMBER: 1288 045 670',0,0,'L');
            $this->SetY(-20);
            $this->SetX(5);
            $this->Cell(50,3,'BRANCH CODE: 128842',0,0,'L');

            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }

}

    $y_axis = 104;
    $today = Carbon::today()->toDateString();
    $docFee = $docCount * 95;

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',8);
    $pdf->SetY(26);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'NAMIBIA EXPRESS',0,1,'L');
    $pdf->SetY(29);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'UNIT 5 AVON BUSINESS PARK',0,0,'L');
    $pdf->SetY(32);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'MALCOLM MOODIE CRESCENT, JET PARK',0,0,'L');
    $pdf->SetY(35);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'TEL: 011 397 3360',0,0,'L');
    $pdf->SetY(38);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'TEL: 011 397 8715',0,0,'L');
    $pdf->SetY(41);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'VAT REG: 3225236-01-5 (NAM)',0,0,'L');
    $pdf->SetY(44);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'VAT REG: 4430193435',0,0,'L');
    $pdf->SetY(50);
    $pdf->SetX(180);
    $pdf->Cell(20,3,'DATE:',0,0,'L');
    $pdf->SetY(50);
    $pdf->SetX(190);
    $pdf->Cell(20,3,$today,0,0,'L');
    $pdf->SetY(55);
    $pdf->SetX(85);
    $pdf->Cell(50, 3, 'TAX INVOICE ' . $waybill[0]->waybill_no,0,0,'L');

    $pdf->SetY(60);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'TO:',0,0,'L');
    $pdf->SetY(60);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$client[0]->comp_name,0,0,'L');
    $pdf->SetY(63);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$client[0]->address1." ".$client[0]->address2,0,0,'L');
    $pdf->SetY(66);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$client[0]->city,0,0,'L');
    $pdf->SetY(69);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$client[0]->country,0,0,'L');
    $pdf->SetY(72);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'TEL:',0,0,'L');
    $pdf->SetY(72);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$client[0]->codet." ".$client[0]->tel,0,0,'L');
    $pdf->SetY(75);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'EMAIL:',0,0,'L');
    $pdf->SetY(75);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$client[0]->comp_name,0,0,'L');
    $pdf->SetY(78);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'ATT:',0,0,'L');
    $pdf->SetY(78);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$client[0]->comp_name,0,0,'L');
    $pdf->SetY(90);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'WAYBILL NUMBER',1,0,'C');
    $pdf->SetY(90);
    $pdf->SetX(80);
    $pdf->Cell(50,3,'DESCRIPTION',1,0,'C');
    $pdf->SetY(90);
    $pdf->SetX(155);
    $pdf->Cell(50,3,'AMOUNT',1,0,'C');
$pdf->SetY(95);
$pdf->SetX(5);
$pdf->Cell(50,3,$waybill[0]->waybill_no,0,0,'C');
$pdf->SetY(95);
$pdf->SetX(80);
$pdf->Cell(50,3,'FREIGHT',0,0,'C');
$pdf->SetY(95);
$pdf->SetX(155);
$pdf->Cell(50,3,'R '.$freight,0,0,'C');
$pdf->SetY(98);
$pdf->SetX(80);
$pdf->Cell(50,3,'DOCUMENTATION FEE',0,0,'C');
$pdf->SetY(98);
$pdf->SetX(155);
$pdf->Cell(50,3,'R '.$docFee,0,0,'C');
$pdf->SetY(101);
$pdf->SetX(80);
$pdf->Cell(50,3,'FUEL SURCHARGE',0,0,'C');
$pdf->SetY(101);
$pdf->SetX(155);
$pdf->Cell(50,3,'R '.$fuelSurcharge,0,0,'C');
if ($vat){
    $pdf->SetY($y_axis);
    $pdf->SetX(80);
    $pdf->Cell(50,3,'VAT',0,0,'C');
    $pdf->SetY($y_axis);
    $pdf->SetX(155);
    $pdf->Cell(50,3,'R '.$vat,0,0,'C');
    $y_axis = $y_axis+3;
}
if ($insurance){
    $pdf->SetY($y_axis);
    $pdf->SetX(80);
    $pdf->Cell(50,3,'INSURANCE',0,0,'C');
    $pdf->SetY($y_axis);
    $pdf->SetX(155);
    $pdf->Cell(50,3,'R '.$insurance,0,0,'C');
    $y_axis = $y_axis+3;
}
if ($outlying){
    $pdf->SetY($y_axis);
    $pdf->SetX(80);
    $pdf->Cell(50,3,'OUTLYING AREAS',0,0,'C');
    $pdf->SetY($y_axis);
    $pdf->SetX(155);
    $pdf->Cell(50,3,'R '.$outlying,0,0,'C');
    $y_axis = $y_axis+3;
}
if ($saturday){
    $pdf->SetY($y_axis);
    $pdf->SetX(80);
    $pdf->Cell(50,3,'SATURDAY DELIVERIES',0,0,'C');
    $pdf->SetY($y_axis);
    $pdf->SetX(155);
    $pdf->Cell(50,3,'R '.$saturday,0,0,'C');
    $y_axis = $y_axis+3;
}

    $pdf->Output();
