
<?php
if (!defined('MOODLE_INTERNAL')) {

    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page

}


require_once($CFG->libdir.'/formslib.php');


require_once($CFG->dirroot.'/user/profile/lib.php');

class blocks_leaderboard_leaderboard_form extends moodleform {	

    function definition() {

        global $USER, $CFG, $DB;

        $mform =& $this->_form;
		        
      if (is_array($this->_customdata)) {
		  
            if (array_key_exists('id', $this->_customdata)) {
                $id = $this->_customdata['id'];
                $edit_details = $DB->get_record('lead_table', array('id'=>$id,'status' => '0'));
                $lead_table = $edit_details->name;
                $leaderboard_score = array('value'=>$edit_details->score);
                $leaderboard_desc = array('value'=>$edit_details->description);
            }
        }


        /////////////////////********************************//////////////////////////
        //////////////*************** EDIT BY ALOK SHARMA ************/////////////////
        ///////////////////////////**********************/////////////////////////////

        $mform->addElement('hidden', 'id');

        $mform->addElement('text', "leaderboardtitle", 'Player Name:*',array('value'=>$lead_table,'placeholder'=>'Player Name'));
        $scorelimit = array();
        for ($o=1; $o <= 100; $o++) 
            {
                    $scorelimit[$o] = $o;
            }

        $mform->addRule('leaderboardid', 'Missing Player Name', 'required', null, 'server');
        $mform->addElement('select', 'score', 'Score*', $scorelimit );

        $mform->addElement('editor', 'description', 'Description');
        
                

        /////////////////////********************************//////////////////////////
        //////////////*************** END BY ALOK SHARMA ************/////////////////
        ///////////////////////////**********************/////////////////////////////
		
		$this->add_action_buttons();					
		// $this->add_action_buttons(false, 'Submit');
	
    }
   
}




