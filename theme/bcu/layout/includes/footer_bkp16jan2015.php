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
 * Version details
 *
 * @package    theme
 * @subpackage bcu
 * @copyright  2014 Birmingham City University <michael.grant@bcu.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
 
?>

<style type="text/css">
.spanw {
    width: 200px;
}
#footer-faculties a{
    color: #fff !important;
}
#social-connect a{
    color: #fff !important;
}
#administrator a{
    color: #fff !important;
}
#contactdetails  a{
    color: #fff !important;
}

</style>
<footer id="page-footer">
    <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
    <div class="container">
        <div class="row">
            <div class="left-col size2of16 spanw">
                <h3>Connect</h3>
                <?php //echo $PAGE->theme->settings->footer4content; ?>
                <div>Veterans Crisis Line:
                1-800-273-8255 (Press 1)

                <h6>Social Media</h6>

                <h6>Complete Directory</h6>
                </div>
            </div>
            <?php if (!empty($PAGE->theme->settings->footer1content)) { ?>
            <div class="left-col size4of16 spanw" id="contactdetails">
                <h3 title="Contact Us"><?php echo $PAGE->theme->settings->footer1header; ?></h3>
                <?php echo $PAGE->theme->settings->footer1content; ?>
            </div>
            <?php } ?>
            <?php if (!empty($PAGE->theme->settings->footer2content)) { ?>
            <div class="left-col size2of16 spanw" id="footer-faculties">
                <h3 title="Our Faculties"><?php echo $PAGE->theme->settings->footer2header; ?></h3>
                <?php echo $PAGE->theme->settings->footer2content; ?>
            </div>
            <?php } ?>
            <?php if (!empty($PAGE->theme->settings->footer3content)) { ?>
            <div class="left-col size4of16 spanw" id="social-connect">
                <h3 title="Connect"><?php echo $PAGE->theme->settings->footer3header; ?></h3>
                <?php echo $PAGE->theme->settings->footer3content; ?>
            </div>
            <?php } ?>
            <?php if (!empty($PAGE->theme->settings->footer4content)) { ?>
            <div class="left-col size2of16 spanw" id="administrator">
                <h3><?php echo $PAGE->theme->settings->footer4header; ?></h3>
                <?php echo $PAGE->theme->settings->footer4content; ?>
            </div>
            <?php } ?>            
        </div>
    </div>
        
    <div class="info container2 clearfix">
        <div class="footer-inner page ptm pbl container">
            <?php 
            echo $html->footnote;
            ?>
        </div>
        <div class="pull-right">
            <?php
            echo $OUTPUT->standard_footer_html();
            ?>
        </div>
    </div>
</footer>
<a class="back-to-top" href="#top" ><i class="fa fa-angle-up "></i></a>
    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
<?php echo $PAGE->theme->settings->jssection; ?>
</body>
</html>
