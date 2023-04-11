<?php  include('header.php'); 
include('config.php'); 
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

error_reporting(0);
// $service_order_sql = "SELECT * FROM `formdata`";
 
            
			
			  
              if(isset($_POST['delete_rows'])){
              $checkbox = $_POST['checkboxx'];
			 // print_r($checkbox); die;
              for($i=0;$i<count($checkbox);$i++){
              $del_id = $checkbox[$i]; 
			//  print_r($del_id); die();
              mysqli_query($conn,"DELETE FROM formdata WHERE id='".$del_id."'");
           
		 
             }
			  echo   $message = "<div class='alert alert-success'> Data deleted successfully !</div>";

            }

 
 $service_order_sql = "SELECT * FROM `formdata`";
/* if(isset($_POST['hwe_filter'])){
//      $sql = mysqli_query($conn, "SELECT * FROM `formdata`");
 //     $row = mysqli_num_rows($sql);
         //search with single column value
      
	if(isset($_POST['name']) && !empty($_POST['name']))
		{
		$name = $_POST['name'];
	 	$service_order_sql .= "where name LIKE '%$name%'";
		}
    if(isset($_POST['company']) && !empty($_POST['company']))
		{
		$company = $_POST['company'];
	 	$service_order_sql .= "where company LIKE '%$company%'";
	 }
	if(isset($_POST['contact']) && !empty($_POST['contact']))
		{
		$contact = $_POST['contact'];
	 	$service_order_sql .= "where mobile_phone LIKE '%$contact%'";
	 }
	 if(isset($_POST['business_contact']) && !empty($_POST['business_contact']))
		{
		$business_contact = $_POST['business_contact'];
	 	$service_order_sql .= "where business_phone LIKE '%$business_contact%'";
	 }
	 if(isset($_POST['identity_card']) && !empty($_POST['identity_card']))
		{
		$identity_card = $_POST['identity_card'];
	 	$service_order_sql .= "where identity_card LIKE '%$identity_card%'";
	 }
	 if(isset($_POST['business_contact_2']) && !empty($_POST['business_contact_2']))
		{
		$business_contact_2 = $_POST['business_contact_2'];
	 	$service_order_sql .= "where business_phone_2 LIKE '%$business_contact_2%'";
	 }
	 if(isset($_POST['identity_card_2']) && !empty($_POST['identity_card_2']))
		{
		$identity_card_2 = $_POST['identity_card_2'];
	 	$service_order_sql .= "where identity_card_2 LIKE '%$identity_card_2%'";
	 }if(isset($_POST['business_fax']) && !empty($_POST['business_fax']))
		{
		$company = $_POST['business_fax'];
	 	$service_order_sql .= "where business_fax LIKE '%$business_fax%'";
	 }if(isset($_POST['residential_address_1']) && !empty($_POST['residential_address_1']))
		{
		$residential_address_1 = $_POST['residential_address_1'];
	 	$service_order_sql .= "where residential_address_1 LIKE '%$residential_address_1%'";
	 }if(isset($_POST['residential_address_2']) && !empty($_POST['residential_address_2']))
		{
		$residential_address_2 = $_POST['residential_address_2'];
	 	$service_order_sql .= "where residential_address_2 LIKE '%$residential_address_2%'";
	 }
	
   }*/
  // $service_order_query = mysqli_query($conn,$service_order_sql);
?>




	<script src="js/datatables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>

                <script>
    $(document).ready(function() {
		$('#userTable').DataTable();
    });  
	
    </script>
    <script>
    $(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});
$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
});
</script>
    
    
    <style>
body
{
	font-size:11.4px !important;
}
#close
{
	cursor:pointer !important;
}
#close1
{
	cursor:pointer !important;
}

#close2
{
	cursor:pointer !important;
}

#close3
{
	cursor:pointer !important;
}

#close4
{
	cursor:pointer !important;
}

#close5
{
	cursor:pointer !important;
}
#close6
{
	cursor:pointer !important;
}

#close7
{
	cursor:pointer !important;
}

#close8
{
	cursor:pointer !important;
}
#close9
{
	cursor:pointer !important;
}
body
{
	font-family: 'Open Sans', sans-serif;
	font-size: 15px !important;
	line-height: 1.5;
}



</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Dashboard</h1></center>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>





