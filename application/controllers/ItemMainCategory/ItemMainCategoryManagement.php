<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class ItemMainCategoryManagement extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		
			if(!$this->session->userdata('logged_in'))
			{
				redirect(base_url() . 'index.php/login');
			}
		
			$this->load->model('ItemMainCategory/ItemMainCategoryModel');
			$this->load->model('ItemMainCategory/ItemMainCategoryService');
		}
	}
?>