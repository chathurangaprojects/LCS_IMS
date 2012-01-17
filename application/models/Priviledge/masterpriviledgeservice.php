<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterPriviledgeService extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('MasterPriviledgeModel');
    }



    function retrieveAllMasterPriviledges(){

        $query = $this->db->get('ta_ims_privilege_master');

        $masterPrivilegeArr=array();

        $index=0;

        foreach ($query->result() as $row)
        {
            $masterPrivilegeModel=new MasterPriviledgeModel();

            $masterPrivilegeModel->setPrivilege_Master_Code($row->Privilege_Master_Code);
            $masterPrivilegeModel->setMaster_Privilege($row->Master_Privilege);
            $masterPrivilegeModel->setDescription($row->Description);

            $masterPrivilegeArr[$index]=$masterPrivilegeModel;

            $index++;
        }


        return $masterPrivilegeArr;


    }//function





}//class
?>



