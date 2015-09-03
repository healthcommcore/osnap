
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

// Get userlogin from query string
$endDir = $_GET['endDir'];
$userName = $_GET['userName'];

//==============
// find files in filesystem (used for pdf archives)
//==============

findFileRowsForUser( $endDir, $userName ); // << this is where the magic happens

function findFileRowsForUser( $endDir, $userName ) {
	// $endDir = pdf-assessment-reports | pdf-action-plans | etc
	// username = WP username, ie 'slaven'
	$basePath = '/var/www/osnap.org/public_html/';
	$webDir = 'wp-content/themes/osnap.1.0/';
	$path = $basePath.$webDir.$endDir;
	$regex = '/^'.$userName.'.*\.(pdf)$/';

	$fileList = findfile( $path, $regex ); 

	if ( $endDir == 'pdf-assessment-reports' ) {
		$spanClass = 'delete-AR-pdf';
	} else {
		$spanClass = 'delete-AP-pdf';
	}	
	echo '<tbody>';
	foreach ($fileList as &$file) {
		echo '<tr><td>';
		echo '<a href="/'.$webDir.$endDir.'/'.$file.'">'.$file.'</a>';
		echo '<span class="'.$spanClass.' btn" id="'.$file.'"><i class="icon-trash"></i></span>';
		echo '</td></tr>';
	}
	echo '</tbody>';
}

function findfile( $location, $fileregex ) {
	if (!$location or !is_dir($location) or !$fileregex) {
	   return false;
	}
 	
	$matchedfiles = array();
 
	$all = opendir($location);
	while ($file = readdir($all)) {
	   if (is_dir($location.'/'.$file) and $file <> ".." and $file <> ".") {
		  $subdir_matches = findfile($location.'/'.$file,$fileregex);
		  $matchedfiles = array_merge($matchedfiles,$subdir_matches);
		  unset($file);
	   }
	   elseif (!is_dir($location.'/'.$file)) {
		  if (preg_match($fileregex,$file)) {
			 //array_push($matchedfiles,$location.'/'.$file);
			 array_push($matchedfiles,$file);
		  }
	   }
	}
	closedir($all);
	unset($all);
	return $matchedfiles;
}

?>


 
