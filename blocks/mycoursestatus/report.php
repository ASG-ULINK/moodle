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
/** 
 * @package    mycoursestatus
 * @category   blocks
 * @copyright  2014 Lavanya Manne
 * @license    https://github.com/lavanyamanne2/moodle-block_mycoursestatus/blob/master/LICENSE
 */

require_once('../../config.php');
global $COURSE, $DB, $PAGE, $CFG, $USER, $CFG, $SESSION, $OUTPUT;
$courseid = required_param('id', PARAM_INT);
$PAGE->set_url(new moodle_url('/blocks/mycoursestatus/report.php', array('id' => $courseid)));

/* Basic access checks */
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('nocourseid');
}
require_login($course);

$context = context_course::instance($course->id);
require_capability('gradereport/user:view', $context);

if (isguestuser()) {
    /* Force them to see system default, no editing allowed */
    $userid = null;
    $USER->editing = $edit = 0;
    $context = get_context_instance(CONTEXT_SYSTEM);
    $PAGE->set_blocks_editing_capability('moodle/my:configsyspages');
    $header = $course->fullname; // Or even you can display site shortname too like $SITE->shortname.
} else {
    /* We are trying to view or edit our own My Moodle page i.e., admin part.*/
    $userid = $USER->id;
    $context = get_context_instance(CONTEXT_USER, $USER->id);
    $PAGE->set_blocks_editing_capability('moodle/my:manageblocks');
    $header = $course->fullname;
}

$PAGE->set_context(get_system_context(CONTEXT_COURSE));
$PAGE->set_title($header);
$PAGE->set_heading($header);

/* Breadcrumbs or navbar */
$newpagenav = get_string('report', 'block_mycoursestatus');
$PAGE->navbar->add($newpagenav);
echo $OUTPUT->header(); // Actual content starts.
echo html_writer::start_tag('div', array('class' => 'toad'));
echo html_writer::div('Name :'.'&nbsp;'. $USER->firstname.'&nbsp;'.$USER->lastname);
echo html_writer::div('Course :'.'&nbsp;'. $course->fullname);
$mods = $DB->get_recordset_sql('SELECT gg.userid, c.fullname, gi.itemtype, gi.itemname, gi.grademax, gi.gradepass, gg.finalgrade,
                               (CASE WHEN gi.grademax >= gi.gradepass THEN "Completed" ELSE "Not completed" END) AS "status"
                                FROM
                               {grade_items} gi
                               JOIN {grade_grades} gg ON gi.id = gg.itemid
                               JOIN {course} c ON c.id = gi.courseid
                               WHERE
                               gi.itemtype IN ("mod") AND
                               gi.courseid = '.$courseid.' AND gg.userid = '.$USER->id.'');
echo '<br>';
$table = new html_table();
$table->head = array('Modules', 'Maximum grade', 'Grade to pass', 'Scored by you', 'Status');
$table->attributes['class'] = 'generaltable';
foreach ($mods as $mds) {
    $table->data[] = new html_table_row(array(implode(array($mds->itemname)), $mds->grademax, $mds->gradepass, $mds->finalgrade,
                     $mds->status));
}
echo html_writer::table($table);
$ccgrade = $DB->get_recordset_sql('SELECT u.username, gi.courseid, gi.itemname, gg.finalgrade, gg.timemodified, ccc.gradepass,
                                   (CASE WHEN gg.finalgrade >=  ccc.gradepass THEN "Passed" ELSE "Failed" END) AS status
                                   FROM {grade_grades} gg
                                   JOIN {grade_items} gi ON gi.id = gg.itemid
                                   JOIN {user} u ON u.id = gg.userid
                                   JOIN {course} c ON c.id = gi.courseid
                                   JOIN {course_completion_criteria} ccc ON ccc.course = gi.courseid
                                   WHERE
                                   gi.itemtype = "course"
                                   AND gg.finalgrade IS NOT NULL
                                   AND u.id = '.$USER->id.'
                                   AND gi.courseid = '.$courseid.'
                                   AND ccc.module IS NULL');
$table = new html_table();
$table->head = array('Criteria Grade', 'Course Grade', 'Status');
$table->attributes['class'] = 'generaltable';
foreach ($ccgrade as $ccg) {
    $table->data[] = new html_table_row(array($ccg->gradepass, $ccg->finalgrade, $ccg->status));
}
echo html_writer::table($table);
echo html_writer::end_tag('div');
// Actual content ENDS.
echo $OUTPUT->footer();
        