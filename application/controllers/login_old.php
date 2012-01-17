<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Login extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			if($this->session->userdata('logged_in'))
			{
				$this->template->setTitles('Page Title', 'Page Sub Title', 'Inner Page Title', 'Inner Page Sub Title');
				
				$this->template->load('template', 'dashboard');
			}
			else
			{
				$this->load->view('login');
			}
		}
		
		public function load_db()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect(base_url() . 'index.php/login');
			}
		}
	}
?>