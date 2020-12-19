<?php

namespace App\Http\Controllers;

use App\User;
use PDF;

class SemenController extends Controller
{
    public function reporte()
    {
        $users = User::all();

        PDF::SetTitle('Lista general de vallas');

        PDF::SetMargins(1, 1, 1);
        PDF::setHeaderCallback(function ($pdf) {
            //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $image_file = public_path('img/img.png');
            $pdf->Image($image_file, 11, 5, 77, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $pdf->setCellPaddings(1, 1, 1, 1);
            $pdf->setCellMargins(1, 1, 1, 1);
            $pdf->SetFillColor(250, 250, 242);
            $txt = "La Paz: Pedro Blanco Esq. Nicolas Acosta Nº 1471\nSanta Cruz: Av 2 de Agosto calle 6 lado capilla\nCochabamba: Av. Blanco Galindo Km. 11 (Aasana)\nE-mail: contactos@imagenpublicidad.com.bo";
            $pdf->MultiCell(100, 19, $txt, 1, 'L', 1, 0, 97, 1, true);
            PDF::writeHTMLCell(0, 0, '10', '26', '<hr>', 0, 0, 0, true, 'J', true);
            $style = array(
                'border'  => false,
                'padding' => 'auto',
                'fgcolor' => array(137, 137, 137),
                'bgcolor' => false,
            );
            PDF::write2DBarcode('https://www.imagenpublicidad.com.bo', 'QRCODE,M', 260, 2, 30, 25, $style, 'N');
        });
        PDF::setFooterCallback(function ($pdf) {
            $fecha = date('Y');
            $html  = '<div style="background-color:#F5B7B1;color:black; text-align: center;"><span style="font-size: xx-small;">Copyright © ' . $fecha . ' Imagen S.R.L Todos los derechos reservados.</span></div>';
            $pdf->writeHTMLCell(276, 0, '10', '203', $html, 0, 1, 0, true, '', true);
        });
        PDF::AddPage('L', 'A4');
        $title = '<h1>Lista general de vallas</h1>';
        PDF::writeHTMLCell(0, 0, '10', '30', $title, 0, 0, 0, true, 'J', true);
        $date = "<b>" . date('d-m-Y') . "</b>";
        PDF::writeHTMLCell(0, 0, '262', '30', $date, 0, 1, 0, true, '', true);

        $html = '';
        $html .= '<table style="border:1px black solid; border-spacing: 2px">';
        $html .= '<thead><tr style="color: #fff; font-family: arial; background-color: #D67272; font-size: 11px; font-weight: bold; text-align: center">';
        $html .= '<th style="width: 8%">CIUDAD</th>';
        $html .= '<th style="width: 8%">ZONA</th>';
        $html .= '</tr></thead>';
        foreach ($users as $user) {
            $html .= '<tr style="background-color: #F0F0F0">';
            $html .= '<td style="width: 8%; font-size: 10px;  text-align: left">' . $user->name . '</td>';
            $html .= '<td style="width: 8%; font-size: 10px;  text-align: left">' . $user->email . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        PDF::writeHTMLCell(396, 0, '10', '40', $html, 0, 1, 0, true, '', true);

        $str = PDF::Output('users.pdf', 'I');
        return response($str);
    }
}
