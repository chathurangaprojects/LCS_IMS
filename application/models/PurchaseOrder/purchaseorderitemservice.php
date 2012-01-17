<?php
class PurchaseOrderItemService extends CI_Model {


 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		$this->load->model('PurchaseOrderItemModel');
		
 }//constructor
 
 
 
 function addNewItemForPurchaseOrder($purchaseOrderItemModel){
	 
  $isAvailable = $this->checkWhethertheItemIsAlreadyInPurchaseOrder($purchaseOrderItemModel);
  
  if($isAvailable==1){
   //item is already in the po request (cant be added again)
   return 0;
   
  }
  else{
   //item was succesfully added to the po
   return  $this->db->insert('ta_ims_po_details', $purchaseOrderItemModel); 
 
  }
   
   
 }//addNewItemForPurchaseOrder
 
 
 
 
 
 function checkWhethertheItemIsAlreadyInPurchaseOrder($purchaseOrderItemModel){
 
 $query = $this->db->query('select * from ta_ims_po_details where Order_Code = '.$purchaseOrderItemModel->getOrder_Code().' AND Master_Item_Code = '.$purchaseOrderItemModel->getMaster_Item_Code());
 
 if ($query->num_rows() > 0)
  {

  return 1;

  }
  else{

   return 0;
   
  }

 }//function 
 
 

 
 
 function getAddedItemForGivenPurchaseOrderRequest($poItemModel){
	 
	 
	 $query = $this->db->get_where('ta_ims_po_details', array('Order_Code' => $poItemModel->getOrder_Code()));
	 
	 
	 	$poItemArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$poItemModel=new PurchaseOrderItemModel();
			
			$poItemModel->setMaster_Item_Code($row->Master_Item_Code);
			$poItemModel->setOrder_Code ($row->Order_Code );
			$poItemModel->setUnit($row->Unit);
			$poItemModel->setUnit_Price($row->Unit_Price);
			$poItemModel->setQuantity($row->Quantity);
			$poItemModel->setDiscount($row->Discount);
			$poItemModel->setDiscount_Value($row->Discount_Value);
			$poItemModel->setItem_Value($row->Item_Value);
			$poItemModel->setInd_Tax($row->Ind_Tax);
			$poItemModel->setTax_Value($row->Tax_Value);
            $poItemModel->setDescription($row->Description);

			
    		$poItemArray[$index]=$poItemModel;
			$index++;
		}
		
		
		return $poItemArray;
	 
 }//getAddedItemForGivenPurchaseOrderRequest
 
 
 
 
 

 
  function updateItemInPurchaseOrder($purchaseOrderItemModel){
	  
	  //echo "method".$purchaseOrderOldItemModel->getOrder_Code()."#".$purchaseOrderOldItemModel->getMaster_Item_Code();
	  //echo 'start';
	  
	  $dataForWhere = array('Order_Code'=>$purchaseOrderItemModel->getOrder_Code(),'Master_Item_Code'=>$purchaseOrderItemModel->getMaster_Item_Code());
	  
//$arr = (array) $purchaseOrderItemModel;

	$this->db->where($dataForWhere);
	$this->db->update('ta_ims_po_details',$purchaseOrderItemModel);
	
	
  }//function
  
  
  
  
  
  function retrieveSelectedPurchaseOrderItemDetails($poItemModel){
	 
	 
	 $query = $this->db->get_where('ta_ims_po_details', array('Order_Code' => $poItemModel->getOrder_Code(),'Master_Item_Code'=>$poItemModel->getMaster_Item_Code()));
	 
		$poItemModel=new PurchaseOrderItemModel();
		
		foreach ($query->result() as $row)
		{
			
			$poItemModel->setMaster_Item_Code($row->Master_Item_Code);
			$poItemModel->setOrder_Code ($row->Order_Code );
			$poItemModel->setUnit($row->Unit);
			$poItemModel->setUnit_Price($row->Unit_Price);
			$poItemModel->setQuantity($row->Quantity);
			$poItemModel->setDiscount($row->Discount);
			$poItemModel->setDiscount_Value($row->Discount_Value);
			$poItemModel->setItem_Value($row->Item_Value);
			$poItemModel->setInd_Tax($row->Ind_Tax);
			$poItemModel->setTax_Value($row->Tax_Value);
            $poItemModel->setDescription($row->Description);


		}
		
		
		return $poItemModel;
	 
 }//retrieveSelectedPurchaseOrderItemDetails
 
  
  
 
 
}//class

?>