<?php 
if ($_SESSION['center_id'] == "5") {?>
    	<a href="account88.php" class="btn btn-success" style="min-width: 200px;">Account Card</a>
<?php } elseif ($_SESSION['center_id'] == "9") {?>
    	<a href="add_customer.php" class="btn btn-success" style="min-width: 200px;">Register New Customer</a>
    	<a href="customer_list.php" class="btn btn-success" style="min-width: 200px;">Customer List</a>
    	<a href="inquiry_list.php" class="btn btn-success" style="min-width: 200px;">Inquiry List</a>
    	<!-- <a href="loan_list.php" class="btn btn-success" style="min-width: 200px;">Loan List</a> -->
<?php } else {
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Customer Card' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
    	<a href="register_new_customer.php" class="btn btn-success" style="min-width: 200px;">Register New Customer</a>
    	<a href="customer_card.php" class="btn btn-success" style="min-width: 200px;">Customer Card</a>
<?php  }
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Customer' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {
  	if ($_SESSION['center_id'] == "6") {?>
    	<a href="ax_register_new_customer.php" class="btn btn-success" style="min-width: 200px;">Register New Customer</a>
<?php   	} else {?>
    	<a href="register_new_customer.php" class="btn btn-success" style="min-width: 200px;">Register New Customer</a>
<?php     }?>
    	<a href="customer.php" class="btn btn-success" style="min-width: 200px;">Customer Card</a>
  <?php }

  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Order List' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {
    if ($_SESSION['group_name'] == "admin") {?>
    	<a href="new_c&quotation.php" class="btn btn-success" style="min-width: 200px;" onclick="return confirmNew()">New Quotation</a>
    	<a href="order_list.php" class="btn btn-success" style="min-width: 200px;">Pending Order</a>
    	<a href="appointment_list.php" class="btn btn-success" style="min-width: 200px;">Job Appointment</a>
    	<a href="complete_order_list.php" class="btn btn-success" style="min-width: 200px;">Completed Order</a>
    
  <?php }}

  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Collection' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
    	<a href="collection.php" class="btn btn-success" style="min-width: 200px;">Collection</a>
<?php  }
}?>

<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Monthly Report' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
    	<a href="monthly_report.php" class="btn btn-success" style="min-width: 200px;">Monthly Report</a>
<?php  }?>

<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Monthly Report' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
    	<a href="collection.php" class="btn btn-success" style="min-width: 200px;">Loan Report</a>
<?php  }?>

<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Daily Report' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
    	<a href="daily_report.php" class="btn btn-success" style="min-width: 200px;">Daily Report</a>
<?php  }?>

<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Uncollected Report' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
    	<a href="uncollected_report.php" class="btn btn-success" style="min-width: 200px;">Uncollected Reports</a>
<?php  }?>


<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Customer Status Check' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
    	<a href="customer_status_check.php" class="btn btn-success" style="min-width: 200px;">Customer Status Inquiry</a>
<?php  }?>
<?php 
    
    if($_SESSION["group_name"] =='superadmin'){     
      ?>
    	<a href="hwe_center_maintainace.php" class="btn btn-success" style="min-width: 200px;">Center management</a>
    	<a href="user_maintenance.php" class="btn btn-success" style="min-width: 200px;">User Management</a>
                  <?php 
      }
       ?>
                  <?php 
    
    if($_SESSION["group_name"] =='admin'){
      $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'User Maintenance' ORDER BY date_time DESC LIMIT 1;";
      $res = mysqli_query($conn, $sql);
      $myrow = mysqli_fetch_assoc($res);
      if ($myrow['status'] == 1) {?>
    	<a href="user_maintenance.php" class="btn btn-success" style="min-width: 200px;">User Management</a>
       <?php }
      $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Product List' ORDER BY date_time DESC LIMIT 1;";
      $res = mysqli_query($conn, $sql);
      $myrow = mysqli_fetch_assoc($res);
      if ($myrow['status'] == 1) {?>
    	<a href="product_list.php" class="btn btn-success" style="min-width: 200px;">Product Management</a>
    	<a href="track_list.php" class="btn btn-success" style="min-width: 200px;">Track Management</a>
    	<a href="design_list.php" class="btn btn-success" style="min-width: 200px;">Design Management</a>
       <?php }
      }
       ?>
    </section>

    <!-- Main content -->
  
  <!--<script> 
    		$(document).ready(function() { 
		    
			$("#sources").on('change', function() { 
		//	jQuery('#show_processing').show();
		//	alert("dhgshg");
			var selected_value  =	 $("#sources").val();
			
		//	var unique_code_string =	 $("#unique_code_string").val();
		//	alert(selected_value);
		//	alert(customer_information);
		//	alert(property_information);
		//	alert(share_holding_percentege);
			$('#show_search_data').val(selected_value)
 					
		    	});
					
		    });
	</script>-->
    <script>
	$(document).ready(function(){
	  $("#show_search_data").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#userTable tr").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		  	
		});
	  });
	});
	function confirmNew() {
		var x = confirm("Is this new customer?");
    if (x == true) {
    	return true;
    } else {
    	window.location = 'old_c&quotation.php';
    	return false;
    }
  }
