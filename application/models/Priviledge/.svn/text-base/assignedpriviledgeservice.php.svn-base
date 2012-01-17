<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AssignedPriviledgeService extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('AssignedPriviledgeModel');
    }




    function isPriviledgeAlreadyAssignedForDepartmentAndLevel($assignedPriviledgeModel){


        $query = $this->db->get_where('ta_ims_level_privilege',array('Privilege_Code'=>$assignedPriviledgeModel->getPrivilege_Code(),'Level_Code'=>$assignedPriviledgeModel->getLevel_Code(),'Department_Code'=>$assignedPriviledgeModel->getDepartment_Code()));


        if($query->num_rows>0){

            return TRUE;
        }
        else{


            return false;

        }


    }//isPriviledgeArlreadyAssignedForDepartmentAndLevel






    function assignedPriviledges($assignedPriviledgeModel){

        $this->db->insert('ta_ims_level_privilege',$assignedPriviledgeModel);


    }//assignedPriviledges





    function removePriviledges($assignedPriviledgeModel){


        $this->db->delete('ta_ims_level_privilege',array('Privilege_Code'=>$assignedPriviledgeModel->getPrivilege_Code(),'Level_Code'=>$assignedPriviledgeModel->getLevel_Code(),'Department_Code'=>$assignedPriviledgeModel->getDepartment_Code()));


    }//removePriviledges


}//class
?>
