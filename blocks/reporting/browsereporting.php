<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");

require_login();
if (isguestuser()) {
    die();
}

global $DB, $USER;
$returnurl = optional_param('returnurl', '', PARAM_URL);
// $courseid = optional_param('id', PARAM_INT);
$select = optional_param('select',0, PARAM_INT);

if (empty($returnurl)) {
    $returnurl = new moodle_url('/my/index.php');
}

$context = get_context_instance(CONTEXT_USER, $USER->id);
require_capability('moodle/user:manageownfiles', $context);

	$title = get_string('browsereporting', 'block_reporting');


$struser = get_string('user');

$PAGE->set_url('/blocks/reporting/browsereporting.php');
$PAGE->set_context($context);
$PAGE->set_title(format_string('Course Completion Report'));
$PAGE->set_heading(format_string('Course Completion Report'));
$PAGE->set_pagelayout();


$data = new stdClass();
$data->returnurl = $returnurl;

if (isguestuser()) {
    /* Force them to see system default, no editing allowed */
    $userid = null;
    $USER->editing = $edit = 0;
    $context = get_context_instance(CONTEXT_SYSTEM);
    $PAGE->set_blocks_editing_capability('moodle/my:configsyspages');
    $header = format_string('Course Completion Report'); // Or even you can display site shortname too like $SITE->shortname.
} else {
    /* We are trying to view or edit our own My Moodle page i.e., admin part.*/
    $userid = $USER->id;
    $context = get_context_instance(CONTEXT_USER, $USER->id);
    $PAGE->set_blocks_editing_capability('moodle/my:manageblocks');
    $header = format_string('Course Completion Report');
}

$PAGE->set_context(get_system_context(CONTEXT_COURSE));
$PAGE->set_title($header);
$PAGE->set_heading($header);
$PAGE->set_pagelayout();

$newpagenav = format_string('Report');
$PAGE->navbar->add($newpagenav);
echo $OUTPUT->header();

echo $OUTPUT->heading('');
$dates = date('Y');

$query_flag = 0;

$groupname = $DB->get_records_sql("SELECT id,fullname FROM mdl_course");

?>

<script type="text/javascript">

	$(document).ready(function() {
		$(".flip3").click(function() {
			$(".panel3").slideToggle("slow");
		});

	});


</script>

<style type="text/css">

.flipcolor a:hover {
    color: #FFFFFF;
    text-decoration: none;
}
.flipcolor a {
    
    text-decoration: none;
}
.flipcolor {
	
	background: #ddd;
}
 
div.panelshow {
	
	display: none;
}

.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#000099;
}

</style>


<form name="" action="browsereporting.php" method="post">
<div class="flip3 flipcolor" style="border: 1px solid; margin-top:10px; border-color: #D2D9DE; padding: 4px 2px; border-radius: 5px; float:right;">Show/Hide</div>
<div style="clear:both;"></div>
<fieldset style="border: 1px solid; padding: 15px; border-color: #9DBED7; border-radius: 5px;">
    <legend style="line-height:0px; border-bottom:none; line-height:20px; width:auto">Course Filter</legend>
   		<div class="panel3 panelshow" ><div>
   			<label><strong>Select Course: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</strong></label>
			<select name="coursename">
				<option value="">- -</option>
				<optgroup label="Course">
				<?php 
				
				foreach ($groupname as $groupval) {
					echo '<option value="'.$groupval->id.'" >'.$groupval->fullname.'</option>';
				}
				
				 ?>
				</optgroup>
			</select>
			
</div>
<br />
<input type="submit" name="search3" value="Search">
</div>
</fieldset>
</form>


<?php


