<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SubPriviledgeModel extends CI_Model {

    var $Privilege_Code;
    var $Privilege_Master_Code;
    var $Privilege;
    var $Description;


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }


    function getPrivilege_Code() { return $this->Privilege_Code; }
    function getPrivilege_Master_Code() { return $this->Privilege_Master_Code; }
    function getPrivilege() { return $this->Privilege; }
    function getDescription() { return $this->Description; }

    function setPrivilege_Code($x) { $this->Privilege_Code = $x; }
    function setPrivilege_Master_Code($x) { $this->Privilege_Master_Code = $x; }
    function setPrivilege($x) { $this->Privilege = $x; }
    function setDescription($x) { $this->Description = $x; }


}//class
?>

