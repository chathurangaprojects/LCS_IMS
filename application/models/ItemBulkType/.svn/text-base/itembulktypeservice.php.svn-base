<?php
	class ItemBulkTypeService extends CI_Model {
	
		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
		}//constructor
		
		public function loadItemItemBulkTypes()
		{
			$this->db->from('ta_ims_bulk_type');
			$query = $this->db->get(); 
		
			$itemBulkTypeArray = array();
			
			$index=0;
		
			foreach ($query->result() as $row)
			{
				$itemBulkTypeModel = new ItemBulkTypeModel();
			
				$itemBulkTypeModel->setBulk_Code($row->Bulk_Code);
				$itemBulkTypeModel->setDescription($row->Description);
			
				$itemBulkTypeArray[$index]=$itemBulkTypeModel;
				
				$index++;
			}
		
		
			return $itemBulkTypeArray;
		}
	}//class
?>