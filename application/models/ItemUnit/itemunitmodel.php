<?php
	class ItemUnitModel extends CI_Model {
	
	var $Unit_Code;
	var $Description;
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}//constructor
	
	function getUnit_Code() { return $this->Unit_Code; } 
	function getDescription() { return $this->Description; } 
		
	function setUnit_Code($x) { $this->Unit_Code = $x; } 
	function setDescription($x) { $this->Description = $x; } 
}//class
?>