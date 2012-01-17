<?php
class DepartmentService extends CI_Model {


 function __construct()
 {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		$this->load->model('DepartmentModel');
		
 }//constructor
 
 
 
 function retriveAllDepartmentDetails(){
	 
	 
	 	$query = $this->db->get('ta_ims_department');
		
		$departmentArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$departmentModel=new DepartmentModel();
			
			$departmentModel->setDepartmentCode($row->Department_Code);
			$departmentModel->setDepartmentName($row->Department_Name);
			$departmentModel->setDepartmentID($row->Department_ID);
			
    		$departmentArray[$index]=$departmentModel;
			$index++;
		}
		
		
		return $departmentArray;
	 
 }//retriveAllDepartmentDetails
  



 function retrieveDepartmentName($departmentModel){
	 
	 $departmentCode=$departmentModel->getDepartmentCode();
	 
	 $query = $this->db->get_where('ta_ims_department', array('Department_Code' =>$departmentCode));
	 
	 	foreach ($query->result() as $row)
		{
			
		return $row->Department_Name;
		
		}
	  		
	 
 }//retrieveDepartmentName
 
 
 

}

?>
