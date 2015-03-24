<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/* timeline Plan Block
 * This plugin serves as a database and plan for all timeline activities in the organziation, 
 * where such activities are organized for a more structured timeline program.
 * @package blocks
 * @author: Azmat Ullah, Talha Noor
 * @date: 20-Aug-2014
 * @copyright  Copyrights © 2012 - 2014 | 3i Logic (Pvt) Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once('../../config.php');
$setting = null;
$row = array();
require_once('timeline_plan_form.php');
require_once('lib.php');
require_once("{$CFG->libdir}/formslib.php");
global $DB, $USER, $OUTPUT, $PAGE, $CFG;

$viewpage = required_param('viewpage', PARAM_INT);
$rem = optional_param('rem', null, PARAM_RAW);
$edit = optional_param('edit', null, PARAM_RAW);
$delete = optional_param('delete', null, PARAM_RAW);
$id = optional_param('id', null, PARAM_INT);
$u_id = optional_param('id', null, PARAM_INT);
$lp = optional_param('lp', null, PARAM_INT);
$pageurl = new moodle_url('/blocks/timeline_plan/view.php', array('viewpage' => $viewpage));
$timelineplan_url = new moodle_url('/blocks/timeline_plan/view.php?viewpage=1');
$nav_title = nav_title($viewpage);
?>

<link rel="stylesheet" type="text/css" href="<?php echo $CFG->wwwroot ?>/blocks/timeline_plan/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="<?php echo $CFG->wwwroot ?>/blocks/timeline_plan/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $CFG->wwwroot ?>/blocks/timeline_plan/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
        $('.display').dataTable();
        //"fnServerData":getRows();

    });
</script>
<?php
require_login();
$context = context_system::instance();
if (!has_capability('block/timeline_plan:managepages', $context)) {
    redirect($CFG->wwwroot);
}
$PAGE->set_context($context);
$PAGE->set_url($pageurl);
$PAGE->set_pagelayout('standard');
//$PAGE->set_heading('timeline Plan');
//$PAGE->set_title('timeline Plan');
$PAGE->set_heading(get_string('timeline_plan', 'block_timeline_plan'));
$PAGE->set_title(get_string('timeline_plan', 'block_timeline_plan'));
$PAGE->navbar->ignore_active();
$PAGE->navbar->add(get_string("pluginname", 'block_timeline_plan'), new moodle_url($timelineplan_url));
$PAGE->navbar->add($nav_title);
echo $OUTPUT->header();
$table = new html_table();
$table->head = array('<a href="' . $CFG->wwwroot . '/blocks/timeline_plan/view.php?viewpage=1">' . get_string('timelinepath', 'block_timeline_plan') . '</a>',
    '<a href="' . $CFG->wwwroot . '/blocks/timeline_plan/view.php?viewpage=2">' . get_string('add_training', 'block_timeline_plan') . '</a>',
    '<a href="' . $CFG->wwwroot . '/blocks/timeline_plan/view.php?viewpage=4">' . get_string('assign_training_timelineplan', 'block_timeline_plan') . '</a>',
    '<a href="' . $CFG->wwwroot . '/blocks/timeline_plan/view.php?viewpage=5">' . get_string('assign_timelineplan_user', 'block_timeline_plan') . '</a>',
    '<a href="' . $CFG->wwwroot . '/blocks/timeline_plan/view.php?viewpage=6">' . get_string('trainingstatus', 'block_timeline_plan') . '</a>',
    '<a href="' . $CFG->wwwroot . '/blocks/timeline_plan/view.php?viewpage=7">' . get_string('search', 'block_timeline_plan') . '</a>');
$table->size = array('15%', '15%', '20%', '25%', '15%', '10%');
$table->align = array('center', 'center', 'center', 'center', 'center', 'center');
$table->width = '100%';
$table->data[] = $row;
echo html_writer::table($table);
if ($viewpage == 1) { // Add timeline Plans.
    $form = new timelineplan_form();
    // Insert or Update data - Save button Click.
    if ($fromform = $form->get_data()) {
        if ($fromform->id) {
            $DB->update_record('timeline_timelineplan', $fromform);
            redirect($pageurl, get_string('updated', 'block_timeline_plan'), 2);
        } else {
            // Insert Record
            $DB->insert_record('timeline_timelineplan', $fromform);
            redirect($pageurl, get_string('saved', 'block_timeline_plan'), 2);
        }
    }
    // Delete Record.
    if ($rem) {
        echo $OUTPUT->confirm(get_string('plan_delete', 'block_timeline_plan'), '/blocks/timeline_plan/view.php?viewpage=1&rem=rem&delete=' . $id, '/blocks/timeline_plan/view.php?viewpage=1');
        if ($delete) {
            delete_timelineplan_record('timeline_timelineplan', $delete, $pageurl);
        }
    }
    // Edit Record.
    if ($edit) {
        $get_timelineplan = $DB->get_record('timeline_timelineplan', array('id' => $id), '*');
        $form = new timelineplan_form(null, array('id' => $get_timelineplan->id));
        $form->set_data($get_timelineplan);
    }
} else if ($viewpage == 2) { // Add Training Types.
    $form = new training_form();
    if ($fromform = $form->get_data()) {
        if ($fromform->id) {
            // Update Record
            $DB->update_record('timeline_training', $fromform);
            redirect($pageurl, get_string('updated', 'block_timeline_plan'), 2);
        } else {
            // Insert Record
            $DB->insert_record('timeline_training', $fromform);
            redirect($pageurl, get_string('saved', 'block_timeline_plan'), 2);
        }
    }
    // Delete Record.
    if ($rem) {
        echo $OUTPUT->confirm(get_string('training_delete', 'block_timeline_plan'), '/blocks/timeline_plan/view.php?viewpage=2&rem=rem&delete=' . $id, '/blocks/timeline_plan/view.php?viewpage=2');
        if ($delete) {
            delete_timelineplan_record('timeline_training', $delete, $pageurl);
        }
    }
    // Edit Record.
    if ($edit) {
        $get_timelineplan = $DB->get_record('timeline_training', array('id' => $id), '*');
        $form = new training_form(null, array('id' => $get_timelineplan->id));
        $form->set_data($get_timelineplan);
    }
} else if ($viewpage == 3) { // Add Training Method.
    $form = new trainingmethod_form();
} else if ($viewpage == 4) { // Assign Training into timeline Plan.
    $form = new assigntraining_timelineplan__form();
    if ($fromform = $form->get_data()) {
        // print_object($fromform);
        if ($fromform->id) {
            // Update Record
            $DB->update_record('timeline_plan_training ', $fromform);
        } else {
            // Insert Record
            $max = sizeof($fromform->t_id);
            //print $max;
            $record = new stdClass();
            $record->lp_id = $fromform->l_id;
            foreach ($fromform->t_id as $formtid) {
                $record->t_id = $formtid;
                $DB->insert_record('timeline_plan_training', $record);
                // Condtion for already assigned timeline plan
                // Getting lpt_id
                // Get lp_id and getting user array
                if (islp_assign_user($record->lp_id)) {
                    $lpt_id = get_lpt_id($record->lp_id, $record->t_id);
                    $users = get_timelineplan_user($record->lp_id);
                    // Insert User Training if leraning plan already assgin to user
                    $record2 = new stdClass();
                    $record2->lpt_id = $lpt_id;
                    foreach ($users as $userid) {
                        $record2->u_id = $userid->u_id;
                        $DB->insert_record('timeline_user_trainingplan', $record2);
                    }
                }
            }
        }
        redirect($pageurl, get_string('saved_changes', 'block_timeline_plan'), 2);
    }
    // Delete Record.
    if ($rem) {
//        echo $OUTPUT->confirm(get_string('record_delete', 'block_timeline_plan'), '/blocks/timeline_plan/view.php?viewpage=4&rem=rem&delete='.$id,
//                                         '/blocks/timeline_plan/view.php?viewpage=4');
        echo $OUTPUT->confirm(get_string('record_delete', 'block_timeline_plan'), '/blocks/timeline_plan/view.php?viewpage=4&rem=rem&delete=' . $id . '&id=' . $lp, '/blocks/timeline_plan/view.php?viewpage=4');
        if ($delete) {
            // delete_timelineplan_record('timeline_plan_training', $delete, $pageurl);
            delete_timelineplan_record('timeline_plan_training', $delete, $pageurl, $id);
        }
    }
} else if ($viewpage == 5) { // Assign timeline plan to User.
    $form = new assignlerningplan_user_form();
    if ($fromform = $form->get_data()) {
        // print_object($fromform);
        if ($fromform->id) {
            // Update Record
            $DB->update_record('timeline_user_timelineplan', $fromform);
        } else {
            // Insert Record
            $record = new stdClass();
            $record2 = new stdClass();
            $record->lp_id = $fromform->l_id;
            $record->assignee_id = $USER->id;
            foreach ($fromform->u_id as $formtid) {
                $record->u_id = $formtid;
                $training = timelineplan_training($fromform->l_id);
                foreach ($training as $train) {
                    $record2->lpt_id = $train->id;
                    $record2->u_id = $record->u_id;
                    // Insert in timeline_user_trainingplan
                    $DB->insert_record('timeline_user_trainingplan', $record2);
                }
                // Insert in timeline_user_timelineplan
                $DB->insert_record('timeline_user_timelineplan', $record);
            }
        }
        redirect($pageurl, get_string('saved', 'block_timeline_plan'), 2);
    }
    // Delete Record.
    if ($rem) {
        echo $OUTPUT->confirm(get_string('record_delete', 'block_timeline_plan'),
                //                              '/blocks/timeline_plan/view.php?viewpage=5&rem=rem&delete='.$id, '/blocks/timeline_plan/view.php?viewpage=5');
                '/blocks/timeline_plan/view.php?viewpage=5&rem=rem&delete=' . $u_id . '&lp=' . $lp, '/blocks/timeline_plan/view.php?viewpage=5');
        if ($delete) {
            // delete_timelineplan_record('timeline_user_timelineplan', $delete, $pageurl);
            delete_timelineplan_record('timeline_user_timelineplan', $delete, $pageurl, $lp);
        }
    }
} else if ($viewpage == 6) { // Set Training Status.
    $form = new trainingstatus_form();
    $setting = optional_param('setting', null, PARAM_INT);
    if ($fromform = $form->get_data()) {
        $status_id = status_id($fromform->l_id, $fromform->u_id, $fromform->t_id);
        $fromform->id = $status_id;
        $DB->update_record('timeline_user_trainingplan', $fromform);
        redirect($pageurl, get_string('saved_changes', 'block_timeline_plan'), 2);
    }
} else if ($viewpage == 7) {
    $form = new search();
}
// Set viewpage with form.
$toform['viewpage'] = $viewpage;
$form->set_data($toform);
// Display Form.
$form->display();
// Form Cancel.
if ($fromform = $form->is_cancelled()) {
    redirect("{$CFG->wwwroot}" . "/blocks/timeline_plan/view.php?viewpage=" . $viewpage);
}
// Display List.
if ($table = $form->display_list()) {
    // echo '<div id="prints">';
    echo html_writer::table($table);
    // echo '</div>';
}
$PAGE->requires->js_init_call('M.block_timeline_plan.init', array($viewpage, $setting));
echo $OUTPUT->footer();
// End Form Display