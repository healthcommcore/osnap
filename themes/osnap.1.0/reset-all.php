
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

// Get userlogin from query string
$userlogin = $_GET['userlogin'];


// find entries for this user in all forms that we want to wipe out


//echo $result;


// echo the name of the file
echo "Done! All assessments and action plans have been reset for user:<br/><b>".$userlogin."</b><br/>";
?>


 
