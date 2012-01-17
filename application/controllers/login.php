<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('UserModel');
        $this->load->model('UserService');
    }



    function index(){

        if($this->session->userdata('logged_in'))
        {
            //echo "logged user";

            $this->template->setTitles('Page Title', 'Page Sub Title', 'Inner Page Title', 'Inner Page Sub Title');

            $this->template->load('template', 'dashboard');


        }
        else{
            $this->load->view('login');

        }

    }//index




    function authenticateUser(){


        $userModel=new UserModel();
        $userService=new UserService();

        $userModel->setEmail($this->input->post('login_username', TRUE));
        $userModel->setPassword($this->input->post('login_password', TRUE));

        $loggedUserModel=$userService->checkUserLoginAuthentication($userModel);


        if($loggedUserModel!="" && $loggedUserModel!=NULL){

            $loggedEmployeeData = array
            (
                'emp_id'  => $loggedUserModel->getEmployeeCode(),
                'emp_name'  => $loggedUserModel->getEmployeeName(),
                'level'  => $loggedUserModel->getLevelCode(),
                'department'  => $loggedUserModel->getDepartmentCode(),
                'email'     => $loggedUserModel->getEmail(),
                'logged_in' => TRUE
            );

            //creating the user session
            $this->session->set_userdata($loggedEmployeeData);


            //display valid login status to the jquery call
            echo "1";

        }
        else{
            //display invalid login status to the jquery call
            echo "2";

        }


    }//authenticateUser





    function userLogout(){


        $sessionData = array
        (
            'emp_id'  => '',
            'emp_name'  => '',
            'level'  => '',
            'department'  => '',
            'email'     => '',
            'logged_in' => FALSE
        );

        $this->session->unset_userdata($sessionData);
        $this->session->sess_destroy();

        redirect(base_url().'index.php');

    }//userLogout



}//Login
?>
