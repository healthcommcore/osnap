
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

// Initialize WKHtmlToPdf
require_once('WkHtmlToPdf.php');
$pdf = new WkHtmlToPdf;

// Get userlogin from query string
$userlogin = $_GET['userlogin'];

// add page from URL
$pdf->addPage('http://osnap.org/tools/my-action-plan-archive/?userlogin='.$userlogin.'');

// Save the PDF
$date = new DateTime();
$filename = $userlogin.'-AP-'.$date->format('y-m-d_hia').'.pdf';
$pdf->saveAs('pdf-action-plans/'.$filename);

// echo the name of the file
echo "Done! Action Plan archive<br/><b>".$filename."</b><br/>has been created.<br/><br/>";
echo "You should now see it in your list of Existing Archives.";
?>


 
