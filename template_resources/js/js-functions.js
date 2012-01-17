var base_url ='http://localhost/LCS_IMS/index.php';
var base_url2 ='http://localhost/LCS_IMS/';

var itemsarray=new Array();

 function deleteitems(trid,action,id,msg){

//alert(trid);
//alert(action);
//alert(id);
 jConfirm(msg , 'Please Confirm', function(result){
if (result) {
    
        $.ajax({
   type: "POST",   
   url: base_url+"/delete/delete_items/", 
   data: "Id="+id + "& action="+action,    
   success: function(msg){
     // alert(msg);
       if(msg==1){     
document.getElementById(trid).style.display='none';
       }else{
           
           }
   }
   
 });
    
}else{
    
    
    }
  });
    
    
    }
    



  function enableEmployee(id){ 
   // alert(id);          
     // alert("enableEmployee");      
            $.ajax({
   type: "POST",   
   url: base_url+"/login/enable_employee/", 
   data: "id="+id,    
   success: function(msg){
     // alert(msg);
       if(msg==1){     
$('#emp_status'+id).html('<a onclick=\"disableEmployee('+id+')\" class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Mark as Disabled." style="cursor:pointer;"><span class="ui-icon ui-icon-arrowreturnthick-1-s"></span></a>'); 
       }else{
           
           }
   }
   
 });  
  }



  function disableEmployee(id){ 
  //alert(id);       
     // alert("disableEmployee");      
                $.ajax({
   type: "POST",   
   url: base_url+"/login/disable_employee/", 
   data: "id="+id,    
   success: function(msg){
     // alert(msg);
       if(msg==1){        
  $('#emp_status'+id).html('<a onclick=\"enableEmployee('+id+')\" class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Mark as Enabled."  style="cursor:pointer;"><span class="ui-icon ui-icon-arrowreturnthick-1-n"></span></a>'); 
       }else{
           
           }
   }
   
 });  
      
            
  }






$(document).ready(function() {
    
    $('#login_button').click(function() {
	//alert(1);
	//alert(base_url);
	
	var login_username= $('#login_username').val();
	var login_password= $('#login_password').val();	
	
$('#login_msg').html('<span class="response-msg notice ui-corner-all">validating...</span>');
$.ajax({
   type: "POST",
   url: base_url+"/login/loging_in/",   
   data: "login_username="+login_username+"& login_password="+login_password,
   success: function(msg){
	// alert(msg);
	 //	$('#login_msg').html(msg);   
	   
	   
	   if(msg==1){     
    $('#login_msg').html('<div class="response-msg success ui-corner-all">Login successfull..</div>');   
      setTimeout("location.href = base_url",100); 
          } else{			   
$('#login_msg').html('<div class="response-msg error ui-corner-all">Invalid login details...</div>');   
    	}	   
	  
   }
   
 });
	
	 });
});

    
  
  
  
  $(document).ready(function() {
    
    $('#forgetpw_button').click(function() {
 // alert(1);
    //alert(registered_email);
    
    var registered_email= $('#registered_email').val();     
      // alert(registered_email);   
$('#fgtpw_msg').html('<span class="response-msg notice ui-corner-all">validating...</span>');
$.ajax({
   type: "POST",
   url: base_url+"/login/check_registeredemail/",   
   data: "registered_email="+registered_email,
   success: function(msg){
    // alert(msg);
     //    $('#login_msg').html(msg);   
       
       
       if(msg==1){     
    $('#fgtpw_msg').html('<div class="response-msg success ui-corner-all">We have send the vertification link to your  email address that you entered.Please verify your email.</div>');   
     // setTimeout("location.href = base_url",100); 
          } else{               
$('#fgtpw_msg').html('<div class="response-msg error ui-corner-all">We don\'t have your email address in our system.</div>');   
        }       
      
   }
   
 });
    
     });
});

function showProperties(str0)
{
    str = ("" + str0).replace(/[\s-]+$/,'').split(/[\s-]/).pop();

    //alert(str);
    
    if (str=="")
    {
        document.getElementById("prop").innerHTML="";
        return;
    }
    
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("prop").innerHTML= "<br/>"+xmlhttp.responseText;
        }
    }
    
    xmlhttp.open("GET", base_url + "/item_property/load_property/" + str, true);
    xmlhttp.send();
}

