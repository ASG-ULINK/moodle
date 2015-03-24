
<?php
if (!defined('MOODLE_INTERNAL')) {

    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page

}


require_once($CFG->libdir.'/formslib.php');


require_once($CFG->dirroot.'/user/profile/lib.php');

class blocks_wizard_wizard_form extends moodleform {	

    function definition() {

        global $USER, $CFG, $DB;

        $mform =& $this->_form;
		        
      if (is_array($this->_customdata)) {
		  
            if (array_key_exists('id', $this->_customdata)) {
                $id = $this->_customdata['id'];
                $edit_details = $DB->get_record('wizard_name', array('id'=>$id));
                
                //$wizard_name = $edit_details->name;
                //$wizard_firstname = $edit_details->firstname;
               // $wizard_lastname = $edit_details->lastname;
                 //$wizard_email = $edit_details->email;
                // $wizard_address = $edit_details->address;
                // $wizard_city = $edit_details->city;
                 //$wizard_score = array('value'=>$editd_etails->score);
                $wizard_desc = array('value'=>$edit_details->description);
            }
        } 

        /////////////////////********************************//////////////////////////
        //////////////*************** EDIT BY ALOK SHARMA ************/////////////////
        ///////////////////////////**********************/////////////////////////////

        $mform->addElement('hidden', 'id');

        $mform->addElement('text', "wizardtitle", 'Wizard title*',array('value'=>$wizard_name,'placeholder'=>'wizard Title Name'));
        $scorelimit = array();
        for ($o=1; $o <= 100; $o++) 
            {
                   $scorelimit[$o] = $o;
            }

        

    $mform->addRule('wizardid', 'Missing wizard Name', 'required', null, 'server');

    $mform->addElement('text', 'firstname', 'First Name :', $wizard);  
     $mform->addElement('text', 'lastname', 'Last Name :', $wizard1);  
     $mform->addElement('text', 'email', 'Email :', $wizard2);

      //$mform->setType('email', PARAM_NOTAGS); 
      //$mform->setDefault('email', 'Please enter email');   

     $mform->addElement('text', 'address', 'Address :', $wizard3);
     $mform->addElement('text', 'city', 'City:', $wizard4);
     $mform->addElement('text', 'state', 'State:', $wizard5); 
     
     //$mform->addElement('', 'ausers', 'State:', $wizard5); 
     $mform->addElement('editor', 'description', 'Description');
     $mform->addElement('filepicker', 'userfile', get_string('file'), null,array('maxbytes' => $maxbytes, 'accepted_types' => '*')); 
 

       // $mform->addElement('select', 'score', 'Score*', $scorelimit );

     
        
                

    
		$this->add_action_buttons();					
		// $this->add_action_buttons(false, 'Submit');
	
       //function validation($data, $files) {
        //return array();
    //}


    }
   
}




