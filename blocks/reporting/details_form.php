<?php

require('../../config.php');
require_once("$CFG->dirroot/lib/filelib.php");
require_once("$CFG->dirroot/blocks/reporting/reporting_form.php");
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

if (empty($returnurl)) {
    $returnurl = new moodle_url('/my/index.php');
}

$context = get_context_instance(CONTEXT_USER, $USER->id);
require_capability('moodle/user:manageownfiles', $context);

if(!empty($id)) {
    $title = 'Edit reporting details';
} else {
    $title = get_string('reporting', 'block_reporting');
}

$struser = get_string('user');

$PAGE->set_url('/blocks/reporting/details_form.php');
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading(format_string('reporting'));
$PAGE->set_pagelayout();

$columnclass = "border-width:0px 0px 1px 0px; border:0px 0px 1px 0px solid;border-color:#dbdfe7";
         
          
        
        /////////////////////*********************************//////////////////////////
        //////////////************** EDIT BY ALOK SHARMA **************////////////////
        ///////////////////////////***********************////////////////////////////

        $reporting_records = $DB->get_records('reporting_name', array('status' => '0'));

$columnStarts = "<td  style='border-width:0px 0px 1px 0px; border:0px 0px 1px 0px solid;border-color:#dbdfe7'>";
$columnEnds = "</td>";
echo "<style>th{text-align:left !important;}</style>";


    echo "<table width='100%' cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead><tr style='background: none repeat scroll 0 0 #efefef'><th>Sr.<th><th>reporting Name<th>Score</th><th>Description</th><th>Edit</th><th>Delete</th></tr></thead><tbody>";
$i=1;
foreach ($reporting_records as $reporting_record) 
{   
    echo "<tr>";
    echo $columnStarts . $i++ . $columnEnds;
    echo $columnStarts . $reporting_record->name . $columnEnds;             
    echo $columnStarts . $reporting_record->score . $columnEnds;              //Cohort ID
    echo $columnStarts . $reporting_record->description . $columnEnds;                //Cohort Size
    echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/reporting/reporting.php?id='.$partner->id.'"><img height="10px" src="'.$CFG->wwwroot.'/blocks/reporting/images/icons/edit.png"/></a>' . $columnEnds;
    echo $columnStarts . '<a href="'.$CFG->wwwroot.'/blocks/reporting/reporting.php?id='.$partner->id.'&select=1"><img height="10px" src="'.$CFG->wwwroot.'/blocks/reporting/images/icons/delete.png"/></a>' . $columnEnds;
    echo "</tr>";
}

echo "</tbody></table>";

// $this->add_action_buttons();

