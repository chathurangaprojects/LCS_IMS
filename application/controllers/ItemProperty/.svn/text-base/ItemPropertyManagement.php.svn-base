<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class ItemPropertyManagement extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		
			if(!$this->session->userdata('logged_in'))
			{
				redirect(base_url() . 'index.php/login');
			}
		
			$this->load->model('ItemProperty/ItemPropertyModel');
            $this->load->model('ItemProperty/ItemPropertyValueModel');
			$this->load->model('ItemProperty/ItemPropertyService');
		}
        
        /** 
         * Developed By: A.M.Roomi
         * Date: 03-01-2012
         * Purpose: Get all the properties based on the given ItemTypeID
         */
        public function getPropertyByItemTypeID()
        {
            $itemPropertyModel = new ItemPropertyModel();
            $itemPropertyService = new ItemPropertyService();
            
            $itemPropertyModel->setProperty_Code(trim($this->input->post('ItemTypeID', TRUE)));
            
            $propertyArray = $itemPropertyService->getPropertyByItemTypeID($itemPropertyModel);
            
            echo '<div class="other-box yellow-box ui-corner-all ui-corner-all" style="padding:5px;"><h3>Existing Item Properties</h3>';
            
            for($index = 0; $index < sizeof($propertyArray); $index++)
            {
                echo '<b>' . ($index + 1) . '. </b>' . $propertyArray[$index]->getProperty() . '<br/>';
            }
            
            echo '</div>';
        }
        
        /** 
         * Developed By: A.M.Roomi
         * Date: 09-01-2012
         * Purpose: Get all the properties based on the given ItemTypeID and add new property
         */
        public function addPropertyByItemTypeID()
        {
            $itemPropertyModel = new ItemPropertyModel();
            $itemPropertyValueModel = new ItemPropertyValueModel();
            $itemPropertyService = new ItemPropertyService();
            
            $itemPropertyModel->setProperty_Code(trim($this->input->post('ItemTypeID', TRUE)));
            
            $propertyArray = $itemPropertyService->getPropertyByItemTypeID($itemPropertyModel);
            
            if(sizeof($propertyArray) > 0)
            {
                echo '<div class="other-box yellow-box ui-corner-all ui-corner-all" style="padding:5px;"><h3>Existing Item Properties and Their Values</h3>';
                //echo '<table>';
                
                for($index = 0; $index < sizeof($propertyArray); $index++)
                {
                    echo '<form method="post" id="add_property_value_form_' . $propertyArray[$index]->getProperty_Code() . '" name="add_property_value_form_' . $propertyArray[$index]->getProperty_Code() . '">';
    
                    echo '<table><tr><td style="width:100px;">' . $propertyArray[$index]->getProperty() . '</td>';
                    
                    echo '<td style="width:250px;">';
                    
                    echo '<select style="width:90%;">';
    
                    $itemPropertyValueModel->setProperty_Code($propertyArray[$index]->getProperty_Code());
                    
                    $propertyValueArray = $itemPropertyService->getPropertyValueByPropertyCode($itemPropertyValueModel);
                    
                    for($index2 = 0; $index2 < sizeof($propertyValueArray); $index2++)
                    {
                        echo '<option>' . $propertyValueArray[$index2]->getPropertiy_Values() . '</option>';
                    }
                    
                    echo '</select>';
                    
                    echo '</td>';
    
                    echo '<td style="width:250px;">';
                    echo '<input style="width:90%;" type="text" id="property_value_' . $propertyArray[$index]->getProperty_Code() . '" name="property_value_' . $propertyArray[$index]->getProperty_Code() . '"/>';
                    echo '<td>';
    
                    echo '<td style="width:100px;">';
                    echo '<input id="add_property_value_' . $propertyArray[$index]->getProperty_Code() . '" class="btn ui-state-default ui-corner-all" type="submit" name="add_property_value_' . $propertyArray[$index]->getProperty_Code() . '" value="Add Value">';
    
                    echo '</td></tr></table></form>';
    ?>
    
                    <script type="text/javascript">
                            $("#add_property_value_form_<?php echo $propertyArray[$index]->getProperty_Code(); ?>").validate
                        	({
                        	    rules:
                        		{
                        		    property_value_<?php echo $propertyArray[$index]->getProperty_Code(); ?>: "required"
                        		},
                        	    messages:
                        		{
                                    property_value_<?php echo $propertyArray[$index]->getProperty_Code(); ?>: "Property Value Required"
                        
                        		},
                        
                        	    submitHandler: function (form) {
                        	       alert('safsadfgsgsdgsd');
                        	    }
                        
                        	});
                    </script>
    
    <?php
                    
                    //echo '<b>' .  . '. </b>' . $propertyArray[$index]->getProperty_Code() . '<br/>';
                }
                
                //echo '</table>';
                
                echo '</div>';
            }
            else
            {
                echo '<div class="other-box yellow-box ui-corner-all ui-corner-all" style="padding:5px;"><h3>No any properties avialable for the selected item.</h3>';
            }
        }
        
        /** 
         * Developed By: A.M.Roomi
         * Date: 04-01-2012
         * Purpose: Insert Property for the given Item Type
         */
         public function insertNewItemProperty()
         {
            $itemPropertyModel = new ItemPropertyModel();
            $itemPropertyService = new ItemPropertyService();
            
            $itemPropertyModel->setType_Code(trim($this->input->post('Item_Type_For_Property_Hidden', TRUE)));
            $itemPropertyModel->setProperty(trim($this->input->post('Item_Property', TRUE)));
            $itemPropertyModel->setProperty_Description(trim($this->input->post('Property_Description', TRUE)));
            
            echo $itemPropertyService->insertNewItemProperty($itemPropertyModel);
         }
	}
?>