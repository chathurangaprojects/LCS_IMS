<div id="add_new_type_dialog" title="Add New Item Type">
	<form id="insert_item_type_form" class="forms" method="post">
		<fieldset>
			<ul>
				<li>
					<label class="desc">Item Type *</label>
	
					<div>
						<input name="Item_Type" class="field text full" id="Item_Type" type="text"/>
					</div>
				</li>
									
				<li>
					<label class="desc">Category *</label>
	
					<div>
						<select name="Item_Category" class="field select large" id="Item_Category">
                            <option value="">--Please Select--</option>
							<?php
								$this->load->model(array('ItemMainCategory/ItemMainCategoryModel', 'ItemMainCategory/ItemMainCategoryService'));
							
								$itemMainCategoryService = new ItemMainCategoryService();
							
								$itemMainCategoryData=$itemMainCategoryService->loadItemCategories();

								for($index = 0; $index < sizeof($itemMainCategoryData); $index++)
								{
							?>
									<option value="<?php echo trim($itemMainCategoryData[$index]->getCategory_Code()); ?>"><?php echo trim($itemMainCategoryData[$index]->getCategory_Name()); ?></option>
							<?php
								}
							?>
						</select>
					</div>
				</li>
				
				<li>
					<label class="desc">Bulk Type</label>
	
					<div>
						<select name="Bulk_Type" class="field select large" id="Bulk_Type">
							<?php
								$this->load->model(array('ItemBulkType/ItemBulkTypeModel', 'ItemBulkType/ItemBulkTypeService'));
							
								$itemBulkTypeService = new ItemBulkTypeService();
							
								$itemBulkTypeData = $itemBulkTypeService->loadItemItemBulkTypes();

								for($index = 0; $index < sizeof($itemBulkTypeData); $index++)
								{
							?>
									<option value="<?php echo $itemBulkTypeData[$index]->getBulk_Code(); ?>"><?php echo $itemBulkTypeData[$index]->getDescription(); ?></option>
							<?php
								}
							?>
						</select>
					</div>
				</li>
				
				<li>
					<label class="desc">Unit</label>
	
					<div>
						<select name="Unit" class="field select large" id="Unit">
							<?php
								$this->load->model(array('ItemUnit/ItemUnitModel', 'ItemUnit/ItemUnitService'));
							
								$itemUnitService = new ItemUnitService();
							
								$itemUnitData = $itemUnitService->loadItemUnits();

								for($index = 0; $index < sizeof($itemUnitData); $index++)
								{
							?>
									<option value="<?php echo $itemUnitData[$index]->getUnit_Code(); ?>"><?php echo $itemUnitData[$index]->getDescription(); ?></option>
							<?php
								}
							?>
						</select>
					</div>
				</li>
				
				<li>
					<label class="desc">Description</label>
	
					<div>
						<input name="Description" class="field text full" id="Description" type="text"/>
					</div>
				</li>
				
                <li>
					<div>
                        <button class="ui-state-default ui-corner-all float-left ui-button" id="btn_add_master_item_type" type="submit">Add Item Type</button>
					</div>
				</li>
				
				<li>
					<div id="add_new_item_type_msg"></div>
				</li>
			</ul>
		</fieldset>
	</form>
</div>