</script>
<script> 	
            $(document).ready(function(){
	    	$('.val').on('click', function() { 
			$("option[class='val']").attr("disabled","disabled"); 
			$('#GFG_DOWN').css("display","block");
			$('#close').css("display","block");
         	$("option[id='option_vall']").attr("selected","selected")
			$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").attr("name","name");
			$("input[id='search_and_view']").attr("class","form-control name");
			 
    	});
	    	$('.val_1').on('click', function() { 
			$("option[class='val_1']").attr("disabled","disabled"); 
			$('#GFG_DOWN1').css("display","block")
			$('#close1').css("display","block")
		 	$("option[id='option_vall']").attr("selected","selected")
			$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","name");
			$("input[id='search_and_view']").attr("name","company");  
			$("input[id='search_and_view']").attr("class","form-control company");
		}); 
    		$('.val_2').on('click', function() { 
			$("option[class='val_2']").attr("disabled","disabled"); 
			$('#GFG_DOWN2').css("display","block")
			$('#close2').css("display","block") 
		 	$("option[id='option_vall']").attr("selected","selected")
        	$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","company");
			$("input[id='search_and_view']").attr("name","contact");
            $("input[id='search_and_view']").attr("class","form-control contact");
		}); 
		$('.val_3').on('click', function() { 
			$("option[class='val_3']").attr("disabled","disabled"); 
			$('#GFG_DOWN3').css("display","block")
			$('#close3').css("display","block") 
		 	$("option[id='option_vall']").attr("selected","selected")
    	   	$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","contact");
			$("input[id='search_and_view']").attr("name","business_contact"); 
			$("input[id='search_and_view']").attr("class","form-control business_contact");
		}); 
		$('.val_4').on('click', function() { 
			$("option[class='val_4']").attr("disabled","disabled"); 
			$('#GFG_DOWN4').css("display","block")
			$('#close4').css("display","block") 
		 	$("option[id='option_vall']").attr("selected","selected")
	    	$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","business_contact");
			$("input[id='search_and_view']").attr("name","identity_card"); 
    		$("input[id='search_and_view']").attr("class","form-control identity_card");	
		}); 
		$('.val_5').on('click', function() { 
			$("option[class='val_5']").attr("disabled","disabled"); 
		    $('#GFG_DOWN5').css("display","block")
			$('#close5').css("display","block") 
		 	$("option[id='option_vall']").attr("selected","selected")
		   	$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","identity_card");
			$("input[id='search_and_view']").attr("name","business_contact_2"); 
			$("input[id='search_and_view']").attr("class","form-control business_contact_2");
		}); 
		$('.val_6').on('click', function() { 
			$("option[class='val_6']").attr("disabled","disabled"); 
	        $('#GFG_DOWN6').css("display","block")
			$('#close6').css("display","block")
		 	$("option[id='option_vall']").attr("selected","selected")
	    	$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","business_contact_2");
			$("input[id='search_and_view']").attr("name","identity_card_2"); 
			$("input[id='search_and_view']").attr("class","form-control identity_card_2");
		}); 
		$('.val_7').on('click', function() { 
			$("option[class='val_7']").attr("disabled","disabled"); 
            $('#GFG_DOWN7').css("display","block")
			$('#close7').css("display","block")
		 	$("option[id='option_vall']").attr("selected","selected")
    		$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","identity_card_2");
			$("input[id='search_and_view']").attr("name","business_fax"); 
			$("input[id='search_and_view']").attr("class","form-control business_fax");
		}); 
		$('.val_8').on('click', function() { 
			$("option[class='val_8']").attr("disabled","disabled"); 
			$('#GFG_DOWN8').css("display","block")
			$('#close8').css("display","block")
		 	$("option[id='option_vall']").attr("selected","selected")
			$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","business_fax");
			$("input[id='search_and_view']").attr("name","residential_address_1"); 
			$("input[id='search_and_view']").attr("class","form-control residential_address_1");
		}); 
			$('.val_9').on('click', function() { 
			$("option[class='val_9']").attr("disabled","disabled"); 
    		$('#GFG_DOWN9').css("display","block")
			$('#close9').css("display","block")
		 	$("option[id='option_vall']").attr("selected","selected")
			$("select[id='vall']").attr("disabled","disabled"); 
			$("input[id='search_and_view']").removeAttr("name","residential_address_1");
			$("input[id='search_and_view']").attr("name","residential_address_2"); 
			$("input[id='search_and_view']").attr("class","form-control residential_address_2");
		}); 
		
	}); 	
