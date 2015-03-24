<?php
require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/repository/lib.php");
require_once("$CFG->dirroot/blocks/wizard/wizard_form.php");


// require_login();
// if (isguestuser()) {
//     die();
// }

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
	
	$title = 'Edit wizard details';
} else {
	$title = get_string('wizard','block_wizard');
}

$struser = get_string('user');

$PAGE->set_url('/blocks/wizard/wizard.php');
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading(format_string('wizard'));
$PAGE->set_pagelayout();


$data = new stdClass();
$data->returnurl = $returnurl;

echo $OUTPUT->header();
if(!empty($id))	
	echo $OUTPUT->heading('Edit wizard', 2, 'headingblock header');
else echo $OUTPUT->heading(get_string('wizard', 'block_wizard'), 2, 'headingblock header');


if(!empty($id)) {
	
	$account = $DB->get_record('wizard_name', array('id'=>$id));
	$mform_add_partner = new blocks_wizard_wizard_form(null, array('id' => $account->id), 'post', '', array('id' => $account->id, 'account' => $account));		
	
$mform_add_partner->set_data($account);
} else {
	$mform_add_partner = new blocks_wizard_wizard_form(null, null, 'post', '', array('autocomplete'=>'on'));
}

require_once("$CFG->dirroot/blocks/wizard/wizard_form.php");
$mform = new blocks_wizard_wizard_form(null, null, 'post', '', array('autocomplete'=>'on'));
// $mform->display();

if ($mform_add_partner->is_cancelled()) {
	$wizard_details = $_REQUEST;

	if (!empty($wizard_details['id'])) 
	{
		redirect("browsewizard.php");
	}
	else
	{
    	redirect(get_login_url());
	}
} 
else if ($data = $mform_add_partner->get_data()) {
	$wizard_details = $_REQUEST;
	unset($wizard_details['submitbutton'],$wizard_details['sesskey'],$wizard_details['_qf__blocks_wizard_wizard_form'],$wizard_details['format']);
	$time = time();
	
	$query_wizard->name= $wizard_details['wizardtitle'];
	$query_wizard->firstname = $wizard_details['firstname'];
	$query_wizard->lastname = $wizard_details['lastname'];
	$query_wizard->email = $wizard_details['email'];
	$query_wizard->address = $wizard_details['address'];
	$query_wizard->city = $wizard_details['city'];
	$query_wizard->state = $wizard_details['state'];
	
   
   $query_wizard->description = $wizard_details['description']['text'];
   $query_wizard->userfile = 'image';
   $query_wizard->status = '0';
	$query_wizard->timemodified = $time;
	

	if (!empty($wizard_details['id'])) 
	{	
		if (!empty($select) && $select == '1') 
		{
			$delete_cpt->id = $wizard_details['id'];
			$delete_cpt->status = '1';
			$DB->update_record('wizard_name', $delete_cpt, $bulk=false);
			redirect("browsewizard.php");
		}
		else{
			
		 $query_wizard->id = $wizard_details['id'];
		// echo "<pre>".print_r($query_wizard)."</pre>";
		$DB->update_record('wizard_name', $query_wizard, $bulk=false);
		redirect("browsewizard.php");
		}
	}
	else
	{
		$query_wizard->id = '';
		$query_wizard->timecreated = $time;
		
  

	 $r_id = $DB->insert_record('wizard_name',$query_wizard);
	 
	 redirect("browsewizard.php");
          


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
		
			$delete_wizard->id = $id;
			//echo "<pre>".print_r($query_wizard)."</pre>";
			$delete_wizard->status = '1';
		 $DB->update_record('wizard_name', $delete_wizard, $bulk=false);
			redirect("browsewizard.php");
		
	}
	else 
	{
		$mform_add_partner->display();
	}

	
}


echo $OUTPUT->footer();
