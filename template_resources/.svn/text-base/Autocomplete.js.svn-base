var base_url = 'http://localhost/LCS_IMS/';
var site_url = 'http://localhost/LCS_IMS/index.php';

$().ready(function () {
	//sup
	// extraParams: {serial: function() { return $("#serial").val(); } },
	//sup2
	
	$("#sup_name").autocomplete(site_url + "/Autocomplete/loadSuppliers", {
	    width: 525,
		//autoFill : true,
		
		extraParams: {sup_type: function() {  return $("#sup_type").val(); } },
        matchContains: true,
        selectFirst: false,
		cacheLength: 0,
formatItem: function (data, i, n, value) {
var supplierName = value.split("###")[1];
        //jQuery(this).flushCache();

return "<span>" + supplierName + "</span>";

},
formatResult: function (data, value) {
	return value.split("###")[1];
}


    }).result(function(event, data, formatted){ 
	
	var selectedID = formatted.split("###")[0];
    // $("#sup_type").flushCache();
    // $('form[name=purchase_order_request] #supplier_id').val(selectedID);
	 $('#supplier_id').val(selectedID);
	
	}//result
	
	);
	
	//sup2
	

	
	
	//item name
	
	$("#po_item_name").autocomplete(site_url + "/Autocomplete/loadItemNames", {
	    width: 525,
		//autoFill : true,
		
		//extraParams: {sup_type: function() {  return $("#sup_type").val(); } },
        matchContains: true,
        selectFirst: false,
		cacheLength: 0,
formatItem: function (data, i, n, value) {
var supplierName = value.split("###")[1];

return "<span>" + supplierName + "</span>";

},
formatResult: function (data, value) {
	return value.split("###")[1];
}


    }).result(function(event, data, formatted){ 
	
	var selectedID = formatted.split("###")[0];
	 $('#item_id').val(selectedID);
	
	 //clear the previous item added message 
	 $('#addNewItemMessage').html('');

	}//result
	
	);
	
	//item name
	
	
	
	
	
	//itemname autocomplete for edit item start
	/*
	$("#edit_po_item_name").autocomplete(site_url + "/Autocomplete/loadItemNames", {
	    width: 525,
		//autoFill : true,
		
		//extraParams: {sup_type: function() {  return $("#sup_type").val(); } },
        matchContains: true,
        selectFirst: false,
		cacheLength: 0,
formatItem: function (data, i, n, value) {
var supplierName = value.split("###")[1];

return "<span>" + supplierName + "</span>";

},
formatResult: function (data, value) {
	return value.split("###")[1];
}


    }).result(function(event, data, formatted){ 
	
	var selectedID = formatted.split("###")[0];
	 $('#updating_item_id').val(selectedID);
	
	 //clear the previous item added message 
	 $('#editItemMessage').html('');

	}//result
	
	);
	
	*/
	
	//itemname autocomplete for edit item ends
		


    });
	
	
