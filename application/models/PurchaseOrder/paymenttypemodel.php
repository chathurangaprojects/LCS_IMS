<?php
class PaymentTypeModel extends CI_Model {
	

var $Payment_Type_Code; 	
var $Payment_Type; 	


 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
 }//constructor


function getPayment_Type_Code() { return $this->Payment_Type_Code; } 
function getPayment_Type() { return $this->Payment_Type; } 
function setPayment_Type_Code($x) { $this->Payment_Type_Code = $x; } 
function setPayment_Type($x) { $this->Payment_Type = $x; } 
	
	
}//class
?>
	
	