function showProperties2(str0)
{
    str = ("" + str0).replace(/[\s-]+$/,'').split(/[\s-]/).pop();
    
    if (str=="")
    {
        document.getElementById("prop2").innerHTML="";
        return;
    }
    
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("prop2").innerHTML= "<br/>"+xmlhttp.responseText;
        }
    }
    
    xmlhttp.open("GET", base_url + "/item_property/load_properties/" + str, true);
    xmlhttp.send();
}

function showProperties3(str0, str1)
{
    str = ("" + str0).replace(/[\s-]+$/,'').split(/[\s-]/).pop();

    //alert(str);
    
    if (str=="")
    {
        document.getElementById("prop3").innerHTML="";
        document.getElementById("item_prp").value = "";
        return;
    }
    
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            //document.getElementById("item_prp").value = "";
            document.getElementById("prop3").innerHTML= "<br/>"+xmlhttp.responseText;
              itemsarray = [];  
              
              select_prop();
           
           // var itemsarray=new Array();
        }
    }
    
    xmlhttp.open("GET", base_url + "/item_property/show_properties/" + str + "/" + str1, true);
    xmlhttp.send();
}

function add_property_value(pc, pv, control, prp)
{
    var answer = confirm("Are you sure you want to add the value " + pv + " to the property " + prp);
    
    if (answer)
    {
        if (pv=="")
        {
            alert("Please Enter Property Value");

            control.focus();

            return;
        }

        if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert("Property Value Added");

                var newOpt = document.getElementById("cmb_pid" + control).appendChild(document.createElement('option'));
                newOpt.text = pv;

                document.getElementById(control).value = "";
            }
        }

        xmlhttp.open("GET", base_url + "/item_property/add_item_property_value/" + pc + "/" + pv, true);
        xmlhttp.send();
    }
}

function add_property_value2(pc, pv, control, prp)
{
    var answer = confirm("Are you sure you want to add the value <" + pv + "> to the property <" + prp + ">");
    
    if (answer)
    {
        if (pv=="")
        {
            alert("Please Enter Property Value");

            control.focus();

            return;
        }

        if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert("Property Value Added");

                var newOpt = document.getElementById("cmb_pid2" + control).appendChild(document.createElement('option'));
                newOpt.text = pv;
                newOpt.value = xmlhttp.responseText;

                document.getElementById("prp" + control).value = "";
                
                //alert(xmlhttp.responseText);
            }
        }

        xmlhttp.open("GET", base_url + "/item_property/add_item_property_value/" + pc + "/" + pv, true);
        xmlhttp.send();
    }
}
           
           
 //var itemsarray=new Array();
    
function get_property_code(pc, i)
{
   //alert(i);
   
   
  // var xx = $('#item_count').val();
      //   alert(xx);  
   
var item_count  = Number(document.getElementById("item_count").value);
 
 
 // alert(item_count);          
        for(var x=1;x<=item_count;x++)
        {
           
           if(x==i)
           {
           itemsarray[x] = pc;               
           }
       
            
        }         
        //alert(itemsarray);  
                           
       document.getElementById("item_prp").value =itemsarray;

}

$().ready(function() {
        $("#item_type").autocomplete(base_url + "/item_master/load_items", {
                width: 700,
                matchContains: true,
                //mustMatch: true,
                //minChars: 0,
                //multiple: true,
                //highlight: false,
                //multipleSeparator: ",",
                selectFirst: false
        });
});

$().ready(function() {
        $("#item_type2").autocomplete(base_url + "/item_master/load_items", {
                width: 525,
                matchContains: true,
                //mustMatch: true,
                //minChars: 0,
                //multiple: true,
                //highlight: false,
                //multipleSeparator: ",",
                selectFirst: false
        });
});

$().ready(function() {
        $("#item_type3").autocomplete(base_url + "/item_master/load_items", {
                width: 525,
                matchContains: true,
                //mustMatch: true,
                //minChars: 0,
                //multiple: true,
                //highlight: false,
                //multipleSeparator: ",",
                selectFirst: false
        });
});

$().ready(function() {
        $("#item_name_edit").autocomplete(base_url + "/item_master/load_item_names", {
                width: 700,
                matchContains: true,
                //mustMatch: true,
                //minChars: 0,
                //multiple: true,
                //highlight: false,
                //multipleSeparator: ",",
                selectFirst: false
        });
});

