<?php


//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('application/libraries/Tcpdf/tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
 class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
        // Logo
        $image_file = K_PATH_IMAGES.'logo.png';

        // Image method signature:
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

        $this->Image($image_file, 10, 5, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


        
        
        // Set font
        $this->SetFont('helvetica', 'B', 16);
        // Title

        $this->Cell(100, 0, 'STUDENT DATA SHEET', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Western College');
$pdf->SetTitle('WCI-'.$studentInfo->lastname);
$pdf->SetSubject('Schedule Details');
$pdf->SetKeywords('Schedule Details');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'R', 12);

// add a page
$pdf->AddPage();

// set some text to print
$html = '

<h1 style="text-align:center; font-size:10px">______________________________________________________________________________________________________________________________</h1>

<h1 style="text-align:left; font-size:14px">Student Type: '.$studentInfo->studenttype.'</h1>
<h1 style="text-align:left; font-size:14px">LRN: '.$studentInfo->lrn.'</h1>

<table cellspacing="0" cellpadding="1" style="border:1px gray solid;">
   
    <tr>
 
        <td style="width:50%;text-align:left; font-size:14px;">First Name:</td>
        <td style="width:50%;text-align:left; font-size:14px;">Middlename:</td>

    </tr>

     <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->firstname.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->middlename.'</td>
    </tr>



    <tr>
 
        <td style="width:50%;text-align:left; font-size:14px;">Last Name:</td>
        <td style="width:50%;text-align:left; font-size:14px;">Suffix:</td>

    </tr>

     <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->lastname.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->suffix.'</td>
    </tr>



    <tr>
        <td style="width:50%;text-align:left; font-size:14px;">Birthdate:</td>
        <td style="width:50%;text-align:left; font-size:14px;">Gender:</td>

    </tr>

     <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->birthdate.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->gender.'</td>
    </tr>



    <tr>

        <td style="width:50%;text-align:left; font-size:14px;">Religion:</td>
        <td style="width:50%;text-align:left; font-size:14px;">Nationality:</td>

    </tr>

    <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->religion.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->nationality.'</td>
    </tr>



    <tr>

        <td style="width:50%;text-align:left; font-size:14px;">Province:</td>
        <td style="width:50%;text-align:left; font-size:14px;">City:</td>

    </tr>

    <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->province.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->city.'</td>
    </tr>



    <tr>

        <td style="width:50%;text-align:left; font-size:14px;">Barangay:</td>
        <td style="width:50%;text-align:left; font-size:14px;">Address:</td>

    </tr>

    <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->barangay.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->address.'</td>
    </tr>



    <tr>

        <td style="width:50%;text-align:left; font-size:14px;">Mothers Name:</td>
        <td style="width:50%;text-align:left; font-size:14px;">Fathers Name:</td>

    </tr>

    <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->mother.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->father.'</td>
    </tr>


     <tr>

        <td style="width:50%;text-align:left; font-size:14px;">Guardian:</td>
        <td style="width:50%;text-align:left; font-size:14px;">Contact No.:</td>

    </tr>
    
    <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->guardian.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->contactno.'</td>
    </tr>

    <tr>

        <td style="width:50%;text-align:left; font-size:14px;">Email:</td>
        <td style="width:50%;text-align:left; font-size:14px;">Status:</td>
    </tr>

     <tr>

        <td style="width:50%;height:30px;">'.$studentInfo->email.'</td>
        <td style="width:50%;height:30px;">'.$studentInfo->status.'</td>
    </tr>
    
</table>

';



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output("WCI-enrollment-'$studentInfo->lastname'.pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+