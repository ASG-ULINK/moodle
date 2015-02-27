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
 * The main videoconference configuration form
 *
 * It uses the standard core Moodle formslib. For more info about them, please
 * visit: http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * @package   mod_videoconference
 * @copyright 2010 Your Name
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_videoconference_mod_form extends moodleform_mod {

    function definition() {

        global $CFG;
        $mform =& $this->_form;

//-------------------------------------------------------------------------------
    /// Adding the "general" fieldset, where all the common settings are showed
        $mform->addElement('header', 'general', get_string('general', 'form'));

    /// Adding the standard "name" field
        $mform->addElement('text', 'name', get_string('videoconferenceroomname', 'videoconference'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'videoconferencename', 'videoconference');

        $this->add_intro_editor(true, get_string('desc', 'videoconference'));
//-------------------------------------------------------------------------------
        $mform->addElement('text', 'adminuserid', get_string('adminuserid', 'videoconference'));
        $mform->setDefault('adminuserid', $_SESSION['USER']->id);
        $mform->setType('adminuserid', PARAM_INT);

//-------------------------------------------------------------------------------
        $mform->addElement('header', 'general', get_string('headersetting', 'videoconference'));

        $mform->addElement('text', 'camwidth', get_string('camWidth', 'videoconference'));
        $mform->setDefault('camwidth', '320');
        $mform->setType('camwidth', PARAM_INT);

        $mform->addElement('text', 'camheight', get_string('camHeight', 'videoconference'));
        $mform->setDefault('camheight', '240');
        $mform->setType('camheight', PARAM_INT);

        $mform->addElement('text', 'camfps', get_string('camFPS', 'videoconference'));
        $mform->setDefault('camfps', '15');
        $mform->setType('camfps', PARAM_INT);

        $options=array();
        $options[22]   =  22;
        $options[11]   =  11;
        $options[44]    =  44;
        $options[48]    =  48;
        $mform->addElement('select', 'micrate', get_string('micRate', 'videoconference'), $options);
		$mform->setDefault('micrate', $CFG->micRate);
		
?>
<script type="text/javascript">
function checkmaxbandwidth() {
	var maxcambandwidth = <?php echo $CFG->camMaxBandwidth;?>;
	var cambandwidth = document.getElementById('id_cambandwidth');

	if (cambandwidth.value > maxcambandwidth) {
		alert('Max camera bandwidth is '+maxcambandwidth);
		cambandwidth.value = maxcambandwidth;
		cambandwidth.focus();
	} 
}
</script>
<?php		
		
        $mform->addElement('text', 'cambandwidth', get_string('camBandwidthlabel', 'videoconference'), 'onblur="checkmaxbandwidth()"');
        $mform->setDefault('cambandwidth', $CFG->camBandwidth);
        $mform->setType('cambandwidth', PARAM_INT);

		$mform->addElement('htmleditor', 'welcome', get_string('welcome', 'videoconference'), 'wrap="virtual" rows="10" cols="50"');
        $mform->setDefault('welcome', "Welcome to ");
        $mform->setType('welcome', PARAM_RAW);

        $mform->addElement('text', 'background_url', get_string('background_url', 'videoconference'), 'size=52');
        $mform->setDefault('background_url', '');
        $mform->setType('background_url', PARAM_TEXT);

		$mform->addElement('textarea', 'layoutcode', get_string('layoutCode', 'videoconference'), 'wrap="virtual" rows="10" cols="50"');
        $mform->setDefault('layoutcode', "");
        $mform->setType('layoutcode', PARAM_RAW);

		$mform->addElement('selectyesno', 'fillwindow', get_string('fillWindow', 'videoconference'));
		$mform->setDefault('fillwindow', '0');

        $mform->addElement('text', 'filterregex', get_string('filterRegex', 'videoconference'), 'size=52');
        $mform->setDefault('filterregex', '(?i)(fuck|cunt)(?-i)');
        $mform->setType('filterregex', PARAM_TEXT);

        $mform->addElement('text', 'filterreplace', get_string('filterReplace', 'videoconference'), 'size=52');
        $mform->setDefault('filterreplace', ' ** ');
        $mform->setType('filterreplace', PARAM_TEXT);

		$mform->addElement('selectyesno', 'tutorial', get_string('tutorial', 'videoconference'));
		$mform->setDefault('tutorial', '1');
		
		$mform->addElement('selectyesno', 'open', get_string('open', 'videoconference'));
		$mform->setDefault('open', '1');

		// add standard elements, common to all modules
        $this->standard_coursemodule_elements();
//-------------------------------------------------------------------------------
        // add standard buttons, common to all modules
        $this->add_action_buttons();
    }
}
