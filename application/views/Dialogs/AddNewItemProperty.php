<div id="add_new_property_dialog" title="Add New Item Property">
    <form id="add_new_property_form" name="add_new_property_form" class="forms" method="post">
    	<fieldset>
    		<ul>
    		    <li>
    			<label class="desc">Item Type *</label>
    			<div>
    			    <input id="Item_Type_For_Property" class="field text full ac_input Item_Type_For_Property" name="Item_Type_For_Property" type="text"/>
                    <input name="Item_Type_For_Property_Hidden" id="Item_Type_For_Property_Hidden" type="hidden"/>
    			</div>
    
    			<div id="Item_Property"></div>
    		    </li>
    
    		    <li>
    			<label class="desc">Property *</label>
    			<div>
    				<input id="Item_Property" class="field text full" name="Item_Property" type="text"/>
    			</div>
    
    		    </li>
    
    		    <li>
    			<label class="desc">Description</label>
    			<div>
    			    <textarea id="Property_Description" class="field textarea small" cols="50" rows="5" name="Property_Description"></textarea>
    			</div>
    		    </li>
    
    		    <li>
    			<div>
    			    <button class="ui-state-default ui-corner-all float-left ui-button" type="submit">Add Property</button>
    			</div>
    		    </li>
                
                <li>
					<div id="add_new_item_property_msg"></div>
				</li>
    		</ul>
    	</fieldset>
    </form>
</div>