<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserService extends CI_Model {
	
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
        $this->load->model('UserModel');
		$this->load->model('UserLevelModel');
		$this->load->model('UserModerationModel');
    }
	
	
	
	
	function checkUserLoginAuthentication($userModel){
		
		$password=md5($userModel->getPassword());
		
		$parameters=array('Email' =>$userModel->getEmail(),'Password'=>$password,'Status'=>'1');
		
		$query = $this->db->get_where('ta_ims_employee',$parameters);
		
		$loggedUserModel=NULL;
		
		foreach ($query->result() as $row)
        {
			//create the model upon succesful login
		   	$loggedUserModel=new UserModel();
			
		   $loggedUserModel->setEmployeeCode($row->Employee_Code);
		   $loggedUserModel->setEmployeeName($row->Employee_Name);
		   $loggedUserModel->setLevelCode($row->Level_Code);
		   $loggedUserModel->setDepartmentCode($row->Department_Code);
		   $loggedUserModel->setEmail($row->Email);

         }	
			
			
			return $loggedUserModel;
		
	}//checkUserLoginAuthentication
	
	
	
	
	
	 function registerNewEmployee($userModel){
		 
		 
		 $employeeData=array(
		 'Email'=>$userModel->getEmail(),
		 'Password'=>$userModel->getPassword(),
		 'Employee_Name'=>$userModel->getEmployeeName(),
		 'Designation'=>$userModel->getDesignation(),
		 'Level_Code'=>$userModel->getLevelCode(),
         'Department_Code'=>$userModel->getDepartmentCode(),
         'Confirmation_Code'=>'123',
		 'Status'=>'1');
		 
		 	$query = $this->db->get_where('ta_ims_employee', array('Email' => $userModel->getEmail()));
	
	if ($query->num_rows() > 0){
		//email address is already registered
		return FALSE;
	}
	else{
	   //email address is not registered	
	      $this->db->insert('ta_ims_employee', $employeeData); 
		  
		  return TRUE;
	}
	
	
  }//registerNewEmployee
  
  
  
  
  
  
  
  function retrieveAllEmployeeDetails(){
	  	  
	  	$query = $this->db->get_where('ta_ims_employee',array('status'=>'1'));
		
		$employeeDataArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$employeeModel=new UserModel();
			
		   $employeeModel->setEmployeeCode($row->Employee_Code);
		   $employeeModel->setEmployeeName($row->Employee_Name);
		   $employeeModel->setLevelCode($row->Level_Code);
		   $employeeModel->setDepartmentCode($row->Department_Code);
		   $employeeModel->setDesignation($row->Designation);
		   $employeeModel->setEmail($row->Email);
		   $employeeModel->setStatus($row->Status);
		   
		   
    		$employeeDataArray[$index]=$employeeModel;
			$index++;
		}
		
		
		return $employeeDataArray;  
	  
  }//retrieveAllEmployeeDetails
  
	 
	
	
  function retrieveAllEmployeeDetailsWithOffset($start,$end){
	  	  
	  	$query = $this->db->get_where('ta_ims_employee',array('status'=>'1'),$start,$end);
		
		$employeeDataArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$employeeModel=new UserModel();
			
		   $employeeModel->setEmployeeCode($row->Employee_Code);
		   $employeeModel->setEmployeeName($row->Employee_Name);
		   $employeeModel->setLevelCode($row->Level_Code);
		   $employeeModel->setDepartmentCode($row->Department_Code);
		   $employeeModel->setDesignation($row->Designation);
		   $employeeModel->setEmail($row->Email);
		   $employeeModel->setStatus($row->Status);
		   
		   
    		$employeeDataArray[$index]=$employeeModel;
			$index++;
		}
		
		
		return $employeeDataArray;  
	  
  }//retrieveAllEmployeeDetails
  	 
	 
   function retriveUserLevel($userModel){
	  
	   	   
	 $levelCode=$userModel->getLevelCode();
	 
	 $query = $this->db->get_where('ta_ims_level', array('Level_Code' =>$levelCode));
	 
	 	foreach ($query->result() as $row)
		{
		$userLevelModel = new UserLevelModel();
		
		$userLevelModel->setLevel_Code($row->Level_Code);
		$userLevelModel->setLevel($row->Level);
		$userLevelModel->setDescription($row->Description);
		
		return $userLevelModel;
		
		}
	   
   }//function
   
   
   
   
   
   
   function retriveAllUsersMatchesProvidedCrieteria($userModel){
   
    $departmentCode=$userModel->getDepartmentCode();
    $userStatus=$userModel->getStatus();
   if($userStatus!=3){
     $query = $this->db->get_where('ta_ims_employee', array('Department_Code'=>$departmentCode,'Status' => $userStatus));
   }
   else{
     //user status 3 means to retrieve both active and inactive users
     $query = $this->db->get_where('ta_ims_employee', array('Department_Code'=>$departmentCode));
   }
        $employeeDataArray=array();
		$index=0;
		
		foreach ($query->result() as $row)
		{
			$employeeModel=new UserModel();
			
		   $employeeModel->setEmployeeCode($row->Employee_Code);
		   $employeeModel->setEmployeeName($row->Employee_Name);
		   $employeeModel->setLevelCode($row->Level_Code);
		   $employeeModel->setDepartmentCode($row->Department_Code);
		   $employeeModel->setDesignation($row->Designation);
		   $employeeModel->setEmail($row->Email);
		   $employeeModel->setStatus($row->Status);
		   
		   
    		$employeeDataArray[$index]=$employeeModel;
			$index++;
		}
		
		
		return $employeeDataArray;  
   
   }//function
   
   
   
   
   
   function disableSelectedUserAccount($userModerationModel){
   
    $userID=$userModerationModel->getUserID();
	
   $this->db->trans_start();
   //inserting to the employee moderation table
   $this->db->insert('ta_ims_employee_moderation', $userModerationModel); 
   
   //updating the status id the employee table
   $this->db->update('ta_ims_employee', array('Status'=>'0'), array('Employee_Code' =>$userID ));
   $this->db->trans_complete();  
  
   }//disableSelectedUserAccount
   
   
   
   
   
   
   function enableSelectedUserAccount($userModerationModel){
   
   $userID=$userModerationModel->getUserID();
	
   $this->db->trans_start();
   //inserting to the employee moderation table
   $this->db->insert('ta_ims_employee_moderation', $userModerationModel); 
   
   //updating the status id the employee table
   $this->db->update('ta_ims_employee', array('Status'=>'1'), array('Employee_Code' =>$userID ));
   $this->db->trans_complete();  
  
   }//enableSelectedUserAccount
   
   
   
   
   
     function retrieveGivenEmployeeDetails($userModel){
	  	  
		$employeeID=$userModel->getEmployeeCode();  
	  	$query = $this->db->get_where('ta_ims_employee',array('Employee_Code'=>$employeeID));
		
        $employeeModel=new UserModel();
		
		foreach ($query->result() as $row)
		{
						
		   $employeeModel->setEmployeeCode($row->Employee_Code);
		   $employeeModel->setEmployeeName($row->Employee_Name);
		   $employeeModel->setLevelCode($row->Level_Code);
		   $employeeModel->setDepartmentCode($row->Department_Code);
		   $employeeModel->setDesignation($row->Designation);
		   $employeeModel->setEmail($row->Email);
		   $employeeModel->setStatus($row->Status);		   

		}
		
		
		return $employeeModel;  
	  
  }//retrieveAllEmployeeDetails
  
  
  
  
  
  function updateUserProfile($userModel,$userModerationModel){
	  			
			$employeeCode=$userModel->getEmployeeCode();

	        $data=array(
	  		'Email'=>$userModel->getEmail(),
			'Department_Code'=>$userModel->getDepartmentCode(),
			'Level_Code'=>$userModel->getLevelCode(),
			'Designation'=>$userModel->getDesignation(),
			'Employee_Name'=>$userModel->getEmployeeName());
	  
	    $this->db->trans_start();
        //inserting to the employee moderation table
        $this->db->insert('ta_ims_employee_moderation', $userModerationModel); 
   
  	   //updating the status id the employee table
	  
		$this->db->where('Employee_Code', $employeeCode);
		$this->db->update('ta_ims_employee', $data); 

         $this->db->trans_complete();   


  }//updateUserProfile
  
  
  
  
  
  function checkEmailAvailability($userModel){
	  
	  $employeeCode=$userModel->getEmployeeCode();
	  $email=$userModel->getEmail();
	  
	  $query = $this->db->get_where('ta_ims_employee', array('Email' => $email));
	  
	  
	  if ($query->num_rows() > 0){
		  
		//email is registered
		foreach ($query->result() as $row)
		{
			
		  if($row->Employee_Code==$employeeCode){
			  
			  //email is registered for the same user
			  return TRUE;
		  }
		  else{
			  
			//email is registered for another USER
			 return FALSE;
		  }
		}
		
	  }
	  else{
		  
		//email is not registered
		return TRUE;
		  
	  }
	  
  }//check the user email availability
  
  
  
  
  
  function isAdministrativeUser($empID){
	  
	  //implemetation here
	 	  
	  $query = $this->db->get_where('ta_ims_employee', array('Department_Code' =>'1','Employee_Code'=>$empID));

      if($query->num_rows()>0){
		
		return TRUE;
		  
	  }
	  else{
		  
		 return FALSE;
	  
	  }
	  
  }//function
  
  
  
  
  
  
  function isHeadOfDepartmentOrAdministrativeDirector($empID){
	  
	
	$sql = "select * from ta_ims_employee where Employee_Code=".$empID." and (Level_Code=3 OR Level_Code=4)";
    $query = $this->db->query($sql);
	
      if($query->num_rows()>0){
		
		return TRUE;
		  
	  }
	  else{
		  
		 return FALSE;
	  
	  }
	  
  }//function
  
  
  
  
    function isHeadOfDepartment($empID){
	  
	 	  
	  $query = $this->db->get_where('ta_ims_employee', array('Level_Code' =>'4','Employee_Code'=>$empID));

      if($query->num_rows()>0){
		
		return TRUE;
		  
	  }
	  else{
		  
		 return FALSE;
	  
	  }
	  
  }//function
  
  
  
  
  
   function isAdministrativeDirector($empID){
	  
	 	  
	  $query = $this->db->get_where('ta_ims_employee', array('Level_Code' =>'3','Employee_Code'=>$empID));

      if($query->num_rows()>0){
		
		return TRUE;
		  
	  }
	  else{
		  
		 return FALSE;
	  
	  }
	  
  }//function







    function isSuperAdministrator($empID){


        $query = $this->db->get_where('ta_ims_employee', array('Level_Code' =>'6','Employee_Code'=>$empID));

        if($query->num_rows()>0){

            return TRUE;

        }
        else{

            return FALSE;

        }

    }//function

  
  
  
  
  
   
} //UserService
?>

	