<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off


require_once('WkHtmlToPdf.php');
$pdf = new WkHtmlToPdf;

// Set default page options for all following pages
//$pdf->setPageOptions(array(
//    'disable-smart-shrinking',
//    'user-style-sheet' => 'pdf.css',
//));

// Add a page. To override above page defaults, you could add
// another $options array as second argument.

$pdf->addPage('http://osnap.org/tools/my-action-plan-2/?userlogin=slaven');
//$pdf->addPage('/?page_id=1202&preview=true');
//$pdf->addPage('<html><head></head><body><h1>hi mike!</h1></body></html>');

$pdf->send();