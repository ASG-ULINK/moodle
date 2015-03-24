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

$PAGE->set_url('/blocks/wizard/assignwizard.php');
$PAGE->set_context($context);
$PAGE->set_title(format_string('Assign wizard'));
$PAGE->set_heading(format_string('wizard'));
$PAGE->set_pagelayout();


$data = new stdClass();

echo $OUTPUT->header();

echo $OUTPUT->heading(format_string('Assign Group wizard '), 2, 'headingblock header');

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
   			<label><strong>Select Wizard: </strong></label>
			<select name="wizard" class="wizard">
				<option>- -</option>
				<optgroup label="Date">';
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
  if($_REQUEST['id']!=''){
        echo '<input type="submit" name="submit" value="Update" class="btn" /><input type="hidden" name="action" value="update" /><input type="hidden" name="id" value="'.$_REQUEST['id'].'" />';
    }
    else{
		echo '<input type="submit" name="sub_group" value="Submit" />';
	}

echo '</div><form>';


if (isset($_POST["sub_group"])) { 

	 $wizard=$_POST['wizard'];
	 $course=$_POST['course'];
	  $group= $_POST['group'];
    // $group= '2';
    
	 $data->wizard = $wizard;
	 $data->course = $course;
	 $data->group = $group;
//print_r($data);
 $insert = "INSERT INTO mdl_assign_group_wizard (course,wizard, groups) VALUES ('".$wizard."','".$course."','".$group."')";
//echo $insert;
    $DB->execute($insert);


}else{  
    echo "";
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


