<?php
class PurchaseOrderRequestService extends CI_Model {


 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		$this->load->model('PurchaseOrderRequestModel');
		
 }//constructor
 
 
 
 
 function createNewPurchaseOrder($purchaseOrderRequestModel){
	 
	 
	 $this->db->insert('ta_ims_po_header', $purchaseOrderRequestModel); 
	 	 
	 return $this->db->insert_id();
  
 }//createNewPurchaseorder
 



 function updatePurchaseOrder($purchaseOrderRequestModel){
	 
	 $this->db->where('Order_Code',$purchaseOrderRequestModel->getOrder_Code()); 
	 $this->db->update('ta_ims_po_header', $purchaseOrderRequestModel); 
	 
  
 }//createNewPurchaseorder
 
 
 
 
 
 function getPurchaseOrderDetailsPlacedByGivenUser($poReqModel){
	 

	 
	  $query = $this->db->get_where('ta_ims_po_header', array('Created_By' =>$poReqModel->getCreated_By()));
	 
	 
	  $poRequestArray =array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$poRequestModel=new PurchaseOrderRequestModel();
			
			$poRequestModel->setOrder_Code($row->Order_Code);
			$poRequestModel->setSupplier_Code($row->Supplier_Code );
			$poRequestModel->setOrder_Date($row->Order_Date);
			$poRequestModel->setExpected_Date($row->Expected_Date);
			$poRequestModel->setQuote_No($row->Quote_No);
			$poRequestModel->setAttn($row->Attn);
			$poRequestModel->setRequested_Dept($row->Requested_Dept);
			$poRequestModel->setRequested_By($row->Requested_By);
			$poRequestModel->setCreated_By($row->Created_By);
			$poRequestModel->setDiscount($row->Discount);
            $poRequestModel->setDiscount_Value($row->Discount_Value);
            $poRequestModel->setPO_Total($row->PO_Total);
			$poRequestModel->setCurrency_Code($row->Currency_Code);
			$poRequestModel->setPayment_Type_Code($row->Payment_Type_Code);
			$poRequestModel->setPayment_Status($row->Payment_Status);
			$poRequestModel->setPO_Purpose($row->PO_Purpose);
			$poRequestModel->setPO_Remarks($row->PO_Remarks);
			$poRequestModel->setPO_Payment_Remarks($row->PO_Payment_Remarks);
			$poRequestModel->setPO_Close_Date($row->PO_Close_Date);
			$poRequestModel->setPO_Close_By($row->PO_Close_By);
			$poRequestModel->setPO_Close_Remarks($row->PO_Close_Remarks);
            $poRequestModel->setPO_Cancel_Date($row->PO_Cancel_Date);
		    $poRequestModel->setPO_Cancel_By($row->PO_Cancel_By);
            $poRequestModel->setPO_Cancel_Remarks($row->PO_Cancel_Remarks);
            $poRequestModel->setPrint_Original($row->Print_Original);
            $poRequestModel->setStatus_Code($row->Status_Code);

    		$poRequestArray[$index]=$poRequestModel;
			$index++;
		}
		
		
		
		return $poRequestArray;
		
		
	 
 }//function
 
 
 
 
 
 
 
 function getNewAndReturnPurchaseOrderDetailsPlacedByGivenUser($poReqModel){
	 

	 
	 // $query = $this->db->get_where('ta_ims_po_header', array('Created_By' =>$poReqModel->getCreated_By()));
	 
	 $query = $this->db->query(" select * from ta_ims_po_header where Created_By =".$poReqModel->getCreated_By()." and (Status_Code=1 or Status_Code=5)");
	 
	  $poRequestArray =array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$poRequestModel=new PurchaseOrderRequestModel();
			
			$poRequestModel->setOrder_Code($row->Order_Code);
			$poRequestModel->setSupplier_Code($row->Supplier_Code );
			$poRequestModel->setOrder_Date($row->Order_Date);
			$poRequestModel->setExpected_Date($row->Expected_Date);
			$poRequestModel->setQuote_No($row->Quote_No);
			$poRequestModel->setAttn($row->Attn);
			$poRequestModel->setRequested_Dept($row->Requested_Dept);
			$poRequestModel->setRequested_By($row->Requested_By);
			$poRequestModel->setCreated_By($row->Created_By);
			$poRequestModel->setDiscount($row->Discount);
            $poRequestModel->setDiscount_Value($row->Discount_Value);
            $poRequestModel->setPO_Total($row->PO_Total);
			$poRequestModel->setCurrency_Code($row->Currency_Code);
			$poRequestModel->setPayment_Type_Code($row->Payment_Type_Code);
			$poRequestModel->setPayment_Status($row->Payment_Status);
			$poRequestModel->setPO_Purpose($row->PO_Purpose);
			$poRequestModel->setPO_Remarks($row->PO_Remarks);
			$poRequestModel->setPO_Payment_Remarks($row->PO_Payment_Remarks);
			$poRequestModel->setPO_Close_Date($row->PO_Close_Date);
			$poRequestModel->setPO_Close_By($row->PO_Close_By);
			$poRequestModel->setPO_Close_Remarks($row->PO_Close_Remarks);
            $poRequestModel->setPO_Cancel_Date($row->PO_Cancel_Date);
		    $poRequestModel->setPO_Cancel_By($row->PO_Cancel_By);
            $poRequestModel->setPO_Cancel_Remarks($row->PO_Cancel_Remarks);
            $poRequestModel->setPrint_Original($row->Print_Original);
            $poRequestModel->setStatus_Code($row->Status_Code);

    		$poRequestArray[$index]=$poRequestModel;
			$index++;
		}
		
		
		
		return $poRequestArray;
		
		
	 
 }//function
 
 
 
 
 
 
 
 function getPurchaseOrderDetailsForGivenOrderID($poReqModel){
	 

	 
	  $query = $this->db->get_where('ta_ims_po_header', array('Order_Code' =>$poReqModel->getOrder_Code(),'Created_By'=>$poReqModel->getCreated_By()));
	 
	 	$poRequestModel=NULL;
	 
		foreach ($query->result() as $row)
		{	
		$poRequestModel=new PurchaseOrderRequestModel();
		
			$poRequestModel->setOrder_Code($row->Order_Code);
			$poRequestModel->setSupplier_Code($row->Supplier_Code );
			$poRequestModel->setOrder_Date($row->Order_Date);
			$poRequestModel->setExpected_Date($row->Expected_Date);
			$poRequestModel->setQuote_No($row->Quote_No);
			$poRequestModel->setAttn($row->Attn);
			$poRequestModel->setRequested_Dept($row->Requested_Dept);
			$poRequestModel->setRequested_By($row->Requested_By);
			$poRequestModel->setCreated_By($row->Created_By);
			$poRequestModel->setDiscount($row->Discount);
            $poRequestModel->setDiscount_Value($row->Discount_Value);
            $poRequestModel->setPO_Total($row->PO_Total);
			$poRequestModel->setCurrency_Code($row->Currency_Code);
			$poRequestModel->setCurrency_Rate($row->Currency_Rate);
			$poRequestModel->setPayment_Type_Code($row->Payment_Type_Code);
			$poRequestModel->setPayment_Status($row->Payment_Status);
			$poRequestModel->setPO_Purpose($row->PO_Purpose); 
			$poRequestModel->setPO_Remarks($row->PO_Remarks);
			$poRequestModel->setPO_Payment_Remarks($row->PO_Payment_Remarks);
			$poRequestModel->setPO_Close_Date($row->PO_Close_Date);
			$poRequestModel->setPO_Close_By($row->PO_Close_By);
			$poRequestModel->setPO_Close_Remarks($row->PO_Close_Remarks);
            $poRequestModel->setPO_Cancel_Date($row->PO_Cancel_Date);
		    $poRequestModel->setPO_Cancel_By($row->PO_Cancel_By);
            $poRequestModel->setPO_Cancel_Remarks($row->PO_Cancel_Remarks);
            $poRequestModel->setPrint_Original($row->Print_Original);
            $poRequestModel->setStatus_Code($row->Status_Code);

		}
		
		return $poRequestModel;
	 
 }//function
 
 
 
 
 
 
 
 function getPurchaseOrderDetailsForGivenOrderCode($poReqModel){
	 

	 
	  $query = $this->db->get_where('ta_ims_po_header', array('Order_Code' =>$poReqModel->getOrder_Code()));
	 
	 	$poRequestModel=NULL;
	 
		foreach ($query->result() as $row)
		{	
		$poRequestModel=new PurchaseOrderRequestModel();
		
			$poRequestModel->setOrder_Code($row->Order_Code);
			$poRequestModel->setSupplier_Code($row->Supplier_Code );
			$poRequestModel->setOrder_Date($row->Order_Date);
			$poRequestModel->setExpected_Date($row->Expected_Date);
			$poRequestModel->setQuote_No($row->Quote_No);
			$poRequestModel->setAttn($row->Attn);
			$poRequestModel->setRequested_Dept($row->Requested_Dept);
			$poRequestModel->setRequested_By($row->Requested_By);
			$poRequestModel->setCreated_By($row->Created_By);
			$poRequestModel->setDiscount($row->Discount);
            $poRequestModel->setDiscount_Value($row->Discount_Value);
            $poRequestModel->setPO_Total($row->PO_Total);
			$poRequestModel->setCurrency_Code($row->Currency_Code);
			$poRequestModel->setCurrency_Rate($row->Currency_Rate);
			$poRequestModel->setPayment_Type_Code($row->Payment_Type_Code);
			$poRequestModel->setPayment_Status($row->Payment_Status);
			$poRequestModel->setPO_Purpose($row->PO_Purpose); 
			$poRequestModel->setPO_Remarks($row->PO_Remarks);
			$poRequestModel->setPO_Payment_Remarks($row->PO_Payment_Remarks);
			$poRequestModel->setPO_Close_Date($row->PO_Close_Date);
			$poRequestModel->setPO_Close_By($row->PO_Close_By);
			$poRequestModel->setPO_Close_Remarks($row->PO_Close_Remarks);
            $poRequestModel->setPO_Cancel_Date($row->PO_Cancel_Date);
		    $poRequestModel->setPO_Cancel_By($row->PO_Cancel_By);
            $poRequestModel->setPO_Cancel_Remarks($row->PO_Cancel_Remarks);
            $poRequestModel->setPrint_Original($row->Print_Original);
            $poRequestModel->setStatus_Code($row->Status_Code);

		}
		
		return $poRequestModel;
	 
 }//function
 
 
 
 
 
 
 
 function updatePurchaseOrderRequest($purchaseOrderRequestModel){
	 
$this->db->where('Order_Code',$purchaseOrderRequestModel->getOrder_Code()); 
$this->db->update('ta_ims_po_header', array('Status_Code'=>$purchaseOrderRequestModel->getStatus_Code())); 
	 
	 
 }//function
 
 
 
 
 function updatePurchaseOrderRequestByHOD($purchaseOrderRequestModel){
	 
	 //check whether the PO request is relevant to the HOD
	 
$query = $this->db->get_where('ta_ims_po_header',array('Order_Code'=>$purchaseOrderRequestModel->getOrder_Code(),'Requested_Dept'=>$purchaseOrderRequestModel->getRequested_Dept()));

if($query->num_rows()>0){
	
$this->db->where(array('Order_Code'=>$purchaseOrderRequestModel->getOrder_Code(),'Requested_Dept'=>$purchaseOrderRequestModel->getRequested_Dept())); 
																																				
$this->db->update('ta_ims_po_header', array('Status_Code'=>$purchaseOrderRequestModel->getStatus_Code()));
	
return TRUE;

}
else{
	
	return FALSE;
	
}

}//updatePurchaseOrderRequestByHOD
 
 
 
 
 
 
 function getNumberOfItemsInPurchaseOrderRequest($purchaseOrderRequestModel){
	 
	 $query = $this->db->get_where('ta_ims_po_details',array('Order_Code'=>$purchaseOrderRequestModel->getOrder_Code()));
	 
	 return $query->num_rows();
	 
	 
 }//function
 
 
 
 
 
 function getPurchaseOrderRequestDetailsForGivenDepartment($poReqModel){
	 
	  $query = $this->db->get_where('ta_ims_po_header', array('Requested_Dept' =>$poReqModel->getRequested_Dept(),'Status_Code' =>$poReqModel->getStatus_Code()));
	 
	 
	  $poRequestArray =array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$poRequestModel=new PurchaseOrderRequestModel();
			
			$poRequestModel->setOrder_Code($row->Order_Code);
			$poRequestModel->setSupplier_Code($row->Supplier_Code );
			$poRequestModel->setOrder_Date($row->Order_Date);
			$poRequestModel->setExpected_Date($row->Expected_Date);
			$poRequestModel->setQuote_No($row->Quote_No);
			$poRequestModel->setAttn($row->Attn);
			$poRequestModel->setRequested_Dept($row->Requested_Dept);
			$poRequestModel->setRequested_By($row->Requested_By);
			$poRequestModel->setCreated_By($row->Created_By);
			$poRequestModel->setDiscount($row->Discount);
            $poRequestModel->setDiscount_Value($row->Discount_Value);
            $poRequestModel->setPO_Total($row->PO_Total);
			$poRequestModel->setCurrency_Code($row->Currency_Code);
			$poRequestModel->setPayment_Type_Code($row->Payment_Type_Code);
			$poRequestModel->setPayment_Status($row->Payment_Status);
			$poRequestModel->setPO_Purpose($row->PO_Purpose);
			$poRequestModel->setPO_Remarks($row->PO_Remarks);
			$poRequestModel->setPO_Payment_Remarks($row->PO_Payment_Remarks);
			$poRequestModel->setPO_Close_Date($row->PO_Close_Date);
			$poRequestModel->setPO_Close_By($row->PO_Close_By);
			$poRequestModel->setPO_Close_Remarks($row->PO_Close_Remarks);
            $poRequestModel->setPO_Cancel_Date($row->PO_Cancel_Date);
		    $poRequestModel->setPO_Cancel_By($row->PO_Cancel_By);
            $poRequestModel->setPO_Cancel_Remarks($row->PO_Cancel_Remarks);
            $poRequestModel->setPrint_Original($row->Print_Original);
            $poRequestModel->setStatus_Code($row->Status_Code);

    		$poRequestArray[$index]=$poRequestModel;
			$index++;
		}
		
		
		
		return $poRequestArray;
		
		
	 
 }//function
 
 
 
 
 
 
 
 function getHODModeratablePurchaseOrderRequestDetailsForGivenDepartment($poReqModel){
	 
	 // $query = $this->db->get_where('ta_ims_po_header', array('Requested_Dept' =>$poReqModel->getRequested_Dept(),'Status_Code' =>$poReqModel->getStatus_Code()));
	 
	 $query = $this->db->query("select * from ta_ims_po_header where Requested_Dept=".$poReqModel->getRequested_Dept()." AND (Status_Code=8 OR Status_Code=2)");
	 
	  $poRequestArray =array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$poRequestModel=new PurchaseOrderRequestModel();
			
			$poRequestModel->setOrder_Code($row->Order_Code);
			$poRequestModel->setSupplier_Code($row->Supplier_Code );
			$poRequestModel->setOrder_Date($row->Order_Date);
			$poRequestModel->setExpected_Date($row->Expected_Date);
			$poRequestModel->setQuote_No($row->Quote_No);
			$poRequestModel->setAttn($row->Attn);
			$poRequestModel->setRequested_Dept($row->Requested_Dept);
			$poRequestModel->setRequested_By($row->Requested_By);
			$poRequestModel->setCreated_By($row->Created_By);
			$poRequestModel->setDiscount($row->Discount);
            $poRequestModel->setDiscount_Value($row->Discount_Value);
            $poRequestModel->setPO_Total($row->PO_Total);
			$poRequestModel->setCurrency_Code($row->Currency_Code);
			$poRequestModel->setPayment_Type_Code($row->Payment_Type_Code);
			$poRequestModel->setPayment_Status($row->Payment_Status);
			$poRequestModel->setPO_Purpose($row->PO_Purpose);
			$poRequestModel->setPO_Remarks($row->PO_Remarks);
			$poRequestModel->setPO_Payment_Remarks($row->PO_Payment_Remarks);
			$poRequestModel->setPO_Close_Date($row->PO_Close_Date);
			$poRequestModel->setPO_Close_By($row->PO_Close_By);
			$poRequestModel->setPO_Close_Remarks($row->PO_Close_Remarks);
            $poRequestModel->setPO_Cancel_Date($row->PO_Cancel_Date);
		    $poRequestModel->setPO_Cancel_By($row->PO_Cancel_By);
            $poRequestModel->setPO_Cancel_Remarks($row->PO_Cancel_Remarks);
            $poRequestModel->setPrint_Original($row->Print_Original);
            $poRequestModel->setStatus_Code($row->Status_Code);

    		$poRequestArray[$index]=$poRequestModel;
			$index++;
		}
		
		
		
		return $poRequestArray;
		
		
	 
 }//function
 
 
 
 
 
 
 
 
 
 function getPurchaseOrderDetailsForGivenOrderIDWithDepartment($poReqModel){
	 

	  $query = $this->db->get_where('ta_ims_po_header', array('Order_Code' =>$poReqModel->getOrder_Code(),'Requested_Dept'=>$poReqModel->getRequested_Dept()));
	 
	 	$poRequestModel=NULL;
	 
		foreach ($query->result() as $row)
		{	
		$poRequestModel=new PurchaseOrderRequestModel();
		
			$poRequestModel->setOrder_Code($row->Order_Code);
			$poRequestModel->setSupplier_Code($row->Supplier_Code );
			$poRequestModel->setOrder_Date($row->Order_Date);
			$poRequestModel->setExpected_Date($row->Expected_Date);
			$poRequestModel->setQuote_No($row->Quote_No);
			$poRequestModel->setAttn($row->Attn);
			$poRequestModel->setRequested_Dept($row->Requested_Dept);
			$poRequestModel->setRequested_By($row->Requested_By);
			$poRequestModel->setCreated_By($row->Created_By);
			$poRequestModel->setDiscount($row->Discount);
            $poRequestModel->setDiscount_Value($row->Discount_Value);
            $poRequestModel->setPO_Total($row->PO_Total);
			$poRequestModel->setCurrency_Code($row->Currency_Code);
			$poRequestModel->setCurrency_Rate($row->Currency_Rate);
			$poRequestModel->setPayment_Type_Code($row->Payment_Type_Code);
			$poRequestModel->setPayment_Status($row->Payment_Status);
			$poRequestModel->setPO_Purpose($row->PO_Purpose); 
			$poRequestModel->setPO_Remarks($row->PO_Remarks);
			$poRequestModel->setPO_Payment_Remarks($row->PO_Payment_Remarks);
			$poRequestModel->setPO_Close_Date($row->PO_Close_Date);
			$poRequestModel->setPO_Close_By($row->PO_Close_By);
			$poRequestModel->setPO_Close_Remarks($row->PO_Close_Remarks);
            $poRequestModel->setPO_Cancel_Date($row->PO_Cancel_Date);
		    $poRequestModel->setPO_Cancel_By($row->PO_Cancel_By);
            $poRequestModel->setPO_Cancel_Remarks($row->PO_Cancel_Remarks);
            $poRequestModel->setPrint_Original($row->Print_Original);
            $poRequestModel->setStatus_Code($row->Status_Code);

            
		}
		
		return $poRequestModel;
	 
 }//function
 
 
 
 
 
 
 
 
 function getPurchaseOrderDetailsForGivenStatus($poReqModel){
	 

	 
	  $query = $this->db->get_where('ta_ims_po_header', array('Status_Code' =>$poReqModel->getStatus_Code()));
	// $query = $this->db->get('ta_ims_po_header');
	 
	 	$poRequestModel=NULL;
		
	    $poRequestArray =array();
		$index=0;
	 
		foreach ($query->result() as $row)
		{	
		$poRequestModel=new PurchaseOrderRequestModel();
		
			$poRequestModel->setOrder_Code($row->Order_Code);
			$poRequestModel->setSupplier_Code($row->Supplier_Code );
			$poRequestModel->setOrder_Date($row->Order_Date);
			$poRequestModel->setExpected_Date($row->Expected_Date);
			$poRequestModel->setQuote_No($row->Quote_No);
			$poRequestModel->setAttn($row->Attn);
			$poRequestModel->setRequested_Dept($row->Requested_Dept);
			$poRequestModel->setRequested_By($row->Requested_By);
			$poRequestModel->setCreated_By($row->Created_By);
			$poRequestModel->setDiscount($row->Discount);
            $poRequestModel->setDiscount_Value($row->Discount_Value);
            $poRequestModel->setPO_Total($row->PO_Total);
			$poRequestModel->setCurrency_Code($row->Currency_Code);
			$poRequestModel->setCurrency_Rate($row->Currency_Rate);
			$poRequestModel->setPayment_Type_Code($row->Payment_Type_Code);
			$poRequestModel->setPayment_Status($row->Payment_Status);
			$poRequestModel->setPO_Purpose($row->PO_Purpose); 
			$poRequestModel->setPO_Remarks($row->PO_Remarks);
			$poRequestModel->setPO_Payment_Remarks($row->PO_Payment_Remarks);
			$poRequestModel->setPO_Close_Date($row->PO_Close_Date);
			$poRequestModel->setPO_Close_By($row->PO_Close_By);
			$poRequestModel->setPO_Close_Remarks($row->PO_Close_Remarks);
            $poRequestModel->setPO_Cancel_Date($row->PO_Cancel_Date);
		    $poRequestModel->setPO_Cancel_By($row->PO_Cancel_By);
            $poRequestModel->setPO_Cancel_Remarks($row->PO_Cancel_Remarks);
            $poRequestModel->setPrint_Original($row->Print_Original);
            $poRequestModel->setStatus_Code($row->Status_Code);

    		$poRequestArray[$index]=$poRequestModel;
			$index++;
		}
		
		return $poRequestArray;
	 
 }//function
 
 
 
 
 
 function insertPurchaseOrderUpdatedStatus($purchaseOrderRequestModel){
	 
	 
	 	 $this->db->insert('ta_ims_po_status_update', $purchaseOrderRequestModel); 

	 
 }//function





 function isPurchaseOrderAvialableWithGivenStatus(){


 }
 
 
 
 
}//class

?>
