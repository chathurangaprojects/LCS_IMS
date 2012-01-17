<link href="<?php echo base_url(); ?>template_resources/css/ui/ui.accordion.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="<?php echo base_url(); ?>template_resources/js/ui/ui.accordion.js"></script>
<script type="text/javascript">
    $(function() {
        $("#accordion").accordion({
        });
    });
</script>

<div class="content-box">

    <div id="select_level_department">


        <b> Select Department </b>
        <select tabindex="3" class="field select small" id="Department_Code" name="Department_Code" onchange="retrieve_priviledges();jQuery('#accordion').accordion();">
            <option value="">Please select</option>
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


        <br/><br/>



        <b>Select Level</b>
        <select tabindex="3" class="field select small" id="Level_Code" name="Level_Code" onchange="retrieve_priviledges();jQuery('#accordion').accordion();">
            <option value="">Please select</option>
            <?php

            $this->load->model('PurchaseOrder/SecurityLevelModelAndService');

            $securityService=new SecurityLevelModelAndService();

            $securityLevelData=$securityService->retriveAllSecurityLevels();

            for($index=0;$index<sizeof($securityLevelData);$index++){
                ?>
                <option value="<?php echo $securityLevelData[$index]->getLevelCode(); ?>"><?php echo $securityLevelData[$index]->getDescription(); ?></option>
                <?php
            }
            ?>
        </select>


        <br/><br/>



    </div>



    <div id="level_priviledges">


    </div>



    <div id="user_notification_message">


    </div>


</div>