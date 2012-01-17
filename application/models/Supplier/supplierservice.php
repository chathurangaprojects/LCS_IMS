<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class SupplierService extends CI_Model {

		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
			$this->load->database();
			$this->load->model('SupplierModel');
		}
		
		public function retriewSupplierNameAndID($supplierModel)
		{
			//get supplier name
			$supplierName = $supplierModel->getSupplier_Name();
			
			//database select query based on like operator on name
             $this->db->like('Supplier_Name',$supplierName,'both');  
			 
			 //getting supplier type
			 $supType = $supplierModel->getSupplier_Type();
			 
			 if($supType!=-1){
             $query = $this->db->get_where('ta_ims_supplier_header',array('Supplier_Type' => $supplierModel->getSupplier_Type()));
			 }
			 else{
			  //user havent selected a supplier type yet. therefore we must display all suppliers at the moment
			   $query = $this->db->get('ta_ims_supplier_header');
			 }
			 
			$supplierArray = array();
			$index = 0;
            foreach ($query->result() as $row)
			{
			$supplier = new SupplierModel();
				
			 $supplier->setSupplier_Code($row->Supplier_Code);	
			 $supplier->setSupplier_Name($row->Supplier_Name);
			 
			  $supplierArray[$index] = $supplier; 
			  
			 $index++;
			}
			return $supplierArray;
      }//retriewSupplierNameAndID
	
	
	
	 function getGivenSupplierDetails($supplierModel){
		 
      $supplierCode=$supplierModel->getSupplier_Code();
	 
	  $query = $this->db->get_where('ta_ims_supplier_header', array('Supplier_Code' =>$supplierCode));
	 
	  $supplier = new SupplierModel();
	  
									  
	 	foreach ($query->result() as $row)
		{
			
			 $supplier->setSupplier_Code($row->Supplier_Code);	
			 $supplier->setSupplier_Name($row->Supplier_Name);
			 $supplier->setAddress($row->Address);	
			 $supplier->setCity($row->City);
			 $supplier->setCountry_Code($row->Country_Code);	
			 $supplier->setPhone($row->Phone);
			 $supplier->setFax($row->Fax);	
			 $supplier->setSupplier_Type($row->Supplier_Type);
			 $supplier->setEmail($row->Email);	
			 $supplier->setReg_No($row->Reg_No);
			 $supplier->setWebsite($row->Website);	
			 $supplier->setActive($row->Active);
			 

		}//foreach
		 
		 return $supplier; 
		 
	 }//function


	
	}//class
	
?>