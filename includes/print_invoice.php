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

    $row_height = 4;
    $y_axis = 60;
    $today = Carbon::today()->toDateString();
    $invNumber = 123456789;

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
    $pdf->Cell(50,3,'TAX INVOICE '.$invNumber,0,0,'L');
    $pdf->SetY(60);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'TO:',0,0,'L');
    $pdf->SetY(60);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$invNumber,0,0,'L');
    $pdf->SetY(63);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$invNumber,0,0,'L');
    $pdf->SetY(66);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$invNumber,0,0,'L');
    $pdf->SetY(69);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$invNumber,0,0,'L');
    $pdf->SetY(72);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'TEL:',0,0,'L');
    $pdf->SetY(72);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$invNumber,0,0,'L');
    $pdf->SetY(75);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'EMAIL:',0,0,'L');
    $pdf->SetY(75);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$invNumber,0,0,'L');
    $pdf->SetY(78);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'ATT:',0,0,'L');
    $pdf->SetY(78);
    $pdf->SetX(20);
    $pdf->Cell(50,3,$invNumber,0,0,'L');
    $pdf->SetY(90);
    $pdf->SetX(5);
    $pdf->Cell(50,3,'WAYBILL NUMBER',1,0,'C');
    $pdf->SetY(90);
    $pdf->SetX(80);
    $pdf->Cell(50,3,'DESCRIPTION',1,0,'C');
    $pdf->SetY(90);
    $pdf->SetX(155);
    $pdf->Cell(50,3,'AMOUNT',1,0,'C');


//    $pdf->SetFont('Times','',12);
//    $pdf->SetY(34);
//    $pdf->SetX(0);
//    $pdf->Cell(20,4,$date,0,0,'C');
//    $pdf->SetX(25);
//    $pdf->Cell(50,4,$manifest_number,0,0,'C');
//    $pdf->SetX(80);
//    $pdf->Cell(40,4,$driver,0,0,'C');
//    $pdf->SetX(125);
//    $pdf->Cell(40,4,$co_driver,0,0,'C');
//    $pdf->SetX(170);
//    $pdf->Cell(30,4,$reg_no,0,0,'C');
//
//    $pdf->SetFont('Times','',10);
//    $pdf->SetY(40);
//    $pdf->SetX(0);
//    $pdf->Cell(22,4,'Seal Numbers:',1,0,'C');
//    $pdf->SetX(25);
//    $pdf->Cell(50,4,$seal1,0,0,'C');
//    $pdf->SetX(80);
//    $pdf->Cell(40,4,$seal2,0,0,'C');
//    $pdf->SetX(125);
//    $pdf->Cell(40,4,$seal3,0,0,'C');
//    $pdf->SetX(170);
//    $pdf->Cell(30,4,$seal4,0,0,'C');


//    $pdf->waybill_heading($y_axis);

//number
    $counter = 1;

//initialize counter
    $i = 0;

//Set maximum rows per page
    $max = 54;

//    while ($manifest_details = mysqli_fetch_assoc($manifest_query_details)) {
//
//        $waybill_number = $manifest_details['waybill_no'];
//        $shipper = $manifest_details['shipper'];
//        $consignee = $manifest_details['consignee'];
//        $item_qty = $manifest_details['qty'];
//        $item_weight = $manifest_details['weight'];
//        $type = $manifest_details['type'];
//        $remarks = $manifest_details['remarks'];
//
//        if ($i == $max) {
//            $pdf->AddPage();
//            $i = 0;
//            $y_axis = 42;
//            $pdf->waybill_heading($y_axis);
//        }
//        $pdf->SetFont('Times','',10);
//        $pdf->SetY($y_axis);
//        $pdf->SetX(0);
//        $pdf->Cell(5,4,$counter,0,0,'C');
//        $pdf->SetX(5);
//        $pdf->Cell(20,4,$waybill_number,0,0,'C');
//        $pdf->SetX(25);
//        $pdf->Cell(55,4,$shipper,0,0,'L');
//        $pdf->SetX(80);
//        $pdf->Cell(55,4,$consignee,0,0,'L');
//        $pdf->SetX(135);
//        $pdf->Cell(15,4,$item_qty,0,0,'C');
//        $pdf->SetX(150);
//        $pdf->Cell(20,4,$item_weight,0,0,'C');
//        $pdf->SetX(170);
//        $pdf->Cell(15,4,$type,0,0,'C');
//        $pdf->SetX(185);
//        $pdf->Cell(25,4,$remarks,0,0,'C');
//        $y_axis = $y_axis + $row_height;
//        $i = $i + 1;
//        $counter = $counter+1;
//
//    }

//    $pdf->SetFont('Times','',12);
//    $pdf->SetY($y_axis+5);
//    $pdf->SetX(107);
//    $pdf->Cell(25,4,'TOTALS:',1,0,'C');
//    $pdf->SetX(132);
//    $pdf->Cell(15,4,$qty['SUM(qty)'],0,0,'C');
//    $pdf->SetX(147);
//    $pdf->Cell(20,4,$weight['SUM(weight)'],0,0,'C');
//
//    $pdf->Ln();
//    $pdf->Ln();
//    $pdf->SetFont('Times','',10);
//
//    $pdf->SetX(107);
//    $pdf->Cell(25,4,'Overnight:',0,0,'C');
//    $pdf->SetX(147);
//    $pdf->Cell(20,4,$overnight['SUM(weight)'],0,0,'C');
//
//    $pdf->Ln();
//    $pdf->SetFont('Times','',10);
//
//    $pdf->SetX(107);
//    $pdf->Cell(25,4,'Budget:',0,0,'C');
//    $pdf->SetX(147);
//    $pdf->Cell(20,4,$budget['SUM(weight)'],0,0,'C');
//
//    $pdf->Ln();
//    $pdf->SetFont('Times','',10);
//
//    $pdf->SetX(107);
//    $pdf->Cell(25,4,'Consol:',0,0,'C');
//    $pdf->SetX(147);
//    $pdf->Cell(20,4,$consol['SUM(weight)'],0,0,'C');
//
//    $pdf->Ln();
//    $pdf->SetFont('Times','',10);
//
//    $pdf->SetX(107);
//    $pdf->Cell(25,4,'Economy:',0,0,'C');
//    $pdf->SetX(147);
//    $pdf->Cell(20,4,$economy['SUM(weight)'],0,0,'C');

    $pdf->Output();
