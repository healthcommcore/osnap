<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>

<?php 

$n=0;
while($n<=200) {

$myString = '
<field id="'.($n+1).'" size="medium" type="section" displayOnly="1">
	<cssClass><![CDATA[ap-section]]></cssClass>
	<label><![CDATA[Section Break]]></label>
</field>
<field id="'.($n+2).'" allowsPrepopulate="1" size="small" type="textarea">
	<cssClass><![CDATA[ap-people-involved]]></cssClass>
	<inputName><![CDATA[people]]></inputName>
	<label><![CDATA[People involved]]></label>
</field>
<field id="'.($n+3).'" size="medium" type="date" calendarIconType="calendar" dateType="datepicker">
	<cssClass><![CDATA[ap-target-date]]></cssClass>
	<label><![CDATA[Target date for completion]]></label>
</field>
<field id="'.($n+4).'" size="small" type="textarea">
	<cssClass><![CDATA[ap-checkin-1]]></cssClass>
	<label><![CDATA[Check-in status 1]]></label>
</field>
<field id="'.($n+5).'" size="small" type="textarea">
	<cssClass><![CDATA[ap-checkin-2]]></cssClass>
	<label><![CDATA[Check-in status 2]]></label>
</field>
<field id="'.($n+6).'" size="small" type="textarea">
	<cssClass><![CDATA[ap-checkin-3]]></cssClass>
	<label><![CDATA[Check-in status 3]]></label>
</field>
<field id="'.($n+7).'" adminOnly="1" allowsPrepopulate="1" size="medium" type="text">
	<inputName><![CDATA[step-code]]></inputName>
	<label><![CDATA[step-code]]></label>
</field>			
<field id="'.($n+8).'" size="medium" type="page" displayOnly="1">
	<cssClass><![CDATA[osnap-page-2]]></cssClass>
	<nextButton type="text">
		<text><![CDATA[Next]]></text>
	</nextButton>
	<previousButton type="text">
		<text><![CDATA[Previous]]></text>
	</previousButton>
</field>
';

echo $myString;
$n=$n+8;
}
?>

</body>
</html>