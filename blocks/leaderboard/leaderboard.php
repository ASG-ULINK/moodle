<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
require_once("$CFG->dirroot/blocks/leaderboard/leaderboard_form.php");


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
	
	$title = 'Edit Leaderboard details';
} else {
	$title = get_string('leaderboard', 'block_leaderboard');
}

$struser = get_string('user');

$PAGE->set_url('/blocks/leaderboard/leaderboard.php');
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading(format_string('leaderboard'));
$PAGE->set_pagelayout();


$data = new stdClass();
$data->returnurl = $returnurl;

echo $OUTPUT->header();
if(!empty($id))	
	echo $OUTPUT->heading('Edit leaderboard:', 2, 'headingblock header');
else echo $OUTPUT->heading(get_string('leaderboard', 'block_leaderboard'), 2, 'headingblock header');


if(!empty($id)) {
	
	$account = $DB->get_record('lead_table', array('id'=>$id));
	$mform_add_partner = new blocks_leaderboard_leaderboard_form(null, array('id' => $account->id), 'post', '', array('id' => $account->id, 'account' => $account));		
	
$mform_add_partner->set_data($account);
} else {
	$mform_add_partner = new blocks_leaderboard_leaderboard_form(null, null, 'post', '', array('autocomplete'=>'on'));
}

require_once("$CFG->dirroot/blocks/leaderboard/leaderboard_form.php");
$mform = new blocks_leaderboard_leaderboard_form(null, null, 'post', '', array('autocomplete'=>'on'));


if ($mform_add_partner->is_cancelled()) {
	$leaderboard_details = $_REQUEST;
	if (!empty($leaderboard_details['id'])) 
	{
		redirect("browseleaderboard.php");
	}
	else
	{
    	redirect(get_login_url());
	}
} 
else if ($data = $mform_add_partner->get_data()) {
	$leaderboard_details = $_REQUEST;
	unset($leaderboard_details['submitbutton'],$leaderboard_details['sesskey'],$leaderboard_details['_qf__blocks_leaderboard_leaderboard_form'],$leaderboard_details['format']);
	$time = time();
	
	$query_leaderboard->name= $leaderboard_details['leaderboardtitle'];
	$query_leaderboard->score = $leaderboard_details['score'];
	$query_leaderboard->status = '0';
	$query_leaderboard->description = $leaderboard_details['description']['text'];
	$query_leaderboard->timemodified = $time;
	

	if (!empty($leaderboard_details['id'])) 
	{	
		if (!empty($select) && $select == '1') 
		{
			$delete_cpt->id = $leaderboard_details['id'];
			$delete_cpt->status = '1';
			$DB->update_record('lead_table', $delete_cpt, $bulk=false);
			redirect("browseleaderboard.php");
		}
		else{
		$query_leaderboard->id = $leaderboard_details['id'];
		$DB->update_record('lead_table', $query_leaderboard, $bulk=false);
		redirect("browseleaderboard.php");
		}
	}
	else
	{
		$query_leaderboard->id = '';
		$query_leaderboard->timecreated = $time;
		$r_id = $DB->insert_record('lead_table',$query_leaderboard);
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
			$DB->update_record('lead_table', $delete_cpt, $bulk=false);
			redirect("browseleaderboard.php");
		
	}
	else
	{
		$mform_add_partner->display();
	}

	
}


echo $OUTPUT->footer();