</script>

<script>
         $(document).ready(function(){
	    	$('#close').on('click', function() { 
		    $("#close").css("display","none");
		    $("#GFG_DOWN").css("display","none");
			$("option[class='val']").removeAttr("disabled","disabled");
		});
		  	$('#close1').on('click', function() { 
		    $("#close1").css("display","none");
		    $("#GFG_DOWN1").css("display","none");
			$("option[class='val_1']").removeAttr("disabled","disabled");
		});
		  	$('#close2').on('click', function() { 
		    $("#close2").css("display","none");
		    $("#GFG_DOWN2").css("display","none");
			$("option[class='val_2']").removeAttr("disabled","disabled");
		});
		  	$('#close3').on('click', function() { 
		    $("#close3").css("display","none");
		    $("#GFG_DOWN3").css("display","none");
			$("option[class='val_3']").removeAttr("disabled","disabled");
		});
		  	$('#close4').on('click', function() { 
		    $("#close4").css("display","none");
		    $("#GFG_DOWN4").css("display","none");
			$("option[class='val_4']").removeAttr("disabled","disabled");
		});
		  	$('#close5').on('click', function() { 
		    $("#close5").css("display","none");
		    $("#GFG_DOWN5").css("display","none");
			$("option[class='val_5']").removeAttr("disabled","disabled");
		});
		  	$('#close6').on('click', function() { 
		    $("#close6").css("display","none");
		    $("#GFG_DOWN6").css("display","none");
			$("option[class='val_6']").removeAttr("disabled","disabled");
		});
		  	$('#close7').on('click', function() { 
		    $("#close7").css("display","none");
		    $("#GFG_DOWN7").css("display","none");
			$("option[class='val_7']").removeAttr("disabled","disabled");
		});
		  	$('#close8').on('click', function() { 
		    $("#close8").css("display","none");
		    $("#GFG_DOWN8").css("display","none");
			$("option[class='val_8']").removeAttr("disabled","disabled");
		});
		  	$('#close9').on('click', function() { 
		    $("#close9").css("display","none");
		    $("#GFG_DOWN9").css("display","none");
			$("option[class='val_9']").removeAttr("disabled","disabled");
		});				
	});
</script> 
 <!--
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('.tm-input').tagsManager();
});
</script>-->
<script>
       $(document).ready(function(){
	    	$('#add_filter').on('click', function() { 

			$("select[id='vall']").removeAttr("disabled","disabled"); 
			
			});
	   });
