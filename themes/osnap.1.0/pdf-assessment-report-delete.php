
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

// Set location of files to delete
$location = '/var/www/osnap.org/public_html/wp-content/themes/osnap.1.0/pdf-assessment-reports/';

// Get filename from query string
$filename = $_GET['filename'];

// delete the file
$pathToFile = $location.$filename;

if ( unlink($pathToFile) )
    echo "Done! Archive<br/><b>".$filename."</b><br/>has been deleted.<br/><br/>";
else
    echo "<b>Error deleting archive.</b>";
	
?>