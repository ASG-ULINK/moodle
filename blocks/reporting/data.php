<?php
require('../../config.php');
if (isset($_SESSION['complete_course']) && isset($_SESSION['notcomplete_course'])) 
{
	$rows = array();
	echo $complete_course = $_SESSION['complete_course'];
	echo $notcomplete_course = $_SESSION['notcomplete_course'];
	$total = $complete_course + $notcomplete_course;

	$percomp = $complete_course*100/$total;
	$pernotcomp = $notcomplete_course*100/$total;
	
	$row[0] = 'Complete Course';
	$row[1] = $percomp;
	array_push($rows,$row);

	$row[0] = 'Not Complete Course';
	$row[1] = $pernotcomp;
	array_push($rows,$row);


	print json_encode($rows, JSON_NUMERIC_CHECK);

}

?> 
