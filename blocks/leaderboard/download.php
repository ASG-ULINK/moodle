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
$groupname = $DB->get_records('lead_table', array('status' => '0'));


$DISTINCT = $DB->get_records_sql('SELECT DISTINCT score FROM {lead_table} WHERE status = ?', array('0'));




?>
<script type="text/javascript">



	$(document).ready(function() {

		$(".flip3").click(function() {

			$(".panel3").slideToggle("slow");

		});

	});
	// for Courses show And Hide
	
	$(document).ready(function() {

		$(".flip2").click(function() {

			$(".panel2").slideToggle("slow");

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
<form name="" action="" method="post">

<div class="flip3 flipcolor" style="border: 1px solid; margin-top:10px; border-color: #D2D9DE; padding: 4px 2px; border-radius: 5px; float:right;">Show/Hide</div>

<div style="clear:both;"></div>

<fieldset style="border: 1px solid; padding: 15px; border-color: #9DBED7; border-radius: 5px;">

    <legend style="line-height:0px; border-bottom:none; line-height:20px; width:auto">Player Filter</legend>

   		<div class="panel3 panelshow" ><div>

   			<label><strong>Select Player: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</strong></label>

			<select name="player_name">
				<option value="">- -</option>
				<optgroup label="Player">

				<?php 
				foreach ($groupname as $groupval)
				 {
					echo '<option value="'.$groupval->id.'" >'.$groupval->name.'</option>';
				 }
				 ?>
				 
				</optgroup>
			</select>
</div>
<br />
<input type="submit" name="search1" value="Search">
</div>
</fieldset>
</form>




<form name="" action="" method="post">

<div class="flip2 flipcolor" style="border: 1px solid; margin-top:10px; border-color: #D2D9DE; padding: 4px 2px; border-radius: 5px; float:right;">Show/Hide</div>

<div style="clear:both;"></div>

<fieldset style="border: 1px solid; padding: 15px; border-color: #9DBED7; border-radius: 5px;">

    <legend style="line-height:0px; border-bottom:none; line-height:20px; width:auto">Score Filter</legend>

   		<div class="panel2 panelshow" ><div>

   			<label><strong>Select Score: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</strong></label>

			<select name="Score">

				<option value="">- -</option>

				<optgroup label="Score">

				<?php 

				foreach ($DISTINCT as $DVS)
				 {
					echo '<option value="'.$DVS->score.'" >'.$DVS->score.'</option>';
				 }
			 ?>
				</optgroup>

			</select>
</div>
<br />
<input type="submit" name="search2" value="Search">
</div>
</fieldset>
</form>

<?php
$_SESSION['player_name'] = $_POST['player_name'];
$_SESSION['player_name'];
if (isset($_POST['search1']))

{
	if (!empty($_POST['player_name'])) 
	{
	
		$player_id = $_POST['player_name'];
        $reporting_sql = $DB->get_records_sql("SELECT * FROM {lead_table} WHERE id = '".$player_id."'");
		//print_r($reporting_sql);
		//die;
	}
	else
	{
		echo "<script> alert('Please Select the Player.'); </script>";
	}
}

 $_SESSION['score'] = $_POST['Score']; 
if (isset($_POST['search2']))
{
    if (!empty($_POST['Score'])) 
	{
		
		$Score = $_POST['Score'];
        $reporting_sql = $DB->get_records_sql("SELECT  * FROM {lead_table} WHERE score = '".$Score."'");

	}
	else
	{
		echo "<script> alert('Please Select the Score.'); </script>";
	}
}



$_SESSION['report_query'] = $reporting_sql;

//$reporting_records = $DB->get_recordset_sql($reporting_sql);
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

						echo "<th><b>Player Name</b></th>";
						echo "<th><b>Score</b></th>";
						echo "<th><b>Description</b></th>";

					echo "</tr></thead>";

				$i=0;
require_once("$CFG->libdir/completionlib.php");
      
                $flag1 = 1;
                // echo "<pre>".print_r($reporting_sql)."</pre>";
				
				foreach($reporting_sql as $reporting_record)
					{	
							echo "<tr>";
							echo $columnStarts . $flag1++ . $columnEnds;  
						    echo $columnStarts . $reporting_record->name . $columnEnds;             
						    echo $columnStarts . $reporting_record->score . $columnEnds;
							echo $columnStarts . $reporting_record->description . $columnEnds;              //Cohort ID
							echo "</tr>";
					  }  // foreach loop END
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