var base_url = 'http://localhost/LCS_IMS/';
var site_url = 'http://localhost/LCS_IMS/index.php';

$().ready(function () {
    /*
     * Developed By: A.M.Roomi
     * Date: 03-01-2012
     * Purpose: Validate Master Item Form 
     */
    $("#insert_master_item_form").validate
	({
	    rules:
		{
		    Item_Name: "required",
		    Item_Type: "required",
		    Reorder_Level: "number",
		    Reorder_Quantity: "number"
		},
	    messages:
		{
		    Item_Name: "Item Name is required",
		    Item_Type: "Item Type is required",
		    Reorder_Level: "Invalid Re-Order Level",
		    Reorder_Quantity: "Invalid Re-Order Quantity"

		},

	    submitHandler: function (form) {
	        $('#addnewempmsg').html('<div class="response-msg inf ui-corner-all"><span>Please Wait...</span>New Master Item is being inserted...</div>');

	        $.post(site_url + '/ItemMaster/ItemMasterManagement/insertItemMasterDetails', $("#insert_master_item_form").serialize(), function (msg) {
	            if (jQuery.trim(msg) == '1') {
	                $('#addnewempmsg').html('<div class="response-msg success ui-corner-all"><span>Master Item Inserted</span>New Master Item is inserted to the database successfully</div>');
	            }
	            else {
	                $('#addnewempmsg').html('<div class="response-msg error ui-corner-all"><span>Master Item Cannot Be Inserted</span>New Master Item cannot be inserted. Please try again...</div>');
	            }
	        });
	    }

	});

    /*
     * Developed By: A.M.Roomi
     * Date: 03-01-2012
     * Purpose: Validate Master Item Type Form 
     */
	$("#insert_item_type_form").validate
	({
	    rules:
		{
		    Item_Type: "required",
		    Item_Category: "required"
		},
	    messages:
		{
		    Item_Type: "Item Type is required",
		    Item_Category: "Category Required"

		},

	    submitHandler: function (form) {
	        $('#add_new_item_type_msg').html('<div class="response-msg inf ui-corner-all"><div>Please Wait...</div>New Master Item Type is being inserted...</div>');

	        $.post(site_url + '/ItemType/ItemTypeManagement/insertMasterItemType', $("#insert_item_type_form").serialize(), function (msg) {
	            if (jQuery.trim(msg) == '1') {
	                $('#add_new_item_type_msg').html('<div class="response-msg success ui-corner-all"><div>Master Item Inserted</div>New Master Item is inserted to the database successfully</div>');
	            }
	            else {
	                $('#add_new_item_type_msg').html('<div class="response-msg error ui-corner-all"><div>Master Item Cannot Be Inserted</div>New Master Item cannot be inserted. Please try again...</div>');
	            }
	        });
	    }
	});
    
    /*
     * Developed By: A.M.Roomi
     * Date: 03-01-2012
     * Purpose: Validate Add New Item Property 
     */
	$("#add_new_property_form").validate
	({
	    rules:
		{
		    Item_Type_For_Property: "required",
		    Item_Property: "required"
		},
	    messages:
		{
		    Item_Type_For_Property: "Item Type is required",
		    Item_Property: "Item Property is required"
		},
	    submitHandler: function (form) {
	        $('#add_new_item_property_msg').html('<div class="response-msg inf ui-corner-all"><span>Please Wait...</span><br/><br/>New Item Property is being inserted...</div>');

	        $.post(site_url + '/ItemProperty/ItemPropertyManagement/insertNewItemProperty', $("#add_new_property_form").serialize(), function (msg) {
	           //alert(msg);
               var title = jQuery.trim(msg.split(" # ")[0]);
               var message = jQuery.trim(msg.split(" # ")[1]);
               var type = jQuery.trim(msg.split(" # ")[2]);
               
               $('#add_new_item_property_msg').html('<div class="response-msg ' + type + ' ui-corner-all"><span>' + title + '</span><br/><br/>' + message + '</div>');
               
               if(type == 'success')
               {
                    $('#Item_Type_For_Property').val('');
                    $('#Item_Type_For_Property_Hidden').val('');
                    $('#Item_Property').val('');
                    $('#Property_Description').val('');
                    
                    $('#Item_Property').html('');
               }
	        });
	    }
	});
});