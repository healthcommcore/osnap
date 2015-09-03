<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>DB Demo</title>
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
	
	// client IP address
	$ip=$_SERVER['REMOTE_ADDR'];
	echo "<b>client IP Address: ".$ip."</b>";
	
	$sql = "SELECT *
				FROM ls_survey_974213 
				WHERE ipaddr = '".$ip."' 
				ORDER BY datestamp DESC
				LIMIT 1
				";	
	
	$result = mysql_query($sql); 
	
	while ($row = mysql_fetch_assoc($result)) {
		
		// use the utility at util-column-names.php to generate the below mappings
		$daysperweek = $row['974213X169X1723'];
		$q0101 = $row['974213X155X1627'];
		$q010101SQ001 = $row['974213X155X1628SQ001'];
		$q010101SQ002 = $row['974213X155X1628SQ002'];
		$eq0101 = $row['974213X155X1731'];
		$q0102 = $row['974213X155X1629'];
		$q010201SQ001 = $row['974213X155X1630SQ001'];
		$q010201SQ002 = $row['974213X155X1630SQ002'];
		$eq0102 = $row['974213X155X1727'];
		$q0103 = $row['974213X155X1631'];
		$q010301SQ001 = $row['974213X155X1632SQ001'];
		$q010301SQ002 = $row['974213X155X1632SQ002'];
		$eq0103 = $row['974213X155X1728'];
		$q0104 = $row['974213X155X1633'];
		$q010401SQ001 = $row['974213X155X1634SQ001'];
		$q010401SQ002 = $row['974213X155X1634SQ002'];
		$eq0104 = $row['974213X155X1729'];
		$q0105 = $row['974213X155X1635'];
		$q010501SQ003 = $row['974213X155X1636SQ003'];
		$q010501SQ001 = $row['974213X155X1636SQ001'];
		$q010501SQ002 = $row['974213X155X1636SQ002'];
		$eq0105 = $row['974213X155X1730'];
		$eq01 = $row['974213X155X1732'];
		$q0201 = $row['974213X156X1637'];
		$q0202 = $row['974213X156X1638'];
		$q0203 = $row['974213X156X1639'];
		$q0204 = $row['974213X156X1640'];
		$q0205 = $row['974213X156X1641'];
		$q020501SQ001 = $row['974213X156X1642SQ001'];
		$eq02 = $row['974213X156X1778'];
		$q0301 = $row['974213X157X1643'];
		$q0302 = $row['974213X157X1644'];
		$q0303 = $row['974213X157X1645'];
		$q0304 = $row['974213X157X1646'];
		$q0305 = $row['974213X157X1647'];
		$q030501SQ001 = $row['974213X157X1648SQ001'];
		$eq03 = $row['974213X157X1779'];
		$eq03a = $row['974213X157X1780'];
		$q0401 = $row['974213X158X1649'];
		$q040101L001 = $row['974213X158X1650L001'];
		$q040101L002 = $row['974213X158X1650L002'];
		$eq0401 = $row['974213X158X1781'];
		$q0402 = $row['974213X158X1651'];
		$q040201L001 = $row['974213X158X1652L001'];
		$q040201L002 = $row['974213X158X1652L002'];
		$eq0402 = $row['974213X158X1782'];
		$q0403 = $row['974213X158X1653'];
		$q040301L001 = $row['974213X158X1654L001'];
		$q040301L002 = $row['974213X158X1654L002'];
		$eq0403 = $row['974213X158X1783'];
		$q0404 = $row['974213X158X1655'];
		$q040401L001 = $row['974213X158X1656L001'];
		$q040401L002 = $row['974213X158X1656L002'];
		$eq0404 = $row['974213X158X1784'];
		$q0405 = $row['974213X158X1657'];
		$q040501SQ001 = $row['974213X158X1658SQ001'];
		$q040501L001 = $row['974213X158X1658L001'];
		$q040501L002 = $row['974213X158X1658L002'];
		$eq0405 = $row['974213X158X1785'];
		$eq04 = $row['974213X158X1786'];
		$q0505SQ001 = $row['974213X159X1669SQ001'];
		$q0501 = $row['974213X159X1659'];
		$q0502 = $row['974213X159X1660'];
		$q0503 = $row['974213X159X1661'];
		$q0504 = $row['974213X159X1662'];
		$q050401SQ001 = $row['974213X159X1663SQ001'];
		$eq05 = $row['974213X159X1787'];
		$q0605SQ001 = $row['974213X160X1670SQ001'];
		$q0601 = $row['974213X160X1664'];
		$q0602 = $row['974213X160X1665'];
		$q0603 = $row['974213X160X1666'];
		$q0604 = $row['974213X160X1667'];
		$q060401SQ001 = $row['974213X160X1668SQ001'];
		$eq06 = $row['974213X160X1789'];
		$q0701 = $row['974213X161X1671'];
		$q0702 = $row['974213X161X1672'];
		$q0703 = $row['974213X161X1673'];
		$q0704 = $row['974213X161X1674'];
		$q0705 = $row['974213X161X1675'];
		$q0706 = $row['974213X161X1676'];
		$q0707 = $row['974213X161X1677'];
		$q070701SQ001 = $row['974213X161X1678SQ001'];
		$q0708 = $row['974213X161X1724'];
		$eq07 = $row['974213X161X1790'];
		$q0801 = $row['974213X162X1679'];
		$q0901 = $row['974213X163X1680'];
		$q090101SQ001 = $row['974213X163X1719SQ001'];
		$eq0901 = $row['974213X163X1791'];
		$q0902 = $row['974213X163X1681'];
		$q090201SQ001 = $row['974213X163X1720SQ001'];
		$eq0902 = $row['974213X163X1792'];
		$q0903 = $row['974213X163X1682'];
		$q090301SQ001 = $row['974213X163X1721SQ001'];
		$eq0903 = $row['974213X163X1793'];
		$q0904 = $row['974213X163X1683'];
		$q090401SQ001 = $row['974213X163X1722SQ001'];
		$eq0904 = $row['974213X163X1794'];
		$q0905 = $row['974213X163X1684'];
		$q090501SQ002 = $row['974213X163X1685SQ002'];
		$q090501SQ001 = $row['974213X163X1685SQ001'];
		$eq0905 = $row['974213X163X1795'];
		$eq09 = $row['974213X163X1796'];
		$q1001 = $row['974213X167X1686'];
		$q1002 = $row['974213X167X1687'];
		$q1003 = $row['974213X167X1688'];
		$q1004 = $row['974213X167X1689'];
		$q1005 = $row['974213X167X1690'];
		$q100501SQ001 = $row['974213X167X1691SQ001'];
		$eq10 = $row['974213X167X1797'];
		$q1101 = $row['974213X168X1692'];
		$q1102 = $row['974213X168X1693'];
		$q1103 = $row['974213X168X1694'];
		$q1104 = $row['974213X168X1695'];
		$q1105 = $row['974213X168X1696'];
		$q110501SQ001 = $row['974213X168X1697SQ001'];
		$eq11 = $row['974213X168X1798'];
		$q1201 = $row['974213X164X1698'];
		$q1202 = $row['974213X164X1699'];
		$q1203 = $row['974213X164X1700'];
		$q1204 = $row['974213X164X1701'];
		$q1205 = $row['974213X164X1702'];
		$q120501SQ001 = $row['974213X164X1703SQ001'];
		$eq12 = $row['974213X164X1799'];
		$q1301 = $row['974213X165X1704'];
		$q130101SQ001 = $row['974213X165X1705SQ001'];
		$eq1301 = $row['974213X165X1801'];
		$q1302 = $row['974213X165X1706'];
		$q130201SQ001 = $row['974213X165X1707SQ001'];
		$eq1302 = $row['974213X165X1802'];
		$q1303 = $row['974213X165X1708'];
		$q130301SQ001 = $row['974213X165X1709SQ001'];
		$eq1303 = $row['974213X165X1803'];
		$q1304 = $row['974213X165X1710'];
		$q130401SQ001 = $row['974213X165X1711SQ001'];
		$eq1304 = $row['974213X165X1804'];
		$q1305 = $row['974213X165X1712'];
		$q130501SQ002 = $row['974213X165X1713SQ002'];
		$q130501SQ001 = $row['974213X165X1713SQ001'];
		$eq1305 = $row['974213X165X1805'];
		$eq13 = $row['974213X165X1806'];
		$q1401 = $row['974213X166X1714'];
		$q1402 = $row['974213X166X1715'];
		$q1403 = $row['974213X166X1716'];
		$q1404 = $row['974213X166X1717'];
		$q1405 = $row['974213X166X1718'];
		$q140501SQ001 = $row['974213X166X1725SQ001'];
		$eq14 = $row['974213X166X1800'];
		// end utility mappings
	
	}
		
		// determine which documents show met goals
		$docs03 = "";
		if (($eq0101 == 2)||($eq0201 == 2)||($eq0301 == 2)) {
			$docs03 = $docs03."Parent newsletters or flyers<br/>";
		}
		if (($eq0102 == 2)||($eq0202 == 2)||($eq0302 == 2)) {
			$docs03 = $docs03."Handbook (parent, staff, general)<br/>";
		}
		if (($eq0103 == 2)||($eq0203 == 2)||($eq0303 == 2)) {
			$docs03 = $docs03."Schedules<br/>";
		}
		if (($eq0104 == 2)||($eq0204 == 2)||($eq0304 == 2)) {
			$docs03 = $docs03."Training materials<br/>";
		}
		if (($eq0105 == 2)||($eq0205 == 2)||($eq0305 == 2)) {
			$otherdoc03 = "";			
			if ($q010501 != ""){$otherdoc03 = $otherdoc03.$q010501."<br/>";}
			if ($q020501 != ""){$otherdoc03 = $otherdoc03.$q020501."<br/>";}
			if ($q030501 != ""){$otherdoc03 = $otherdoc03.$q030501."<br/>";}
			$docs03 = $docs03."Other document: ".$otherdoc03;
		}
	
		$docs04 = "";
		if ($eq0401 == 2) {$docs04 = $docs04."Parent newsletters or flyers<br/>";}
		if ($eq0402 == 2) {$docs04 = $docs04."Handbook (parent, staff, general)<br/>";}
		if ($eq0403 == 2) {$docs04 = $docs04."Schedules<br/>";}
		if ($eq0404 == 2) {$docs04 = $docs04."Training materials<br/>";}
		if ($eq0405 == 2) {$docs04 = $docs04."Other document: ".$q040501."<br/>";}
		
		$docs05 = "";		
		if ($q0501 == 'Y') {$docs05 = $docs05."Handbook (parent, staff, general)<br/>";}
		if ($q0502 == 'Y') {$docs05 = $docs05."Parent newsletters or flyers<br/>";}
		if ($q0503 == 'Y') {$docs05 = $docs05."Staff training materials<br/>";}
		if ($q0504 == 'Y') {$docs05 = $docs05."Other document: ".$q050401."<br/>";}
		
		$docs06 = "";		
		if ($q0601 == 'Y') {$docs06 = $docs06."Handbook (parent, staff, general)<br/>";}
		if ($q0602 == 'Y') {$docs06 = $docs06."Parent newsletters or flyers<br/>";}
		if ($q0603 == 'Y') {$docs06 = $docs06."Staff training materials<br/>";}
		if ($q0604 == 'Y') {$docs06 = $docs06."Other document: ".$q060401."<br/>";}
		
		$docs07 = "";		
		if ($q0701 == 'Y') {$docs07 = $docs07."Menu<br/>";}
		if ($q0702 == 'Y') {$docs07 = $docs07."Handbook (parent, staff, general)<br/>";}
		if ($q0703 == 'Y') {$docs07 = $docs07."Family newsletters or flyers<br/>";}
		if ($q0704 == 'Y') {$docs07 = $docs07."Official memos or letters to parents<br/>";}
		if ($q0705 == 'Y') {$docs07 = $docs07."Posters on site<br/>";}
		if ($q0706 == 'Y') {$docs07 = $docs07."Staff training materials<br/>";}
		if ($q0707 == 'Y') {$docs07 = $docs07."Other document: ".$q070701."<br/>";}
		
		$docs09 = "";
		if ($eq0901 == 2) {$docs09 = $docs09."Menu<br/>";}
		if ($eq0902 == 2) {$docs09 = $docs09."Handbook (parent, staff, general)<br/>";}
		if ($eq0903 == 2) {$docs09 = $docs09."Parent newsletters or flyers<br/>";}
		if ($eq0904 == 2) {$docs09 = $docs09."Staff training materials<br/>";}
		if ($eq0905 == 2) {$docs09 = $docs09."Other document: ".$q090501."<br/>";}
		
		$docs10 = "";		
		if ($q1001 == 'Y') {$docs10 = $docs10."Menu<br/>";}
		if ($q1002 == 'Y') {$docs10 = $docs10."Handbook (parent, staff, general)<br/>";}
		if ($q1003 == 'Y') {$docs10 = $docs10."Parent newsletters or flyers<br/>";}
		if ($q1004 == 'Y') {$docs10 = $docs10."Staff training materials<br/>";}
		if ($q1005 == 'Y') {$docs10 = $docs10."Other document: ".$q100501."<br/>";}
		
		$docs11 = "";		
		if ($q1101 == 'Y') {$docs11 = $docs11."Menu<br/>";}
		if ($q1102 == 'Y') {$docs11 = $docs11."Handbook (parent, staff, general)<br/>";}
		if ($q1103 == 'Y') {$docs11 = $docs11."Parent newsletters or flyers<br/>";}
		if ($q1104 == 'Y') {$docs11 = $docs11."Staff training materials<br/>";}
		if ($q1105 == 'Y') {$docs11 = $docs11."Other document: ".$q110501."<br/>";}
		
		$docs12 = "";		
		if ($q1201 == 'Y') {$docs12 = $docs12."Menu<br/>";}
		if ($q1202 == 'Y') {$docs12 = $docs12."Handbook (parent, staff, general)<br/>";}
		if ($q1203 == 'Y') {$docs12 = $docs12."Parent newsletters or flyers<br/>";}
		if ($q1204 == 'Y') {$docs12 = $docs12."Staff training materials<br/>";}
		if ($q1205 == 'Y') {$docs12 = $docs12."Other document: ".$q120501."<br/>";}
		
		$docs13 = "";		
		if ($q1301 == 'Y') {$docs13 = $docs13."Menu<br/>";}
		if ($q1302 == 'Y') {$docs13 = $docs13."Handbook (parent, staff, general)<br/>";}
		if ($q1303 == 'Y') {$docs13 = $docs13."Parent newsletters or flyers<br/>";}
		if ($q1304 == 'Y') {$docs13 = $docs13."Staff training materials<br/>";}
		if ($q1305 == 'Y') {$docs13 = $docs13."Other document: ".$q130501."<br/>";}
		
		$docs14 = "";		
		if ($q1401 == 'Y') {$docs14 = $docs14."Menu<br/>";}
		if ($q1402 == 'Y') {$docs14 = $docs14."Handbook (parent, staff, general)<br/>";}
		if ($q1403 == 'Y') {$docs14 = $docs14."Parent newsletters or flyers<br/>";}
		if ($q1404 == 'Y') {$docs14 = $docs14."Staff training materials<br/>";}
		if ($q1405 == 'Y') {$docs14 = $docs14."Other document: ".$q140501."<br/>";}
		
		
		?>
		<br/><br/><hr/>
		datestamp: <?php echo $row["datestamp"] ?><br/>
		ipaddr: <?php echo $row["ipaddr"] ?></br>
		days/wk: <?php echo $days_per_week = $row["974213X169X1723"] ?><br/>
		eq01: <?php echo $eq01 ?><br/>
		eq0101: <?php echo $eq0101 ?><br/>
		eq02: <?php echo $eq02 ?><br/>
		eq03: <?php echo $eq03 ?><br/>
		eq03a: <?php echo $eq03a ?><br/>
		docs03: <?php echo $docs03 ?><br/>
		

		<div style="width:600px;margin:30px;border:1px solid gray;">
		<table class="table table-striped" >
			<thead>
				<tr>
					<td>OSNAP Standard</td>
					<td>Policy Status</td>
				<tr>
			</thead>
			<tbody>
				<tr>
					<td>Include 30 minutes of moderate physical activity for every child every day (include outdoor activity if possible).</td>
					<td>
						<?php if ($eq03a==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs03;
						} elseif ($eq03a==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs03;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Physical Activity section</a> 
							of our <a href=''>Policy Writing Guide</a>.";
						} ?>
					</td>
				</tr>
				<tr>
					<td>Offer 20 minutes of vigorous physical activity 3 times per week.</td>
					<td>
						<?php if ($eq04==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs04;
						} elseif ($eq04==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs04;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Physical Activity section</a> 
							of our <a href=''>Policy Writing Guide</a>.";					
						} ?>
					</td>			
				</tr>
				<tr>
					<td>Eliminate use of commercial broadcast TV/movies.</td>
					<td>
						<?php if ($eq05==9) { 
							echo "Not applicable for your program.<br/>";
						} elseif ($eq05==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs05;
						} elseif ($eq05==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs05;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Screen Time section</a> 
							of our <a href=''>Policy Writing Guide</a>.";						
						} ?>
					</td>
				</tr>
				<tr>
					<td>Limit computer and digital device time to homework or instructional only.</td>
					<td>
						<?php if ($eq06==9) { 
							echo "Not applicable for your program.<br/>";
						} elseif ($eq06==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs06;
						} elseif ($eq06==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs06;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Screen Time section</a> 
							of our <a href=''>Policy Writing Guide</a>.";						
						} ?>
					</td>
				</tr>
				
				<?php if ($q0801='Y') { ?>
					<tr>
						<td>Offer a fruit or vegetable option every day at snack.</td>
						<td>
						<?php if ($eq09==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs09;
						} elseif ($eq09==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs09;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Snacks section</a> 
							of our <a href=''>Policy Writing Guide</a>.";						
						} ?>
						</td>
					</tr>
					<tr>
						<td>When serving grains, serve whole grains.</td>
						<td>
						<?php if ($eq10==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs10;
						} elseif ($eq10==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs10;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Snacks section</a> 
							of our <a href=''>Policy Writing Guide</a>.";						
						} ?>
						</td>
					</tr>
					<tr>
						<td>Do not serve foods with trans fats. </td>
						<td>
						<?php if ($eq11==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs11;
						} elseif ($eq11==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs11;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Snacks section</a> 
							of our <a href=''>Policy Writing Guide</a>.";						
						} ?>
						</td>
					</tr>
					<tr>
						<td>Do not serve  sugar-sweetened drinks.</td>
						<td>
						<?php if ($eq12==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs12;
						} elseif ($eq12==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs12;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Snacks section</a> 
							of our <a href=''>Policy Writing Guide</a>.";						
						} ?>
						</td>
					</tr>
					<tr>
						<td>Offer water as a beverage at snack every day.</td>
						<td>
						<?php if ($eq13==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs13;
						} elseif ($eq13==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs13;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Snacks section</a> 
							of our <a href=''>Policy Writing Guide</a>.";						
						} ?>
						</td>
					</tr>
					<tr>
						<td>Do not allow sugar-sweetened drinks to be brought in from outside the snack program.</td>
						<td>
						<?php if ($eq14==2) { 
							echo "Meets goals, as written in the following document(s):<br/>";
							echo $docs14;
						} elseif ($eq14==1) { 
							echo "Partially meets goals, as written in the following document(s):<br/>";
							echo $docs14;
						} else { 
							echo "Does not meet these goals. Find specific help in the 
							<a href=''>Snacks section</a> 
							of our <a href=''>Policy Writing Guide</a>.";						
						} ?>
						</td>
					</tr>					
				
				<?php } else { ?>
					<tr>
						<td>All snack related questions have been skipped.</td>
						<td>N/A</td>
					</tr>
				<?php } ?>
  
	
			</tbody>
		</table>
		</div>


</body>
</html> 
