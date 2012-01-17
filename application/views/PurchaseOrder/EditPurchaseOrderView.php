<div class="content-box">
<h3>Purchase Order Form</h3>
<?php echo form_open_multipart('',array('name'=>'purchase_order_request_edit','id'=>'purchase_order_request_edit')); ?>
<fieldset>
<table width="100%" border="1px" class="flexme2">
<tr>
    <td colspan="1" style="padding: 5px 5px 5px 0;"><b>Supplier Type *</b></td>
    <div>
        <td colspan="3" style="padding: 5px 5px 5px 0;"><select id="sup_type" class="field select full" name="sup_type" onchange="select_currency();" >
            <option value=""> - -Select Supplier Type- -</option>
            <option value="0" <?php if($SupplierType==0){ ?> selected="selected"<?php } ?> >Local Supplier</option>
            <option value="1" <?php if($SupplierType==1){ ?> selected="selected"<?php } ?> >Foreign Supplier</option>
        </select></td>
    </div>
    <?php
    //retrieving the supplier name
    $this->load->model(array('Supplier/SupplierModel','Supplier/SupplierService'));

    $supplierModel = new SupplierModel();
    $supplierService = new SupplierService();

    $supplierModel->setSupplier_Code($PurchaseOrderRequestObject->getSupplier_Code());

    $supplierModelRetrieved = $supplierService->getGivenSupplierDetails($supplierModel);

    ?>
    <td colspan="1" style="padding: 5px 5px 5px 0;"><b>Supplier Name *</b></td>
    <td colspan="3" style="padding: 5px 5px 5px 0;"><div>
        <input type="text" id="sup_name"  class="field text full" name="sup_name" onchange="purchaseOrderRequestFormValidation()" value="<?php echo $supplierModelRetrieved->getSupplier_Name(); ?>" />
    </div></td>
</tr>
<tr>
    <td style="padding: 5px 5px 5px 0;"><b>Order Date *</b></td>
    <td style="padding: 5px 5px 5px 0;"><div>
        <input type="text" id="order_date" class="field text full" name="order_date" value="<?php echo substr($PurchaseOrderRequestObject->getOrder_Date(),0,10); ?>" readonly="readonly" />
    </div></td>
    <td style="padding: 5px 5px 5px 0;"><b>Expected Date</b></td>
    <td style="padding: 5px 5px 5px 0;"><div>
        <input type="text" id="expected_date" class="field text full" name="expected_date" onchange="expectedDateFieldValidation()" value="<?php echo substr($PurchaseOrderRequestObject->getExpected_Date(),0,10); ?>"/>
    </div>
        <div id="date_error_message"> </div></td>
    <td style="padding: 5px 5px 5px 0;"><b>Quotation No.</b></td>
    <td style="padding: 5px 5px 5px 0;"><div>
        <input type="text" id="quatation_no" class="field text full" name="quatation_no" value="<?php echo $PurchaseOrderRequestObject->getQuote_No(); ?>" />
    </div></td>
    <td style="padding: 5px 5px 5px 0;"><b>Attention</b></td>
    <td style="padding: 5px 5px 5px 0;"><div>
        <input type="text" id="attention" class="field text full" name="attention" value="<?php echo $PurchaseOrderRequestObject->getAttn(); ?>" />
    </div></td>
