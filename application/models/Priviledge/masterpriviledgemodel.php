<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterPriviledgeModel extends CI_Model {

    var $Privilege_Master_Code;
    var $Master_Privilege;
    var $Description;


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }



    function getPrivilege_Master_Code() { return $this->Privilege_Master_Code; }
    function getMaster_Privilege() { return $this->Master_Privilege; }
    function getDescription() { return $this->Description; }

    function setPrivilege_Master_Code($x) { $this->Privilege_Master_Code = $x; }
    function setMaster_Privilege($x) { $this->Master_Privilege = $x; }
    function setDescription($x) { $this->Description = $x; }



}//class

?>
