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
        <select tabindex="3" class="field select small" id="Department_Code" name="Department_Code" onchange="retrieve_priviledges()">
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
        <select tabindex="3" class="field select small" id="Level_Code" name="Level_Code" onchange="retrieve_priviledges()">
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


    <div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">

        <?php

        for($index=0;$index<sizeof($priviledgeDataArray);$index++){

            $MasterAndSubPriviledgeModel = $priviledgeDataArray[$index];

            $masterPriviledgeModel = $MasterAndSubPriviledgeModel->getMasterPriviledge();

            //$subPriviledgeModel contains an array
            $subPriviledgeModel =  $MasterAndSubPriviledgeModel->getSubPriviledge();

            ?>


            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" aria-selected="false" tabindex="-1">
                <span class="ui-icon ui-icon-triangle-1-e"></span>

                <a href="#" tabindex="-1"> <?php echo $masterPriviledgeModel->getMaster_Privilege(); ?> </a>
            </h3>

            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="height: 300px; overflow: auto; padding-top: 11.2px; padding-bottom: 11.2px;" role="tabpanel">

                <?php
                //display the sub priviledges
                for($ind=0;sizeof($subPriviledgeModel)>$ind;$ind++){

                    echo $subPriviledgeModel[$ind]->getPrivilege()."<br/>";

                }
                ?>
            </div>

            <?php
        }//for
        ?>


    </div>



</div>