$().ready(function() {
        var st = $("#sup_type").val();
        $("#sup_name").autocomplete(base_url + "/po/purchase_order/load_suppliers/" + st, {
                width: 700,
                matchContains: true,
                //mustMatch: true,
                //minChars: 0,
                //multiple: true,
                //highlight: false,
                //multipleSeparator: ",",
                selectFirst: false
        });
});

$().ready(function() {
        $("#po_item_name").autocomplete(base_url + "/item_master/load_item_names", {
                width: 450,
                matchContains: true,
                //mustMatch: true,
                //minChars: 0,
                //multiple: true,
                //highlight: false,
                //multipleSeparator: ",",
                selectFirst: false
        });
});

/*
$(document).ready(function(){
    $("#x").click(function(){
        alert($("#sup_type").val());
        
        $('#sup_name').hide();
    });
});
*/

$(document).ready(function(){
    $("#item_name_edit").blur(function(){
        if($("#item_name_edit").val() == "")
        {
            $("#new_item_name_edit").val("");
            $("#item_type").val("");
            $("#item_prp").val("");
            $("#picture").val("");
            $("#txt_description").val("");
            $("#reorder_level").val("0");
            $("#reorder_quantity").val("0");
        }
        else
        {
           // get_item_name($("#item_name_edit").val());
          //  get_item_type($("#item_name_edit").val());
        }
    });
});




function get_item_name(item_code)
{
    if($("#item_name_edit").val() == "")
    {
        $("#new_item_name_edit").val("");
        $("#item_type").val("");
        $("#item_prp").val("");
        $("#picture").val("");
        $("#txt_description").val("");
        $("#reorder_level").val("0");
        $("#reorder_quantity").val("0");
        
        return;
    }
    
    // alert(1);
    
     $.ajax({
   type: "POST",   
   url: base_url+"/item_master/get_item_name/", 
   data: "item_code="+item_code,    
   success: function(msg){
    //  alert(msg);
     
 $('#new_item_name_edit').val(msg); 
 //get_item_type(item_code);
     
   }
   
 });   
    
    
    
    
    
}

function get_item_description(item_code)
{
    if(item_code != "")
    {
        if($("#item_name_edit").val() == "")
        {
            $("#new_item_name_edit").val("");
            $("#item_type").val("");
            $("#item_prp").val("");
            $("#picture").val("");
            $("#txt_description").val("");
            $("#reorder_level").val("0");
            $("#reorder_quantity").val("0");
            
            return;
        }
        
        // alert(1);
        
         $.ajax({
       type: "POST",   
       url: base_url+"/item_master/get_item_description/", 
       data: "item_code="+item_code,    
       success: function(msg){
       
           //alert(msg);
         
            $('#txt_description').val(msg);
         
       }
       
     });   
    }
    else
    {
        $('#txt_description').val("");
    }
}

function get_item_rol(item_code)
{
    if(item_code != "")
    {
        if($("#item_name_edit").val() == "")
        {
            $("#new_item_name_edit").val("");
            $("#item_type").val("");
            $("#item_prp").val("");
            $("#picture").val("");
            $("#txt_description").val("");
            $("#reorder_level").val("0");
            $("#reorder_quantity").val("0");
            
            return;
        }
        
        // alert(1);
        
         $.ajax({
       type: "POST",   
       url: base_url+"/item_master/get_item_rol/", 
       data: "item_code="+item_code,    
       success: function(msg){
       
           //alert(msg);
         
            $('#reorder_level').val(msg);
         
       }
       
     });
    }
    else
    {
        $('#reorder_level').val(0);
    }
}

function get_item_roq(item_code)
{
    if(item_code != "")
    {
        if($("#item_name_edit").val() == "")
        {
            $("#new_item_name_edit").val("");
            $("#item_type").val("");
            $("#item_prp").val("");
            $("#picture").val("");
            $("#txt_description").val("");
            $("#reorder_level").val("0");
            $("#reorder_quantity").val("0");
            
            return;
        }
        
        // alert(1);
        
         $.ajax({
       type: "POST",   
       url: base_url+"/item_master/get_item_roq/", 
       data: "item_code="+item_code,    
       success: function(msg){
       
           //alert(msg);
         
            $('#reorder_quantity').val(msg);
         
       }
       
     });   
    }
    else
    {
        $('#reorder_quantity').val(0);
    }
}

