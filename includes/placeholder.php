<?php
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
