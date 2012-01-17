<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PurchaseOrderManagement extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array('PurchaseOrder/DepartmentModel','PurchaseOrder/DepartmentService','PurchaseOrder/CurrencyModel','PurchaseOrder/CurrencyService','PurchaseOrder/PaymentTypeModel','PurchaseOrder/PaymentTypeService','PurchaseOrder/PurchaseOrderRequestModel','PurchaseOrder/PurchaseOrderRequestService','PurchaseOrder/UnitModelService','PurchaseOrder/PurchaseOrderItemModel','PurchaseOrder/PurchaseOrderItemService','ItemMaster/ItemMasterModel','ItemMaster/ItemMasterService','Supplier/SupplierModel','Supplier/SupplierService','UserModel','UserService','PurchaseOrder/PurchaseOrderModerateStatus'));

        if(!$this->session->userdata('logged_in'))
        {
            redirect(base_url() . 'index.php/login');
        }
    }//construct



    function createNewPurchaseOrder()
    {


        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(5);//priviledge 5 is for creating purchase order requests

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //retrieveing department details
                $departmentModel = new DepartmentModel();
                $departmentService = new DepartmentService();

                $departmentModel->setDepartmentCode($this->session->userdata('department'));
                $departmentName=$departmentService->retrieveDepartmentName($departmentModel);


                //retrieving currency details
                $currencyService = new CurrencyService();
                $currencyObjectArray = $currencyService->retriveAllCurrencyDetails();


                //retrieving payment type details
                $paymentTypeService = new PaymentTypeService();
                $paymentTypeObjectArray = $paymentTypeService->retriveAllPaymentTypes();


                $unitService = new UnitModelService();

                $unitModelObjArr = $unitService->retrieveAllUnitDetails();

                //setting up the data array
                $data=array('departmentName'=>$departmentName,'currencyObjectArray'=>$currencyObjectArray,'paymentTypeObjectArray'=>$paymentTypeObjectArray,'UnitArray'=>$unitModelObjArr);


                $this->template->setTitles('LankaCom Inventory Management System', 'Subsidiry of Singapoor Telecom', 'Create New Purchase Order', 'Please Fill All The Mandatory Fields...');

                $this->template->load('template', 'PurchaseOrder/AddNewPurchaseOrderView',$data);

            }
            else{

                // "user doesnt have the priviledges";

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if
        else{


            redirect(base_url().'index.php');


        }




    }//createNewPurchaseOrder












    // the below function is used to retrive the currency conversion rate based on the ajax request made by the purchase order request form

    function retriveCurrrencyConversionRate(){



        //echo "retriveCurrrencyConversionRate";
        $this->input->post('currencyCode', TRUE);

        $currencyCode=$this->input->post('currencyCode', TRUE);



        $currencyService = new CurrencyService();

        $currencyModel = new CurrencyModel();



        $currencyModel->setCurrency_Code($currencyCode);


        $currencyModelRetrieved = $currencyService->retriveSelectedCurrencyDetails($currencyModel);


        //sending the conversion rate as ajax response to the browser
        echo $currencyModelRetrieved->getConversion_Rate();



    }//function








    function createNewPurchaseOrderRequest(){



        //echo "inserting/updating po request data ";

        //PurchaseOrderRequestModel


        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(5);//priviledge 5 is for creating purchase order requests

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //echo "user has the priviledges";


                $poRequest = new PurchaseOrderRequestModel();

                $poService = new PurchaseOrderRequestService();

                //setting the values start

                $user_id = $this->session->userdata('emp_id');


                //getting the purchase order id
                $purchase_order_id = $this->input->post('po_request_id',TRUE);

                $poRequest->setSupplier_Code($this->input->post('supplier_id',TRUE));
                $poRequest->setOrder_Date($this->input->post('order_date',TRUE));
                //$poRequest->setExpected_Date($this->input->post('expected_date',TRUE));
                $poRequest->setQuote_No($this->input->post('quatation_no',TRUE));
                $poRequest->setAttn($this->input->post('attention',TRUE));
                $poRequest->setRequested_Dept($this->input->post('Department_Code',TRUE));
                $poRequest->setRequested_By($this->input->post('requested_by',TRUE));
                $poRequest->setCurrency_Code($this->input->post('currrency_selector',TRUE));
                $poRequest->setCurrency_Rate($this->input->post('conversion_rate',TRUE));
                $poRequest->setPayment_Type_Code($this->input->post('payment_type',TRUE));
                $poRequest->setPO_Purpose($this->input->post('po_purpose',TRUE));
                $poRequest->setPO_Remarks($this->input->post('po_remarks',TRUE));
                $poRequest->setPO_Payment_Remarks($this->input->post('pay_remark',TRUE));
                $poRequest->setPrint_Original(0);


                //setting the values end


                if($purchase_order_id==""){

                    $userService = new UserService();

                    //these fields should be updated when creating new PO request
                    if($userService->isHeadOfDepartment($user_id)){
                        //if the creating user is Head of Depoartment, it will be updated to status 2
                        $poRequest->setStatus_Code(2);
                    }
                    else{
                        $poRequest->setStatus_Code(1);
                    }

                    $poRequest->setStatus_Code(2);
                    $poRequest->setCreated_By($user_id);

                    //purchase order is not in dabase and it should be inserted
                    $purchaseOrderID = $poService->createNewPurchaseOrder($poRequest);

                    echo "Purchase Order was succesfully Created.. #".$purchaseOrderID;

                }
                else{

                    $poRequest->setOrder_Code($purchase_order_id);

                    //retrieving the previous data
                    $poReqModel = $poService->getPurchaseOrderDetailsForGivenOrderCode($poRequest);
                    //saving the same status code
                    $poRequest->setStatus_Code($poReqModel->getStatus_Code());
                    //saving the same created by user
                    $poRequest->setCreated_By($poReqModel->getCreated_By());


                    //purchase order already exists and it should be updated
                    $poService->updatePurchaseOrder($poRequest);
                    echo "Purchase Order was succesfully Saved..#".$purchase_order_id;


                }

            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if
        else{


            redirect(base_url().'index.php');


        }


    }//function








    function addItemsToPurchaseOrder(){

        //check the priviledges

        $poItemService = new PurchaseOrderItemService();
        $poItemModel =new PurchaseOrderItemModel();


        $discountVal = $this->input->post('discount_amount',TRUE);
        $discountPercentage = $this->input->post('discount_percentage',TRUE);

        $taxVal = $this->input->post('tax_value',TRUE);
        $taxPercentage = $this->input->post('tax_percentage',TRUE);

        if($discountVal==""){

            $discountVal = 0;

        }


        if($discountPercentage==""){

            $discountPercentage = 0.0;

        }


        if($taxVal==""){

            $taxVal = 0;

        }


        if($taxPercentage==""){

            $taxPercentage = 0.0;

        }


        $poItemModel->setOrder_Code($this->input->post('purchase_order_id',TRUE));
        $poItemModel->setMaster_Item_Code($this->input->post('item_id',TRUE));
        $poItemModel->setUnit($this->input->post('po_item_unit',TRUE));
        $poItemModel->setUnit_Price($this->input->post('po_item_unit_price',TRUE));
        $poItemModel->setQuantity($this->input->post('po_item_qty',TRUE));
        $poItemModel->setDiscount($discountPercentage);
        $poItemModel->setDiscount_Value($discountVal);
        $poItemModel->setItem_Value($this->input->post('po_item_value',TRUE));
        $poItemModel->setInd_Tax($taxPercentage);
        $poItemModel->setTax_Value($taxVal);
        $poItemModel->setDescription($this->input->post('po_description',TRUE));
        $poItemModel->setItem_added_by($this->session->userdata('emp_id'));

        /*
         $poItemModel->setOrder_Code($this->input->post('purchase_order_id',TRUE));
         $poItemModel->setMaster_Item_Code($this->input->post('item_id',TRUE));
         $poItemModel->setUnit($this->input->post('po_item_unit',TRUE));
         $poItemModel->setUnit_Price($this->input->post('po_item_unit_price',TRUE));
         $poItemModel->setQuantity($this->input->post('po_item_qty',TRUE));
         $poItemModel->setDiscount($this->input->post('discount_percentage',TRUE));
         $poItemModel->setDiscount_Value($this->input->post('discount_amount',TRUE));
         $poItemModel->setItem_Value($this->input->post('po_item_value',TRUE));
         $poItemModel->setInd_Tax($this->input->post('tax_percentage',TRUE));
         $poItemModel->setTax_Value($this->input->post('tax_value',TRUE));
         $poItemModel->setDescription($this->input->post('po_description',TRUE));
         $poItemModel->setItem_added_by($this->session->userdata('emp_id'));
        */

        $insertID = $poItemService->addNewItemForPurchaseOrder($poItemModel);

        $message="";

        if($insertID==1){

            $message= '<div class="response-msg success ui-corner-all"><span> Item Added</span>New Item was succesfully added for the purchase order </div>';

        }
        else{

            $message= '<div class="response-msg error ui-corner-all"><span> Item exists</span>the item is already included in the purchase order request</div>';

        }

        $purchaseOrderID = $this->input->post('purchase_order_id',TRUE);

        $poItemTableView = $this->loadItemTable($purchaseOrderID);

        echo $message.'#######----#######'.$poItemTableView;


    }//function






    /*
       function loadItemTable($poID){


                //$pono = trim($_POST['pono']);
                $pono=$poID;

                $poItemModel = new PurchaseOrderItemModel();
                $poItemService = new PurchaseOrderItemService();

                $poItemModel->setOrder_Code($pono);

                $poItemModelArray = $poItemService->getAddedItemForGivenPurchaseOrderRequest($poItemModel);

                if(!empty($poItemModelArray))
                {
                    echo '<table width="100%">';
                    echo '<tr style="background-color: #CDB79E;height: 25px;margine: 5px;" valign="middle">';
                    //echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Item Code</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Item Description</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Quantity</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Unit</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Price</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Item Value</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Discount %</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Discount Value</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Ind Tax %</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Ind Tax Value</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Net Value</th>';
                    echo '<th style="padding: 5px 5px 5px 0;font-weight:bold;">Action</th>';
                    echo '</tr>';

                    $i = 1;

                   // foreach ($result->result_array() as $row)
                   for($index=0;$index<sizeof($poItemModelArray);$index++)
                    {
                       // $iv = ((floatval($row['Unit_Price']) - (floatval($row['Unit_Price']) * floatval($row['Discount']) / 100) + (floatval(floatval($row['Unit_Price']) - (floatval($row['Unit_Price']) * floatval($row['Discount']) / 100)) * floatval($row['Ind_Tax']) / 100)) * floatval($row['Quantity'])) - floatval($row['Discount_Value']) + floatval($row['Tax_Value']);
                      $iv =100;

                        $i = 1 - $i;

                        if($i == 0)
                        {
                            echo '<tr style="background-color: #FFFFFF;">';
                        }
                        else
                        {
                            echo '<tr style="background-color: #F5F5DC;">';
                        }

                        //echo '<td style="padding: 5px 5px 5px 0;">' . $row['Master_Item_Code'] . '</td>';
                        echo '<td style="padding: 5px 5px 5px 0;">Item name</td>';
                        echo '<td style="padding: 5px 5px 5px 0;">' . $poItemModelArray[$index]->getQuantity(). '</td>';
                        echo '<td style="padding: 5px 5px 5px 0;"> Description </td>';
                      echo '<td style="padding: 5px 5px 5px 0;">' . $poItemModelArray[$index]->getUnit_Price(). '</td>';
                       echo '<td style="padding: 5px 5px 5px 0;">' .$poItemModelArray[$index]->getItem_Value(). '</td>';
                        echo '<td style="padding: 5px 5px 5px 0;">' .$poItemModelArray[$index]->getDiscount(). '</td>';
                   echo '<td style="padding: 5px 5px 5px 0;">' .$poItemModelArray[$index]->getDiscount_Value(). '</td>';
                        echo '<td style="padding: 5px 5px 5px 0;">' . $poItemModelArray[$index]->getInd_Tax(). '</td>';
                        echo '<td style="padding: 5px 5px 5px 0;">' .$poItemModelArray[$index]->getTax_Value(). '</td>';
                        echo '<td style="padding: 5px 5px 5px 0;">' . $iv . '<input type="hidden" id="net_val_' . $poItemModelArray[$index]->getMaster_Item_Code(). '" name="txt_net_val_' . $poItemModelArray[$index]->getMaster_Item_Code(). '" value="' . $iv . '"/></td>';
                        echo '<td style="padding: 5px 5px 5px 0;">

                                <a class="lnk_edit_item" href="#" title="Edit Item" onclick="load_item_to_edit(' . $poItemModelArray[$index]->getMaster_Item_Code(). ');">
                                    <img src="' . base_url() . 'resources/images/edit_item.png" alt="Edit Item"/>
                                </a>

                                <a class="lnk_delete_item" href="#" onclick="delete_po_items(' .$poItemModelArray[$index]->getMaster_Item_Code(). ');" title="Delete Item">
                                    <img src="' . base_url() . 'resources/images/delete_item.png" alt="Delete"/>
                                </a>

                                <a class="lnk_read_more" href="#" title="Read More">
                                    <img src="' . base_url() . 'resources/images/read_more.png" alt="Read More"/>
                                </a>
                            </td>';
                        echo '</tr>';
                    }//for

                    echo '</table>';
                }//if






       }//loadItemTable

    */



    function loadItemTable($poID){

        ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>template_resources/js/custom.js"></script>
    <?php

        $resultTbl="";
        //$pono = trim($_POST['pono']);
        $pono=$poID;

        $poItemModel = new PurchaseOrderItemModel();
        $poItemService = new PurchaseOrderItemService();

        $poItemModel->setOrder_Code($pono);

        $poItemModelArray = $poItemService->getAddedItemForGivenPurchaseOrderRequest($poItemModel);

        if(!empty($poItemModelArray))
        {
            $resultTbl= $resultTbl.'<table width="100%">';
            $resultTbl= $resultTbl.'<tr style="background-color: #CDB79E;height: 25px;margine: 5px;" valign="middle">';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Item Name</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Quantity</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Unit</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Price</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Item Value</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Discount %</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Discount Value</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Ind Tax %</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Ind Tax Value</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Net Value</th>';
            $resultTbl= $resultTbl.'<th style="padding: 5px 5px 5px 0;font-weight:bold;">Action</th>';
            $resultTbl= $resultTbl.'</tr>';

            $i = 1;
            $totalValue=0;

            // foreach ($result->result_array() as $row)
            for($index=0;$index<sizeof($poItemModelArray);$index++)
            {
                // $iv = ((floatval($row['Unit_Price']) - (floatval($row['Unit_Price']) * floatval($row['Discount']) / 100) + (floatval(floatval($row['Unit_Price']) - (floatval($row['Unit_Price']) * floatval($row['Discount']) / 100)) * floatval($row['Ind_Tax']) / 100)) * floatval($row['Quantity'])) - floatval($row['Discount_Value']) + floatval($row['Tax_Value']);

                //retrieve Item name
                $itemMasterModel =  new ItemMasterModel();
                $itemMasterModel->setMaster_Item_Code($poItemModelArray[$index]->getMaster_Item_Code());

                $itemMasterService = new ItemMasterService();
                $itemMasterModelRetrieved = $itemMasterService->retrieveItemDetails($itemMasterModel);

                //retieve unit details
                $unitService = new UnitModelService();
                $unitService->setUnit_Code($poItemModelArray[$index]->getUnit());

                $unitRetrieved = $unitService->retrieveUnitDetails($unitService);
                $unitDescription = $unitRetrieved->getDescription();


                $unitPrice=$poItemModelArray[$index]->getUnit_Price();
                $discount=$poItemModelArray[$index]->getDiscount();
                $discountVal=$poItemModelArray[$index]->getDiscount_Value();
                $indTax= $poItemModelArray[$index]->getInd_Tax();
                $taxVal=$poItemModelArray[$index]->getTax_Value();
                $quantity=$poItemModelArray[$index]->getQuantity();

                $iv = ((($unitPrice) - (floatval($unitPrice) * floatval($discount) / 100) + (floatval(floatval($unitPrice) - (floatval($unitPrice) * floatval($discount) / 100)) * floatval($indTax) / 100)) * floatval($quantity)) - floatval($discountVal) + floatval($taxVal);

                $i = 1 - $i;

                if($i == 0)
                {
                    $resultTbl= $resultTbl.'<tr style="background-color: #FFFFFF;">';
                }
                else
                {
                    $resultTbl= $resultTbl.'<tr style="background-color: #F5F5DC;">';
                }

                //echo '<td style="padding: 5px 5px 5px 0;">' . $row['Master_Item_Code'] . '</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">'.substr($itemMasterModelRetrieved->getItem_Name(),0,25).'</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">' . $poItemModelArray[$index]->getQuantity(). '</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;"> '.$unitDescription.' </td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">' . $poItemModelArray[$index]->getUnit_Price(). '</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">' .$poItemModelArray[$index]->getItem_Value(). '</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">' .$poItemModelArray[$index]->getDiscount(). '</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">' .$poItemModelArray[$index]->getDiscount_Value(). '</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">' . $poItemModelArray[$index]->getInd_Tax(). '</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">' .$poItemModelArray[$index]->getTax_Value(). '</td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">' . $iv . '<input type="hidden" id="net_val_' . $poItemModelArray[$index]->getMaster_Item_Code(). '" name="txt_net_val_' . $poItemModelArray[$index]->getMaster_Item_Code(). '" value="' . $iv . '"/></td>';
                $resultTbl= $resultTbl.'<td style="padding: 5px 5px 5px 0;">

                            <a  class="lnk_update_item" href="#" onclick="load_item_details_for_edit(' .$poItemModelArray[$index]->getMaster_Item_Code(). ','.$poItemModelArray[$index]->getOrder_Code().')">
                              <img src="' . base_url() . 'template_resources/images/edit_item.png" alt="Edit Item"/>
                            </a> &nbsp;&nbsp;

                            <a class="lnk_delete_item" href="#" onclick="delete_po_items(' .$poItemModelArray[$index]->getMaster_Item_Code(). ','.$pono.');" title="Delete Item">
                                <img src="' . base_url() . 'template_resources/images/delete_item.png" alt="Delete"/>
                            </a>
                            
                        </td>';
                $resultTbl= $resultTbl.'</tr>';
                $totalValue = $totalValue + $iv;
            }//for


            $resultTbl= $resultTbl.'<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>Total</b></td><td><b>'.$totalValue.'</b></td><tr/>';
            $resultTbl= $resultTbl.'</table>';
        }//if

        return  $resultTbl;




    }//loadItemTable




    function displayAddedItemsForPurchaseOrder($po_request_id){

        echo $this->loadItemTable($po_request_id);

    }//function








    function editItemsInPurchaseOrder(){

        //check the priviledges

        $poItemService = new PurchaseOrderItemService();
        $poItemModel =new PurchaseOrderItemModel();

        //	$poOldItemModel =new PurchaseOrderItemModel();


        $discountVal = $this->input->post('edit_discount_amount',TRUE);
        $discountPercentage = $this->input->post('edit_discount_percentage',TRUE);

        $taxVal = $this->input->post('edit_tax_value',TRUE);
        $taxPercentage = $this->input->post('edit_tax_percentage',TRUE);

        if($discountVal==""){

            $discountVal = 0;

        }


        if($discountPercentage==""){

            $discountPercentage = 0.0;

        }


        if($taxVal==""){

            $taxVal = 0;

        }


        if($taxPercentage==""){

            $taxPercentage = 0.0;

        }


        //$previousItemID = $this->input->post('previous_item_id',TRUE);

        $poItemModel->setOrder_Code($this->input->post('updating_po_id',TRUE));
        $poItemModel->setMaster_Item_Code($this->input->post('updating_item_id',TRUE));
        $poItemModel->setUnit($this->input->post('edit_po_item_unit',TRUE));
        $poItemModel->setUnit_Price($this->input->post('edit_po_item_unit_price',TRUE));
        $poItemModel->setQuantity($this->input->post('edit_po_item_qty',TRUE));
        $poItemModel->setDiscount($discountPercentage);
        $poItemModel->setDiscount_Value($discountVal);
        // $poItemModel->setItem_Value($this->input->post('edit_po_item_value',TRUE));
        $poItemModel->setInd_Tax($taxPercentage);
        $poItemModel->setTax_Value($taxVal);
        $poItemModel->setDescription($this->input->post('edit_po_description',TRUE));
        $poItemModel->setItem_added_by($this->session->userdata('emp_id'));


        //setting up the old PO Item data moderl
        /* $poOldItemModel->setMaster_Item_Code($previousItemID);
        $poOldItemModel->setOrder_Code($this->input->post('updating_po_id',TRUE));*/

        // echo "updated 123";

        $poItemService->updateItemInPurchaseOrder($poItemModel);

        /*
         $insertID = $poItemService->addNewItemForPurchaseOrder($poItemModel);

            $message="";

            if($insertID==1){

            $message= '<div class="response-msg success ui-corner-all"><span> Item Added</span>New Item was succesfully added for the purchase order </div>';

            }
            else{

            $message= '<div class="response-msg error ui-corner-all"><span> Item exists</span>the item is already included in the purchase order request</div>';

            }
        */

        $message= '<div class="response-msg success ui-corner-all"><span> Item Updated</span>Item was succesfully updated for the purchase order </div>';

        $purchaseOrderID = $this->input->post('updating_po_id',TRUE);

        $poItemTableView = $this->loadItemTable($purchaseOrderID);

        echo $message.'#######----#######'.$poItemTableView;


    }//function






    function retrivePurchaseOrderItemDetails(){


        //echo "retriveItemDetails".$this->input->post('itemID',TRUE);

        $poItemModel = new PurchaseOrderItemModel();
        $poItemModel->setOrder_Code($this->input->post('purchaseOrderID',TRUE));
        $poItemModel->setMaster_Item_Code($this->input->post('itemID',TRUE));

        $poItemService = new PurchaseOrderItemService();
        $poItemModelRetrieved = $poItemService->retrieveSelectedPurchaseOrderItemDetails($poItemModel);

        $arr = (array) $poItemModelRetrieved;

        $itemMasterModel =  new ItemMasterModel();
        $itemMasterModel->setMaster_Item_Code($poItemModelRetrieved->getMaster_Item_Code());

        $itemMasterService = new ItemMasterService();
        $itemMasterModelRetrieved = $itemMasterService->retrieveItemDetails($itemMasterModel);

        // echo "retrived datab ".print_r($arr);

        // echo "item name ".$itemMasterModelRetrieved->getItem_Name();

        $data = $itemMasterModelRetrieved->getItem_Name();
        $data = $data."####".$poItemModelRetrieved->getUnit()."####".$poItemModelRetrieved->getUnit_Price()."####".$poItemModelRetrieved->getQuantity()."####".$poItemModelRetrieved->getDiscount()."####".$poItemModelRetrieved->getDiscount_Value()."####".$poItemModelRetrieved->getInd_Tax()."####".$poItemModelRetrieved->getTax_Value()."####".$poItemModelRetrieved->getDescription();

        echo $data;

    }//retriveItemDetails









    function viewListOfPurchaseOrders(){


        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(5);//priviledge 5 is for creating purchase order requests

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                $employeeID = $this->session->userdata('emp_id');

                // echo "user has the priviledges";

                $poReqModel = new PurchaseOrderRequestModel();


                $poReqModel->setCreated_By($employeeID);

                $poReqService = new PurchaseOrderRequestService();

                //  $purchaseOrders = $poReqService->getPurchaseOrderDetailsPlacedByGivenUser($poReqModel);
                $purchaseOrders = $poReqService->getNewAndReturnPurchaseOrderDetailsPlacedByGivenUser($poReqModel);

                //setting up the data array
                $data = array('PurchaseOrders'=>$purchaseOrders);

                $this->template->setTitles('LankaCom Inventory Management System', 'Subsidiary of Singapore Telecom', 'Purchase Orders', 'Your List of Purchase Orders...');

                $this->template->load('template', 'PurchaseOrder/viewPurchaseOrdersList',$data);
                //$this->template->load('template', 'PurchaseOrder/viewPurchaseOrdersList');



            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if
        else{


            redirect(base_url().'index.php');


        }


    }//function






    function editPurchaseOrderView($purchaseOrderCode){


        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(5);//priviledge 5 is for creating purchase order request

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                $employeeID = $this->session->userdata('emp_id');

                // echo "user has the priviledges";

                //start

                //retrieveing department details
                $departmentModel = new DepartmentModel();
                $departmentService = new DepartmentService();

                $departmentModel->setDepartmentCode($this->session->userdata('department'));
                $departmentName=$departmentService->retrieveDepartmentName($departmentModel);


                //retrieving currency details
                $currencyService = new CurrencyService();
                $currencyObjectArray = $currencyService->retriveAllCurrencyDetails();


                //retrieving payment type details
                $paymentTypeService = new PaymentTypeService();
                $paymentTypeObjectArray = $paymentTypeService->retriveAllPaymentTypes();


                $unitService = new UnitModelService();

                $unitModelObjArr = $unitService->retrieveAllUnitDetails();
                //retrieving all details related to the purchase order request

                $poReqService = new PurchaseOrderRequestService();

                $poModel = new PurchaseOrderRequestModel();

                $poModel->setOrder_Code($purchaseOrderCode);
                $poModel->setCreated_By( $employeeID);

                //retrieve the given purchase order if it is placed by this particular user
                $poModelRetrieved = $poReqService->getPurchaseOrderDetailsForGivenOrderID($poModel);

                if($poModelRetrieved!=NULL){

                    //Purchase Order Request found with the given ID and it is placed by the currently logged user

                    //supplier type retrieving
                    $supplierModelObject = new SupplierModel();

                    $supplierModelObject->setSupplier_Code($poModelRetrieved->getSupplier_Code());
                    $supService = new SupplierService();
                    $supModRetrieved = $supService->getGivenSupplierDetails($supplierModelObject);

                    //setting up the data array
                    $data=array('departmentName'=>$departmentName,'currencyObjectArray'=>$currencyObjectArray,'paymentTypeObjectArray'=>$paymentTypeObjectArray,'UnitArray'=>$unitModelObjArr,'PurchaseOrderID'=>$purchaseOrderCode,'PurchaseOrderRequestObject'=>$poModelRetrieved,'SupplierType'=>$supModRetrieved->getSupplier_Type());

                    //end
                    $userService = new UserService();
                    $user_id = $this->session->userdata('emp_id');

                    $this->template->setTitles('', '', 'Edit Purchase Order', '');

                    //employee can edit only the purchase order requests that are in new state (save state) or returned by the HOD
                    if($poModelRetrieved->getStatus_Code()=='1' || $poModelRetrieved->getStatus_Code()=='5'){

                        $this->template->load('template', 'PurchaseOrder/EditPurchaseOrderView',$data);

                    }
                    //Department Head Can Edit the PO request (status 2 requets) that are sent for his Approval
                    else if($userService->isHeadOfDepartment($user_id) && $poModelRetrieved->getStatus_Code()=='2'){

                        $this->template->load('template', 'PurchaseOrder/EditPurchaseOrderView',$data);

                    }
                    else{


                        redirect(base_url()."index.php/PurchaseOrder/PurchaseOrderManagement/viewListOfPurchaseOrders");

                    }//else


                }//purchase order request was found for given id
                else{

                    //purchase order requst not found for the given id. therefore the error mesaage is displayed

                    $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                    $this->template->load('template', 'errorPage');


                }

            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if
        else{


            redirect(base_url().'index.php');


        }


    }//editPurchaseOrderView








    function sendForHODapproval(){

        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(5);//priviledge 5 is for creating purchase order request

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){


                $poRequestID = $this->input->post('PO_Request_ID',TRUE);

                $poRequestModel = new PurchaseOrderRequestModel();

                $poRequestService = new PurchaseOrderRequestService();

                $poRequestModel->setOrder_Code($poRequestID);
                $poRequestModel->setStatus_Code(2);
                // $poRequestModel->setRequested_Dept($this->session->userdata('department'));


                $num_of_po_items = $poRequestService->getNumberOfItemsInPurchaseOrderRequest($poRequestModel);

                if($num_of_po_items>0){
                    //if there are items in the purchase order
                    $poRequestService->updatePurchaseOrderRequest($poRequestModel);

                    echo '<div class="response-msg success ui-corner-all">Purchase Order Request was succesfully sent for the HOD Approval</div>#######----#######success';
                }
                else{

                    echo '<div class="response-msg error ui-corner-all">Purchase Order Request should contains at least one item before sending for sending HOD Approval</div>#######----#######error';

                }

            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if
        else{


            redirect(base_url().'index.php');


        }


    }//sendForHODapproval






    function removePurchaseOrderItem(){


        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(6);//priviledge 6 is for removing po items from the po request

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                $employeeID = $this->session->userdata('emp_id');

                //po_item_id
                $po_item_id=$this->input->post('po_item_id');

                //po_request_id
                $po_request_id = $this->input->post('po_request_id');

                // echo "user has the priviledges";
                //  echo 'deleting item id '.$po_item_id.' and po request id '.$po_request_id;

                $poItemModel = new PurchaseOrderItemModel();
                $poItemService = new PurchaseOrderItemService();

                $poItemModel->setOrder_Code($po_request_id);
                $poItemModel->setMaster_Item_Code($po_item_id);

                $poItemService->deletePurchaseOrderItem($poItemModel);

                $message= '<div class="response-msg success ui-corner-all"><span> Item Deleted</span>Item was succesfully deleted from the purchase order request </div>';

                $poItemTableView = $this->loadItemTable($po_request_id);

                echo $message.'#######----#######'.$poItemTableView;



            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }


    }//removePurchaseOrderItem





    function viewDepartmentPOrequests(){

        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(11);/* priviledge 11 is for viewing a list of PO requests placed by the department users */


            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //echo "user has the priviledges to check PO requests";


                $deparmentID = $this->session->userdata('department');

                // echo "user has the priviledges";

                $poReqModel = new PurchaseOrderRequestModel();


                $poReqModel->setRequested_Dept($deparmentID);
                $poReqModel->setStatus_Code(2); // retrieve the PO requests sent by the employees
                $poReqService = new PurchaseOrderRequestService();

                // $purchaseOrders = $poReqService->getPurchaseOrderRequestDetailsForGivenDepartment($poReqModel);
                $purchaseOrders = $poReqService->getHODModeratablePurchaseOrderRequestDetailsForGivenDepartment($poReqModel);

                //setting up the data array
                $data = array('PurchaseOrders'=>$purchaseOrders);

                $this->template->setTitles('LankaCom Inventory Management System', 'Subsidiry of Singapoor Telecom', 'Purchase Order requests', 'List of Purchase Order Request for giving approval...');

                $this->template->load('template', 'PurchaseOrder/viewDepartmentPurchaseOrdersList',$data);
                //$this->template->load('template', 'PurchaseOrder/viewPurchaseOrdersList');




            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";
                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }

    }//viewDepartmentPOrequests











    function approvePurchaseOrderbyHOD($po_request_id){


        if($this->session->userdata('logged_in'))
        {

            $userPriviledgeModel=new UserPriviledge();
            //check whether the user has the HOD priviledges
            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode($this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(7);//priviledge 7 is to approve the PO request by the HOD

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //HOD has the priviledges to approve the PO request
                //echo "approve PO ".$;


                $poRequestModel = new PurchaseOrderRequestModel();

                $poRequestService = new PurchaseOrderRequestService();

                $poRequestModel->setOrder_Code($po_request_id);
                $poRequestModel->setStatus_Code(4);//status 4 - PO approved by HOD
                $poRequestModel->setRequested_Dept($this->session->userdata('department'));

                $poModStatus = new PurchaseOrderModerateStatus();

                $status_change_remark=$this->input->post('status_change_remark',TRUE);

                $poModStatus->setOrder_Code($po_request_id);
                $poModStatus->setStatus_Code(4);
                $poModStatus->setEmployee_Code($this->session->userdata('emp_id'));
                $poModStatus->setComments($status_change_remark);

                $poRequestService->insertPurchaseOrderUpdatedStatus($poModStatus);

                $isUpdated = $poRequestService->updatePurchaseOrderRequestByHOD($poRequestModel);

                if($isUpdated){

                    echo '<div class="response-msg success ui-corner-all">Purchase Order Request was successfully approved and forwarded to the Administrative director</div>#######success';

                }
                else{

                    echo '<div class="response-msg error ui-corner-all">You are not Authorized to Approve this Purchase Order request</div>#######error';

                }


            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";
                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');



            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }


    }//approvePurchaseOrderbyHOD









    function approvePurchaseOrderbyACD($po_request_id){


        if($this->session->userdata('logged_in'))
        {

            $userPriviledgeModel=new UserPriviledge();
            //check whether the user has the HOD priviledges
            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode($this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(8);//priviledge 8 is to approve the PO request by the ACD

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //ACD has the priviledges to approve the PO request

                $poRequestModel = new PurchaseOrderRequestModel();

                $poRequestService = new PurchaseOrderRequestService();

                $poRequestModel->setOrder_Code($po_request_id);
                $poRequestModel->setStatus_Code(6);//status 6 - PO approved by ACD

                $poModStatus = new PurchaseOrderModerateStatus();

                $status_change_remark=$this->input->post('status_change_remark',TRUE);

                $poModStatus->setOrder_Code($po_request_id);
                $poModStatus->setStatus_Code(6);
                $poModStatus->setEmployee_Code($this->session->userdata('emp_id'));
                $poModStatus->setComments($status_change_remark);

                $poRequestService->insertPurchaseOrderUpdatedStatus($poModStatus);

                $poRequestService->updatePurchaseOrderRequest($poRequestModel);



                echo '<div class="response-msg success ui-corner-all">Purchase Order Request was successfully approved by the Administrative Director</div>#######success';



            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";
                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');



            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }


    }//approvePurchaseOrderbyACD









    function rejectPurchaseOrderbyHOD($po_request_id){


        if($this->session->userdata('logged_in'))
        {

            $userPriviledgeModel=new UserPriviledge();
            //check whether the user has the HOD priviledges
            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode($this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(10);//priviledge 10 is to reject the PO request by the HOD

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //HOD has the priviledges to approve the PO request
                //echo "approve PO ".$;

                $poRequestModel = new PurchaseOrderRequestModel();

                $poRequestService = new PurchaseOrderRequestService();

                $poRequestModel->setOrder_Code($po_request_id);
                $poRequestModel->setStatus_Code(3);//status 3 - PO Rejected by HOD
                $poRequestModel->setRequested_Dept($this->session->userdata('department'));

                $poModStatus = new PurchaseOrderModerateStatus();

                $status_change_remark=$this->input->post('status_change_remark',TRUE);

                $poModStatus->setOrder_Code($po_request_id);
                $poModStatus->setStatus_Code(3);
                $poModStatus->setEmployee_Code($this->session->userdata('emp_id'));
                $poModStatus->setComments($status_change_remark);

                $poRequestService->insertPurchaseOrderUpdatedStatus($poModStatus);


                $isUpdated = $poRequestService->updatePurchaseOrderRequestByHOD($poRequestModel);

                if($isUpdated){

                    echo '<div class="response-msg success ui-corner-all">Purchase Order Request was successfully Rejected</div>#######success';

                }
                else{

                    echo '<div class="response-msg error ui-corner-all">You are not Authorized to reject this Purchase Order request</div>#######error';

                }


            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";
                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');



            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }


    }//rejectPurchaseOrderbyHOD






    function rejectPurchaseOrderbyACD($po_request_id){


        if($this->session->userdata('logged_in'))
        {

            $userPriviledgeModel=new UserPriviledge();
            //check whether the user has the HOD priviledges
            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode($this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(9);//priviledge 9 is to reject the PO request by the ACD

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //ACD has the priviledges to approve the PO request

                $poRequestModel = new PurchaseOrderRequestModel();

                $poRequestService = new PurchaseOrderRequestService();

                $poRequestModel->setOrder_Code($po_request_id);
                $poRequestModel->setStatus_Code(7);//status 7 - PO rejected by ACD

                $poModStatus = new PurchaseOrderModerateStatus();

                $status_change_remark=$this->input->post('status_change_remark',TRUE);

                $poModStatus->setOrder_Code($po_request_id);
                $poModStatus->setStatus_Code(7);
                $poModStatus->setEmployee_Code($this->session->userdata('emp_id'));
                $poModStatus->setComments($status_change_remark);

                $poRequestService->insertPurchaseOrderUpdatedStatus($poModStatus);


                $poRequestService->updatePurchaseOrderRequest($poRequestModel);



                echo '<div class="response-msg success ui-corner-all">Purchase Order Request was successfully Rejected by the Administrative Director</div>#######success';



            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";
                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');



            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }


    }//rejectPurchaseOrderbyACD









    function returnPurchaseOrderbyACD($po_request_id){


        if($this->session->userdata('logged_in'))
        {

            $userPriviledgeModel=new UserPriviledge();
            //check whether the user has the HOD priviledges
            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode($this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(15);//priviledge 15 is to reject the PO request by the ACD

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //ACD has the priviledges to approve the PO request

                $poRequestModel = new PurchaseOrderRequestModel();

                $poRequestService = new PurchaseOrderRequestService();

                $poRequestModel->setOrder_Code($po_request_id);
                $poRequestModel->setStatus_Code(8);//status 8 - PO returned by ACD


                $poModStatus = new PurchaseOrderModerateStatus();

                $status_change_remark=$this->input->post('status_change_remark',TRUE);

                $poModStatus->setOrder_Code($po_request_id);
                $poModStatus->setStatus_Code(8);
                $poModStatus->setEmployee_Code($this->session->userdata('emp_id'));
                $poModStatus->setComments($status_change_remark);

                $poRequestService->insertPurchaseOrderUpdatedStatus($poModStatus);



                $poRequestService->updatePurchaseOrderRequest($poRequestModel);



                echo '<div class="response-msg success ui-corner-all">Purchase Order Request was successfully Returned by the Administrative Director</div>#######success';



            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";
                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');



            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }


    }//returnPurchaseOrderbyACD












    function returnPurchaseOrderbyHOD($po_request_id){


        if($this->session->userdata('logged_in'))
        {

            $userPriviledgeModel=new UserPriviledge();
            //check whether the user has the HOD priviledges
            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode($this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(14);//priviledge 14 is to return the PO request by the HOD

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //HOD has the priviledges to approve the PO request
                //echo "approve PO ".$;

                $poRequestModel = new PurchaseOrderRequestModel();

                $poRequestService = new PurchaseOrderRequestService();

                $poRequestModel->setOrder_Code($po_request_id);
                $poRequestModel->setStatus_Code(5);//status 5 - PO Returned by HOD
                $poRequestModel->setRequested_Dept($this->session->userdata('department'));



                $poModStatus = new PurchaseOrderModerateStatus();

                $status_change_remark=$this->input->post('status_change_remark',TRUE);

                $poModStatus->setOrder_Code($po_request_id);
                $poModStatus->setStatus_Code(5);
                $poModStatus->setEmployee_Code($this->session->userdata('emp_id'));
                $poModStatus->setComments($status_change_remark);

                $poRequestService->insertPurchaseOrderUpdatedStatus($poModStatus);


                $isUpdated = $poRequestService->updatePurchaseOrderRequestByHOD($poRequestModel);

                if($isUpdated){

                    echo '<div class="response-msg success ui-corner-all">Purchase Order Request was successfully Returned</div>#######success';

                }
                else{

                    echo '<div class="response-msg error ui-corner-all">You are not Authorized to return this Purchase Order request</div>#######error';

                }


            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";
                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');



            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }


    }//returnPurchaseOrderbyHOD









    /* this function is used to view and edit the PO request by the HOD user */

    function viewPurchaseOrder($purchaseOrderCode){


        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(5);//priviledge 5 is for creating purchase order request

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                $deptID = $this->session->userdata('department');

                // echo "user has the priviledges";

                //start

                //retrieveing department details
                $departmentModel = new DepartmentModel();
                $departmentService = new DepartmentService();

                $departmentModel->setDepartmentCode($this->session->userdata('department'));
                $departmentName=$departmentService->retrieveDepartmentName($departmentModel);


                //retrieving currency details
                $currencyService = new CurrencyService();
                $currencyObjectArray = $currencyService->retriveAllCurrencyDetails();


                //retrieving payment type details
                $paymentTypeService = new PaymentTypeService();
                $paymentTypeObjectArray = $paymentTypeService->retriveAllPaymentTypes();


                $unitService = new UnitModelService();

                $unitModelObjArr = $unitService->retrieveAllUnitDetails();
                //retrieving all details related to the purchase order request

                $poReqService = new PurchaseOrderRequestService();

                $poModel = new PurchaseOrderRequestModel();

                $poModel->setOrder_Code($purchaseOrderCode);
                $poModel->setRequested_Dept($deptID);

                //retrieve the given purchase order if it is placed by this particular user
                $poModelRetrieved = $poReqService->getPurchaseOrderDetailsForGivenOrderIDWithDepartment($poModel);

                if($poModelRetrieved!=NULL){

                    //Purchase Order Request found with the given ID and it is placed by the currently logged user

                    //supplier type retrieving
                    $supplierModelObject = new SupplierModel();

                    $supplierModelObject->setSupplier_Code($poModelRetrieved->getSupplier_Code());
                    $supService = new SupplierService();
                    $supModRetrieved = $supService->getGivenSupplierDetails($supplierModelObject);

                    //setting up the data array
                    $data=array('departmentName'=>$departmentName,'currencyObjectArray'=>$currencyObjectArray,'paymentTypeObjectArray'=>$paymentTypeObjectArray,'UnitArray'=>$unitModelObjArr,'PurchaseOrderID'=>$purchaseOrderCode,'PurchaseOrderRequestObject'=>$poModelRetrieved,'SupplierType'=>$supModRetrieved->getSupplier_Type());

                    //end


                    $this->template->setTitles('', '', 'Purchase Order Request', '');

                    //hod can edit only the purchase order requests that are sent for the approval or returned by the ACD
                    if($poModelRetrieved->getStatus_Code()=='2' || $poModelRetrieved->getStatus_Code()=='8'){

                        $this->template->load('template', 'PurchaseOrder/EditPurchaseOrderView',$data);

                    }
                    else{


                        redirect(base_url()."index.php/PurchaseOrder/PurchaseOrderManagement/viewDepartmentPOrequests");

                    }//else


                }//purchase order request was found for given id
                else{

                    //purchase order requst is not relevant for the HOD requested. therefore the error mesaage is displayed

                    $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                    $this->template->load('template', 'errorPage');


                }

            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if
        else{


            redirect(base_url().'index.php');


        }


    }//editPurchaseOrderView








    /* this method is used by the ACD for viewing the PO request in detail*/

    function viewPurchaseOrderRequest($purchaseOrderCode){


        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(13);//priviledge 5 is for Edit PO requests by ACD

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                $deptID = $this->session->userdata('department');

                // echo "user has the priviledges";

                //start

                //retrieveing department details
                $departmentModel = new DepartmentModel();
                $departmentService = new DepartmentService();

                $departmentModel->setDepartmentCode($this->session->userdata('department'));
                $departmentName=$departmentService->retrieveDepartmentName($departmentModel);


                //retrieving currency details
                $currencyService = new CurrencyService();
                $currencyObjectArray = $currencyService->retriveAllCurrencyDetails();


                //retrieving payment type details
                $paymentTypeService = new PaymentTypeService();
                $paymentTypeObjectArray = $paymentTypeService->retriveAllPaymentTypes();


                $unitService = new UnitModelService();

                $unitModelObjArr = $unitService->retrieveAllUnitDetails();
                //retrieving all details related to the purchase order request

                $poReqService = new PurchaseOrderRequestService();

                $poModel = new PurchaseOrderRequestModel();

                $poModel->setOrder_Code($purchaseOrderCode);
                $poModel->setRequested_Dept($deptID);

                //retrieve the given purchase order if it is placed by this particular user
                $poModelRetrieved = $poReqService->getPurchaseOrderDetailsForGivenOrderIDWithDepartment($poModel);

                if($poModelRetrieved!=NULL){

                    //Purchase Order Request found with the given ID and it is placed by the currently logged user

                    //supplier type retrieving
                    $supplierModelObject = new SupplierModel();

                    $supplierModelObject->setSupplier_Code($poModelRetrieved->getSupplier_Code());
                    $supService = new SupplierService();
                    $supModRetrieved = $supService->getGivenSupplierDetails($supplierModelObject);

                    //setting up the data array
                    $data=array('departmentName'=>$departmentName,'currencyObjectArray'=>$currencyObjectArray,'paymentTypeObjectArray'=>$paymentTypeObjectArray,'UnitArray'=>$unitModelObjArr,'PurchaseOrderID'=>$purchaseOrderCode,'PurchaseOrderRequestObject'=>$poModelRetrieved,'SupplierType'=>$supModRetrieved->getSupplier_Type());

                    //end


                    $this->template->setTitles('', '', 'Purchase Order Request', '');

                    //user can edit only the purchase order requests that are approved by HOD
                    if($poModelRetrieved->getStatus_Code()=='4'){

                        $this->template->load('template', 'PurchaseOrder/EditPurchaseOrderView',$data);

                    }
                    else{


                        redirect(base_url()."index.php/PurchaseOrder/PurchaseOrderManagement/viewAllDepartmentPendingPOrequests");

                    }//else


                }//purchase order request was found for given id
                else{

                    //purchase order requst is not relevant for the HOD requested. therefore the error mesaage is displayed

                    $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                    $this->template->load('template', 'errorPage');


                }

            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";

                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if
        else{


            redirect(base_url().'index.php');


        }


    }//PurchaseOrderView










    /*
     the below method is used to diaply all the pending po requests of all departments for the ACD user (Administrative Director)
     */

    function viewAllDepartmentPendingPOrequests(){

        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(12);/* priviledge 12 is for viewing a list of PO requests placed by the all department users */


            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                //echo "user has the priviledges to check PO requests";


                $deparmentID = $this->session->userdata('department');

                // echo "user has the priviledges";

                $poReqModel = new PurchaseOrderRequestModel();


                //$poReqModel->setRequested_Dept($deparmentID);
                $poReqModel->setStatus_Code(4); // retrieve all the PO requests approved by the HOD
                $poReqService = new PurchaseOrderRequestService();

                $purchaseOrders = $poReqService->getPurchaseOrderDetailsForGivenStatus($poReqModel);

                echo sizeof($purchaseOrders);
                //setting up the data array
                $data = array('PurchaseOrders'=>$purchaseOrders);

                $this->template->setTitles('LankaCom Inventory Management System', 'Subsidiry of Singapoor Telecom', 'Purchase Order requests', 'List of Purchase Order Request for giving approval...');

                $this->template->load('template', 'PurchaseOrder/viewAllDepartmentsPurchaseOrdersList',$data);


            }//hasPriviledges
            else{

                // "user doesnt have the priviledges";
                $this->template->setTitles('Access Denied', 'You are not allowed to access this page.', 'You are not allowed to access this page.', 'Please Contact Administrator...');

                $this->template->load('template', 'errorPage');

            }

        }//if logged
        else{

            redirect(base_url().'index.php');

        }

    }//viewDepartmentPOrequests







    function displayApprovedPO(){

        echo  "displayApprovedPO";

    }//displayApprovedPO









}//class
?>