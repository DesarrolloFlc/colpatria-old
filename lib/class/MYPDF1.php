<?php

use \TCPDF as PDF;

class MYPDF1 extends PDF
{
    public function ColoredTable($header, $data)
    {
        $this->SetFillColor(210, 20, 1);
        $this->SetTextColor(255);
        $this->SetDrawColor(204, 204, 204);
        $this->SetLineWidth(0.2);
        $this->SetFont('', 'B');

        $w = array(20, 30, 80, 27, 25);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        $fill = 0;
        $ext = '';
        if (!is_array($data)) return;

        foreach ($data as $row) {
            $fecha = explode(' ', $row[5]);
            $this->Cell($w[0], 6, $row[3], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $fecha[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, getEstados($row[4]), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
        
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Cell($w[0], 6, 'Firma:', '0', 0, 'C', 0);
        $this->Cell(64, 6, '', 'B', 0, 'C', 0);
    }
}