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
 * My Moodle -- a user's personal dashboard
 *
 * - each user can currently have their own page (cloned from system and then customised)
 * - only the user can see their own dashboard
 * - users can add any blocks they want
 * - the administrators can define a default site dashboard for users who have
 *   not created their own dashboard
 *
 * This script implements the user's view of the dashboard, and allows editing
 * of the dashboard.
 *
 * @package    moodlecore
 * @subpackage my
 * @copyright  2010 Remote-Learner.net
 * @author     Hubert Chathi <hubert@remote-learner.net>
 * @author     Olav Jordan <olav.jordan@remote-learner.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot . '/my/lib.php');

redirect_if_major_upgrade_required();

// TODO Add sesskey check to edit
$edit   = optional_param('edit', null, PARAM_BOOL);    // Turn editing on and off
$reset  = optional_param('reset', null, PARAM_BOOL);

require_login();

$strmymoodle = get_string('myhome');

if (isguestuser()) {  // Force them to see system default, no editing allowed
    // If guests are not allowed my moodle, send them to front page.
    if (empty($CFG->allowguestmymoodle)) {
        redirect(new moodle_url('/', array('redirect' => 0)));
    }

    $userid = null;
    $USER->editing = $edit = 0;  // Just in case
    $context = context_system::instance();
    $PAGE->set_blocks_editing_capability('moodle/my:configsyspages');  // unlikely :)
    $header = "$SITE->shortname: $strmymoodle (GUEST)";

} else {        // We are trying to view or edit our own My Moodle page
    $userid = $USER->id;  // Owner of the page
    $context = context_user::instance($USER->id);
    $PAGE->set_blocks_editing_capability('moodle/my:manageblocks');
    $header = "$SITE->shortname: $strmymoodle";
}

// Get the My Moodle page info.  Should always return something unless the database is broken.
if (!$currentpage = my_get_page($userid, MY_PAGE_PRIVATE)) {
    print_error('mymoodlesetup');
}

if (!$currentpage->userid) {
    $context = context_system::instance();  // So we even see non-sticky blocks
}

// Start setting up the page
$params = array();
$PAGE->set_context($context);
$PAGE->set_url('/my/index.php', $params);
$PAGE->set_pagelayout('mydashboard');
$PAGE->set_pagetype('my-index');
$PAGE->blocks->add_region('content');
$PAGE->set_subpage($currentpage->id);
$PAGE->set_title($header);
$PAGE->set_heading($header);

if (!isguestuser()) {   // Skip default home page for guests
    if (get_home_page() != HOMEPAGE_MY) {
        if (optional_param('setdefaulthome', false, PARAM_BOOL)) {
            set_user_preference('user_home_page_preference', HOMEPAGE_MY);
        } else if (!empty($CFG->defaulthomepage) && $CFG->defaulthomepage == HOMEPAGE_USER) {
            $PAGE->settingsnav->get('usercurrentsettings')->add(get_string('makethismyhome'), new moodle_url('/my/', array('setdefaulthome'=>true)), navigation_node::TYPE_SETTING);
        }
    }
}

// Toggle the editing state and switches
if ($PAGE->user_allowed_editing()) {
    if ($reset !== null) {
        if (!is_null($userid)) {
            require_sesskey();
            if(!$currentpage = my_reset_page($userid, MY_PAGE_PRIVATE)){
                print_error('reseterror', 'my');
            }
            redirect(new moodle_url('/my'));
        }
    } else if ($edit !== null) {             // Editing state was specified
        $USER->editing = $edit;       // Change editing state
        if (!$currentpage->userid && $edit) {
            // If we are viewing a system page as ordinary user, and the user turns
            // editing on, copy the system pages as new user pages, and get the
            // new page record
            if (!$currentpage = my_copy_page($USER->id, MY_PAGE_PRIVATE)) {
                print_error('mymoodlesetup');
            }
            $context = context_user::instance($USER->id);
            $PAGE->set_context($context);
            $PAGE->set_subpage($currentpage->id);
        }
    } else {                          // Editing state is in session
        if ($currentpage->userid) {   // It's a page we can edit, so load from session
            if (!empty($USER->editing)) {
                $edit = 1;
            } else {
                $edit = 0;
            }
        } else {                      // It's a system page and they are not allowed to edit system pages
            $USER->editing = $edit = 0;          // Disable editing completely, just to be safe
        }
    }

    // Add button for editing page
    $params = array('edit' => !$edit);

    $resetbutton = '';
    $resetstring = get_string('resetpage', 'my');
    $reseturl = new moodle_url("$CFG->wwwroot/my/index.php", array('edit' => 1, 'reset' => 1));

    if (!$currentpage->userid) {
        // viewing a system page -- let the user customise it
        $editstring = get_string('updatemymoodleon');
        $params['edit'] = 1;
    } else if (empty($edit)) {
        $editstring = get_string('updatemymoodleon');
    } else {
        $editstring = get_string('updatemymoodleoff');
        $resetbutton = $OUTPUT->single_button($reseturl, $resetstring);
    }

    $url = new moodle_url("$CFG->wwwroot/my/index.php", $params);
    $button = $OUTPUT->single_button($url, $editstring);
    $PAGE->set_button($resetbutton . $button);

} else {
    $USER->editing = $edit = 0;
}