</tr>
<tr>
    <td colspan="1" style="padding: 5px 5px 5px 0;"><b>Department *</b></td>
    <td colspan="3" style="padding: 5px 5px 5px 0;"><div>
        <select id="Department_Code" class="field select full" name="Department_Code" >
            <option value="">Please select</option>
            <?php
            $this->load->model(array('PurchaseOrder/DepartmentModel','PurchaseOrder/DepartmentService','UserService','UserModel'));

            $userService = new UserService();
            $departmentService=new DepartmentService();

            $deptModel = new DepartmentModel();

            if(!$userService->isAdministrativeUser($this->session->userdata('emp_id'))) {

                //getting the department name and the id of the employee
                $departmentCode = $this->session->userdata('department');

                $deptModel->setDepartmentCode($departmentCode);

                $depatModelRetrieved = $departmentService->retriveGivenDepartmentDetails($deptModel);
                ?>
                <option value="<?php echo $depatModelRetrieved->getDepartmentCode(); ?>"><?php echo $depatModelRetrieved->getDepartmentName(); ?></option>
                <?php
            }
            else{

                $departmentData=$departmentService->retriveAllDepartmentDetails();
                for($index=0;$index<sizeof($departmentData);$index++){
                    ?>
                    <option value="<?php echo $departmentData[$index]->getDepartmentCode(); ?>" <?php if($departmentData[$index]->getDepartmentCode()==$PurchaseOrderRequestObject->getRequested_Dept()){ ?> selected="selected" <?php } ?> ><?php echo $departmentData[$index]->getDepartmentName(); ?></option>
                    <?php
                }//for
            }//else -- administrative user
            ?>
        </select>
    </div></td>
    <td colspan="1" style="padding: 5px 5px 5px 0;"><b>Requested By *</b></td>
    <td colspan="3" style="padding: 5px 5px 5px 0;">
        <?php
        $userService = new UserService();

        if(!$userService->isAdministrativeUser($this->session->userdata('emp_id'))) {
            //retrieve only the logged employee data

            $userMod = new UserModel();

            $userMod->setEmployeeCode($PurchaseOrderRequestObject->getRequested_By());
            $userModelRetrieved = $userService->retrieveGivenEmployeeDetails($userMod);

            ?>
            <select id="requested_by" class="field select full" name="requested_by">

                <option value="<?php echo $PurchaseOrderRequestObject->getRequested_By(); ?>" ><?php echo $userModelRetrieved->getEmail(); ?></option>

            </select>
            <?php
        }
        else{
            //retrieve a list of all user data

            //$userService = new UserService();
            $userModelArray=$userService->retrieveAllEmployeeDetails();
            ?>
          <select id="requested_by" class="field select full" name="requested_by">
            <option value=""> -- Select Employee --</option>
            <?php
            for($index=0;$index<sizeof($userModelArray);$index++){
                ?>
                <option value="<?php echo $userModelArray[$index]->getEmployeeCode(); ?>" <?php if($userModelArray[$index]->getEmployeeCode()==$PurchaseOrderRequestObject->getRequested_By()) { ?> selected="selected" <?php } ?> > <?php echo $userModelArray[$index]->getEmail(); ?> </option>
                <?php
            }//for
        }//else
        ?>
    </select>
    </td>
</tr>
<tr>
    <td colspan="1" style="padding: 5px 5px 5px 0;"><b>Payment Type *</b></td>
    <td colspan="3" style="padding: 5px 5px 5px 0;"><select id="payment_type" class="field select full" name="payment_type" >
        <option value="">- - Select Payment Type- - </option>
        <?php
        foreach ($paymentTypeObjectArray as $paymentTypeModel)
        {
            ?>
            <option value="<?php echo $paymentTypeModel->getPayment_Type_Code(); ?>" <?php if($PurchaseOrderRequestObject->getPayment_Type_Code()) { ?> selected="selected" <?php } ?> ><?php echo $paymentTypeModel->getPayment_Type(); ?></option>
            <?php
        }
        ?>

    </select>
    </td>
    <td style="padding: 5px 5px 5px 0;"><b>Currency *</b></td>
    <td style="padding: 5px 5px 5px 0;"><select id="currrency_selector" class="field select full" name="currrency_selector" onchange="select_conversion_rate();">
        <option value="">- - Select - -</option>
        <?php
        foreach ($currencyObjectArray as $currencyModel)
        {
            ?>
            <option value="<?php echo $currencyModel->getCurrency_Code(); ?>" <?php if($currencyModel->getCurrency_Code()==$PurchaseOrderRequestObject->getCurrency_Code()){ ?> selected="selected" <?php } ?>  ><?php echo $currencyModel->getCurrency(); ?></option>
            <?php
        }
        ?>
    </select></td>
    <td style="padding: 5px 5px 5px 0;"><b>Conversion Rate *</b></td>
    <td style="padding: 5px 5px 5px 0;">
        <div>
            <input type="text" id="conversion_rate" class="field text full" name="conversion_rate" value="<?php echo $PurchaseOrderRequestObject->getCurrency_Rate();?>"/>
        </div>
    </td>
