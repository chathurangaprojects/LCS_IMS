<?php
	class ItemPropertyService extends CI_Model {
    	   
    	function __construct()
    	{
    		// Call the Model constructor
    		parent::__construct();
            
            $this->load->model('ItemPropertyModel');
    	}//constructor
        
        /** 
         * Developed By: A.M.Roomi
         * Date: 03-01-2012
         * Purpose: Get all the properties based on the given ItemTypeCode
         */
        public function getPropertyByItemTypeID($itemPropertyModel)
        {
            $itemTypeID = $itemPropertyModel->getProperty_Code();
            
            $query = $this->db->get_where('ta_ims_property', array('Type_Code' => $itemTypeID));
            
            $propertyArray = Array();
            $index=0;
            
            foreach ($query->result() as $row)
            {
                $propertyModel = new ItemPropertyModel();
                
                $propertyModel->setProperty($row->Property);
                $propertyModel->setProperty_Code($row->Property_Code);
                
                $propertyArray[$index] = $propertyModel;
                
                $index++;
            }
            
            return $propertyArray;
        }
        
        /** 
         * Developed By: A.M.Roomi
         * Date: 13-01-2012
         * Purpose: Get all the property values based on the given PropertyCode
         */
        public function getPropertyValueByPropertyCode($itemPropertyValueModel)
        {
            $itemPropertyCode = $itemPropertyValueModel->getProperty_Code();
            
            $query = $this->db->get_where('ta_ims_property_value', array('Property_Code' => $itemPropertyCode));
            
            $propertyValueArray = Array();
            $index=0;
            
            foreach ($query->result() as $row)
            {
                $propertyValueModel = new ItemPropertyValueModel();
                
                $propertyValueModel->setProperty_Value_Code($row->Property_Value_Code);
                $propertyValueModel->setPropertiy_Values($row->Propertiy_Values);
                
                $propertyValueArray[$index] = $propertyValueModel;
                
                $index++;
            }
            
            return $propertyValueArray;
        }
        
        /** 
         * Developed By: A.M.Roomi
         * Date: 04-01-2012
         * Purpose: Insert Property for the given Item Type
         */
         public function insertNewItemProperty($itemPropertyModel)
         {
            $query = $this->db->get_where('ta_ims_property', array('Type_Code' => $itemPropertyModel->getType_Code(), 'Property' => $itemPropertyModel->getProperty()));
            
            //return $query->num_rows();
            
            
            
            if ($query->num_rows() > 0)
            {
                return 'Property Cannot be Inserted # Given Property is already available in the database. Please provide a different Property Name. # notice';
            }
            else if ($query->num_rows() == 0)
            {
                $result = $this->db->insert('ta_ims_property', $itemPropertyModel);
                
                if($result == 1)
                {
                    return 'Property Inserted # Property inserted to the database successfully. # success';
                }
                else
                {
                    return 'Error Inserting Property # Property cannot be inserted. Please contact system administrator... # error';
                }
            }
            
         }
    }//class
?>