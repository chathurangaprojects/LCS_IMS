var base_url = 'http://localhost/LCS_IMS/';
var site_url = 'http://localhost/LCS_IMS/index.php';

$().ready(function () {
    //Autocomplete for Add New Master Item
    $("#Item_Type").autocomplete(site_url + "/Autocomplete/loadItemTypes", {
        width: 525,
        highlight: false,
        selectFirst: false,

        formatItem: function (data, i, n, value) {
            return "<b>" + jQuery.trim(value.split(" !@#$%^&*() ")[0]) + "</b> - " + jQuery.trim(value.split(" !@#$%^&*() ")[1]);
        },
        formatResult: function (data, value) {
            return jQuery.trim(value.split(" !@#$%^&*() ")[0]);
        }
    }).result(function (event, data, formatted) {
        var selectedID = jQuery.trim(formatted.split(" !@#$%^&*() ")[2]);

        $('#Item_Type_Hidden').val(selectedID)
    });
    
    //Autocomplete for Add New Property
    $("#Item_Type_For_Property").autocomplete(site_url + "/Autocomplete/loadItemTypes", {
        width: 525,
        highlight: false,
        selectFirst: false,

        formatItem: function (data, i, n, value) {
            return "<b>" + jQuery.trim(value.split(" !@#$%^&*() ")[0]) + "</b> - " + jQuery.trim(value.split(" !@#$%^&*() ")[1]);
        },
        formatResult: function (data, value) {
            return jQuery.trim(value.split(" !@#$%^&*() ")[0]);
        }
    }).result(function (event, data, formatted) {
        var selectedID = jQuery.trim(formatted.split(" !@#$%^&*() ")[2]);

        $('#Item_Type_For_Property_Hidden').val(selectedID)

        $.post(site_url + '/ItemProperty/ItemPropertyManagement/getPropertyByItemTypeID', {ItemTypeID: $('#Item_Type_For_Property_Hidden').val()}, function(data) {
          $('#Item_Property').html(data);
          //alert(data);
        })
    });
    
    //Autocomplete for Add New Property
    $("#Item_Type_For_Property_Value").autocomplete(site_url + "/Autocomplete/loadItemTypes", {
        width: 525,
        highlight: false,
        selectFirst: false,

        formatItem: function (data, i, n, value) {
            return "<b>" + jQuery.trim(value.split(" !@#$%^&*() ")[0]) + "</b> - " + jQuery.trim(value.split(" !@#$%^&*() ")[1]);
        },
        formatResult: function (data, value) {
            return jQuery.trim(value.split(" !@#$%^&*() ")[0]);
        }
    }).result(function (event, data, formatted) {
        var selectedID = jQuery.trim(formatted.split(" !@#$%^&*() ")[2]);

        $('#Item_Type_For_Property_Hidden').val(selectedID)

        $.post(site_url + '/ItemProperty/ItemPropertyManagement/addPropertyByItemTypeID', {ItemTypeID: $('#Item_Type_For_Property_Hidden').val()}, function(data) {
          $('#Add_Item_Property').html(data);
          //alert(data);
        })
    });
});