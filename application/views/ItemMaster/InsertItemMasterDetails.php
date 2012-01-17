<div class="content-box">
	<form id="insert_master_item_form" class="forms" method="post">
		<fieldset>
			<ul>
                <li>
                    <span class="cont tooltip ui-corner-all" title="Click here to add new Item Types">
                        <a id="add_new_type_link" class="btn ui-state-default ui-corner-all" href="#">
                            <span class="ui-icon ui-icon-newwin"></span>
                            Add New Type
                        </a>
                    </span>
                    
                    <span class="cont tooltip ui-corner-all" title="Click here to add new Properties to existing items">
                        <a id="add_new_property_link" class="btn ui-state-default ui-corner-all" href="#">
                            <span class="ui-icon ui-icon-newwin"></span>
                            Add New Properties
                        </a>
                    </span>
                    
                    <span class="cont tooltip ui-corner-all" title="Click here to add values to existing Properties">
                        <a id="add_property_value_link" class="btn ui-state-default ui-corner-all" href="#">
                            <span class="ui-icon ui-icon-newwin"></span>
                        
                            Add Property Values
                        </a>
                    </span>
                </li>
                
				<li>
					<label class="desc">Item Name *</label>
	
					<div>
						<input name="Item_Name" class="field text full" id="Item_Name" type="text"/>
					</div>
				</li>
		
				<li>
					<label class="desc">Item Type *</label>
	
					<div>
						<input name="Item_Type" class="field text full txt_Item_Type" id="Item_Type" type="text"/> <!-- onkeyup="validkey(event)"/> -->
						<input name="Item_Type_Hidden" id="Item_Type_Hidden" type="hidden"/>
					</div>
				</li>
			
				<li>
					<label class="desc">Item Image</label>
				
					<div>
						<input name="Item_Image" id="Item_Image" type="text"/>
					</div>
				</li>
		
				<li>
					<label class="desc">Description</label>
	
					<div>
						<textarea name="Description" class="field text full" id="Description"></textarea>
					</div>
				</li>
		
				<li>
					<table width="100%">
						<tr>
							<td width="50%">
								<label>Re-Order Level</label>
				
								<div>
									<input name="Reorder_Level" class="field text medium" id="Reorder_Level" type="text"/>
								</div>
							</td>
					
							<td width="50%">
								<label>Re-Order Quantity</label>
				
								<div>
									<input name="Reorder_Quantity" class="field text medium" id="Reorder_Quantity" type="text"/>
								</div>
							</td>
						</tr>
					</table>
				</li>
				
				<li>
					<div>
						<input class="ui-state-default ui-corner-all float-left ui-button" id="btn_add_master_item" type="submit" value="Add Item"/>
					</div>
				</li>
				
				<div id="addnewempmsg">
				</div>
			</ul>
		</fieldset>
	</form>
    
    <?php
	   echo $this->load->view('Dialogs/AddNewItemType', '', true);
       
	   echo $this->load->view('Dialogs/AddNewItemProperty', '', true);
       
	   echo $this->load->view('Dialogs/AddNewItemPropertyValue', '', true);
   ?>
</div>