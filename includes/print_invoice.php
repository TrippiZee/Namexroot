<?php

require('fpdf.php');

if (isset($_GET['print_invoice'])){
    $id=$_GET['print_id'];

    $query_result = manifest($id);
    $manifest = mysqli_fetch_array($query_result);

    $date = $manifest['date'];
    $manifest_number = $manifest['manifest_no'];
    $driver = $manifest['driver'];
    $co_driver = $manifest['co_driver'];
    $reg_no = $manifest['reg_no'];
    $seal1 = $manifest['seal1'];
    $seal2 = $manifest['seal2'];
    $seal3 = $manifest['seal3'];
    $seal4 = $manifest['seal4'];


    $manifest_id = $manifest['id'];

    $query = 'SELECT * ';
    $query .= 'FROM manifest_details ';
    $query .= "WHERE manifest_no = {$manifest_id}";

    $manifest_query_details = mysqli_query($connection,$query);


    $sum_qty = quantity($manifest_id);
    $qty = mysqli_fetch_array($sum_qty);
    $sum_weight = weight($manifest_id);
    $weight = mysqli_fetch_array($sum_weight);
    $sum_overnight = overnight($manifest_id);
    $overnight = mysqli_fetch_array($sum_overnight);
    $sum_budget = budget($manifest_id);
    $budget = mysqli_fetch_array($sum_budget);
    $sum_consol = consol($manifest_id);
    $consol = mysqli_fetch_array($sum_consol);
    $sum_economy = economy($manifest_id);
    $economy = mysqli_fetch_array($sum_economy);

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
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }


        function waybill_heading($y)
        {
            $this->SetFont('Times', '', 12);
            $this->SetY($y - 10);
            $this->SetX(0);
            $this->Cell(4, 6, ' ', 1, 0, 'C');
            $this->SetX(4);
            $this->Cell(21, 6, 'WAYBILL ', 1, 0, 'C');
            $this->SetX(25);
            $this->Cell(55, 6, 'SHIPPER', 1, 0, 'C');
            $this->SetX(80);
            $this->Cell(55, 6, 'CONSIGNEE', 1, 0, 'C');
            $this->SetX(135);
            $this->Cell(15, 6, 'QTY', 1, 0, 'C');
            $this->SetX(150);
            $this->Cell(20, 6, 'WEIGHT', 1, 0, 'C');
            $this->SetX(170);
            $this->Cell(15, 6, 'TYPE', 1, 0, 'C');
            $this->SetX(185);
            $this->Cell(25, 6, 'REMARKS', 1, 0, 'C');
        }
    }

    $row_height = 4;
    $y_axis = 60;


    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',14);
    $pdf->SetY(26);
    $pdf->SetX(0);
    $pdf->Cell(20,6,'DATE',1,0,'C');
    $pdf->SetX(25);
    $pdf->Cell(50,6,'MANIFEST NUMBER',1,0,'C');
    $pdf->SetX(80);
    $pdf->Cell(40,6,'DRIVER',1,0,'C');
    $pdf->SetX(125);
    $pdf->Cell(40,6,'CO-DRIVER',1,0,'C');
    $pdf->SetX(170);
    $pdf->Cell(30,6,'REG NO',1,0,'C');

    $pdf->SetFont('Times','',12);
    $pdf->SetY(34);
    $pdf->SetX(0);
    $pdf->Cell(20,4,$date,0,0,'C');
    $pdf->SetX(25);
    $pdf->Cell(50,4,$manifest_number,0,0,'C');
    $pdf->SetX(80);
    $pdf->Cell(40,4,$driver,0,0,'C');
    $pdf->SetX(125);
    $pdf->Cell(40,4,$co_driver,0,0,'C');
    $pdf->SetX(170);
    $pdf->Cell(30,4,$reg_no,0,0,'C');

    $pdf->SetFont('Times','',10);
    $pdf->SetY(40);
    $pdf->SetX(0);
    $pdf->Cell(22,4,'Seal Numbers:',1,0,'C');
    $pdf->SetX(25);
    $pdf->Cell(50,4,$seal1,0,0,'C');
    $pdf->SetX(80);
    $pdf->Cell(40,4,$seal2,0,0,'C');
    $pdf->SetX(125);
    $pdf->Cell(40,4,$seal3,0,0,'C');
    $pdf->SetX(170);
    $pdf->Cell(30,4,$seal4,0,0,'C');


    $pdf->waybill_heading($y_axis);

//number
    $counter = 1;

//initialize counter
    $i = 0;

//Set maximum rows per page
    $max = 54;

    while ($manifest_details = mysqli_fetch_assoc($manifest_query_details)) {

        $waybill_number = $manifest_details['waybill_no'];
        $shipper = $manifest_details['shipper'];
        $consignee = $manifest_details['consignee'];
        $item_qty = $manifest_details['qty'];
        $item_weight = $manifest_details['weight'];
        $type = $manifest_details['type'];
        $remarks = $manifest_details['remarks'];

        if ($i == $max) {
            $pdf->AddPage();
            $i = 0;
            $y_axis = 42;
            $pdf->waybill_heading($y_axis);
        }
        $pdf->SetFont('Times','',10);
        $pdf->SetY($y_axis);
        $pdf->SetX(0);
        $pdf->Cell(5,4,$counter,0,0,'C');
        $pdf->SetX(5);
        $pdf->Cell(20,4,$waybill_number,0,0,'C');
        $pdf->SetX(25);
        $pdf->Cell(55,4,$shipper,0,0,'L');
        $pdf->SetX(80);
        $pdf->Cell(55,4,$consignee,0,0,'L');
        $pdf->SetX(135);
        $pdf->Cell(15,4,$item_qty,0,0,'C');
        $pdf->SetX(150);
        $pdf->Cell(20,4,$item_weight,0,0,'C');
        $pdf->SetX(170);
        $pdf->Cell(15,4,$type,0,0,'C');
        $pdf->SetX(185);
        $pdf->Cell(25,4,$remarks,0,0,'C');
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
        $counter = $counter+1;

    }

    $pdf->SetFont('Times','',12);
    $pdf->SetY($y_axis+5);
    $pdf->SetX(107);
    $pdf->Cell(25,4,'TOTALS:',1,0,'C');
    $pdf->SetX(132);
    $pdf->Cell(15,4,$qty['SUM(qty)'],0,0,'C');
    $pdf->SetX(147);
    $pdf->Cell(20,4,$weight['SUM(weight)'],0,0,'C');

    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Times','',10);

    $pdf->SetX(107);
    $pdf->Cell(25,4,'Overnight:',0,0,'C');
    $pdf->SetX(147);
    $pdf->Cell(20,4,$overnight['SUM(weight)'],0,0,'C');

    $pdf->Ln();
    $pdf->SetFont('Times','',10);

    $pdf->SetX(107);
    $pdf->Cell(25,4,'Budget:',0,0,'C');
    $pdf->SetX(147);
    $pdf->Cell(20,4,$budget['SUM(weight)'],0,0,'C');

    $pdf->Ln();
    $pdf->SetFont('Times','',10);

    $pdf->SetX(107);
    $pdf->Cell(25,4,'Consol:',0,0,'C');
    $pdf->SetX(147);
    $pdf->Cell(20,4,$consol['SUM(weight)'],0,0,'C');

    $pdf->Ln();
    $pdf->SetFont('Times','',10);

    $pdf->SetX(107);
    $pdf->Cell(25,4,'Economy:',0,0,'C');
    $pdf->SetX(147);
    $pdf->Cell(20,4,$economy['SUM(weight)'],0,0,'C');

    $pdf->Output();
}