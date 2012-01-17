<?php
	class ItemUnitService extends CI_Model {
	
		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
		}//constructor
		
		public function loadItemUnits()
		{
			$this->db->from('ta_ims_unit');
			$query = $this->db->get(); 
		
			$itemUnitArray = array();
			
			$index=0;
		
			foreach ($query->result() as $row)
			{
				$itemUnitModel = new ItemUnitModel();
			
				$itemUnitModel->setUnit_Code($row->Unit_Code);
				$itemUnitModel->setDescription($row->Description);
			
				$itemUnitArray[$index]=$itemUnitModel;
				
				$index++;
			}
		
		
			return $itemUnitArray;
		}
	}//class
?>