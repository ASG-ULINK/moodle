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
 * Library of interface functions and constants for module videoconference
 *
 * All the core Moodle functions, neeeded to allow the module to work
 * integrated in Moodle should be placed here.
 * All the videoconference specific functions, needed to implement all the module
 * logic, should go to locallib.php. This will help to save some memory when
 * Moodle is performing actions across all modules.
 *
 * @package   mod_videoconference
 * @copyright 2010 Your Name
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/** example constant */
//define('videoconference_ULTIMATE_ANSWER', 42);

/**
 * If you for some reason need to use global variables instead of constants, do not forget to make them
 * global as this file can be included inside a function scope. However, using the global variables
 * at the module level is not a recommended.
 */
//global $videoconference_GLOBAL_VARIABLE;
//$videoconference_QUESTION_OF = array('Life', 'Universe', 'Everything');

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param object $videoconference An object from the form in mod_form.php
 * @return int The id of the newly inserted videoconference record
 */
function videoconference_add_instance($videoconference) {
    global $DB;

    $videoconference->timecreated = time();

    # You may have to add extra stuff in here #

    return $DB->insert_record('videoconference', $videoconference);
}

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param object $videoconference An object from the form in mod_form.php
 * @return boolean Success/Fail
 */
function videoconference_update_instance($videoconference) {
    global $DB;

    $videoconference->timemodified = time();
    $videoconference->id = $videoconference->instance;

    # You may have to add extra stuff in here #

    return $DB->update_record('videoconference', $videoconference);
}

/**
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 */
function videoconference_delete_instance($id) {
    global $DB;

    if (! $videoconference = $DB->get_record('videoconference', array('id' => $id))) {
        return false;
    }

    # Delete any dependent records here #

    $DB->delete_records('videoconference', array('id' => $videoconference->id));

    return true;
}

/**
 * Return a small object with summary information about what a
 * user has done with a given particular instance of this module
 * Used for user activity reports.
 * $return->time = the time they did it
 * $return->info = a short text description
 *
 * @return null
 * @todo Finish documenting this function
 */
function videoconference_user_outline($course, $user, $mod, $videoconference) {
    $return = new stdClass;
    $return->time = 0;
    $return->info = '';
    return $return;
}

/**
 * Print a detailed representation of what a user has done with
 * a given particular instance of this module, for user activity reports.
 *
 * @return boolean
 * @todo Finish documenting this function
 */
function videoconference_user_complete($course, $user, $mod, $videoconference) {
    return true;
}

/**
 * Given a course and a time, this module should find recent activity
 * that has occurred in videoconference activities and print it out.
 * Return true if there was output, or false is there was none.
 *
 * @return boolean
 * @todo Finish documenting this function
 */
function videoconference_print_recent_activity($course, $viewfullnames, $timestart) {
    return false;  //  True if anything was printed, otherwise false
}

/**
 * Function to be run periodically according to the moodle cron
 * This function searches for things that need to be done, such
 * as sending out mail, toggling flags etc ...
 *
 * @return boolean
 * @todo Finish documenting this function
 **/
function videoconference_cron () {
    return true;
}

/**
 * Must return an array of users who are participants for a given instance
 * of videoconference. Must include every user involved in the instance,
 * independient of his role (student, teacher, admin...). The returned
 * objects must contain at least id property.
 * See other modules as example.
 *
 * @param int $videoconferenceid ID of an instance of this module
 * @return boolean|array false if no participants, array of objects otherwise
 */
function videoconference_get_participants($videoconferenceid) {
    return false;
}

/**
 * This function returns if a scale is being used by one videoconference
 * if it has support for grading and scales. Commented code should be
 * modified if necessary. See forum, glossary or journal modules
 * as reference.
 *
 * @param int $videoconferenceid ID of an instance of this module
 * @return mixed
 * @todo Finish documenting this function
 */
function videoconference_scale_used($videoconferenceid, $scaleid) {
    global $DB;

    $return = false;

    //$rec = $DB->get_record("videoconference", array("id" => "$videoconferenceid", "scale" => "-$scaleid"));
    //
    //if (!empty($rec) && !empty($scaleid)) {
    //    $return = true;
    //}

    return $return;
}

/**
 * Checks if scale is being used by any instance of videoconference.
 * This function was added in 1.9
 *
 * This is used to find out if scale used anywhere
 * @param $scaleid int
 * @return boolean True if the scale is used by any videoconference
 */
function videoconference_scale_used_anywhere($scaleid) {
    global $DB;

    if ($scaleid and $DB->record_exists('videoconference', 'grade', -$scaleid)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Execute post-uninstall custom actions for the module
 * This function was added in 1.9
 *
 * @return boolean true if success, false on error
 */
function videoconference_uninstall() {
    return true;
}