function get_item_type(item)
{
    item_code = ("" + item).replace(/[\s-]+$/,'').split(/[\s-]/).pop();

    item_name = item.replace(" - " + item_code, "");

    $.ajax
    ({
        type: "POST",   
        url: base_url+"/item_master/get_item_type/", 
        data: "item_code="+item_code,    
        success: function(msg)
        {
            $('#item_type').val(msg);
            $('#new_item_name_edit').val(item_name);

            if(isNaN(item_code) || item == "")
            {
                $('#item_type').val("");
                $('#new_item_name_edit').val("");
                $('#picture').val("");
                $('#files').html("<img src='" + base_url2 + "resources/images/no_image.gif' alt='No Image Available' style='width: 150px;' />");
            }

            //showProperties3($('#item_type').val(), item_code)

            if(item_code != "")
            {
                get_item_image(item_code);
                
                get_item_description(item_code);
                
                get_item_rol(item_code);
                
                get_item_roq(item_code);
                
                //select_prop();
            }
            else
            {
                $('#files').html("<img src='" + base_url2 + "resources/images/no_image.gif' alt='No Image Available' style='width: 150px;' />");
            }
        }
    });
}

function get_po_item_name(item)
{
    item_code = ("" + item).replace(/[\s-]+$/,'').split(/[\s-]/).pop();

    item_name = item.replace(" - " + item_code, "");

    $.ajax
    ({
        type: "POST",   
        url: base_url+"/item_master/get_item_type/", 
        data: "item_code="+item_code,    
        success: function(msg)
        {
            $('#item_type').val(msg);
            $('#new_item_name_edit').val(item_name);

            if(isNaN(item_code) || item == "")
            {
                $('#item_type').val("");
                $('#new_item_name_edit').val("");
                $('#picture').val("");
                $('#files').html("<img src='" + base_url2 + "resources/images/no_image.gif' alt='No Image Available' style='width: 150px;' />");
            }

            //showProperties3($('#item_type').val(), item_code)

            if(item_code != "")
            {
                get_item_image(item_code);
                
                get_item_description(item_code);
                
                get_item_rol(item_code);
                
                get_item_roq(item_code);
                
                //select_prop();
            }
            else
            {
                $('#files').html("<img src='" + base_url2 + "resources/images/no_image.gif' alt='No Image Available' style='width: 150px;' />");
            }
        }
    });
}

function select_prop()
{
    item_code = ("" + $("#item_name_edit").val()).replace(/[\s-]+$/,'').split(/[\s-]/).pop();
    
    var i = 1;
    var x = 1;

    if($("#item_count").val() != 0 && $("#item_count").val() != "")
    {
        while(i <= $("#item_count").val())
        {
            $.ajax({
                type: "POST",   
                url: base_url+"/item_property/select_prop/",
                data: "item_code="+item_code+"&prop_code="+$("#prid" + i).val(),
                success: function(msg)
                {
                    $("#ex_prp" + x).html("<b>: " + msg + "</b>");
                    
                    x++;
                }
            });
            
            //alert(x);
            //alert(i);
            
            i = i + 1;
        }
    }
}

function get_item_image(item_code)
{
    if(item_code != "")
    {
        $.ajax
        ({
            type: "POST",   
            url: base_url+"/item_master/get_item_image/" + item_code, 
            
            success: function(msg)
            {
                //alert(msg);
                
                //alert("-" + msg + "-");
                
                if(msg != "")
                {
                    $('#picture').val(msg);
                    
                    $('#files').html("<img src='" + base_url2 + "uploads/" + msg + "' alt='" + msg + "' style='width: 150px;' />"); 
                }
                else
                {
                    $('#picture').val("");
                                          
                    $('#files').html("<img src='" + base_url2 + "resources/images/no_image.gif' alt='No Image Available' style='width: 150px;' />");
                }
            }
        });
    }
    else
    {
        $('#files').html("");
    }
}


function addEmployee(){
    
    
   // alert(1);
    
    var Employee_Name = $('#Employee_Name').val();
    var Designation = $('#Designation').val();
    var Department_Code = $('#Department_Code').val();
    var Email = $('#Email').val();
    var Level_Code = $('#Level_Code').val();
    
    
  
  
      $.ajax({
   type: "POST",   
   url: base_url+"/login/add_new_employee/", 
   data: "Employee_Name="+Employee_Name+"&Designation="+Designation+"&Department_Code="+Department_Code+"&Email="+Email+"&Level_Code="+Level_Code,    
   success: function(msg){
  //  alert(msg);
     
 $('#addnewempmsg').html(msg); 
 //get_item_type(item_code);
     
   }
   
 });   
  
    
    
    
    
}

