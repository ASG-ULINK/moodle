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
 * Prints a particular instance of videoconference
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package   mod_videoconference
 * @copyright 2010 Your Name
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/// (Replace videoconference with the name of your module and remove this line)

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$id = optional_param('id', 0, PARAM_INT); // course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // videoconference instance ID - it should be named as the first character of the module
$video  = optional_param('video', 0, PARAM_INT);  // videoconference instance ID - it should be named as the first character of the module

if ($id) {
	$cm         = get_coursemodule_from_id('videoconference', $id, 0, false, MUST_EXIST);
	$course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
	$videoconference  = $DB->get_record('videoconference', array('id' => $cm->instance), '*', MUST_EXIST);
} elseif ($n) {
	$videoconference  = $DB->get_record('videoconference', array('id' => $n), '*', MUST_EXIST);
	$course     = $DB->get_record('course', array('id' => $videoconference->course), '*', MUST_EXIST);
	$cm         = get_coursemodule_from_instance('videoconference', $videoconference->id, $course->id, false, MUST_EXIST);
} else {
	error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);
$context = get_context_instance(CONTEXT_MODULE, $cm->id);
$PAGE->set_context($context);

if ($video == 0) {

	/// Print the page header
	add_to_log($course->id, 'videoconference', 'view', "view.php?id=$cm->id", $videoconference->name, $cm->id);

	$PAGE->set_url('/mod/videoconference/view.php', array('id' => $cm->id));
	$accessdata = get_user_access_sitewide($_SESSION['USER']->id);
	$PAGE->set_title($course->fullname.': '.get_string('moduletitle', 'videoconference'));
	$PAGE->set_heading($course->shortname);
	$PAGE->set_button(update_module_button($cm->id, $course->id, get_string('modulename', 'videoconference')));

	// other things you may want to set - remove if not needed
	//$PAGE->set_cacheable(false);
	//$PAGE->set_focuscontrol('some-html-id');

	// Output starts here
	echo $OUTPUT->header();

	if (has_capability('mod/videoconference:view', $context)) {
		// Replace the following lines with you own code
		//echo $OUTPUT->heading('Video Consultation room name '.$videoconference->name.$course->shortname.$id.', '.$USER->id.', '.$USER->username);
		echo $OUTPUT->heading($videoconference->name);
		if ($videoconference->open == '1') {
			if ($videoconference->intro) {
				echo $OUTPUT->box(format_module_intro('videoconference', $videoconference, $cm->id), 'generalbox', 'intro');
			}

			/// Print the main part of the page
			echo $OUTPUT->box_start('generalbox', 'enterlink');
			if ($USER->id == $videoconference->adminuserid) {
				$params['id'] = $id;
				$params['video'] = '1';
			} else {
				$params['id'] = $id;
				$params['video'] = '1';
			}
			$link = new moodle_url('/mod/videoconference/view.php', $params);
			$action = new popup_action('click', $link, "popup", array('height' => 500, 'width' => 700));
			echo '<h2 align = "center"> ';
			echo $OUTPUT->action_link($link, get_string('enter','videoconference'), $action, array('title'=>get_string('modulename', 'videoconference')));
			echo '</h2><p>Clicking link above should open application in a new window. If application does not open, disable popup blockers for this site or right click and open in new tab.</p>';
		} else {
			echo $OUTPUT->box_start('generalbox', 'enterlink');
			echo '<p>The room currently closed ';
			echo '</p>';
		}
		echo $OUTPUT->box_end();
	} else {
		echo $OUTPUT->box_start('generalbox', 'notallowenter');
		echo '<p>'.get_string('notallowenter', 'videoconference').'</p>';
		echo $OUTPUT->box_end();
	}

	// Finish the page
	echo $OUTPUT->footer();
} else {
	require_once('simple_html_dom.php');
	$rtmp_server = $CFG->rtmp_host;
	$rtmp_amf = $CFG->rtmp_amf;

	$username = preg_replace("/[^0-9a-zA-Z\s_]/","-",$USER->username);
	$user = $DB->get_record('user', array('id' => $USER->id));
	$str = str_get_html($OUTPUT->user_picture($user, array('size'=>100)));
	$e = $str->find("img", 0);
	$picture = $e->src;
	setcookie("userpicture",urlencode("defaultpicture.png"),time()+72000);
	if ($USER->picture == '1') {
		setcookie("userpicture",urlencode($picture),time()+72000);
	}
	setcookie("usertype",urlencode('0'),time()+72000);
	if ($USER->id == $videoconference->adminuserid) {
		if (has_capability('mod/videoconference:administrator', $context)) {
			setcookie("usertype",urlencode('3'),time()+72000);
		}
	}
	$params['id'] = $USER->id;
	$link = new moodle_url('/user/profile.php', $params);
	setcookie("userlink",urlencode($link),time()+72000);
	$r = preg_replace("/[^0-9a-zA-Z\s_]/","-",$videoconference->name);	
	setcookie("username",$username,time()+72000);
	setcookie("userroom",$r,time()+72000);
	setcookie("rtmp_server",urlencode($rtmp_server),time()+72000);
	setcookie("rtmp_amf",urlencode($rtmp_amf),time()+72000);
	
	setcookie("camMaxBandwidth",$CFG->camMaxBandwidth,time()+72000);
	setcookie("bufferLive",$CFG->bufferLive,time()+72000);
	setcookie("bufferFull",$CFG->bufferFull,time()+72000);
	setcookie("bufferLivePlayback",$CFG->bufferLivePlayback,time()+72000);
	setcookie("bufferFullPlayback",$CFG->bufferFullPlayback,time()+72000);
	setcookie("disableBandwidthDetection",'0',time()+72000);
	if ($CFG->disableBandwidthDetection != '0') setcookie("disableBandwidthDetection",'1',time()+72000);
	setcookie("limitByBandwidth",'0',time()+72000);
	if ($CFG->limitByBandwidth != '0') setcookie("limitByBandwidth",'1',time()+72000);
	setcookie("disableUploadDetection",'0',time()+72000);
	if ($CFG->disableUploadDetection != '0') setcookie("disableUploadDetection",'1',time()+72000);
	
	setcookie("camWidth",$videoconference->camwidth,time()+72000);
	setcookie("camHeight",$videoconference->camheight,time()+72000);
	setcookie("camFPS",$videoconference->camfps,time()+72000);
	setcookie("micRate",$videoconference->micrate,time()+72000);
	setcookie("camBandwidth",$videoconference->cambandwidth,time()+72000);
	setcookie("welcome",$videoconference->welcome,time()+72000);
	setcookie("background_url",$videoconference->background_url,time()+72000);
	setcookie("layoutcode",$videoconference->layoutcode,time()+72000);
	setcookie("fillwindow",$videoconference->fillwindow,time()+72000);
	setcookie("filterregex",$videoconference->filterregex,time()+72000);
	setcookie("filterreplace",$videoconference->filterreplace,time()+72000);
	setcookie("tutorial",$videoconference->tutorial,time()+72000);
	if (has_capability('mod/videoconference:autoviewcams', $context)) {
		setcookie("autoviewcams",'1',time()+72000);
	} else {
		setcookie("autoviewcams",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:room_delete', $context)) {
		setcookie("room_delete",'1',time()+72000);
	} else {
		setcookie("room_delete",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:room_create', $context)) {
		setcookie("room_create",'1',time()+72000);
	} else {
		setcookie("room_create",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:panelfiles', $context)) {
		setcookie("panelfiles",'1',time()+72000);
	} else {
		setcookie("panelfiles",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:showcamsettings', $context)) {
		setcookie("showCamSettings",'1',time()+72000);
	} else {
		setcookie("showCamSettings",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:advancedcamsettings', $context)) {
		setcookie("advancedCamSettings",'1',time()+72000);
	} else {
		setcookie("advancedCamSettings",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:configuresource', $context)) {
		setcookie("configureSource",'1',time()+72000);
	} else {
		setcookie("configureSource",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:disablevideo', $context)) {
		setcookie("disableVideo",'0',time()+72000);
	} else {
		setcookie("disableVideo",'1',time()+72000);
	}
	if (has_capability('mod/videoconference:disablesound', $context)) {
		setcookie("disableSound",'0',time()+72000);
	} else {
		setcookie("disableSound",'1',time()+72000);
	}

	if (has_capability('mod/videoconference:showtimer', $context)) {
		setcookie("showtimer",'1',time()+72000);
	} else {
		setcookie("showtimer",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:file_upload', $context)) {
		setcookie("file_upload",'1',time()+72000);
	} else {
		setcookie("file_upload",'0',time()+72000);
	}
	if (has_capability('mod/videoconference:file_delete', $context)) {
		setcookie("file_delete",'1',time()+72000);
	} else {
		setcookie("file_delete",'0',time()+72000);
	}
?>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $r;?> : Video Conference</title>
<script language="javascript"> AC_FL_RunContent = 0; </script>
<script language="javascript"> DetectFlashVer = 0; </script>
<script src="AC_RunActiveContent.js" language="javascript"></script>
<script language="JavaScript" type="text/javascript">
<!--
// -----------------------------------------------------------------------------
// Globals
// Major version of Flash required
var requiredMajorVersion = 9;
// Minor version of Flash required
var requiredMinorVersion = 0;
// Revision of Flash required
var requiredRevision = 0;
// -----------------------------------------------------------------------------
// -->
</script>
</head>
<body bgcolor="#5a5152" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript" type="text/javascript">
<!--
if (AC_FL_RunContent == 0 || DetectFlashVer == 0) {
	alert("This page requires AC_RunActiveContent.js.");
} else {
	var hasRightVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);
	if(hasRightVersion) {  // if we've detected an acceptable version
		// embed the flash movie
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '100%',
			'height', '100%',
			'src', 'videowhisper_conference',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'left',
			'play', 'true',
			'loop', 'true',
			'scale', 'noscale',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'videowhisper_conference',
			'bgcolor', '#5a5152',
			'name', 'videowhisper_conference',
			'menu', 'true',
			'allowScriptAccess','sameDomain',
			'allowFullScreen','true',
			'movie', 'videowhisper_conference',
			'salign', 'lt'
			); //end AC code
	} else {  // flash is too old or we can't detect the plugin
		var alternateContent = 'Alternate HTML content should be placed here.'
			+ 'This content requires the Adobe Flash Player.'
			+ '<a href=http://www.macromedia.com/go/getflash/>Get Flash</a>';
		document.write(alternateContent);  // insert non-flash content
	}
}
// -->
</script>
<noscript>
<p align=center><a href="http://www.videowhisper.com/?p=Video+Conference"><strong>VideoWhisper Video Conference
Software</strong></a></p>
<p align="center"><strong>This content requires the Adobe Flash Player:
  	<a href="http://www.macromedia.com/go/getflash/">Get Flash</a></strong>!</p>
</noscript>
</body>
</html>

<?php
}