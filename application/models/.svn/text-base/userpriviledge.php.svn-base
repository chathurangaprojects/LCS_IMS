<?php
class UserPriviledge extends CI_Model {


var $levelCode;
var $departmentCode;
var $priviledgeCode;


 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
 }//constructor
 
 
 
function getLevelCode() { return $this->levelCode; } 
function getDepartmentCode() { return $this->departmentCode; } 
function getPriviledgeCode() { return $this->priviledgeCode; } 

function setLevelCode($x) { $this->levelCode = $x; } 
function setDepartmentCode($x) { $this->departmentCode = $x; } 
function setPriviledgeCode($x) { $this->priviledgeCode = $x; } 
 



function checkUserPriviledge($userPriviledgeObject){
	
$priviledgeCode=$userPriviledgeObject->getPriviledgeCode();
$departmentCode=$userPriviledgeObject->getDepartmentCode();
$levelCode=$userPriviledgeObject->getLevelCode();

	
	$query = $this->db->get_where('ta_ims_level_privilege', array('Privilege_Code' => $priviledgeCode,'Department_Code'=>$departmentCode,'Level_Code'=>$levelCode));
	
	if ($query->num_rows() > 0){
		//user has the priviledges
		return TRUE;
		
	}
	else{
	 	//user doesnt have the priviledges
        return FALSE;
   
	}
	
	
}//function checkUserPriviledge




}//class
?>
