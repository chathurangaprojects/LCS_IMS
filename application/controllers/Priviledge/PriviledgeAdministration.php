<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PriviledgeAdministration extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('UserModel');
        $this->load->model('UserService');
        $this->load->model('UserModerationModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model(array('PurchaseOrder/DepartmentModel','PurchaseOrder/DepartmentService','Priviledge/MasterPriviledgeModel','Priviledge/MasterPriviledgeService','Priviledge/SubPriviledgeModel','Priviledge/SubPriviledgeService','Priviledge/MasterAndSubPriviledgeModel','Priviledge/AssignedPriviledgeModel','Priviledge/AssignedPriviledgeService'));

    }//construct



    function index(){

        echo "Priviledge Administration Controller";

    }//function index


/* display the level change view */

    function displayChangeLevelPriviledges(){


        if($this->session->userdata('logged_in'))
        {

            $userService = new UserService();

            $isSuperAdmin = $userService->isSuperAdministrator($this->session->userdata('emp_id'));

            if($isSuperAdmin){

                //user has the privileges


                $this->template->setTitles('', '', 'Level Privileges', 'Assign/Change Privileges');

                $this->template->load('template', 'levelPriviledges');


            }
            else{

                //Access Denied

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if user logged
        else{

            redirect(base_url().'index.php');
        }




    }//displayChangeLevelPriviledges



    /* change the level */

    function changeLevelPriviledges(){

        if($this->session->userdata('logged_in'))
        {

            $userService = new UserService();

            $isSuperAdmin = $userService->isSuperAdministrator($this->session->userdata('emp_id'));

            if($isSuperAdmin){

                //user has the privileges


                //retrieving all Master Privileges
                $masterPrivilegeService = new MasterPriviledgeService();

                $masterPrivilegeModelArray = $masterPrivilegeService->retrieveAllMasterPriviledges();


                $subPrivilegeService = new SubPriviledgeService();


                //the following data array will be passed to the view
                $priviledgeDataArray = array();


                //retrieving each sub priviledge under the master priviledge
                for($index=0;$index<sizeof($masterPrivilegeModelArray);$index++){

                    $subPriviledgeModel= $subPrivilegeService->retrieveSubPrivilegeBasedOnMasterPriviledge($masterPrivilegeModelArray[$index]);

                    $masterAndSubModel = new MasterAndSubPriviledgeModel();

                    $masterAndSubModel->setMasterPriviledge($masterPrivilegeModelArray[$index]);
                    $masterAndSubModel->setSubPriviledge($subPriviledgeModel);

                    //set up the retrieved data to the array

                    $priviledgeDataArray[$index] = $masterAndSubModel;

                }//for


                $data=array('priviledgeDataArray'=>$priviledgeDataArray);

                $this->template->setTitles('', '', 'Level Privileges', 'Assign/Change Privileges');

                $this->template->load('template', 'levelPriviledges',$data);


            }
            else{

                //Access Denied

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if user logged
        else{

            redirect(base_url().'index.php');
        }

    }//changeLevelPriviledges








    /* retrieve assigned  priviledegs for the given department and level */


    function departmentLevelPriviledges(){

        if($this->session->userdata('logged_in'))
        {

            $userService = new UserService();

            $isSuperAdmin = $userService->isSuperAdministrator($this->session->userdata('emp_id'));

            if($isSuperAdmin){

                //user has the privileges


                //retrieving all Master Privileges
                $masterPrivilegeService = new MasterPriviledgeService();

                $masterPrivilegeModelArray = $masterPrivilegeService->retrieveAllMasterPriviledges();


                $subPrivilegeService = new SubPriviledgeService();


                //the following data array will be passed to the view
                $priviledgeDataArray = array();


                //retrieving each sub priviledge under the master priviledge
                for($index=0;$index<sizeof($masterPrivilegeModelArray);$index++){

                    $subPriviledgeModel= $subPrivilegeService->retrieveSubPrivilegeBasedOnMasterPriviledge($masterPrivilegeModelArray[$index]);

                    $masterAndSubModel = new MasterAndSubPriviledgeModel();

                    $masterAndSubModel->setMasterPriviledge($masterPrivilegeModelArray[$index]);
                    $masterAndSubModel->setSubPriviledge($subPriviledgeModel);

                    //set up the retrieved data to the array

                    $priviledgeDataArray[$index] = $masterAndSubModel;

                }//for

                //start

 $string='<div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
';

                for($index=0;$index<sizeof($priviledgeDataArray);$index++){

                    $MasterAndSubPriviledgeModel = $priviledgeDataArray[$index];

                    $masterPriviledgeModel = $MasterAndSubPriviledgeModel->getMasterPriviledge();

                    //$subPriviledgeModel contains an array
                    $subPriviledgeModel =  $MasterAndSubPriviledgeModel->getSubPriviledge();


                    $string=$string.'<h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" aria-selected="false" tabindex="-1">
            <span class="ui-icon ui-icon-triangle-1-e"></span>

            <a href="#" onclick="synchronize_accordion()" tabindex="-1">'.$masterPriviledgeModel->getMaster_Privilege().'</a>
        </h3>

        <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="height: 300px; overflow: auto; padding-top: 11.2px; padding-bottom: 11.2px;" role="tabpanel">';


                    //display the all sub priviledges under the master priviledge
                    for($ind=0;sizeof($subPriviledgeModel)>$ind;$ind++){

                        //get master priviledge code
                        $masterCode =$masterPriviledgeModel->getPrivilege_Master_Code();

                        //get subpriviledge code
                        $subCode = $subPriviledgeModel[$ind]->getPrivilege_Code();


                        /*check whether the priviledge is already assigned for the level and department.
                         if it is already assigned the checkbox should be marked as checked
                        */

                        $assignedPriviledge = new AssignedPriviledgeModel();

                        $departmentCode= $this->input->post('departmentCode',TRUE);
                        $levelCode= $this->input->post('levelCode',TRUE);

                        $assignedPriviledge->setDepartment_Code($departmentCode);
                        $assignedPriviledge->setLevel_Code($levelCode);
                        $assignedPriviledge->setPrivilege_Code($subCode);

                        $assignedPriviledgeService = new AssignedPriviledgeService();

                        $isPriviledgeAlreadyAvailable = $assignedPriviledgeService->isPriviledgeAlreadyAssignedForDepartmentAndLevel($assignedPriviledge);


                        if($isPriviledgeAlreadyAvailable){

                            $string=$string.'<input checked="checked" type="checkbox" id="priviledge_given'.$masterCode.'_'.$subCode.'" onchange="moderate_priviledge('.$masterCode.','.$subCode.')" onclick="if(this.checked){this.value=\'on\'}else{this.value=\'off\'}" >'.$subPriviledgeModel[$ind]->getPrivilege().'</input><br/>';

                        }
                        else{
                            $string=$string.'<input type="checkbox" id="priviledge_given'.$masterCode.'_'.$subCode.'" onchange="moderate_priviledge('.$masterCode.','.$subCode.')" onclick="if(this.checked){this.value=\'on\'}else{this.value=\'off\'}" >'.$subPriviledgeModel[$ind]->getPrivilege().'</input><br/>';
                        }
                    }

                    $string = $string.'</div>';


                }//for


                echo $string.'</div>';

                //ends



            }
            else{

                //Access Denied

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if user logged
        else{

            redirect(base_url().'index.php');
        }

    }//departmentLevelPriviledges








    /* this method is used to moderate user priviledges based on the user request */

    function moderateLevelPriviledges(){

        if($this->session->userdata('logged_in'))
        {

            $userService = new UserService();

            $isSuperAdmin = $userService->isSuperAdministrator($this->session->userdata('emp_id'));

            if($isSuperAdmin){


                $masterCode= $this->input->post('masterCode',TRUE);
                $subCode= $this->input->post('subCode',TRUE);
                $departmentCode= $this->input->post('departmentCode',TRUE);
                $levelCode= $this->input->post('levelCode',TRUE);

                //echo "user has the privileges".$masterCode."##".$subCode."##".$levelCode."##".$departmentCode;

                $assignedPriviledge = new AssignedPriviledgeModel();

                $assignedPriviledge->setDepartment_Code($departmentCode);
                $assignedPriviledge->setLevel_Code($levelCode);
                $assignedPriviledge->setPrivilege_Code($subCode);
                $assignedPriviledge->setDescription('description');

                $assignedPriviledgeService = new AssignedPriviledgeService();

                $isPriviledgeAlreadyAvailable = $assignedPriviledgeService->isPriviledgeAlreadyAssignedForDepartmentAndLevel($assignedPriviledge);


                if($isPriviledgeAlreadyAvailable){

                    // echo "priviledge is already assigned to the department and level. therefore it should be removed";
                    $assignedPriviledgeService->removePriviledges($assignedPriviledge);
                    echo '<div class="response-msg success ui-corner-all"><span> Removed</span>The selected privilege was successfully removed from the requested department and the level </div>';
                }
                else{

                    // echo "Priviledge is not assigned to the Department and level... therefore it should be added";
                    $assignedPriviledgeService->assignedPriviledges($assignedPriviledge);
                    echo '<div class="response-msg success ui-corner-all"><span> Assigned</span>The selected privilege was successfully assigned to the requested department and the level</div>';

                }
            }
            else{

                //Access Denied

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if user logged
        else{

            redirect(base_url().'index.php');
        }

    }//moderateLevelPriviledges






}//class

?>
