<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Utility to map question titles to column names</title>
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="http://michaelslaven.com/clients/osnap/wp-content/themes/osnap.1.0/style.css" rel="stylesheet">	
</head>

<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>

<?php 
	//--------------------------------------------------------------------------
	// php script for fetching data from mysql database
	//--------------------------------------------------------------------------
	$host = "localhost";
	$user = "michaels_limread";
	$pass = "2obese";			
	$databaseName = "michaels_lime527";   

	//--------------------------------------------------------------------------
	// Connect to mysql database
	//--------------------------------------------------------------------------
	$con = mysql_connect($host,$user,$pass);
	$dbs = mysql_select_db($databaseName, $con);

	//--------------------------------------------------------------------------
	// Query database for data
	//--------------------------------------------------------------------------

	$sql = "SELECT 
		CONCAT(q.sid, 'X', q.gid, 'X', q.qid, IFNULL(sq.title,'')) AS sgq, 
		CONCAT(q.title, IFNULL(sq.title,'')) AS fulltitle, q.question, q.type
		FROM ls_questions AS q
		LEFT JOIN ls_groups AS g ON q.sid = g.sid AND q.gid = g.gid 
		LEFT JOIN ls_questions AS sq ON q.qid = sq.parent_qid 
		WHERE g.sid = 974213 
		AND q.parent_qid = 0
		ORDER BY g.group_order, q.question_order, sq.question_order
	";	
		
	$result = mysql_query($sql); 
	
	while ($row = mysql_fetch_assoc($result)) {

		echo "$".$row['fulltitle']." = \$row['".$row['sgq']."'];<br/>";			

		//$q010501 = $row["974213X155X1636SQ003"];

	}
?>


</body>
</html> 
