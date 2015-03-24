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
 * This plugin serves as a database and plan for all timeline activities in the organization,
 * where such activities are organized for a more structured timeline program.
 * @package blocks
 * @author: Azmat Ullah, Talha Noor
 * @date: 20-Aug-2014
 * @copyright  Copyrights © 2012 - 2014 | 3i Logic (Pvt) Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(realpath(dirname(__FILE__) . '/lib.php'));

class block_timeline_plan extends block_base {

    public function init() {
        global $CFG, $USER, $COURSE;
        $this->title = get_string('timeline_plan', 'block_timeline_plan');
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        global $CFG, $USER, $COURSE, $PAGE, $DB;
        if (has_capability('block/timeline_plan:managepages', $this->context)) {
            $this->title = get_string('timeline_plan', 'block_timeline_plan');
        } else if (has_capability('block/timeline_plan:viewpages', $this->context)) {
            $this->title = get_string('myview', 'block_timeline_plan');
        }
        $this->content = new stdClass;
        if (has_capability('block/timeline_plan:managepages', $this->context)) {
            $pageurl = new moodle_url('/blocks/timeline_plan/view.php?viewpage');
            if (!strpos($pageurl, '=')) {
                $pageurl .= '=';
            }
            $this->content->text .= html_writer::link($pageurl . '1', get_string('timelinepath', 'block_timeline_plan')) . '<br>';
            $this->content->text .= html_writer::link($pageurl . '2', get_string('add_training', 'block_timeline_plan')) . '<br>';
            $this->content->text .= html_writer::link($pageurl . '4', get_string('assign_training_timelineplan', 'block_timeline_plan')) . '<br>';
            $this->content->text .= html_writer::link($pageurl . '5', get_string('assign_timelineplan_user', 'block_timeline_plan')) . '<br>';
            $this->content->text .= html_writer::link($pageurl . '6', get_string('trainingstatus', 'block_timeline_plan')) . '<br>';
            $this->content->text .= html_writer::link($pageurl . '7', get_string('search', 'block_timeline_plan'));
        } else if (has_capability('block/timeline_plan:viewpages', $this->context)) {
            $pageurl = new moodle_url('/blocks/timeline_plan/student/view.php?id');
            if (!strpos($pageurl, '=')) {
                $pageurl .= '=';
            }
            $timeline_plan = user_timelineplan($USER->id);
            foreach ($timeline_plan as $lp) {
                $this->content->text .= html_writer::link($pageurl . $lp->id, format_string($lp->timelineplan, false)) . '<br>';
            }
            $timeline_plan->close();
        }
        return $this->content;
    }

    public function applicable_formats() {
        return array(
            'all' => true);
    }

}
