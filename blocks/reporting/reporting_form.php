
<?php
if (!defined('MOODLE_INTERNAL')) {

    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page

}


require_once($CFG->libdir.'/formslib.php');


require_once($CFG->dirroot.'/user/profile/lib.php');

class blocks_reporting_reporting_form extends moodleform {	

    function definition() {

        global $USER, $CFG, $DB;

        $mform =& $this->_form;
		        
      if (is_array($this->_customdata)) {
		  
            if (array_key_exists('id', $this->_customdata)) {
                $id = $this->_customdata['id'];
                $edit_details = $DB->get_record('reporting_name', array('id'=>$id,'status'=>'0'));
                $reporting_name = $edit_details->name;
                $reporting_score = array('value'=>$edit_details->score);
                $reporting_desc = array('value'=>$edit_details->description);
            }
        }


        /////////////////////********************************//////////////////////////
        //////////////*************** EDIT BY ALOK SHARMA ************/////////////////
        ///////////////////////////**********************/////////////////////////////

        $mform->addElement('hidden', 'id');

        $mform->addElement('text', "reportingtitle", 'reporting Title*',array('value'=>$reporting_name,'placeholder'=>'reporting Title Name'));
        $scorelimit = array();
        for ($o=1; $o <= 100; $o++) 
            {
                    $scorelimit[$o] = $o;
            }

        $mform->addRule('reportingid', 'Missing reporting Name', 'required', null, 'server');
        $mform->addElement('select', 'score', 'Score*', $scorelimit );

        $mform->addElement('editor', 'description', 'Description');
        
                

        /////////////////////********************************//////////////////////////
        //////////////*************** END BY ALOK SHARMA ************/////////////////
        ///////////////////////////**********************/////////////////////////////
		
		$this->add_action_buttons();					
		// $this->add_action_buttons(false, 'Submit');
	
    }
   
}




