<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
require_once("$CFG->dirroot/blocks/wizard/wizard_form.php");

require_login();
if (isguestuser()) {
    die();
}

global $DB;




$context = get_context_instance(CONTEXT_USER, $USER->id);
require_capability('moodle/user:manageownfiles', $context);

	
$struser = get_string('user');

$PAGE->set_url('/blockswizard/assignwizard.php');
$PAGE->set_context($context);
$PAGE->set_title(format_string('Assign wizard Group'));
$PAGE->set_heading(format_string('wizard'));
$PAGE->set_pagelayout();


$data = new stdClass();

echo $OUTPUT->header();

echo $OUTPUT->heading(format_string('Assign wizard Group'), 2, 'headingblock header');

       
$group_wizard = $DB->get_records_sql("SELECT * FROM  `mdl_assign_group_wizard` WHERE status = '0'");


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
                        echo "<th><b>wizard</b></th>";

                        echo "<th><b>Group</b></th>";

						echo "<th><b>Course</b></th>";
                       									
						echo "<th><b></b></th>";


						echo "<th><b></b></th>";


						echo "<th><b></b></th>";


					echo "</tr></thead>";
			
					$i=1;
                    foreach ($group_wizard as $group_wizardvalue) {
                    	
                    $course=$DB->get_record_sql('SELECT * FROM  `mdl_course` WHERE id="'.$group_wizardvalue->course.'"');
			        $rec=$DB->get_record_sql('SELECT * FROM  `mdl_wizard_name` WHERE id="'.$group_wizardvalue->wizard.'"');
			        $group=$DB->get_record_sql('SELECT * FROM  `mdl_groups` WHERE id="'.$group_wizardvalue->groups.'"');
                   
						echo "<tr>";

					echo $columnStarts . $i++ . $columnEnds;
					echo $columnStarts . $rec->name . $columnEnds;

					echo $columnStarts . $group->name . $columnEnds;

					echo $columnStarts . $course->fullname . $columnEnds;

					echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/wizard/assignwizard.php?id='.$group_wizardvalue->id.'"><img height="10px" src="'.$CFG->wwwroot.'/blocks/wizard/images/icons/edit.png"/></a>' . $columnEnds;


					echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/wizard/assignwizard.php?id='.$group_wizardvalue->id.'&selectdel=del"><img height="10px" src="'.$CFG->wwwroot.'/blocks/wizard/images/icons/delete.png"/></a>' . $columnEnds;

					// echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/cpd/cpd.php?id='.$group_cpdvalue->id.'"><img height="10px" src="'.$CFG->wwwroot.'/blocks/cpd/images/icons/edit.png"/></a>' . $columnEnds;


					// echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/cpd/cpd.php?id='.$group_cpdvalue->id.'&select=1"><img height="10px" src="'.$CFG->wwwroot.'/blocks/cpd/images/icons/delete.png"/></a>' . $columnEnds;

					 	echo "</tr>";


					// }

                    }
					


					echo "</table>";


			echo "</td>";		


		echo "</tr>";


		


	echo "</table>";
?>

<style type="text/css" title="currentStyle">
strong
{
line-height: 50px;
}
h2.headingblock{
line-height: 3em;
}
select, input, button, textarea {

padding: 3px;
margin-left: 66px;
width: 150px
}
.group
{
margin-left: 74px;
}
.course1
{
margin-left: 70px;
}
.wizard
{
margin-left: 84px;
}
</style>


