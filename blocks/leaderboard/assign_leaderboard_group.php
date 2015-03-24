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




$context = get_context_instance(CONTEXT_USER, $USER->id);
require_capability('moodle/user:manageownfiles', $context);

	
$struser = get_string('user');

$PAGE->set_url('/blocks/leaderboard/assignleaderboard.php');
$PAGE->set_context($context);
$PAGE->set_title(format_string('Assign leaderboard Group'));
$PAGE->set_heading(format_string('leaderboard'));
$PAGE->set_pagelayout();


$data = new stdClass();

echo $OUTPUT->header();

echo $OUTPUT->heading(format_string('Assign leaderboard Group'), 2, 'headingblock header');

       
$group_leaderboard = $DB->get_records_sql("SELECT * FROM  `mdl_assign_group_leaderboard` WHERE status = '0'");


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
                        echo "<th><b>leaderboard</b></th>";

                        echo "<th><b>Group</b></th>";

						echo "<th><b>Course</b></th>";
                       									
						echo "<th><b></b></th>";


						echo "<th><b></b></th>";


						echo "<th><b></b></th>";


					echo "</tr></thead>";
			
					$i=1;
                    foreach ($group_leaderboard as $group_leaderboardvalue) {
                    	
                    $course=$DB->get_record_sql('SELECT * FROM  `mdl_course` WHERE id="'.$group_leaderboardvalue->course.'"');
			        $rec=$DB->get_record_sql('SELECT * FROM  `mdl_lead_table` WHERE id="'.$group_leaderboardvalue->leaderboard.'"');
			        $group=$DB->get_record_sql('SELECT * FROM  `mdl_groups` WHERE id="'.$group_leaderboardvalue->groups.'"');
                   
						echo "<tr>";

					echo $columnStarts . $i++ . $columnEnds;
					echo $columnStarts . $rec->name . $columnEnds;

					echo $columnStarts . $group->name . $columnEnds;

					echo $columnStarts . $course->fullname . $columnEnds;

					echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/leaderboard/assignleaderboard.php?id='.$group_leaderboardvalue->id.'"><img height="10px" src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/edit.png"/></a>' . $columnEnds;


					echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/leaderboard/assignleaderboard.php?id='.$group_leaderboardvalue->id.'&selectdel=del"><img height="10px" src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/delete.png"/></a>' . $columnEnds;

					// echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/leaderboard/leaderboard.php?id='.$group_leaderboardvalue->id.'"><img height="10px" src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/edit.png"/></a>' . $columnEnds;


					// echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/leaderboard/leaderboard.php?id='.$group_leaderboardvalue->id.'&select=1"><img height="10px" src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/delete.png"/></a>' . $columnEnds;

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
.leaderboard
{
margin-left: 84px;
}
</style>


