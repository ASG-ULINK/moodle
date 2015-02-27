<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/blocks/cpd/cpd_form.php");
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
		$query_cpd->id = $id;
		$query_cpd->status = '1';
		$DB->update_record('cpd_name', $query_cpd, $bulk=false);
		redirect("browsecpd.php");
	}
else
	{
		redirect("browsecpd.php");
	}
?>