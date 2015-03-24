<?php
class block_wizard extends block_list {
    public function init() {
        $this->title = get_string('pluginname', 'block_wizard');
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
  $NewCertificateurl = new moodle_url('/blocks/wizard/wizard.php');   	
  $icon = '<img src="'.$CFG->wwwroot.'/blocks/wizard/images/icons/addproduct.gif" height="16" width="16" 
  alt="'.get_string('wizard','block_wizard').'" />'.$OUTPUT->spacer($spacer);
  	$this->content->items[] =  html_writer::tag('a', get_string('wizard','block_wizard'), 
      array('href' => $NewCertificateurl));	$this->content->icons[] = $icon;		



    $browsecertificateurl = new moodle_url('/blocks/wizard/browsewizard.php');	
    $icon = $OUTPUT->spacer($subtopic).'<img src="'.$CFG->wwwroot.'/blocks/wizard/images/icons/addproduct.gif" height="16" width="16" alt="'.get_string('browsewizard','block_wizard').'" />'.$OUTPUT->spacer($spacer);	
    $this->content->items[] = html_writer::tag('a', get_string('browsewizard','block_wizard'), 
      array('href' => $browsecertificateurl));	$this->content->icons[] = $icon;

    $groupassignwizardurl = new moodle_url('/blocks/wizard/assignwizard.php'); 
    $icon = '<br /><img src="'.$CFG->wwwroot.'/blocks/wizard/images/icons/1.png" height="18" width="18" alt="'.get_string('Group Assign wizard').'" />'.$OUTPUT->spacer($spacer);  
    $this->content->items[] = html_writer::tag('a', 'Group Assign wizard', array('href' => $groupassignwizardurl));  $this->content->icons[] = $icon;
 
    return $this->content;
  }
}   // Here's the closing bracket for the class definition