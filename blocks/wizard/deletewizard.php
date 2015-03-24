<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/blocks/wizard/wizard_form.php");
require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/user/profile/lib.php');

require_login();
if (isguestuser()) {
    die();
}
global $DB,$USER;

$returnurl = optional_param('returnurl', '', PARAM_URL);
$id = optional_param('id',0, PARAM_INT);
$select = optional_param('select',0, PARAM_INT);

if (!empty($id)) 
	{
		$query_wizard->id = $id;
		$query_wizard->status = '1';
		$DB->update_record('wizard_name', $query_wizard, $bulk=false);
		redirect("browsewizard.php");
	}
else
	{
		redirect("browsewizard.php");
	}
?>