function add_item_to_po()
{
//    if($('#cmb_sup_type').val() == "" || $('#sup_name').val() == "" || $('#con_rate').val() == "" || $('#req_dept').val() == "" || $('#req_by').val() == "" || $('#pay_type').val() == "" || $('#curr').val() == "" || $('#con_rate').val() == "")
//    {
//        alert("Please Fill All The Mandatory Fields.");
//        
//        $('#dlg_add_item').dialog('close');
//        
//        return;
//    }
//    else if(isNaN($('#con_rate').val()))
//    {
//        alert("Please Enter Numeric Values For Conversion Rate");
//        
//        $('#dlg_add_item').dialog('close');
//        
//        $('#con_rate').focus();
//        
//        return;
//    }
//    else
//    {
        if($('#po_no').val() == "")
        {
            var sn = $('#sup_name').val();
            var od = $('#ord_date').val();
            var ed = $('#exp_date').val();
            var qn = $('#quote_no').val();
            var a = $('#attention').val();
            var d = $('#req_dept').val();
            var rb = $('#req_by').val();
            var pt = $('#pay_type').val();
            var c = $('#curr').val();
            var cr = $('#con_rate').val();
            var pr = $('#pay_remark').val();
            var pop = $('#po_purpose').val();
            var por = $('#po_remarks').val();

            $.ajax
            ({
                type: "POST",
                url: base_url+"/po/purchase_order/add_empty_po/",
                data: "sn="+sn+"&od="+od+"&ed="+ed+"&qn="+qn+"&a="+a+"&d="+d+"&rb="+rb+"&pt="+pt+"&c="+c+"&cr="+cr+"&pr="+pr+"&pop="+pop+"&por="+por,
                
                success: function(msg)
                {
                    if(trim(msg) != "")
                    {
                        $('#po_no').val(msg);
                    }
                    else
                    {
                        $('#po_no').val('');
                        
                        $('#dlg_add_item').dialog('close');
                        
                        alert("Error Creating PO. Please Try Again...");
                    }
                }
            });
        }
        
        //$('#po_number').html($('#po_no').val());
//    }
}

function select_currency()
{
    if($('#sup_type').val() == '0')
    {
        $('#curr').val('1')
        
        select_conv_rate();
    }
    else
    {
        $('#curr').val('')
        
        $('#con_rate').val('0.00');
    }
}

function select_conv_rate()
{
    if($('#curr').val() != '')
    {
        $.ajax({
            type: "POST",
            url: base_url+"/po/purchase_order/select_conv_rate",
            data: "cc="+$('#curr').val(),
            success: function(msg)
            {
                $('#con_rate').val(msg);
            }
        });
    }
    else
    {
        $('#con_rate').val('0.00');
    }
}

/*
$(function(){
}
$("#po_item_unit_price").maskMoney({thousands:'', decimal:'.'});
})

$(function(){
$("#po_qty").maskMoney({thousands:'', decimal:'.'});
})

$(function(){
$("#po_disc_per").maskMoney({thousands:'', decimal:'.'});
})

$(function(){
$("#po_disc").maskMoney({thousands:'', decimal:'.'});
})

$(function(){
$("#po_item_val").maskMoney({thousands:'', decimal:'.'});
})

$(function(){
$("#po_ind_tax").maskMoney({thousands:'', decimal:'.'});
})

$(function(){
$("#po_tax_val").maskMoney({thousands:'', decimal:'.'});
})
*/

$(document).ready(function(){
    $("#breakable").change(function(){
        if($("#breakable").val() == 'Yes')
        {
            $("#po_brk_unit").removeAttr('readonly');
            $("#po_brk_qty").removeAttr('readonly');
        }
        else if($("#breakable").val() == 'No')
        {
            $("#po_brk_unit").attr('readonly', 'readonly');
            $("#po_brk_qty").attr('readonly', 'readonly');
        }
    });
});