// HACK WARNING!  This loads up all this page's blocks in the system context
if ($currentpage->userid == 0) {
    $CFG->blockmanagerclass = 'my_syspage_block_manager';
}


echo $OUTPUT->header();

echo $OUTPUT->custom_block_region('content');
?>
<style>
a.button {
background-image: -moz-linear-gradient(top, #ffffff, #dbdbdb);
background-image: -webkit-gradient(linear,left top,left bottom,
    color-stop(0, #ffffff),color-stop(1, #dbdbdb));
filter: progid:DXImageTransform.Microsoft.gradient
    (startColorStr='#ffffff', EndColorStr='#dbdbdb');
-ms-filter: "progid:DXImageTransform.Microsoft.gradient
    (startColorStr='#ffffff', EndColorStr='#dbdbdb')";
border: 1px solid #fff;
-moz-box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.4);
-webkit-box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.4);
box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.4);
border-radius: 18px;
-webkit-border-radius: 18px;
-moz-border-radius: 18px;
padding: 5px 15px;
text-decoration: none;
text-shadow: #fff 0 1px 0;
float: left;
margin-right: 15px;
margin-bottom: 15px;
display: block;
color: #597390;
line-height: 24px;
font-size: 20px;
font-weight: bold;
}

a.button:hover {
background-image: -moz-linear-gradient(top, #ffffff, #eeeeee);
background-image: -webkit-gradient(linear,left top,left bottom,
    color-stop(0, #ffffff),color-stop(1, #eeeeee));
filter: progid:DXImageTransform.Microsoft.gradient
    (startColorStr='#ffffff', EndColorStr='#eeeeee');
-ms-filter: "progid:DXImageTransform.Microsoft.gradient
    (startColorStr='#ffffff', EndColorStr='#eeeeee')";
color: #000;
display: block;
}

a.button:active {
background-image: -moz-linear-gradient(top, #dbdbdb, #ffffff);
background-image: -webkit-gradient(linear,left top,left bottom,
    color-stop(0, #dbdbdb),color-stop(1, #ffffff));
filter: progid:DXImageTransform.Microsoft.gradient
    (startColorStr='#dbdbdb', EndColorStr='#ffffff');
-ms-filter: "progid:DXImageTransform.Microsoft.gradient
    (startColorStr='#dbdbdb', EndColorStr='#ffffff')";
text-shadow: 0px -1px 0 rgba(255, 255, 255, 0.5);
margin-top: 1px;
}

a.button {
border: 1px solid #979797;
}



a.button.icon {
padding-left: 11px;
}

a.button.icon span{
padding-left: 4px;
background: url(images/icons.png) no-repeat 0 -4px;
}
a.button.icon.chat span {
background-position: 0px -36px;
}
</style>
<div id="broadcast" style="padding-left: 40%;">
<a class="button icon chat" target="_blank" href="http://host71690.123flashchat.com/Gcitizen/htmlchat/123flashchat.html?init_host=host71690.123flashchat.com&amp;init_port=21127&amp;init_host_s=host72690.123flashchat.com&amp;init_port_s=443&amp;init_host_h=host73690.123flashchat.com&amp;init_port_h=443&amp;init_group=Gcitizen&amp;init_room=5175&amp;init_user=<?php echo $USER->firstname . ' ' . $USER->lastname . ', ' . $country[$USER->country]; ?>"><span>Video conference</span></a>
</div>
<?php

echo $OUTPUT->footer();
