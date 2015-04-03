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
class block_mycoursestatus extends block_base {
    public function init() {
        global $CFG;
        $this->title = get_string('mycoursestatus', 'block_mycoursestatus');
    }

    public function get_content() {
        global $COURSE, $DB, $PAGE, $CFG, $USER, $CFG, $SESSION, $OUTPUT;
        if ($this->content !== null) {
             return $this->content;
        }
        $this->content = new stdClass;
        if (isloggedin() and !has_capability('moodle/site:config', get_context_instance(CONTEXT_SYSTEM))) {
            $context = $PAGE->context;
            $coursecontext = $context->get_course_context(); /* current courseid */
            $courseid = $coursecontext->instanceid;
            $this->content->text .= html_writer::start_tag('div', array('class' => 'content'));
            /* BLOCK CONTENT IN A COURSE PAGE */
            $currentcourseid  = optional_param('id', null, PARAM_INT);
            if ($currentcourseid == $courseid) {
                $criteriamods = $DB->get_recordset_sql('SELECT count(cm.id) AS "coursemodules", (SELECT count(cmc.coursemoduleid)
                                                        FROM {course_modules_completion} cmc JOIN {course_modules} cm
                                                        ON cmc.coursemoduleid = cm.id WHERE cmc.userid = '.$USER->id.'
                                                        AND cm.course = '.$COURSE->id.' AND cmc.completionstate BETWEEN 1 AND 3)
                                                        AS "completedmodules" FROM {course_modules} cm WHERE
                                                        cm.course= '.$COURSE->id.'');
                foreach ($criteriamods as $ctmds) {
                    $width = round(($ctmds->completedmodules / $ctmds->coursemodules) * 100);
                    $this->content->text .= html_writer::div(get_string('cname', 'block_mycoursestatus').'&nbsp;'.$COURSE->fullname,
                                            'cname');
                    $this->content->text .= '<div class="mods">
                                              <div style="float:left;width:50px;padding-top:3px;color:#32529A;">Modules:</div>
                                              <div style="float:left;">
                                               <div class="mydiv1"><div class="mydiv2" style="width:'.$width.'%">'.$width.'% </div>
                                               </div>
                                              </div>
                                             </div>';
                    if ($ctmds->completedmodules == $ctmds->coursemodules) {
                        $coursegrade = $DB->get_recordset_sql('SELECT * FROM (SELECT u.username,gi.courseid, gi.itemname,
                                                               gg.finalgrade, gg.timemodified FROM {grade_grades} gg
                                                               JOIN {grade_items} gi ON gi.id = gg.itemid
                                                               JOIN {user} u ON u.id = gg.userid
                                                               JOIN {course} c ON c.id = gi.courseid
                                                               WHERE gi.itemtype = "course"
                                                               AND gg.finalgrade IS NOT NULL
                                                               AND u.id = '.$USER->id.'
                                                               AND gi.courseid ='.$COURSE->id.') AS temp');
                        $this->content->text .= html_writer::start_tag('div', array('class' => 'status'));
                        foreach ($coursegrade as $cg) {
                            $this->content->text .= html_writer::div(get_string('cgrade', 'block_mycoursestatus').'&nbsp;'.
                                                    round($cg->finalgrade).'%');
                            $this->content->text .= '<div style="float:left;border:1px dotted lightgray;margin-top:4px;">
                                                      '.get_string('compl', 'block_mycoursestatus').'&nbsp;
                                                      <img src="'.$CFG->wwwroot.'/blocks/mycoursestatus/pix/grade_correct.png"/>
                                                     </div>';
                            $failed = $DB->get_recordset_sql('SELECT course, gradepass FROM {course_completion_criteria}
                                                              WHERE gradepass>=0 AND course = '.$COURSE->id.'');
                            foreach ($failed as $fail) {
                                if ($cg->finalgrade >= $fail->gradepass) {
                                    $this->content->text .= '<div style="float:left;border:1px dotted lightgray;
                                                              padding-left:2px;margin-left:3px;margin-top: 4px;">
                                                              '.get_string('pass', 'block_mycoursestatus').'
                                                          <img src="'.$CFG->wwwroot.'/blocks/mycoursestatus/pix/grade_correct.png"/>
                                                            </div>';
                                } else {
                                    $this->content->text .= '<div style="float:left;border:1px dotted lightgray;padding-left:2px;
                                                              margin-left:3px;margin-top:4px;">&nbsp;'.
                                                              get_string('fail', 'block_mycoursestatus').'
                                                            <img src="'.$CFG->wwwroot.'/blocks/mycoursestatus/pix/grade_wrong.png"/>
                                                            </div>';
                                }
                            }
                            $this->content->text .= html_writer::end_tag('div', array('class' => 'status'));
                            $this->content->text .= html_writer::start_tag('div', array('class' => 'report'));
                            $viewreport = new moodle_url($CFG->wwwroot.'/blocks/mycoursestatus/report.php',
                                          array('id' => $COURSE->id));
                            $this->content->text .= html_writer::link($viewreport, get_string('report', 'block_mycoursestatus'));
                            $this->content->text .= html_writer::end_tag('div', array('class' => 'report'));
                        }
                    } /*IF statement: $ctmds->completedmodules == $ctmds->criteriamodules.*/ else {
                        $this->content->text .= html_writer::div(get_string('cgrade', 'block_mycoursestatus').'&nbsp;'.
                                                get_string('ngrade', 'block_mycoursestatus'), 'nostat');
                        $this->content->text .= html_writer::div(get_string('status1', 'block_mycoursestatus').'&nbsp;'.
                                                get_string('status2', 'block_mycoursestatus').'&nbsp;', 'nostat');
                        $this->content->text .= html_writer::div(get_string('bac', 'block_mycoursestatus'), 'nostat');
                    }
                }
            } /*BLOCK CONTENT OUTSIDE OF COURSE PAGE.*/ else {
                $cond = $DB->get_recordset_sql('SELECT dm.course,
                        (SELECT count(cm.id) FROM {course_modules} cm WHERE dm.course = cm.course) AS "coursemodules",
                        (SELECT count(cmc.coursemoduleid) FROM {course_modules_completion} cmc JOIN {course_modules} cm ON
                         cmc.coursemoduleid = cm.id WHERE cmc.userid = '.$USER->id.' AND dm.course = cm.course AND
                         cmc.completionstate BETWEEN 1 AND 3) AS "completedmodules"
                         FROM
                        {course_modules} dm GROUP BY dm.course');
                foreach ($cond as $c) {
                    if ($c->coursemodules == $c->completedmodules) {
                        $ccgrade = $DB->get_recordset_sql('SELECT u.username, gi.courseid, c.shortname, gi.itemname, gg.finalgrade,
                                                           gg.timemodified, ccc.gradepass,
                                                          (CASE WHEN gg.finalgrade >= ccc.gradepass THEN "Passed" ELSE "Failed" END)
                                                           AS status
                                                           FROM {grade_grades} gg
                                                           JOIN {grade_items} gi ON gi.id = gg.itemid
                                                           JOIN {user} u ON u.id = gg.userid
                                                           JOIN {course} c ON c.id = gi.courseid
                                                           JOIN {course_completion_criteria} ccc ON ccc.course = gi.courseid
                                                           WHERE
                                                           gi.itemtype = "course"
                                                           AND gg.finalgrade IS NOT NULL
                                                           AND u.id = '.$USER->id.' AND gi.courseid = '.$c->course.'
                                                           AND ccc.module IS NULL');
                        foreach ($ccgrade as $ccg) {
                            if ($ccg->finalgrade >= $ccg->gradepass) {
                                $this->content->text .= html_writer::div($ccg->shortname.'&nbsp;:&nbsp;'.
                                                        round($ccg->finalgrade).'%'. '&nbsp;&nbsp;'. $ccg->status.'&nbsp;
                                                        <img src="'.$CFG->wwwroot.'/blocks/mycoursestatus/pix/grade_correct.png"/>',
                                                        'cnot');
                            } else {
                                 $this->content->text .= html_writer::div($ccg->shortname.'&nbsp;:&nbsp;'.
                                                         round($ccg->finalgrade).'%'. '&nbsp;&nbsp;'. $ccg->status.'&nbsp;
                                                         <img src="'.$CFG->wwwroot.'/blocks/mycoursestatus/pix/grade_wrong.png"/>',
                                                         'cnot');
                            }
                        }
                    }
                } // For loop $cond as $c.
                if ($c->coursemodules !== $c->completedmodules) {
                           $this->content->text .= html_writer::div('No courses completed yet');
                }
            }
            $this->content->text .= html_writer::end_tag('div', array('class' => 'content'));
        } // Function - isloggedin().
        return $this->content;
    } // Function - get_content().
    public function getmodules() {
        return true;
    }
}
