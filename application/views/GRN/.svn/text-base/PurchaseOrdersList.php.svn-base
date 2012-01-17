<div class="hastable">
    <div id="registeredEmployeeTable">
        <table id="sort-table">
            <thead>
            <tr>
                <th>Order ID</th>
                <th> Department </th>
                <th>Requested By</th>
                <th>Created By</th>
                <th>Supplier</th>
                <th>Supplier Type</th>
                <th>Date Created</th>
                <th>Order Purpose </th>
                <th>Order Status</th>
                <th style="width:60px">Options</th>
            </tr>
            </thead>
            <tbody>

            <?php

            $this->load->model(array('PurchaseOrder/DepartmentService','PurchaseOrder/DepartmentModel','PurchaseOrder/PurchaseOrderGeneralService','Supplier/SupplierModel','Supplier/SupplierService','UserModel','UserService'));

            $departmentModel = new DepartmentModel();
            $deptService = new DepartmentService();

            $supplier = new SupplierModel();
            $supService = new SupplierService();


            $poGeneral = new PurchaseOrderGeneralService();

            for($index=0; $index < sizeof($PurchaseOrders); $index++){

                $departmentModel->setDepartmentCode($PurchaseOrders[$index]->getRequested_Dept());

                $supplier->setSupplier_Code($PurchaseOrders[$index]->getSupplier_Code());

                $supplierModel = $supService->getGivenSupplierDetails($supplier);


                //retrieving the created and requested user details

                $userCreated = new UserModel();
                $userRequested = new UserModel();


                $userCreated->setEmployeeCode($PurchaseOrders[$index]->getCreated_By());
                $userRequested->setEmployeeCode($PurchaseOrders[$index]->getRequested_By());

                $userService =  new UserService();

                $createdUserObject = $userService->retrieveGivenEmployeeDetails($userCreated);
                $requestedUserObject = $userService->retrieveGivenEmployeeDetails($userRequested);

                ?>

            <tr>
                <td class="center"><?php echo $PurchaseOrders[$index]->getOrder_Code(); ?></td>
                <td><?php echo $deptService->retrieveDepartmentName($departmentModel); ?></td>
                <td> <?php echo $requestedUserObject->getEmail(); ?> </td>
                <td> <?php echo $createdUserObject->getEmail(); ?> </td>
                <td><?php echo $supplierModel->getSupplier_Name(); ?></td>
                <td><?php if($supplierModel->getSupplier_Type()==1){ echo "Foreign"; } else if($supplierModel->getSupplier_Type()==0){ echo "Local"; } ?></td>
                <td><?php echo substr($PurchaseOrders[$index]->getOrder_Date(),0,10); ?></td>
                <td><?php if(trim($PurchaseOrders[$index]->getPO_Purpose())!=""){echo $PurchaseOrders[$index]->getPO_Purpose(); } else{ echo "-"; }?></td>
                <td><?php echo $poGeneral->retrievePoStatus($PurchaseOrders[$index]->getStatus_Code()); ?></td>

                <td>

                    <a title="Generate GRN" href="<?php  echo base_url(); ?>index.php/GRN/GRNAdministration/generateGrnForPurchaseOrder/<?php echo $PurchaseOrders[$index]->getOrder_Code(); ?>" onclick="return confirm('Are you sure to Generate GRN for this Purchase Order? ');" >
                        Click to Generate GRN
                    </a>

                </td>
            </tr>

                <?php
            }//for
            ?>


            </tbody>
        </table>
    </div>
</div>
