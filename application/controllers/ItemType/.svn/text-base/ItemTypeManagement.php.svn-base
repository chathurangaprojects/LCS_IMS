<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class ItemTypeManagement extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		
			if(!$this->session->userdata('logged_in'))
			{
				redirect(base_url() . 'index.php/login');
			}
		
			$this->load->model('ItemType/ItemTypeModel');
			$this->load->model('ItemType/ItemTypeService');
		}
        
        public function insertMasterItemType()
        {
            $itemTypeModel = new ItemTypeModel();
            $itemTypeService = new ItemTypeService();
            
            $itemTypeModel->setItem_Type(trim($this->input->post('Item_Type', TRUE)));
            $itemTypeModel->setCategory_Code(trim($this->input->post('Item_Category', TRUE)));
            $itemTypeModel->setBulk_Code(trim($this->input->post('Bulk_Type', TRUE)));
            $itemTypeModel->setUnit_Code(trim($this->input->post('Unit', TRUE)));
            $itemTypeModel->setDescription(trim($this->input->post('Description', TRUE)));
            
            echo $itemTypeService->insertMasterItemType($itemTypeModel);
        }
	}
?>