</script>
<script> 
    		$(document).ready(function() { 
		    
			$("#hwe_filter").on('click', function() { 
		//	jQuery('#show_processing').show();
		//	alert("dhgshg");
			var name                        =	 $(".name").val();
			var company                     =	 $(".company").val();
			var contact                     =	 $(".contact").val();
			var business_contact            =	 $(".business_contact").val();
			var identity_card               =	 $(".identity_card").val();
			var business_contact_2          =	 $(".business_contact_2").val();
			var identity_card_2             =	 $(".identity_card_2").val();
			var business_fax                =	 $(".business_fax").val();
			var residential_address_1       =	 $(".residential_address_1").val();
			var residential_address_2       =	 $(".residential_address_2").val();
			
		//	var unique_code_string =	 $("#unique_code_string").val();
		//	alert(name);
		//	alert(company);
		//	alert(contact);
		//	alert(business_contact);
		//	alert(identity_card);
		//	alert(business_contact_2);
		//	alert(identity_card_2);
		//	alert(business_fax);
		//	alert(residential_address_1);
		//	alert(residential_address_2);
			
 			$.ajax({
				type: "POST",
				url: 'ajax/hwe_filter_result.php',
				data: { 
	     			name: name,
					company: company,
					contact: contact,
					business_contact: business_contact,
					identity_card: identity_card,
					business_contact_2: business_contact_2,
					identity_card_2: identity_card_2,
					business_fax: business_fax,
					residential_address_1: residential_address_1,
					residential_address_2: residential_address_2,
					
				},
				success: function(result) {
					  //  alert(result);
						  if(result) 
						  {
							  jQuery("#filtered_table").html(result);
						  }
					
					//		jQuery('#show_processing').hide();					
						//	$("#mail_sent_success").html("<div class='alert alert-success' role='alert'>Form Sent successfully.</div>");
						//	jQuery('#name').val('');
						//	jQuery('#email').val('');
						//	jQuery('#msg_subject').val('');
						//	jQuery('#message').val('');
						}
					});				
		    	});
					
		    });
	</script>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="row">
          
            <!--<div class="search_up">
            
           
              <div onclick="myFunction1()" class="w3-button" style="display:flex !important; background-color:unset !important; padding:unset !important">
            <i class="fa fa-search" aria-hidden="true" style="font-size:25px; cursor:pointer; padding-top:10%"></i>
            <i class="fa fa-caret-down " aria-hidden="true"  onclick="myFunction()" style="margin-left:1%;font-size:40px;margin-top:-5%;  cursor:pointer;"></i>
          
           
               <!-- <button  class="w3-button w3-black">Click Me!</button>
                <div id="Demo" class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="#" class="w3-bar-item w3-button">All</a>
                  <a href="#" class="w3-bar-item w3-button">Customer Information </a>
                  <a href="#" class="w3-bar-item w3-button">Property Information</a>
                  <a href="#" class="w3-bar-item w3-button">Share & Holding Percentege</a>
                </div>
              </div>
            </div>-->
            
            
		
             
                    <?php  

/*$result_db = mysqli_query($conn,"SELECT COUNT(id) FROM formdata"); 
$row_db = mysqli_fetch_row($result_db);  

//print_r($row_db); die();

$total_records = $row_db[0];  
$total_pages = ceil($total_records / $limit); 
//echo $total_pages; die();
/* echo  $total_pages; 
$pagLink = "<ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='page-link' href='search_result.php?page=".$i."'>".$i."</a></li>";	
}
echo $pagLink . "</ul>";  */
?>     
                   </div>
                 
                  </div>
                  </div>

                </div>
                
				
                
			</div>
            <!-- /.card -->
            </div>
         
          <!-- /.col -->
        </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
  </footer>

 
</div>

<!-- ./wrapper -->

<!-- jQuery -->

<!-- Page specific script -->
<script>
  /*$(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });*/
  
  function hwe_show_logout_dorpdown()
  {
	 jQuery('.dropdown_content_logout').toggle();
  }
</script>
<script>
$("#checkAll").change(function(){

  if (! $('input:checkbox').is('checked')) {
      $('input:checkbox').attr('checked','checked');
  } else {
      $('input:checkbox').removeAttr('checked');
  }       
});
</script>
   
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


 <script>
  $(".btn_imports_contact").on("click", function(){
	  {

  $("#excelfile").click()

	  }
  });
</script>
<!-- <script>
   $('.btn_imports_contact').click()
   {
	   $('#excelfile').click();
   }
   </script>
