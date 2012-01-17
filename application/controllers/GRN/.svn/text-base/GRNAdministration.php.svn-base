<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GRNAdministration extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('UserModel');
        $this->load->model('UserService');
        $this->load->model('UserModerationModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model(array('PurchaseOrder/DepartmentModel','PurchaseOrder/DepartmentService','PurchaseOrder/CurrencyModel','PurchaseOrder/CurrencyService','PurchaseOrder/PaymentTypeModel','PurchaseOrder/PaymentTypeService','PurchaseOrder/PurchaseOrderRequestModel','PurchaseOrder/PurchaseOrderRequestService','PurchaseOrder/UnitModelService','PurchaseOrder/PurchaseOrderItemModel','PurchaseOrder/PurchaseOrderItemService','ItemMaster/ItemMasterModel','ItemMaster/ItemMasterService','Supplier/SupplierModel','Supplier/SupplierService','UserModel','UserService','PurchaseOrder/PurchaseOrderModerateStatus'));

    }//construct



    function index(){

        echo "GRN Administration Controller";

    }//function index






    function viewPurchaseOrderList(){



        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(17);//priviledge 17 is for viewing a list of Purchase Orders

            $hasPriviledges=$userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){

                // echo "user has the required priviledges to view a list of Purchase Orders";
                $deparmentID = $this->session->userdata('department');

                $poReqModel = new PurchaseOrderRequestModel();
                $poReqModel->setStatus_Code(6); // retrieve all the PO requests approved by the ACD
                $poReqService = new PurchaseOrderRequestService();

                $purchaseOrders = $poReqService->getPurchaseOrderDetailsForGivenStatus($poReqModel);

                echo sizeof($purchaseOrders);
                //setting up the data array
                $data = array('PurchaseOrders'=>$purchaseOrders);

                $this->template->setTitles('LankaCom Inventory Management System', 'Subsidiary of Singapore Telecom', 'Purchase Orders', 'List of Approved Purchase Orders...');

                $this->template->load('template', 'GRN/PurchaseOrdersList',$data);

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


    }//viewPurchaseOrderList






    function generateGrnForPurchaseOrder($purchaseOrderID){


        if($this->session->userdata('logged_in'))
        {
            //the user is logged and priviledges should be checked
            $userPriviledgeModel=new UserPriviledge();

            $userPriviledgeModel->setLevelCode($this->session->userdata('level'));
            $userPriviledgeModel->setDepartmentCode( $this->session->userdata('department'));
            $userPriviledgeModel->setPriviledgeCode(18);//priviledge 18 is for generating GRN for the Purchase Order

            $hasPriviledges = $userPriviledgeModel->checkUserPriviledge($userPriviledgeModel);

            if($hasPriviledges){


                $this->template->setTitles('LankaCom Inventory Management System', 'Subsidiary of Singapore Telecom', 'Good Receive Note', 'GRN for Purchase Order...');

                $this->template->load('template', 'GRN/GRNForPO');


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

    }//generateGrnForPurchaseOrder












}//class
?>
