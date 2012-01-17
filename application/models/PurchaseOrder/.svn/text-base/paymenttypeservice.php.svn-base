<?php
class PaymentTypeService extends CI_Model {


 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		$this->load->model('PaymentTypeModel');
		
 }//constructor
 
 
 
 function retriveAllPaymentTypes(){
	
	 
	 	$query = $this->db->get('ta_ims_payment_type');
		
		$paymentTypeArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$paymentTypeModel=new PaymentTypeModel();
			
			$paymentTypeModel->setPayment_Type_Code($row->Payment_Type_Code);
			$paymentTypeModel->setPayment_Type($row->Payment_Type);
				
    		$paymentTypeArray[$index]=$paymentTypeModel;
			$index++;
		}
		
		
		return $paymentTypeArray;
	 
 }//retriveAllPaymentTypes
  
  
  


}//class

?>
