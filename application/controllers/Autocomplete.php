<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Autocomplete extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		
	        //$this->load->model('UserModel');
			//$this->load->model('UserService');
			//$this->load->model(array('Supplier/SupplierModel','Supplier/SupplierService'));
			
			$this->load->model(array('UserModel', 'UserService'));
			$this->load->model(array('ItemMaster/ItemMasterModel', 'ItemMaster/ItemMasterService'));
			$this->load->model(array('Supplier/SupplierModel', 'Supplier/SupplierService'));
		}
		
		
		public function loadItemTypes()
		{
			$itemMasterModel = new ItemMasterModel();
			$itemMasterService = new ItemMasterService();
			
			$itemMasterModel->setItem_Name($this->input->get('q', TRUE));
			
			$results = $itemMasterService->loadItemTypes($itemMasterModel);
			
			if(!empty($results))
			{
				foreach($results->result() as $result)
				{
					$itemType = trim($result->Item_Type);
					$itemCategory = trim($result->Category_Name);
					
					if(empty($itemType))
					{
						$itemType = "&lt;Type Not Available&gt;";
					}
					
					if(empty($itemCategory))
					{
						$itemCategory = "&lt;Category Not Available&gt;";
					}
					
					echo $itemType . " !@#$%^&*() " . $itemCategory . " !@#$%^&*() " . trim($result->Type_Code) . "\n";
				}
			}
		}
		
		
	
		public function loadSuppliers(){
			
			
			$charactersTypingforSupplierName = $this->input->get('q',TRUE);
			
			$supplierModel = new SupplierModel();
			
			$supplierType = $this->input->get('sup_type',TRUE);
			
			if($supplierType !=""){
			//user has selected a supplier type
			$supplierModel->setSupplier_Type($supplierType);
            }
			else{
			//user haven selected a supplier type
			$supplierModel->setSupplier_Type(-1);
			}
			
			$supplierModel->setSupplier_Name($charactersTypingforSupplierName);
			
			$supplierService = new SupplierService();
			
			$supplierArray = array();
			
			$supplierArray = $supplierService->retriewSupplierNameAndID($supplierModel);
			
			//foreach($supplierArray as $supplier){
			for($index=0; $index<sizeof($supplierArray);$index++){
				
			//echo $supplierArray[$index]->getSupplier_Code()."###".$supplierArray[$index]->getSupplier_Name()."\n";
			echo $supplierArray[$index]->getSupplier_Code()."###".$supplierArray[$index]->getSupplier_Name()."###".$this->input->get('sup_type',TRUE)."\n";
						
			}
			
		}//loadSuppliers
		
		
		
		
	
		
		
		
		
		
		
		
		
		function loadItemNames(){
			
			
			//echo "1###name###cat";
			 $charactersTypingforitemName = $this->input->get('q',TRUE);

	
	          $itemModel = new ItemMasterModel();
			  $itemService = new ItemMasterService();
			
			 $itemModel->setItem_Name($charactersTypingforitemName);
			 
			 $itemArray = $itemService->retrieveItemNames($itemModel);
			 
	        // echo "1###name".$charactersTypingforitemName.sizeof($itemArray)."###cat";
	        
		     for($index=0;$index<sizeof($itemArray);$index++){
	         
			 echo  $itemArray[$index]->getMaster_Item_Code()."###".$itemArray[$index]->getItem_Name()."\n";
	
			 }
			 
			 
		}//loadItemNames
		
		
		
	}//Autocomplete
	
?>