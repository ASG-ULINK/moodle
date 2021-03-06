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
$id = optional_param('id','', PARAM_INT);
$context = get_context_instance(CONTEXT_USER, $USER->id);
require_capability('moodle/user:manageownfiles', $context);

	
$struser = get_string('user');

$PAGE->set_url('/blocks/wizard/assignwizard.php');
$PAGE->set_context($context);
$PAGE->set_title(format_string('Assign wizard'));
$PAGE->set_heading(format_string('wizard'));
$PAGE->set_pagelayout();


$data = new stdClass();

echo $OUTPUT->header();

echo $OUTPUT->heading(format_string('Assign Group wizard '), 2, 'headingblock header');


if($id != '' && $_REQUEST['selectdel'] == 'del')
{
	$insert = "UPDATE mdl_assign_group_wizard SET status = '1' WHERE id = '".$id."'";
    $DB->execute($insert);
    redirect("assign_wizard_group.php");
}

       $course=$DB->get_records_sql('SELECT * FROM  `mdl_course`');
       $rec=$DB->get_records_sql('SELECT * FROM  `mdl_wizard_name`');
       $group=$DB->get_records_sql('SELECT * FROM  `mdl_groups`');
       
       echo '<form name="assignwizard" action="" method="post" id="assignwizard">
       <div>
   			<label><strong>Select course: </strong></label>
			<select name="course" class="course1">
				<option>- -</option>
				<optgroup label="Course">';
				foreach ($course as $cou) 
		        {
		       		echo '<option value="'.$cou->id.'" >'.$cou->fullname.'</option>';
		        }
				 
				echo '</optgroup>
			</select>
</div>
<div>
   			<label><strong>Select wizard: </strong></label>
			<select name="wizard" class="wizard">
				<option>- -</option>
				<optgroup label="wizard">';
				foreach ($rec as $datas) 
		        {
		       		echo '<option value="'.$datas->id.'" >'.$datas->name.'</option>';
		        } 
				echo '</optgroup>
			</select>
</div>
<div>
   			<label><strong>Select group: </strong></label>
			<select name="group"  class="group">
				<option></option>
				<optgroup label="Group">';
				foreach ($group as $groups) 
		        {
		       		echo '<option value="'.$groups->id.'" >'.$groups->name.'</option>';
		        } 
				echo '</optgroup>
			</select>
</div>';
  if($id != ''){
        echo '<input type="submit" name="update" value="Update" class="btn" /><input type="hidden" name="action" value="update" /><input type="hidden" name="id" value="'.$_REQUEST['id'].'" />';
    }
    else{
		echo '<input type="submit" name="submit" value="Submit" />';
	}

echo '</div><form>';


if (isset($_POST["submit"])) { 

	$wizard=$_POST['wizard'];
	$courses=$_POST['course'];
	$group= $_POST['group'];
    
 	$insert = "INSERT INTO mdl_assign_group_wizard (wizard,course,groups) VALUES ('".$wizard."','".$courses."','".$group."')";

    $DB->execute($insert);


}
if (isset($_POST["update"])) { 

	$wizard=$_POST['wizard'];
	$courses=$_POST['course'];
	$group= $_POST['group'];
    
 	$update= "UPDATE mdl_assign_group_wizard SET wizard = '".$wizard."',course = '".$courses."',groups = '".$group."' WHERE id = '".$id."'";

    $DB->execute($update);
	redirect("assign_wizard_group.php");
}


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
input[type="submit"] {
background: #00AEEF;
margin-left: 188px;
width: 95px;
}
</style>
