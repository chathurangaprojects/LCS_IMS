<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class ItemMasterManagement extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		
			if(!$this->session->userdata('logged_in'))
			{
				redirect(base_url() . 'index.php/login');
			}
		
			$this->load->model('ItemMaster/ItemMasterModel');
			$this->load->model('ItemMaster/ItemMasterService');
		}
	
		//Load Insert Master Item Form
		public function insertItemMasterDetailsForm()
		{
			//$data['AddNewItemTypeDialog'] = $this->load->view('Dialogs/AddNewItemType');
            
			$this->template->setTitles('Insert Master Items', '', 'Add New Master Items', '');
			
			$this->template->load('template', 'ItemMaster/InsertItemMasterDetails');
		}
		
		//Insert Master Items
		public function insertItemMasterDetails()
		{
			$itemMasterModel = new ItemMasterModel();
			$itemMasterService = new ItemMasterService();
			
			$itemMasterModel->setItem_Name(trim($this->input->post('Item_Name', TRUE)));
			$itemMasterModel->setType_Code(trim($this->input->post('Item_Type_Hidden', TRUE)));
            $itemMasterModel->setImage(trim($this->input->post('Item_Image', TRUE)));
            $itemMasterModel->setDescription(trim($this->input->post('Description', TRUE)));
            $itemMasterModel->setR_Level((trim($this->input->post('Reorder_Level', TRUE)))!=''?trim($this->input->post('Reorder_Level', TRUE)):0);
            $itemMasterModel->setR_Qty((trim($this->input->post('Reorder_Quantity', TRUE)))!=''?trim($this->input->post('Reorder_Quantity', TRUE)):0);
			$itemMasterModel->setEmployee_Code(trim($this->session->userdata('emp_id')));
            
            echo $itemMasterService->insertItemMasterDetails($itemMasterModel);
		}
	}
?>