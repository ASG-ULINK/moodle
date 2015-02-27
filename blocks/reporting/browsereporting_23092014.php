<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
require_once("$CFG->dirroot/blocks/reporting/reporting_form.php");

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

	$title = get_string('browsereporting', 'block_reporting');


$struser = get_string('user');

$PAGE->set_url('/blocks/reporting/browsereporting.php');
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_pagelayout('mydashboard');


$data = new stdClass();
$data->returnurl = $returnurl;

echo $OUTPUT->header();


//echo $OUTPUT->box_start('generalbox');


echo $OUTPUT->heading(get_string('browsereporting', 'block_reporting'), 2, 'headingblock header');





$query = "select bc.*, c.fullname, c.summary from {block_reporting} as bc join {reporting} as c on c.id=bc.reportingid order by bc.id DESC";





$partners = $DB->get_recordset_sql($query);





$columnStarts = "<td  style='border-width:0px 0px 1px 0px; border:0px 0px 1px 0px solid;border-color:#dbdfe7'>";


$columnEnds = "</td>";





echo "<style>th{text-align:left !important;}</style>";


echo "<table width='100%'>";


		


		echo "<tr>";


			echo "<td colspan='2'>";			


				echo "<table width='100%' cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead>";


				echo "<tr><td>&nbsp;</td></tr>";


					echo "<tr style='background: none repeat scroll 0 0 #efefef'>";


						echo "<th><b>reporting</b></th>";


						echo "<th><b>Description</b></th>";

						echo "<th><b>Widget</b></th>";

						echo "<th><b>Price (USD)</b></th>";


						echo "<th><b></b></th>";


						echo "<th><b></b></th>";


					echo "</tr></thead>";





					foreach($partners as $partner){				


						echo "<tr>";


						echo $columnStarts . $partner->fullname . $columnEnds;


						echo $columnStarts . $partner->summary . $columnEnds;
						
						echo $columnStarts . '<a href="javascript:void(0)" onclick="window.open(\''.$CFG->wwwroot.'/blocks/reporting/view-widget.php?id='.$partner->id.'\',\'widget\', \'width=265,height=380\')"><img height="10px" src="'.$CFG->wwwroot.'/blocks/reporting/images/icons/widget.png"'.'"/></a>' . $columnEnds;


						echo $columnStarts . $partner->price . $columnEnds;
						

						echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/reporting/reporting.php?id='.$partner->id.'"><img height="10px" src="'.$CFG->wwwroot.'/blocks/reporting/images/icons/edit.png"/></a>' . $columnEnds;


						echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/reporting/reporting.php?id='.$partner->id.'&select=1"><img height="10px" src="'.$CFG->wwwroot.'/blocks/reporting/images/icons/delete.png"/></a>' . $columnEnds;


						echo "</tr>";


					}


					


					echo "</table>";


			echo "</td>";		


		echo "</tr>";


		


	echo "</table>";


	


	$partners->close();


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