if (isset($_POST['search3']))
{
	if (!empty($_POST['coursename'])) 
	{
		$query_flag = 1;
		$courseid = $_POST['coursename'];
		$reporting_sql = 'SELECT ue.enrolid AS enrolid, ue.userid AS userid, u.firstname AS firstname, u.lastname AS lastname, u.email AS emailid,c.id AS courseid, c.fullname AS coursename, e.timecreated AS timecreated, cc.timecompleted AS timecompleted,cc.timestarted AS timestarted FROM mdl_user_enrolments AS ue INNER JOIN mdl_enrol AS e ON e.id = ue.enrolid INNER JOIN mdl_user AS u ON u.id = ue.userid INNER JOIN mdl_course AS c ON c.id = e.courseid INNER JOIN mdl_course_completions AS cc ON c.id = cc.course WHERE c.id = '.$courseid;
	}
	else{
		echo "<script> alert('Please Select the Course.'); </script>";
	}
	
}
if ($query_flag == '0') 
{
		$reporting_sql = 'SELECT ue.enrolid AS enrolid, ue.userid AS userid, u.firstname AS firstname, u.lastname AS lastname, u.email AS emailid,c.id AS courseid, c.fullname AS coursename, e.timecreated AS timecreated, cc.timecompleted AS timecompleted,cc.timestarted AS timestarted FROM mdl_user_enrolments AS ue INNER JOIN mdl_enrol AS e ON e.id = ue.enrolid INNER JOIN mdl_user AS u ON u.id = ue.userid INNER JOIN mdl_course AS c ON c.id = e.courseid INNER JOIN mdl_course_completions AS cc ON c.id = cc.course';
}

$_SESSION['report_query'] = $reporting_sql;

$reporting_records = $DB->get_recordset_sql($reporting_sql);

$columnStarts = "<td  style='border-width:0px 0px 1px 0px; border:0px 0px 1px 0px solid;border-color:#dbdfe7'>";

$columnEnds = "</td>";

echo "<style>th{text-align:left !important;}</style>";

	echo '<div id="exceldown" class="flipcolor" style="border: 1px solid; border-color: #D2D9DE; padding: 4px 2px; border-radius: 5px; float:right;"><a href="excelfile.php">Report Download</a></div>
<div style="clear:both;"></div>';


echo "<table width='100%'>";

		echo "<tr>";
			echo "<td colspan='2'>";

				echo "<table width='100%' cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead>";

				echo "<tr><td>&nbsp;</td></tr>";

					echo "<tr style='background: none repeat scroll 0 0 #efefef'>";

						echo "<th><b>Sr.No.</b></th>";
						echo "<th><b>First Name</b></th>";
						echo "<th><b>Last Name</b></th>";
						echo "<th><b>Email ID</b></th>";
						echo "<th><b>Course</b></th>";
						echo "<th><b>Completion Status</b></th>";
						echo "<th><b>Completion Date</b></th>";
						echo "<th><b>Qualification</b></th>";

					echo "</tr></thead>";

				$i=1;

require_once("$CFG->libdir/completionlib.php");
				$flag1 = 0;
				
				foreach($reporting_records as $reporting_record)
					{	
						$flag1 = 1;		
						
							echo "<tr>";
							echo $columnStarts . $i++ . $columnEnds;
						    echo $columnStarts . $reporting_record->firstname . $columnEnds;             
						    echo $columnStarts . $reporting_record->lastname . $columnEnds;              //Cohort ID
						    echo $columnStarts . $reporting_record->emailid . $columnEnds;                //Cohort Size
						    echo $columnStarts . $reporting_record->coursename . $columnEnds;

				             $course = new stdClass();
				             $course->id = $reporting_record->courseid;
				             $cinfo = new completion_info($course);
				            
				             $is_complete = $cinfo->is_course_complete($reporting_record->userid);
				             
				             if($is_complete == true){
				             	$ccomp_flag += 1;
								echo $columnStarts . "Complete". $columnEnds;
								}
								else{
									$cncomp_flag += 1;
									echo $columnStarts . "In Progress". $columnEnds;
								}
							 
							 if(!empty($reporting_record->timecompleted)){
							 	$newformat = date('d-M-Y',$reporting_record->timecompleted);
								echo $columnStarts .$newformat. $columnEnds;
								}
								else{
									echo $columnStarts . "". $columnEnds;
								}
													
						    echo $columnStarts . "" . $columnEnds;

							echo "</tr>";

					} //// foreach loop END
					

					echo "</table>";

			echo "</td>";		

		echo "</tr>";

	echo "</table>";


$reporting_records->close();
	

echo $OUTPUT->footer();


?>

<script type="text/javascript" language="javascript"src="../js/jquery-1.3.2.min.js"></script>


<style type="text/css" title="currentStyle">


			@import "../css/demo_page.css";			


			@import "../css/demo_table_jui.css";			


</style>


<script type="text/javascript" language="javascript"src="../js/jquery.dataTables.min.js"></script>


<script type="text/javascript" charset="utf-8">


			$(document).ready(function() {	              		


              oTable = jQuery('#example').dataTable({	


              "sPaginationType": "full_numbers"


             });			 


            });


</script>