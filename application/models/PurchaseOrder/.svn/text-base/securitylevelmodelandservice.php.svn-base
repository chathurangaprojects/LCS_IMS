<?php

class SecurityLevelModelAndService extends CI_Model {
	

var $levelCode;
var $level;
var $description;

 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		
 }//constructor
 
 
 
function getLevelCode() { return $this->levelCode; } 
function getLevel() { return $this->level; } 
function getDescription() { return $this->description; } 
function setLevelCode($x) { $this->levelCode = $x; } 
function setLevel($x) { $this->level = $x; } 
function setDescription($x) { $this->description = $x; } 
	
 
 
 
 function retriveAllSecurityLevels(){
	 
	 
 	 $query = $this->db->get('ta_ims_level');
		
		$securityLevelArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$securityLevelModel=new SecurityLevelModelAndService();
			
			$securityLevelModel->setLevelCode($row->Level_Code);
			$securityLevelModel->setLevel($row->Level);
			$securityLevelModel->setDescription($row->Description);
			
    		$securityLevelArray[$index]=$securityLevelModel;
			$index++;
		}
		
		
		return $securityLevelArray;
	 
	 
	 
	 
 }//retriveAllSecurityLevels
 
 
 
 
 

}//class

?>