--><script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<script type="">
        $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
        $('.checkbox').change(function(){ //".checkbox" change 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });
</script>
<script>
function myFunction1() {
  var x = document.getElementById("Demo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
<!--<script>


    function ExportToTable() {  
	
         var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;  
         /*Checks whether the file is a valid excel file*/  
         if (regex.test($("#excelfile").val().toLowerCase())) {  
             var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/  
             if ($("#excelfile").val().toLowerCase().indexOf(".xlsx") > 0) {  
                 xlsxflag = true;  
             }  
             /*Checks whether the browser supports HTML5*/  
             if (typeof (FileReader) != "undefined") {  
                 var reader = new FileReader();  
                 reader.onload = function (e) {  
                     var data = e.target.result;  
                     /*Converts the excel data in to object*/  
                     if (xlsxflag) {  
                         var workbook = XLSX.read(data, { type: 'binary' });  
                     }  
                     else {  
                         var workbook = XLS.read(data, { type: 'binary' });  
                     }  
                     /*Gets all the sheetnames of excel in to a variable*/  
                     var sheet_name_list = workbook.SheetNames;  
      
                     var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/  
                     sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/  
                         /*Convert the cell value to Json*/  
                         if (xlsxflag) {  
                             var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);  
                         }  
                         else {  
                             var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
                         }  
                         if (exceljson.length > 0 && cnt == 0) {  
                             BindTable(exceljson, '#exceltable');  
                             cnt++;  
                         }  
                     });  
                     $('#exceltable').show();  
                 }  
                 if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/  
                     reader.readAsArrayBuffer($("#excelfile")[0].files[0]);  
                 }  
                 else {  
                     reader.readAsBinaryString($("#excelfile")[0].files[0]);  
                 }  
             }  
             else {  
                 alert("Sorry! Your browser does not support HTML5!");  
             }  
         }  
         else {  
             alert("Please upload a valid Excel file!");  
         }  
     }  

    function BindTable(jsondata, tableid) {/*Function used to convert the JSON array to Html Table*/  
         var columns = BindTableHeader(jsondata, tableid); /*Gets all the column headings of Excel*/  
         for (var i = 0; i < jsondata.length; i++) {  
             var row$ = $('<tr/>');  
             for (var colIndex = 0; colIndex < columns.length; colIndex++) {  
                 var cellValue = jsondata[i][columns[colIndex]];  
                 if (cellValue == null)  
                     cellValue = "";  
                 row$.append($('<td/>').html(cellValue));  
             }  
             $(tableid).append(row$);  
         }  
     }  
     function BindTableHeader(jsondata, tableid) {/*Function used to get all column names from JSON and bind the html table header*/  
         var columnSet = [];  
         var headerTr$ = $('<tr/>');  
         for (var i = 0; i < jsondata.length; i++) {  
             var rowHash = jsondata[i];  
             for (var key in rowHash) {  
                 if (rowHash.hasOwnProperty(key)) {  
                     if ($.inArray(key, columnSet) == -1) {/*Adding each unique column names to a variable array*/  
                         columnSet.push(key);  
                         headerTr$.append($('<th/>').html(key));  
                     }  
                 }  
             }  
         }  
         $(tableid).append(headerTr$);  
         return columnSet;  
     }  


</script>-->
  
    <style>
	.dataTables_length
	{
		display:none;
	}
	.link_add_filter {
    padding-left:5%;
	margin:auto;
}
	a.link_add_filter:hover 
	{
		text-decoration:none;
		
	}
	.dataTables_filter
	{
		display:none;
	}
	
 .list-group.list-group-unbordered a {
	color: #337ab7;
	 
	position: absolute;
	margin-left: 13px;
}
  .box-body {
    /*! border-top-left-radius: 0; */
    /*! border-top-right-radius: 0; */
    /*! border-bottom-right-radius: 3px; */
    /*! border-bottom-left-radius: 3px; */
    padding: 10px;
}

.profile-user-img {
    margin: 0 15% 0 25%;
    width: 100px;
    padding: 3px;
    border: 3px solid #d2d6de;
}
 .box-primary {
    border-top: 3px solid #01BC8C;
}


.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}

.box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
	padding: 8px;
	line-height: 1.42857143;
	vertical-align: top;
	border: 1px solid #ddd;
}
.content-header {
	background: #f1f1f1;
	box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.05);
	border-bottom: 1px solid #d0d0d0;
	min-height: 54px;
	height: auto;
	margin-bottom: 20px;
}
.content-header h1 {
	color: #0e0d0d;
	font-size: 22px;
	font-weight: 500;
}

#users a {
	color: #337ab7;
}

.card-body {
	color: #27292a;
	font-size: 18px;
	font-weight: 500;
	cursor: pointer;
	padding: 10px;
}




