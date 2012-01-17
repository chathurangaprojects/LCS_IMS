<div class="hastable">   

<label  class="desc"> List All Employees in Department </label>
       <form name="registered_employees" id="registered_employees" action="" method="post" >
	    <div>
          <select tabindex="3" class="field select small" id="Department_Code" name="Department_Code" onchange="retriveDepartment()" >
            <option value="-1" selected="selected">----Select Department-----</option>
            <?php
								 
				$this->load->model(array('PurchaseOrder/DepartmentModel','PurchaseOrder/DepartmentService'));
			  
			    $departmentService=new DepartmentService();
				
				$departmentData=$departmentService->retriveAllDepartmentDetails();
					for($index=0;$index<sizeof($departmentData);$index++){
					?>
            <option value="<?php echo $departmentData[$index]->getDepartmentCode(); ?>"><?php echo $departmentData[$index]->getDepartmentName(); ?></option>
            <?php
					}
				?>
          </select>
        </div>
		<br/>
		<br/>
		<div id="user_status"> </div>
  <br/>
       <div id="user_message"> </div>   
  <br/>
  <br/>
</form>

<div id="registeredEmployeeTable">	
	
<table id="sort-table"> 
                        <thead> 
                        <tr>
                            <th><?php /*?><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)" class="submit"/><?php */?></th>
                            <th>Employee Name</th> 
                            <th>Designation</th> 
                            <th>Department</th> 
                            <th>Email</th> 
                            <th>Level</th>
                            <th style="width:128px">Options</th> 
                        </tr> 
                        </thead> 
                                                                                                          
                          <tbody> 
                        
                  <?php   
						 
			     $this->load->model(array('UserModel','UserService','UserLevelModel','PurchaseOrder/DepartmentModel','PurchaseOrder/DepartmentService'));
				 
				 
				 $departmentModel= new DepartmentModel();
				 $departmentService = new DepartmentService();
				 
			  
			   // $userService=new UserService();
				
				//$userModelObjectArray=$userService->retrieveAllEmployeeDetails();
						 
					for($index=0;$index<sizeof($userModelObjectArray);$index++){
							?>
                        <tr id="employees<?php echo $userModelObjectArray[$index]->getEmployeeCode(); ?>">
                      
                            <td class="center"><?php  echo $userModelObjectArray[$index]->getEmployeeCode(); ?></td> 
                            <td><?php  echo $userModelObjectArray[$index]->getEmployeeName(); ?></td> 
                            <td><?php  echo $userModelObjectArray[$index]->getDesignation(); ?></td>
                                                        <?php
							//finding the department name
							$departmentCode=$userModelObjectArray[$index]->getDepartmentCode();
							
							$departmentModel->setDepartmentCode($departmentCode);
							$departmentName=$departmentService->retrieveDepartmentName($departmentModel);	
							
							//finding the level code and leveldescription
														
							$userModel=new UserModel();							
							$userModel->setLevelCode($userModelObjectArray[$index]->getLevelCode());
							
							$userModelRetrieved=$userService->retriveUserLevel($userModel);
							//$userLevelModelRetrieved->getLevel();
							
							?>   
                            <td><?php  echo $departmentName; ?></td>
                            <td><?php  echo $userModelObjectArray[$index]->getEmail();?></td>   
                            <td><?php  echo $userModelRetrieved->getLevel()."-".$userModelRetrieved->getDescription();  ?></td>   
                            <td>
                                <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Edit this example" href="<?php  echo base_url(); ?>index.php/UserAdministration/EmployeeAdministration/editEmployeeProfile/<?php echo $userModelObjectArray[$index]->getEmployeeCode(); ?>">
                                    <span class="ui-icon ui-icon-wrench"></span>
                                </a>
                              
                              
                              <span id="emp_status<?php //echo $rowallemployees->Employee_Code ; ?>">
                              
                                
                                <?php
									 if($userModelObjectArray[$index]->getStatus()=='0'){
										 //activate employee
                                 ?>

                                <a href="<?php  echo base_url(); ?>index.php/UserAdministration/EmployeeAdministration/activateEmployee/<?php echo $userModelObjectArray[$index]->getEmployeeCode(); ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Mark as Enabled."  style="cursor:pointer;">
                                
                                    <span class="ui-icon ui-icon-arrowreturnthick-1-n"></span>
                                </a>                                  
                                 <?php } ?>
                                 
                                 <?php
									 if($userModelObjectArray[$index]->getStatus()=='1'){
										 //disable employees
                                 ?>
                                <a href="<?php  echo base_url(); ?>index.php/UserAdministration/EmployeeAdministration/inactivateEmployee/<?php echo $userModelObjectArray[$index]->getEmployeeCode(); ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Mark as Disabled."  style="cursor:pointer;">
                                    <span class="ui-icon ui-icon-arrowreturnthick-1-s"></span>
                                </a>                                  
                                 <?php } ?>
                                 </span>   
                                                            
                            </td>
                        </tr> 
                        <?php } ?>
                             </tbody> 
                             
                          </table>
						<?php //echo $this->pagination->create_links(); ?>  
	
					  </div>
                        </div>
                        
 
  