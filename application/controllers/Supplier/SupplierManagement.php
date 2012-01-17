<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class SupplierManagement extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		
			if(!$this->session->userdata('logged_in'))
			{
				redirect(base_url() . 'index.php/login');
			}
			
			$this->load->model('SupplierModel');
			$this->load->model('SupplierService');
		}
		
		function retriewSupplierNameAndID()
		{
			//create supplierModel Object  and encapsulate the supplier name(part)
			
			//create a supplierService object and call the retriewSupplierNameAndID() method by providing the supplierObject model
			
			$supplierModel = new SupplierModel();
			$supplierService = new SupplierService();
			
			$supplierModel->setSupplierName();
			
			
			echo 'sfjksdgjdflj';
		}
	}
?>