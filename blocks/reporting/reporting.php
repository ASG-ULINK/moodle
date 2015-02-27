<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
require_once("$CFG->dirroot/blocks/reporting/reporting_form.php");

require_login();
if (isguestuser()) {
    die();
}

global $DB, $USER;
$returnurl = optional_param('returnurl', '', PARAM_URL);
$id = optional_param('id',0, PARAM_INT);
$select = optional_param('select',0, PARAM_INT);

if (empty($returnurl)) {
    $returnurl = new moodle_url('/my/index.php');
}

$context = get_context_instance(CONTEXT_USER, $USER->id);
require_capability('moodle/user:manageownfiles', $context);

if(!empty($_REQUEST['select'])) 
{
	$select = $_REQUEST['select'];
	
}
else{
	$select = '';
}

if(!empty($id)) {
	
	$title = 'Edit reporting details';
} else {
	$title = get_string('reporting', 'block_reporting');
}

$struser = get_string('user');

$PAGE->set_url('/blocks/reporting/reporting.php');
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading(format_string('reporting'));
$PAGE->set_pagelayout();


$data = new stdClass();
$data->returnurl = $returnurl;

echo $OUTPUT->header();
if(!empty($id))	
	echo $OUTPUT->heading('Edit reporting', 2, 'headingblock header');
else echo $OUTPUT->heading(get_string('reporting', 'block_reporting'), 2, 'headingblock header');


if(!empty($id)) {
	
	$account = $DB->get_record('reporting_name', array('id'=>$id));
	$mform_add_partner = new blocks_reporting_reporting_form(null, array('id' => $account->id), 'post', '', array('id' => $account->id, 'account' => $account));		
	
$mform_add_partner->set_data($account);
} else {
	$mform_add_partner = new blocks_reporting_reporting_form(null, null, 'post', '', array('autocomplete'=>'on'));
}

require_once("$CFG->dirroot/blocks/reporting/reporting_form.php");
$mform = new blocks_reporting_reporting_form(null, null, 'post', '', array('autocomplete'=>'on'));


if ($mform_add_partner->is_cancelled()) {
	$reporting_details = $_REQUEST;
	if (!empty($reporting_details['id'])) 
	{
		redirect("browsereporting.php");
	}
	else
	{
    	redirect(get_login_url());
	}
} 
else if ($data = $mform_add_partner->get_data()) {
	$reporting_details = $_REQUEST;
	unset($reporting_details['submitbutton'],$reporting_details['sesskey'],$reporting_details['_qf__blocks_reporting_reporting_form'],$reporting_details['format']);
	$time = time();
	
	$query_reporting->name= $reporting_details['reportingtitle'];
	$query_reporting->score = $reporting_details['score'];
	$query_reporting->status = '0';
	$query_reporting->description = $reporting_details['description']['text'];
	$query_reporting->timemodified = $time;
	

	if (!empty($reporting_details['id'])) 
	{	
		if (!empty($select) && $select == '1') 
		{
			$delete_cpt->id = $reporting_details['id'];
			$delete_cpt->status = '1';
			$DB->update_record('reporting_name', $delete_cpt, $bulk=false);
			redirect("browsereporting.php");
		}
		else{
		$query_reporting->id = $reporting_details['id'];
		$DB->update_record('reporting_name', $query_reporting, $bulk=false);
		redirect("browsereporting.php");
		}
	}
	else
	{
		$query_reporting->id = '';
		$query_reporting->timecreated = $time;
		$r_id = $DB->insert_record('reporting_name',$query_reporting);
	}

	
	
	$mform->display();
}
else if ($questiondata = $mform->get_data()) {
//save
	
	$mform_add_partner->display();

} 
else {

	if (!empty($id) && !empty($select) && $select == '1') 
	{	
		
			$delete_cpt->id = $id;
			$delete_cpt->status = '1';
			$DB->update_record('reporting_name', $delete_cpt, $bulk=false);
			redirect("browsereporting.php");
		
	}
	else
	{
		$mform_add_partner->display();
	}

	
}


echo $OUTPUT->footer();
