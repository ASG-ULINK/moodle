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
 * Settings used by the videoconference module.
 *
 * @package    mod
 * @subpackage videoconference
 * @copyright  2011 videoconference
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 **/

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once($CFG->dirroot.'/mod/videoconference/locallib.php');

    /** RTMP Server settings */
    $settings->add(new admin_setting_configtext('rtmp_host', get_string('rtmplabel', 'videoconference'),
            get_string('rtmpdesc', 'videoconference'), 'rtmp://localhost/videowhisper', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('rtmp_amf', get_string('amflabel', 'videoconference'),
            get_string('amfdesc', 'videoconference'), 'AMF3', PARAM_TEXT));

    /** Video settings */
    $settings->add(new admin_setting_configtext('camMaxBandwidth', get_string('camMaxBandwidthlabel', 'videoconference'),
            get_string('camMaxBandwidthdesc', 'videoconference'), '81920', PARAM_INT));
    $settings->add(new admin_setting_configtext('bufferLive', get_string('bufferLivelabel', 'videoconference'),
            get_string('bufferLivedesc', 'videoconference'), '0.5', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('bufferFull', get_string('bufferFulllabel', 'videoconference'),
            get_string('bufferFulldesc', 'videoconference'), '0.5', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('bufferLivePlayback', get_string('bufferLivePlaybacklabel', 'videoconference'),
            get_string('bufferLivePlaybackdesc', 'videoconference'), '0.2', PARAM_TEXT));
    $settings->add(new admin_setting_configtext('bufferFullPlayback', get_string('bufferFullPlaybacklabel', 'videoconference'),
            get_string('bufferFullPlaybackdesc', 'videoconference'), '0.5', PARAM_TEXT));
    $settings->add(new admin_setting_configcheckbox('disableBandwidthDetection', get_string('disableBandwidthDetectionlabel', 'videoconference'),
            get_string('disableBandwidthDetectiondesc', 'videoconference'), '0', PARAM_TEXT));
    $settings->add(new admin_setting_configcheckbox('disableUploadDetection', get_string('disableUploadDetectionlabel', 'videoconference'),
            get_string('disableUploadDetectiondesc', 'videoconference'), '0', PARAM_TEXT));
    $settings->add(new admin_setting_configcheckbox('limitByBandwidth', get_string('limitByBandwidthlabel', 'videoconference'),
            get_string('limitByBandwidthdesc', 'videoconference'), '1', PARAM_TEXT));
			
}