<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SubPriviledgeService extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('SubPriviledgeModel');

    }




    function  retrieveSubPrivilegeBasedOnMasterPriviledge($masterPrivilege){


        $query = $this->db->get_where('ta_ims_privilege',array('Privilege_Master_Code'=>$masterPrivilege->getPrivilege_Master_Code()));

        $subPrivilegeArr=array();

        $index=0;

        foreach ($query->result() as $row)
        {
            $subPrivilegeModel=new SubPriviledgeModel();

            $subPrivilegeModel->setPrivilege_Code($row->Privilege_Code);
            $subPrivilegeModel->setPrivilege_Master_Code($row->Privilege_Master_Code);
            $subPrivilegeModel->setPrivilege($row->Privilege);
            $subPrivilegeModel->setDescription($row->Description);

            $subPrivilegeArr[$index]=$subPrivilegeModel;

            $index++;
        }


        return $subPrivilegeArr;

    }//function






}//class
?>

