<?php
	class ItemMainCategoryModel extends CI_Model {
	
	var $Category_Code;
	var $Category_Name;
	var $Description;
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}//constructor
	
	function getCategory_Code() { return $this->Category_Code; } 
	function getCategory_Name() { return $this->Category_Name; } 
	function getDescription() { return $this->Description; } 
		
	function setCategory_Code($x) { $this->Category_Code = $x; } 
	function setCategory_Name($x) { $this->Category_Name = $x; } 
	function setDescription($x) { $this->Description = $x; } 
}//class
?>