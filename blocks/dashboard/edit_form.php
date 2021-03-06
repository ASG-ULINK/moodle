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
 * Form for editing HTML block instances.
 *
 * @package   block_dashboard
 * @copyright 2012 Valery Fremaux
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Form for editing dashboard block instances.
 *
 * @copyright 2012 Valery Fremaux
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_dashboard_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
    	global $CFG, $COURSE, $OUTPUT;

        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        $mform->addElement('text', 'config_title', get_string('configtitle', 'block_dashboard'));
        $mform->setType('config_title', PARAM_MULTILANG);
        $mform->setDefault('config_title', get_string('newdashboard', 'block_dashboard'));

        $mform->addElement('checkbox', 'config_hidetitle', '', get_string('checktohide', 'block_dashboard'));

		/** Layout settings **/

        $mform->addElement('header', 'configheader1', get_string('dashboardlayout', 'block_dashboard'));

		$layoutopts[0] = get_string('publishinpage', 'block_dashboard');
		$layoutopts[1] = get_string('publishinblock', 'block_dashboard');
        $mform->addElement('select', 'config_inblocklayout', get_string('configlayout', 'block_dashboard'), $layoutopts);

        $mform->addElement('header', 'configheader20', get_string('configdashboardparams', 'block_dashboard'));
		$generalparamsconfigstr = get_string('generalparams', 'block_dashboard');
		$generalparamslink = "<a href=\"{$CFG->wwwroot}/blocks/dashboard/setup.php?id={$COURSE->id}&amp;instance={$this->block->instance->id}\">$generalparamsconfigstr</a>";

		$mform->addElement('static', '', '', $generalparamslink);

        $mform->addElement('header', 'configheader19', get_string('configimportexport', 'block_dashboard'));
		$importconfigstr = get_string('importconfig', 'block_dashboard');
		$exportconfigstr = get_string('exportconfig', 'block_dashboard');
		$import_export = "<a href=\"{$CFG->wwwroot}/blocks/dashboard/copyconfig.php?id={$COURSE->id}&amp;instance={$this->block->instance->id}&amp;what=upload\">$importconfigstr</a> - 
      	<a href=\"{$CFG->wwwroot}/blocks/dashboard/copyconfig.php?id={$COURSE->id}&amp;instance={$this->block->instance->id}&amp;what=get\" target=\"_blank\">$exportconfigstr</a>";

		$mform->addElement('static', '', '', $import_export);

        $mform->addElement('header', 'configheader195', get_string('configcharset', 'block_dashboard'));
	    $charsetopt['utf8'] = 'Utf-8';
	    $charsetopt['iso'] = 'ISO 8859-1';
        $mform->addElement('select', 'configexportcharset', get_string('configexportcharset', 'block_dashboard'), $charsetopt);

		if (debugging()){
	        $mform->addElement('header', 'configheader20', get_string('configdashboardcron', 'block_dashboard'));
	
	        $mform->addElement('text', 'config_lastcron', get_string('configlastcron', 'block_dashboard'));
	        $mform->addElement('checkbox', 'config_isrunning', get_string('configisrunning', 'block_dashboard'));
		}
	}	
	
	function set_data($defaults){
		if (!empty($this->block->config)){
			if (!empty($this->block->config->sqlparams)){
				foreach($this->block->config->sqlparams as $paramid => $paramdef){
					// print_object($paramdef);
					$varkey = "config_sqlparams[$paramid][sqlparamvar]";
					$defaults->$varkey = $paramdef['sqlparamvar'];
				}
			}
		}
		parent::set_data($defaults);
	}
}