<?php
class UserModerationModel extends CI_Model {

	var  $userID;
	var  $modifiedByUser;
	var  $modifiedStatus;
	var  $dateModified;
	
	
	 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
 function getUserID() { return $this->userID; } 
 function getModifiedByUser() { return $this->modifiedByUser; } 
 function getModifiedStatus() { return $this->modifiedStatus; } 
 function getDateModified() { return $this->dateModified; } 
 function setUserID($x) { $this->userID = $x; } 
 function setModifiedByUser($x) { $this->modifiedByUser = $x; } 
 function setModifiedStatus($x) { $this->modifiedStatus = $x; } 
 function setDateModified($x) { $this->dateModified = $x; } 

	
	}//class
?>
	
	