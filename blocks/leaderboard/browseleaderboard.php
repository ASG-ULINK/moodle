<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
require_once("$CFG->dirroot/blocks/leaderboard/leaderboard_form.php");

require_login();
if (isguestuser()) {
    die();
}

global $DB;
$returnurl = optional_param('returnurl', '', PARAM_URL);
$id = optional_param('id',0, PARAM_INT);
$select = optional_param('select',0, PARAM_INT);

if (empty($returnurl)) {
    $returnurl = new moodle_url('/my/index.php');
}
$context = get_context_instance(CONTEXT_USER, $USER->id);
require_capability('moodle/user:manageownfiles', $context);
	$title = get_string('browseleaderboard', 'block_leaderboard');

$struser = get_string('user');

$PAGE->set_url('/blocks/leaderboard/browseleaderboard.php');
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_pagelayout();

$data = new stdClass();
$data->returnurl = $returnurl;

echo $OUTPUT->header();

echo $OUTPUT->heading(get_string('browseleaderboard', 'block_leaderboard'), 2, 'headingblock header');

$leaderboard_records = $DB->get_records('lead_table', array('status' => '0'));
//$leaderboard_records = $DB->get_records_sql("SELECT id,name, score, description FROM mdl_lead_table");

$columnStarts = "<td  style='border-width:0px 0px 1px 0px; border:0px 0px 1px 0px solid;border-color:#dbdfe7'>";
$columnEnds = "</td>";
echo "<style>th{text-align:left !important;}</style>";
echo "<table width='100%'>";
		echo "<tr>";
			echo "<td colspan='2'>";
				echo "<table width='100%' cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead>";
				echo "<tr><td>&nbsp;</td></tr>";
					echo "<tr style='background: none repeat scroll 0 0 #efefef'>";
						echo "<th><b>Sr.No.</b></th>";
						echo "<th><b>Player: Name</b></th>";
						echo "<th><b>Score:</b></th>";
						echo "<th><b>Description:</b></th>";
						echo "<th><b></b></th>";
						echo "<th><b></b></th>";
					echo "</tr></thead>";
				$i=1;
				foreach($leaderboard_records as $leaderboard_record)
					{				
						echo "<tr>";
						echo $columnStarts . $i++ . $columnEnds;
					    echo $columnStarts . $leaderboard_record->name . $columnEnds;             
					    echo $columnStarts . $leaderboard_record->score . $columnEnds;              //Cohort ID
					    echo $columnStarts . $leaderboard_record->description . $columnEnds;                //Cohort Size
					   // echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/leaderboard/leaderboard.php?id='.$leaderboard_record->id.'"><img height="10px" src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/edit.png"/></a>' . $columnEnds;
					    echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/leaderboard/leaderboard.php?id='.$leaderboard_record->id.'&select=1"><img height="10px" src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/delete.png"/></a>' . $columnEnds;
						echo "</tr>";

					}
					echo "</table>";
			echo "</td>";		
		echo "</tr>";
	echo "</table>";
	$leaderboard_records->close();
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