.hwe_content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
 


 div.box 
 {
 	 height: auto !important;
	
	 border-color: black;
	 	 background:#fff !important;
 }
 div.box1 
 {
 	 height: 40px !important;
	 background:#fff !important;
	 border-color: black;
 }
 
 div.box2
 {
 	 height: 40px !important;
	 background:#fff !important;
	 border-color: black;
 } 
 
 .box-header1
 {
	 padding:unset !important;
	 
 }
 .contact_text_main  {
	margin-left: 5%;
	padding-top: 2.5%;
}
.plus_plus_plus {
	width: 11%;
	background: #a49eaa;
	border-radius: 69%;
	margin-left: 5%;
	color: #FFF;
	font-size: 22px;
	padding-left: 3.7%;
	padding-top: 2.3%;
	padding-bottom: 2%;
}
.btn_imports_contact 
{
	margin-top:1%;
    margin-left: 2%;
	font-size:13px !important;
}
.btn_imports_down_angle
{
		margin-top:1%;
        font-size:13px !important;
}
.search_up {
	width: 8%;
	margin-left: 4%;
	height: 9%;
	text-align: center;
	padding-top: 0.5%;
	background: #fff;
	margin-bottom: 1%;
	padding-bottom: 1%;
	padding-right: 1%;
	padding-left: 1%;
}
/*.extra_text {
	

	margin-left: 75%;
	margin-top:-13%;
}*/
#userTable_paginate	
{
	display:none;
}




.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}

.container-fluid {
	 width: 100%; 
	 padding-right:0px !important; 
	 padding-left:0px !important;
	 margin-right: auto; 
	 margin-left: auto; 
	left: 0;
}
body {
  background: #ededed;
  font-family: 'Open Sans', sans-serif;
}
.center {
  position: absolute;
  display: inline-block;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
}

/** Custom Select **/
.custom-select-wrapper {
  position: relative;
  display: inline-block;
  user-select: none;
}
  .custom-select-wrapper select {
    display: none;
  }
  .custom-select {
    position: relative;
    display: inline-block;
  }
    .custom-select-trigger {
      position: relative;
      display: block;
      width: 130px;
      padding: 0 84px 0 22px;
      font-size: 22px;
      font-weight: 300;
      color: #fff;
      line-height: 60px;
      background: #5c9cd8;
      border-radius: 4px;
      cursor: pointer;
    }
      .custom-select-trigger:after {
        position: absolute;
        display: block;
        content: '';
        width: 10px; height: 10px;
        top: 50%; right: 25px;
        margin-top: -3px;
        border-bottom: 1px solid #fff;
        border-right: 1px solid #fff;
        transform: rotate(45deg) translateY(-50%);
        transition: all .4s ease-in-out;
        transform-origin: 50% 0;
      }
      .custom-select.opened .custom-select-trigger:after {
        margin-top: 3px;
        transform: rotate(-135deg) translateY(-50%);
      }
  .custom-options {
    position: absolute;
    display: block;
    top: 100%; left: 0; right: 0;
    min-width: 100%;
    margin: 15px 0;
    border: 1px solid #b5b5b5;
    border-radius: 4px;
    box-sizing: border-box;
    box-shadow: 0 2px 1px rgba(0,0,0,.07);
    background: #fff;
    transition: all .4s ease-in-out;
    
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(-15px);
  }
  .custom-select.opened .custom-options {
    opacity: 1;
    visibility: visible;
    pointer-events: all;
    transform: translateY(0);
  }
    .custom-options:before {
      position: absolute;
      display: block;
      content: '';
      bottom: 100%; right: 25px;
      width: 7px; height: 7px;
      margin-bottom: -4px;
      border-top: 1px solid #b5b5b5;
      border-left: 1px solid #b5b5b5;
      background: #fff;
      transform: rotate(45deg);
      transition: all .4s ease-in-out;
    }
    .option-hover:before {
      background: #f9f9f9;
    }
    .custom-option {
      position: relative;
      display: block;
      padding: 0 22px;
      border-bottom: 1px solid #b5b5b5;
      font-size: 18px;
      font-weight: 600;
      color: #b5b5b5;
      line-height: 47px;
      cursor: pointer;
      transition: all .4s ease-in-out;
    }
    .custom-option:first-of-type {
      border-radius: 4px 4px 0 0;
    }
    .custom-option:last-of-type {
      border-bottom: 0;
      border-radius: 0 0 4px 4px;
    }
    .custom-option:hover,
    .custom-option.selection {
      background: #f9f9f9;
    }
    .checked_all{
		width:15px !important;
	}
	


</style>
</body>
</html>
