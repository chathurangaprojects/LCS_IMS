<?php
	class ItemTypeService extends CI_Model {
	
		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
		}//constructor
        
        public function insertMasterItemType($itemTypeModel)
        {
            $result = $this->db->insert('ta_ims_item_type', $itemTypeModel);
            
            return $result;
        }
		
//		public function loadItemCategories()
//		{
//			$this->db->from('ta_ims_main_category');
//			$this->db->order_by("Category_Name", "asc");
//			$query = $this->db->get(); 
//		
//			$itemMainCategoryArray = array();
//			
//			$index=0;
//		
//			foreach ($query->result() as $row)
//			{
//				$itemMainCategory=new ItemMainCategoryModel();
//			
//				$itemMainCategory->setCategory_Code($row->Category_Code);
//				$itemMainCategory->setCategory_Name($row->Category_Name);
//				$itemMainCategory->setDescription($row->Description);
//			
//				$itemMainCategoryArray[$index]=$itemMainCategory;
//				$index++;
//			}
//		
//		
//			return $itemMainCategoryArray;
//		}
	}//class
?>