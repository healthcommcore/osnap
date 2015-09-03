<?php
/*
Template Name: Reset-All Page
*/
?>

<?php 
	// get the wp header
	get_header('minimal');
	
	// get current user 
	$user_login = $current_user->user_login; 
	
	//echo "<br><br>user: ".$user_login."<br>";
	
	echo deleteAllMyEntries();
?>



<?php //get_footer(); ?>