function add_items_to_po()
{
    var pono = $('#po_no').val();
    var ic = $('#po_item_name').val();
    var u = $('#po_item_unit').val();
    var up = $('#po_item_unit_price').val();
    var q = $('#po_qty').val();
    
    var d = $('#po_disc_per').val();
    if(d == '')
    {
        d = 0;
    }
    
    var da = $('#po_disc').val();
    if(da == '')
    {
        da = 0;
    }
    
    var iv = $('#po_item_val').val();
    
    var it = $('#po_ind_tax').val();
    if(it == '')
    {
        it = 0;
    }
    
    var tv = $('#po_tax_val').val();
    if(tv == '')
    {
        tv = 0;
    }
    
    var desc = $('#po_desc').val();
    
    if($('#po_item_name').val() == '' || $('#po_item_unit').val() == '' || $('#po_item_unit_price').val() == '' || $('#po_qty').val() == '' || jQuery.trim(iv) == '')
    {
        alert('Unable to save data. Please fill all mandatory fields and try again...');
        
        return;
    }
    
    if(d != '' && da != '')
    {
        alert('The Selected Item Cannot Have <Discount %> and <Discount Amount> Both');
        
        $('#po_disc_per').focus();
        $('#po_disc_per').select();
        
        return;
    }
    else if(it != '' && tv != '')
    {
        alert('The Selected Item Cannot Have <Individual Tax %> and <Individual Tax Value> Both');
        
        $('#po_ind_tax').focus();
        $('#po_ind_tax').select();
        
        return;
    }
    else
    {
        $.ajax({
            type: "POST",
            url: base_url+"/po/purchase_order/add_items_to_po",
            data: "pono="+pono+"&ic="+ic+"&u="+u+"&up="+up+"&q="+q+"&d="+d+"&da="+da+"&iv="+iv+"&it="+it+"&tv="+tv+"&desc="+desc,
            success: function(msg)
            {
                get_po_items(pono);
                
                alert("Item Added Successfully");

                $('#po_item_name').val('');
                $('#po_item_unit').val('');
                $('#po_item_unit_price').val('');
                $('#po_qty').val('');
                $('#po_disc_per').val('');
                $('#po_disc').val('');
                $('#po_item_val').val('');
                $('#po_ind_tax').val('');
                $('#po_tax_val').val('');
                $('#po_desc').val('');
            }
        });
    }
}

function calculate_item_value()
{
    //alert($('#po_item_unit_price').val());
    
    var up = jQuery.trim($('#po_item_unit_price').val());
    var qty = jQuery.trim($('#po_qty').val());
    var dp = jQuery.trim($('#po_disc_per').val());
    var d = jQuery.trim($('#po_disc').val());
    var it = jQuery.trim($('#po_ind_tax').val());
    var tv = jQuery.trim($('#po_tax_val').val());
    
    if(up == '')
    {
        up = 0;
    }
    
    if(qty == '')
    {
        qty = 0;
    }
    
    if(dp == '')
    {
        dp = 0;
    }
    
    if(d == '')
    {
        d = 0;
    }
    
    if(it == '')
    {
        it = 0;
    }
    
    if(tv == '')
    {
        tv = 0;
    }
    
    //alert(parseFloat(up) / parseFloat(qty));
    
    //var iv = parseFloat((parseFloat(up) - (((parseFloat(up) * parseFloat(dp)) / 100) + parseFloat(d)) + (((parseFloat(up) * parseFloat(it)) / 100) + parseFloat(tv))) * parseFloat(qty));
    
    var iv = ((parseFloat(up) - (parseFloat(up) * parseFloat(dp) / 100) + (parseFloat(parseFloat(up) - (parseFloat(up) * parseFloat(dp) / 100)) * parseFloat(it) / 100)) * parseFloat(qty)) - parseFloat(d) + parseFloat(tv);
    
    $('#po_item_val').val(iv);
}

function get_po_items(pono)
{
    $.ajax({
        type: "POST",
        url: base_url+"/po/purchase_order/get_po_items",
        data: "pono="+pono,
        success: function(msg)
        {
            $('#po_items').html(msg);
        }
    });
}

function delete_po_items(ic)
{
    var pono = $('#po_no').val();
    
    //alert(pono);
    
    if(confirm('Are you sure you want to delete the selected record?'))
    {
        $.ajax({
            type: "POST",
            url: base_url+"/po/purchase_order/delete_po_items",
            data: "pono="+pono+"&ic="+ic,
            success: function(msg)
            {
                //$('#po_items').html(msg);
                
                if(msg > 0)
                {
                    get_po_items(pono);
                }
                else
                {
                    alert('Error deleting the selected item. Try Again...');
                }
            }
        });
    }
}

function load_item_to_edit(ic)
{
    $('#ic2').val('');
    $('#ic2').val(ic);
}

function edit_po_items()
{
    //alert('sdffsdf');
}