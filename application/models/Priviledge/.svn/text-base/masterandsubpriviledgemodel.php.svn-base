<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterAndSubPriviledgeModel extends CI_Model {

    var $masterPriviledge;
    var $subPriviledge;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model(array('SubPriviledgeModel','MasterPriviledgeModel'));

    }

    function getMasterPriviledge() { return $this->masterPriviledge; }
    function getSubPriviledge() { return $this->subPriviledge; }

    function setMasterPriviledge($x) { $this->masterPriviledge = $x; }
    function setSubPriviledge($x) { $this->subPriviledge = $x; }




}//class
?>
