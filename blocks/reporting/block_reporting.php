<?php
class block_reporting extends block_list {
    public function init() {
        $this->title = get_string('pluginname', 'block_reporting');
    }
    // The PHP tag and the curly bracket for the class definition 
    // will only be closed after there is another function added in the next section.
    
    public function get_content() {
    	
    	global $CFG, $OUTPUT, $DB, $USER;
    if ($this->content !== null) {
      return $this->content;
    }
    
  $this->content         = new stdClass;
  $this->content->items  = array();
  $this->content->icons  = array();
  $this->content->footer = '';
  $spacer = array('height'=>1, 'width'=> 4);
  
  $subtopic = array('height'=>1, 'width'=> 15);
  // $NewCertificateurl = new moodle_url('/blocks/reporting/reporting.php');   	
  // $icon = '<img src="'.$CFG->wwwroot.'/blocks/reporting/images/icons/addproduct.gif" height="16" width="16" 
  // alt="'.get_string('reporting','block_reporting').'" />'.$OUTPUT->spacer($spacer);
  // 	$this->content->items[] =  html_writer::tag('a', get_string('reporting','block_reporting'), 
  //     array('href' => $NewCertificateurl));	$this->content->icons[] = $icon;		



    $browsecertificateurl = new moodle_url('/blocks/reporting/browsereporting.php');	
    $icon = $OUTPUT->spacer($subtopic).'<img src="'.$CFG->wwwroot.'/blocks/reporting/images/icons/1.png" height="11" 
    width="11" alt="'.get_string('browsereporting','block_reporting').'" />'.$OUTPUT->spacer($spacer);	
    $this->content->items[] = html_writer::tag('a', 'Course Completion', array('href' => $browsecertificateurl));	$this->content->icons[] = $icon;

    //  $usersresultsgradsurl = new moodle_url('/mod/speakforsuccess/users_results_grads.php'); 
    // $icon = '<br /><img src="'.$CFG->wwwroot.'/blocks/reporting/images/icons/grad.png" height="18" width="18" alt="'.get_string('Students Grads').'" />'.$OUTPUT->spacer($spacer);  
    // $this->content->items[] = html_writer::tag('a', 'Students Grads', array('href' => $usersresultsgradsurl));  $this->content->icons[] = $icon;
 
    return $this->content;
  }
}   // Here's the closing bracket for the class definition