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

    .myfooter {
    margin-left: 20px;
    font-size: 11px;
padding: 5px;
}
#page-footer a {
border-left: 1px solid #6F7DA1!important;
padding: 5px;
font-family: Verdana, Arial, Helvetica, sans-serif;

}
.footer-inner.page.ptm.pbl.container {
height: 0px;
}
.page-footer
{
height: 30px!important;

}
</style>
<footer id="page-footer">
    <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
    
    <div class="myfooter">
        <span><a href="">VHA Intranet Home </a></span><span><a href=""> VHA Intranet Home</a></span><span><a href=""> VBA Intranet Home</a></span><span><a href=""> Section 508 Accessibility</a></span><span><a href=""> Privacy Policy</a></span><span><a href=""> No Fear Act</a></span>
    </div>
        
    <!-- <div class="info container2 clearfix">
        <div class="footer-inner page ptm pbl container">
            <?php 
            echo $html->footnote;
            ?>
        </div>
        <!-- <div class="pull-right">
            <?php
            echo $OUTPUT->standard_footer_html();
            ?>
        </div> -->
    </div> 
</footer>
<a class="back-to-top" href="#top" ><i class="fa fa-angle-up "></i></a>
    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
<?php echo $PAGE->theme->settings->jssection; ?>
</body>
</html>