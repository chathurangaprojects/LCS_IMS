<?php
class EmailClass extends CI_Model {
 
     var $emailUsername="abanstest@gmail.com";
     var $emailPassword="abanstest123";
     var $emailHost="ssl://smtp.googlemail.com";
     var $emailProtocol="smtp";
     var $emailPort="465";
     var $emaiType="html";
     
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //$this->load->helper("url");
    }
     
     
function sendEmail($emailFrom,$emailTo,$subject,$message){
     
 $config = Array(
  'protocol' => $this->emailProtocol,
  'smtp_host' => $this->emailHost,
  'smtp_port' => $this->emailPort,
  'smtp_user' => $this->emailUsername, 
  'smtp_pass' => $this->emailPassword, 
  'mailtype' => $this->emaiType,
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);
 
 
  $this->load->library('email', $config);
  $this->email->set_newline("\r\n");
  $this->email->from($emailFrom); // change it to yours
  $this->email->to($emailTo); // change it to yours
  $this->email->subject($subject);
  $this->email->message($message);
 
  if($this->email->send())
  {
 
   return true;
 
  }
  else
  {
   show_error($this->email->print_debugger());
    
	echo $this->email->print_debugger();
	
   return false;
  }
   
     
}


     
         
}//class
         
?>   