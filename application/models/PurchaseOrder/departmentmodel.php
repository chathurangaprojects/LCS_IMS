<?php
class DepartmentModel extends CI_Model {
	

var $departmentCode;
var $departmentID;
var $departmentName;

 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
 }//constructor
	
function getDepartmentCode() { return $this->departmentCode; } 
function getDepartmentID() { return $this->departmentID; } 
function getDepartmentName() { return $this->departmentName; } 
function setDepartmentCode($x) { $this->departmentCode = $x; } 
function setDepartmentID($x) { $this->departmentID = $x; } 
function setDepartmentName($x) { $this->departmentName = $x; } 

}//class
?>
	
	