</tr>
<tr>
    <td colspan="1" style="padding: 5px 5px 5px 0;"><b>Payment Remarks</b></td>
    <td colspan="7" style="padding: 5px 5px 5px 0;">
        <textarea id="pay_remark" class="field text full" name="pay_remark" rows="2">
            <?php echo $PurchaseOrderRequestObject->getPO_Payment_Remarks(); ?>
        </textarea></td>
</tr>
<tr>
    <td colspan="1" style="padding: 5px 5px 5px 0;"><label class="desc">PO Purpose</label></td>
    <td colspan="3" style="padding: 5px 5px 5px 0;"><!-- <input type="text" id="po_purpose" class="field text full" name="txt_po_purpose" /> -->
        <textarea id="po_purpose" class="field text full" name="po_purpose" rows="2">
            <?php echo $PurchaseOrderRequestObject->getPO_Purpose(); ?>
        </textarea></td>
    <td colspan="1" style="padding: 5px 5px 5px 0;"><label class="desc">PO Remarks</label></td>
    <td colspan="3" style="padding: 5px 5px 5px 0;"><!-- <input type="text" id="po_remarks" class="field text full" name="txt_po_remarks" /> -->
        <textarea id="po_remarks" class="field text full" name="po_remarks" rows="2">
            <?php echo $PurchaseOrderRequestObject->getPO_Remarks(); ?>
        </textarea></td>
</tr>
<tr>
    <td colspan="8"><!--                            <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
                                <a id="lnk_add_item" class="btn ui-state-default ui-corner-all" href="#">
                                    <span class="ui-icon ui-icon-newwin"></span>
                                    Add Item
                                </a>
                            </span>-->
        <!--                                                                  <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
            <a id="lnk_add_item" class="btn ui-state-default ui-corner-all" href="#" name="lnk_add_item">
               <span class="ui-icon ui-icon-newwin"></span>
                Add Item
            </a>
        </span>-->
          <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
          <input type="button" value="Add Item"  id="lnk_add_item" name="lnk_add_item" class="btn ui-state-default ui-corner-all" onclick="addNewItemDialog()" />
          
          </span>

        <br/><br/>
         
         <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
        <input type="submit" value="Save"  id="po_save" name="po_save" class="btn ui-state-default ui-corner-all" />
          </span>

        <?php
        //check whther the logged user is  HOD(Head of Departments) or Administrative Director
        $userService = new UserService();
        $isHODorACDuser = $userService->isHeadOfDepartmentOrAdministrativeDirector($this->session->userdata('emp_id'));


        $isHODuser = $userService->isHeadOfDepartment($this->session->userdata('emp_id'));

        $isAdminDirector = $userService->isAdministrativeDirector($this->session->userdata('emp_id'));

        //send for Approval button is only dedicated for the Employee who place the PO request
        if(!$isHODorACDuser){
            ?>

            <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
          <input type="button" value="Send For Approval"  id="item_for_approval" name="item_for_approval" class="btn ui-state-default ui-corner-all" onclick="sendForApprvalByEmployee()" />
          </span>

            <?php
        }//if send for Approval

        //the below three buttons will be displyed only for the HOD(Head of Departments)
        if($isHODuser){

            //check whether PO request is relevant to the logged in HOD user

            $po_requested_dept=$PurchaseOrderRequestObject->getRequested_Dept();

            $logged_hod_user_dept=$this->session->userdata('department');

            if($po_requested_dept==$logged_hod_user_dept){
                ?>
                <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
  <input type="button" value="Approve PO"  id="Approve" name="Approve" class="btn ui-state-default ui-corner-all" onclick="approvePOrequestByHOD()" />
       </span>

                <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
          <input type="button" value="Reject PO"  id="Reject" name="Reject" class="btn ui-state-default ui-corner-all"  onclick="rejectPOrequestByHOD()" />
          </span>

                <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
     <input type="button" value="Return PO"  id="Return" name="Return" class="btn ui-state-default ui-corner-all" onclick="returnPOrequestByHOD()"/>
          </span>
                <?php

            }//HOD user has the PO request moderation ownership
        }//if HOD user

        if($isAdminDirector){
            ?>

            <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
  <input type="button" value="Approve PO"  id="Approve" name="Approve" class="btn ui-state-default ui-corner-all" onclick="approvePOrequestByACD()" />
       </span>

            <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
          <input type="button" value="Reject PO"  id="Reject" name="Reject" class="btn ui-state-default ui-corner-all"  onclick="rejectPOrequestByACD()" />
          </span>

            <span class="cont tooltip ui-corner-all" title="Click here to add an Item">
     <input type="button" value="Return PO"  id="Return" name="Return" class="btn ui-state-default ui-corner-all" onclick="returnPOrequestByACD()"/>
          </span>

            <?php
        }
        ?>


        <br/><br/>

        <?php

        $userService = new UserService();

        $isHODorACD = $userService->isHeadOfDepartmentOrAdministrativeDirector($this->session->userdata('emp_id'));

        if($isHODorACD){
            //  PO request Approve/Reject/Return Remarks will be shown only for the ACD or HOD user
            ?>

            <input id="status_change_remark_checkbox" name="status_change_remark_checkbox" type="checkbox" onclick="if(this.checked){status_change_remark_request('on')}else{ status_change_remark_request('off')} " />PO Request Moderation Remarks

            <div id="po_status_change_text">
                <?php //the required html element will be set using jquery ?>

            </div>

            <?php
        }
        ?>

        <div id="add_new_po_msg">
            <input type="hidden" id="required_fields" name="required_fields" value="false">
            <input type="hidden" id="po_request_id" name="po_request_id" value="<?php echo $PurchaseOrderID; ?>"  />
            <input type="hidden" id="expected_date_validity" name="expexted_date_validity" value="true"  />
            <input type="hidden" id="supplier_id" name="supplier_id" value="<?php echo $PurchaseOrderRequestObject->getSupplier_Code(); ?>" />


        </div>
        <div id="po_request_message">  </div>

    </td>
