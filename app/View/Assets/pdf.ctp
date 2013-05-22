<?php
    $fpdf->AliasNbPages();
    $fpdf->AddPage();
    
    $nomor = 0;
    $header = array ('No', 'Tahun', 'Nama Aset', 'Nilai Aset');
    
    $columnWidths = array(
        10, 30, 90, 40
    );
    
    $i = 0;
    $fpdf->SetFont('Arial', '', 20);
    $fpdf->Cell(170,10,'Laporan Asset',0,0,'C');
    $fpdf->Ln(20);
    $fpdf->SetFont('Arial', '', 12);
    $fpdf->Cell(50,10,'Nama: '.AuthComponent::user('first_name').' '.AuthComponent::user('last_name'),0,1);
    $fpdf->Cell(50,10,'Email: '.AuthComponent::user('email'),0,0);
    
    $fpdf->Ln(20);
    $fpdf->SetFont('Arial', 'B', 12);
    foreach($header as $col):
        $fpdf->Cell($columnWidths[$i],7,$col,1,0,'C');
        $i++;
    endforeach;
    $fpdf->Ln();
    
    $fpdf->SetFont('Arial', '', 12);
    foreach ($assets as $asset):
        $nomor++;
        $fpdf->Cell($columnWidths[0],6,$nomor,1);
        $fpdf->Cell($columnWidths[1],6,$asset['Asset']['year'],1);
        $fpdf->Cell($columnWidths[2],6,$asset['Asset']['name'],1);
        $fpdf->Cell($columnWidths[3],6,$this->Aturdoku->currencyFormat($asset['Asset']['value']),1);
        $fpdf->Ln();
    endforeach;
    $fpdf->Output();
?>