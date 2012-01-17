<?php
class CurrencyModel extends CI_Model {
	

var $Currency_Code; 	
var $Currency; 	
var $Conversion_Rate; 	
var $Description;

 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
 }//constructor
	
function getCurrency_Code() { return $this->Currency_Code; } 
function getCurrency() { return $this->Currency; } 
function getConversion_Rate() { return $this->Conversion_Rate; } 
function getDescription() { return $this->Description; } 
function setCurrency_Code($x) { $this->Currency_Code = $x; } 
function setCurrency($x) { $this->Currency = $x; } 
function setConversion_Rate($x) { $this->Conversion_Rate = $x; } 
function setDescription($x) { $this->Description = $x; } 


}//class
?>
	
	