</tr>
</table>

<div id="addedItemTable">

</div>

</fieldset>
</form>
<?php //ordeer item add start ?>
<div id="dlg_add_item" title="Add Item to Purchase Order">
    <form name="add_purchase_order_item" id="add_purchase_order_item">
        <table style="width: 100%">
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Item Name *</b></td>
                <td style="padding: 5px 5px 5px 0;" colspan="5"><input type="text" id="po_item_name" class="field text full" name="po_item_name" onkeypress="get_po_item_name(this.value);" onchange="get_po_item_name(this.value);" onblur="get_po_item_name(this.value);"/></td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Unit *</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><!-- <input type="text" id="po_item_unit" class="field text full" name="txt_po_item_unit" /> -->
                    <select id="po_item_unit" class="field select full" name="po_item_unit">
                        <option value=""></option>
                        <?php
                        foreach ($UnitArray as $unitModel)
                        {
                            ?>
                            <option value="<?php echo $unitModel->getUnit_Code(); ?>"><?php echo $unitModel->getDescription(); ?></option>
                            <?php
                        }
                        ?>

                    </select></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Unit Price *</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="po_item_unit_price" class="field text full" name="po_item_unit_price" style="font-weight: bold;text-align: right;" onkeyup="calculate_item_value();" /></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Quantity *</b></td>
                <td style="padding: 5px 5px 5px 0;width: 18%"><input type="text" id="po_item_qty" class="field text full" name="po_item_qty" style="font-weight: bold;text-align: right;" onkeyup="calculate_item_value();" /></td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Discount %</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="discount_percentage" class="field text full" name="discount_percentage" style="text-align: right;" onkeyup="calculate_item_value();" onchange="validateDiscount()" /></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Discount Amount</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="discount_amount" class="field text full" name="discount_amount" style="text-align: right;" onkeyup="calculate_item_value();" onchange="validateDiscount()" /></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"></td>
                <td style="padding: 5px 5px 5px 0;width: 18%"></td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Individual Tax %</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="tax_percentage" class="field text full" name="tax_percentage" style="text-align: right;" onkeyup="calculate_item_value();" onchange="validateTax()"/></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Tax Value</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="tax_value" class="field text full" name="tax_value" style="text-align: right;" onkeyup="calculate_item_value();" onchange="validateTax()" /></td>
                <td style="padding: 5px 5px 5px 0;width: 16%;text-align: right;font-size: 15px;"><b>Item Value</b></td>
                <td style="padding: 5px 5px 5px 0;width: 18%;"><input type="text" readonly="readonly" id="po_item_val" class="field text full" name="txt_po_item_val" style="text-align: right;background-color: #99f099;font-size: 15px;font-weight: bold;" /></td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%;"><b>Description</b></td>
                <td style="padding: 5px 5px 5px 0;" colspan="5"><textarea id="po_description" class="field text full" name="po_description" rows="2"></textarea></td>
            </tr>
        </table>
        <input  name="purchase_order_id" id="purchase_order_id" type="text" value="" />
        <input type="text" name="item_id" id="item_id" />

        <!--      <button class="ui-state-default ui-corner-all float-left ui-button" type="button" onclick="add_items_to_po();">Add</button>-->
        <div id="addNewItemMessage" >

        </div>

        <button class="ui-state-default ui-corner-all float-left ui-button" type="submit" >Add</button>

    </form>
