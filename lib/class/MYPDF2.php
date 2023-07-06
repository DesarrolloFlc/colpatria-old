<?php

use \TCPDF as PDF;

class MYPDF2 extends PDF
{
    public function ColoredTable($header, $data, $radicado)
    {
        $this->SetFillColor(210, 20, 1);
        $this->SetTextColor(255);
        $this->SetDrawColor(204, 204, 204);
        $this->SetLineWidth(0.2);
        $this->SetFont('', 'B');
        $w = array(18, 121, 40);
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
        if ($radicado->getExtension() != '' && $radicado->getExtension() != 'NULL') {
            $ext = ' EXT ' . $radicado->getExtension();
        }
        if (!is_array($data)) return;
        
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['rownum'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row['descripcion'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['documento'], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');

        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Cell($w[0], 6, 'Firma:', '0', 0, 'C', 0);
        $this->Cell(64, 6, '', 'B', 0, 'C', 0);
        $this->Ln();
        $this->Cell(22, 6, 'Telefono:', '0', 0, 'C', 0);
        $this->Cell(60, 6, $radicado->getTelefono() . $ext, 'B', 0, 'L', 0);
    }
}