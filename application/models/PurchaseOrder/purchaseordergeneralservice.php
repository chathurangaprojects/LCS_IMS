<?php

class PurchaseOrderGeneralService extends CI_Model {
	


 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		
 }//constructor
 
 

 
 function retrievePoStatus($statusCode){
	 
	 
 	 $query = $this->db->get_where('ta_ims_po_status',array('Status_Code'=>$statusCode));
		

		
		foreach ($query->result() as $row)
		{
		
			return $row->Status;

		}
		
 
	 
 }//retrievePoStatus
 
 
 
 
 

}//class

?>
