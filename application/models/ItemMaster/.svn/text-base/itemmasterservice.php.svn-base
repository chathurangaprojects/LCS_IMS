<?php
	class ItemMasterService extends CI_Model {
	
		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
			$this->load->database();
			$this->load->model('ItemMasterModel');
		}//constructor
	
		public function loadItemTypes($itemMasterModel)
		{
			$val = explode(' ', trim($itemMasterModel->getItem_Name()));

			$qry = '';

			$i = 0;
			while($i < count($val))
			{
				if($i == 0)
				{
					$qry = "ta_ims_item_type.Item_Type LIKE '%" . $val[$i] . "%'";
				}
				else
				{
					$qry = $qry . " AND ta_ims_item_type.Item_Type LIKE '%" . $val[$i] . "%'";
				}

				$i += 1;
			}
		
			$sql = "SELECT ta_ims_item_type.*, ta_ims_main_category.Category_Name FROM ta_ims_item_type INNER JOIN ta_ims_main_category ON ta_ims_item_type.Category_Code = ta_ims_main_category.Category_Code WHERE " . trim($qry) . " OR ta_ims_item_type.Description LIKE '%" . trim($itemMasterModel->getItem_Name()) . "%' AND (ta_ims_item_type.Item_Type != '' OR ta_ims_item_type.Item_Type != NULL)";
		
			$results = $this->db->query($sql);

			if($results->num_rows() > 0)
			{
				return $results;
			}
			else
			{
				return NULL;
			}
		}
		
	//Insert Master Items
	public function insertItemMasterDetails($itemMsaterModel)
	{
		$result = $this->db->insert('ta_ims_item_master', $itemMsaterModel);
		return $result;
	}
	
	
	
	
	
	
	function retrieveItemNames($itemModel){
		
		$val = explode(' ', trim($itemModel->getItem_Name()));

            $qry = '';

            $i = 0;
            while($i < count($val))
            {
                if($i == 0)
                {
                    $qry = "ta_ims_item_master.Item_Name LIKE '%" . $val[$i] . "%'";
                }
                else
                {
                    $qry = $qry . " AND ta_ims_item_master.Item_Name LIKE '%" . $val[$i] . "%'";
                }

                $i += 1;
            }

            $sql = "SELECT * FROM ta_ims_item_master WHERE " . trim($qry) . " ORDER BY Item_Name ASC";
/*
            $results = $this->db->query($sql);
            
            if($results->num_rows() > 0)
            {
                return $results;
            }
            else
            {
                return NULL;
            }
		*/
		$query = $this->db->query($sql);
		
		$itemArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$itemModel=new ItemMasterModel();
			
			$itemModel->setMaster_Item_Code($row->Master_Item_Code);
			$itemModel->setItem_Name($row->Item_Name);
			
    		$itemArray[$index]=$itemModel;
			$index++;
		}
		
		
		return $itemArray;
		
		
		
	}//addNewItemForPurchaseOrder
	
	
	
	
	
	
	function retrieveItemDetails($itemModel){
		
		
		
	$query = $this->db->get_where('ta_ims_item_master', array('Master_Item_Code' => $itemModel->getMaster_Item_Code()));

        $itemMasterModel = new ItemMasterModel();
		
		
			foreach ($query->result() as $row)
		{
				
		$itemMasterModel->setItem_Name($row->Item_Name);
		$itemMasterModel->setType_Code($row->Type_Code);
		$itemMasterModel->setImage($row->Image);
		$itemMasterModel->setDescription($row->Description);
		$itemMasterModel->setR_Level($row->R_Level);
		$itemMasterModel->setR_Qty($row->R_Qty);
		$itemMasterModel->setEmployee_Code($row->Employee_Code);
		$itemMasterModel->setMaster_Item_Code($row->Master_Item_Code);
		$itemMasterModel->setPrimary_cat($row->Primary_cat);
		$itemMasterModel->setSecondary_cat($row->Secondary_cat);
			
		}
		
		
		return  $itemMasterModel;
	
	}//retrieveItemDetails
	
	
	
}//class
?>