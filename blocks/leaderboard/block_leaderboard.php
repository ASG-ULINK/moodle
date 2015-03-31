<?php
class block_leaderboard extends block_list
 {
    public function init()
	 {
        $this->title = get_string('pluginname', 'block_leaderboard');
     }
    // The PHP tag and the curly bracket for the class definition 
    // will only be closed after there is another function added in the next section.
    
    public function get_content()
   {
    	
    global $CFG, $OUTPUT, $DB, $USER;
    if ($this->content !== null) 
	{
      return $this->content;
    }
    
  $this->content         = new stdClass;
  $this->content->items  = array();
  $this->content->icons  = array();
  $this->content->footer = '';
  $spacer = array('height'=>1, 'width'=> 4);
  
  $subtopic = array('height'=>1, 'width'=> 15);
  $NewCertificateurl = new moodle_url('/blocks/leaderboard/leaderboard.php');   	
  $icon = '<img src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/addproduct.gif" height="16" width="16" 
  alt="'.get_string('leaderboard','block_leaderboard').'" />'.$OUTPUT->spacer($spacer);
  	$this->content->items[] =  html_writer::tag('a', get_string('leaderboard','block_leaderboard'), 
      array('href' => $NewCertificateurl));	$this->content->icons[] = $icon;		



    $browsecertificateurl = new moodle_url('/blocks/leaderboard/browseleaderboard.php');	
    $icon = $OUTPUT->spacer($subtopic).'<img src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/addproduct.gif" height="16" width="16" alt="'.get_string('browseleaderboard','block_leaderboard').'" />'.$OUTPUT->spacer($spacer);	
    $this->content->items[] = html_writer::tag('a', get_string('browseleaderboard','block_leaderboard'), 
      array('href' => $browsecertificateurl));	$this->content->icons[] = $icon;

    $groupassignleaderboardurl = new moodle_url('/blocks/leaderboard/assignleaderboard.php'); 
    $icon = '<br /><img src="'.$CFG->wwwroot.'/blocks/leaderboard/images/icons/1.png" height="18" width="18" alt="'.get_string('Group Assign leaderboard').'" />'.$OUTPUT->spacer($spacer);  
    $this->content->items[] = html_writer::tag('a', 'Group Assign leaderboard', array('href' => $groupassignleaderboardurl));  $this->content->icons[] = $icon;
    return $this->content;
  }
}   // Here's the closing bracket for the class definition