</div>
<?php //order item add ends ?>
<?php //order item edit start ?>
<div id="dlg_edit_item" title="Edit Item">
    <?php /*?> <form>
      <table style="width: 100%">
        <tr>
          <td style="padding: 5px 5px 5px 0;width: 16%"><b>Item Name *</b></td>
          <td style="padding: 5px 5px 5px 0;" colspan="5"><input type="hidden" id="ic2" name="txt_ic2"/>
            <input type="text" id="po_item_name2" class="field text full" name="txt_po_item_name2" readonly="readonly"/></td>
        </tr>
        <tr>
          <td style="padding: 5px 5px 5px 0;width: 16%"><b>Unit *</b></td>
          <td style="padding: 5px 5px 5px 0;width: 17%"><select id="po_item_unit2" class="field select full" name="cmb_po_item_unit2">
              <option value=""></option>
                              <?php
                                    foreach ($UnitArray as $unitModel)
                                    {
                                   ?>
            <option value="<?php echo $unitModel->getUnit_Code(); ?>"><?php echo $unitModel->getDescription(); ?></option>
            <?php
                                    }
                                ?>  
            </select></td>
          <td style="padding: 5px 5px 5px 0;width: 16%"><b>Unit Price *</b></td>
          <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="po_item_unit_price2" class="field text full" name="txt_po_item_unit_price2" style="font-weight: bold;text-align: right;" onkeyup="calculate_item_value();" /></td>
          <td style="padding: 5px 5px 5px 0;width: 16%"><b>Quantity *</b></td>
          <td style="padding: 5px 5px 5px 0;width: 18%"><input type="text" id="po_qty2" class="field text full" name="txt_po_qty2" style="font-weight: bold;text-align: right;" onkeyup="calculate_item_value();" /></td>
        </tr>
        <tr>
          <td style="padding: 5px 5px 5px 0;width: 16%"><b>Discount %</b></td>
          <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="po_disc_per2" class="field text full" name="txt_po_disc_per2" style="text-align: right;" onkeyup="calculate_item_value();" /></td>
          <td style="padding: 5px 5px 5px 0;width: 16%"><b>Discount Amount</b></td>
          <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="po_disc2" class="field text full" name="txt_po_disc2" style="text-align: right;" onkeyup="calculate_item_value();" /></td>
          <td style="padding: 5px 5px 5px 0;width: 16%"></td>
          <td style="padding: 5px 5px 5px 0;width: 18%"></td>
        </tr>
        <tr>
          <td style="padding: 5px 5px 5px 0;width: 16%"><b>Individual Tax %</b></td>
          <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="po_ind_tax2" class="field text full" name="txt_po_ind_tax2" style="text-align: right;" onkeyup="calculate_item_value();" /></td>
          <td style="padding: 5px 5px 5px 0;width: 16%"><b>Tax Value</b></td>
          <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="po_tax_val2" class="field text full" name="txt_po_tax_val2" style="text-align: right;" onkeyup="calculate_item_value();" /></td>
          <td style="padding: 5px 5px 5px 0;width: 16%;text-align: right;font-size: 15px;"><b>Item Value</b></td>
          <td style="padding: 5px 5px 5px 0;width: 18%;"><input type="text" readonly="readonly" id="po_item_value" class="field text full" name="po_item_value" style="text-align: right;background-color: #99f099;font-size: 15px;font-weight: bold;" /></td>
        </tr>
        <tr>
          <td style="padding: 5px 5px 5px 0;width: 16%;"><b>Description</b></td>
          <td style="padding: 5px 5px 5px 0;" colspan="5"><!-- <input type="text" id="po_desc" class="field text full" name="txt_po_desc" /> -->
            <textarea id="po_desc2" class="field text full" name="txt_po_desc2" rows="2"></textarea></td>
        </tr>
      </table>
      <button class="ui-state-default ui-corner-all float-left ui-button" type="button" onclick="edit_po_items();">Update</button>
    </form><?php */?>


    <!-- edit start -->

    <form name="update_purchase_order_item" id="update_purchase_order_item">
        <table style="width: 100%">
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Item Name *</b></td>
                <td style="padding: 5px 5px 5px 0;" colspan="5"><input type="text" id="edit_po_item_name" class="field text full" name="edit_po_item_name" onkeypress="get_po_item_name(this.value);" onchange="get_po_item_name(this.value);" onblur="get_po_item_name(this.value);" readonly="readonly"/></td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Unit *</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><!-- <input type="text" id="po_item_unit" class="field text full" name="txt_po_item_unit" /> -->
                    <select id="edit_po_item_unit" class="field select full" name="edit_po_item_unit">
                        <option value=""></option>
                        <?php
                        foreach ($UnitArray as $unitModel)
                        {
                            ?>
                            <option value="<?php echo $unitModel->getUnit_Code(); ?>"><?php echo $unitModel->getDescription(); ?></option>
                            <?php
                        }
                        ?>

                    </select></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Unit Price *</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="edit_po_item_unit_price" class="field text full" name="edit_po_item_unit_price" style="font-weight: bold;text-align: right;" onkeyup="calculate_item_value_for_edit();" /></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Quantity *</b></td>
                <td style="padding: 5px 5px 5px 0;width: 18%"><input type="text" id="edit_po_item_qty" class="field text full" name="edit_po_item_qty" style="font-weight: bold;text-align: right;" onkeyup="calculate_item_value_for_edit();" /></td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Discount %</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="edit_discount_percentage" class="field text full" name="edit_discount_percentage" style="text-align: right;" onkeyup="calculate_item_value_for_edit();" onchange="validateEditDiscount()" /></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Discount Amount</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="edit_discount_amount" class="field text full" name="edit_discount_amount" style="text-align: right;" onkeyup="calculate_item_value_for_edit();" onchange="validateEditDiscount()" /></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"></td>
                <td style="padding: 5px 5px 5px 0;width: 18%"></td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Individual Tax %</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="edit_tax_percentage" class="field text full" name="edit_tax_percentage" style="text-align: right;" onkeyup="calculate_item_value_for_edit();" onchange="validateEditTax()"/></td>
                <td style="padding: 5px 5px 5px 0;width: 16%"><b>Tax Value</b></td>
                <td style="padding: 5px 5px 5px 0;width: 17%"><input type="text" id="edit_tax_value" class="field text full" name="edit_tax_value" style="text-align: right;" onkeyup="calculate_item_value_for_edit();" onchange="validateEditTax()" /></td>
                <td style="padding: 5px 5px 5px 0;width: 16%;text-align: right;font-size: 15px;"><b>Item Value</b></td>
                <td style="padding: 5px 5px 5px 0;width: 18%;"><input type="text" readonly="readonly" id="edit_po_item_val" class="field text full" name="edit_po_item_val" style="text-align: right;background-color: #99f099;font-size: 15px;font-weight: bold;" /></td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 0;width: 16%;"><b>Description</b></td>
                <td style="padding: 5px 5px 5px 0;" colspan="5"><textarea id="edit_po_description" class="field text full" name="edit_po_description" rows="2"></textarea></td>
            </tr>
        </table>

        <?php /*?> updating item<?php */?> <input type="hidden" name="updating_item_id" id="updating_item_id" />
        <?php /*?>     purchase order<?php */?> <input type="hidden" name="updating_po_id" id="updating_po_id" />

        <!--      <button class="ui-state-default ui-corner-all float-left ui-button" type="button" onclick="add_items_to_po();">Add</button>-->
        <div id="editItemMessage" >

        </div>

        <button class="ui-state-default ui-corner-all float-left ui-button" type="submit" >Update</button>

    </form>




    <!--edit ends -->


</div>
</div>
<?php //order item edit ends ?>
</div>
