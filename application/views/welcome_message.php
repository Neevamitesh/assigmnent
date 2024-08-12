<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
  <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= base_url(); ?>assets/css/app-style.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('assets/css/select.css');?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'>
    <script src="https://code.jquery.com/ui/1.13.0-rc.3/jquery-ui.min.js"></script>
	<style type="text/css">
	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }
	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}
	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
		text-align: center;
	}
	#body {
		margin: 0 15px 0 15px;
	}
	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	.trw{
		margin-top: -15px;
	    margin-bottom: 10px;
	    margin-left: 67%;
	    width: 330px;
	}
	h6{
		color: #4CAF50;
	}
	.btnbot{
		margin-bottom: 20px;
    	margin-left: 80%;
	}
	</style>
</head>
<body>
<div id="container">
	<h1>Generate Invoice</h1>
	<div id="body">
		<form method="post" action="<?= base_url("Welcome/AddInvoice"); ?>">
		<div class="row" id="auth" style="margin-bottom: 10px;">
			<div class="col-md-3" style="margin-left: 300px;">
                <label>Select Firm</label>
                <select class="form-control sel-prd select2" id="firmid" name="firm" required="true">
                    <option value="">Select Firm</option>
                    <?php
                    foreach ($firm->result() as $row) {
                    ?>
                        <option value="<?= $row->FirmID ?>"><?= $row->FirmName ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Select Vendor</label>
                <select class="form-control sel-size select2" id="sel-vendor" name="vendor" required="true">
                    <option value="">Select Vendor</option>
                    <?php
                    foreach ($vendor->result() as $row) {
                    ?>
                        <option value="<?= $row->VendorID ?>"><?= $row->VendorName ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
		</div>
		<div class="" id="division" hidden>
			<div class='row'>
		          <div class='col-md-12'>
		            <h5 class='text-success'>Product Details</h5>
		            <table class='table table-bordered'>
		              <thead>
		                <tr>
		                  <th>Product</th>
		                  <th>Price</th>
		                  <th>Qty</th>
		                  <th>Total</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody id='product_tbody'>
		                <tr>
		                  <td>
		                  	<select name="pname[]" class="form-control select2" required>
                            		<option value="">Select Product</option>
                            		<?php foreach ($product->result() as $key => $value) { ?>
                            		<option value="<?= $value->ProductID?>"><?= $value->ProductName?>
                            		</option>
                            	<?php }?>
                            </select>
                          </td>
		                  <td><input type='text' required name='price[]' class='form-control price' required></td>
		                  <td><input type='text' required name='qty[]' class='form-control qty' required></td>
		                  <td><input type='text' required name='total[]' class='form-control total' required></td>
		                  <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td>
		                </tr>
		              </tbody>
		              <tfoot>
		                <tr>
		                  <td><input type='button' value='+ Add Row' class='btn btn-primary btn-sm' id='btn-add-row'></td>
		                  <td colspan='2' class='text-right'>Total</td>
		                  <td><input type='text' name='grand_total' id='grand_total' class='form-control' required></td>
		                </tr>
		              </tfoot>
		            </table>
		          </div>
        	</div>
            <div class="form-group">
            	<h6>Vendor Details</h6>
            	<div class="row">
            		<div class="col-md-6">
            			<label>Shop Name :</label>
            			<textarea type="text" name="shop" id="shopid" class="form-control" placeholder="ShopName"></textarea>
            		</div>
	            	<div class="col-md-6">
	            		<label>Phone No :</label>
	            		<textarea type="text" name="phone" id="phoneid" class="form-control" placeholder="PhoneNo"></textarea>
	            	</div>
            	</div>
            	<br>
            	<div class="row">
            		<div class="col-md-12">
            			<label>Address :</label>
            			<textarea name="address" id="addressid" class="form-control" placeholder="Address"></textarea>
            		</div>
            	</div>
            </div>
            <div class="form-group">
            	<h6>Comments & Special Instructions</h6>
            	<div class="row">
            		<div class="col-md-6">
            			<label>Bank :</label>
            			<input type="text" name="bankname" id="bankid" class="form-control" placeholder="Enter Bank Name">
            		</div>
	            	<div class="col-md-6">
	            		<label>Branch :</label>
	            		<input type="text" name="branchname" id="branchid" class="form-control" placeholder="Enter Branch Name">
	            	</div>
            	</div>
            	<br>
            	<div class="row">
            		<div class="col-md-6">
            			<label>Account No :</label>
            			<input type="number" name="account" id="accountid" class="form-control" placeholder="Enter Account No ">
            		</div>
	            	<div class="col-md-6">
	            		<label>IDFC Code :</label>
	            		<input type="text" name="idfc" id="idfcid" class="form-control" placeholder="Enter IDFC Code">
	            	</div>
            	</div>
            	<br>
            	<div class="row">
            		<div class="col-md-12">
            			<label>Enter Additional Instruction :</label>
            			<textarea name="instruction" id="instructionid" class="form-control" placeholder="Enter Additional Instruction"></textarea>
            		</div>
            	</div>
            </div>
            <button type="submit" class="btn btn-success btnbot">Save Invoice</button>
		</div>
		</form>
	</div>
</div>
</body>
  <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
  <script src="<?= base_url();?>assets/js/jquery-ui.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/popper.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="<?= base_url('assets/js/select2.js')?>"></script>
<script>
  	$("#firmid").change(function() {
    var a = $("#firmid").val();
    console.log(a);
    if(a == 1){
        $('#division').removeClass('hidden');
        $('#division').prop('hidden',false);
        $('#division').prop('disabled',false);
    }else{
    	alert("Form Not Available for this Firm");
    	$('#division').addClass('hidden');
    	$('#division').prop('hidden',true);
        $('#division').prop('disabled',true);
    }
	});
    function MySearch() {
        $(".select2").select2({
            width:'element',
            heigth:'100%',
        });
        // $('#Product,#PrdCode').select2({
        //     width:'100%'
        // });
    }
        $(function(){
            MySearch();
        });

	function BtnAdd(){
		var v = $("#TRow").clone().appendTo("#TBody");
		$(v).find("input").val('');
		$(v).removeClass("d-none");
	}    
	function BtnDelete(v){
		$(v).parent().parent().remove();
	}
	function Calc(v){
		var index = $(v).parent().parent().index();
		var rate = document.getElementsByName("rate")[index].value;
		var qty = document.getElementsByName("qty")[index].value;
		var amt = qty * rate;
		document.getElementsByName("amt")[index].value = amt;
		GetTotal();
	}
	function GetTotal(){
		var sum = 0;
		var amts = document.getElementsByName("amt");
		for (let index = 0; index < amts.length; index++) {
			var amt = amts[index].value;
			sum = +(sum) +  +(amt) ;
		}
		document.getElementById("FTotal").value = sum;
	}

	$(document).ready(function() {
        $("#sel-vendor").change(function(){
            console.log('Check');
            var Vendors = $("#sel-vendor").val();
            console.log(Vendors);
            $.ajax({
                type: 'POST',
                url: "<?= base_url('Welcome/GetVendorInfo')?>",
                data:{
                    Vendors:Vendors,
                },
                success:function(data){
                    var data = JSON.parse(data);
                   console.log(data);
                    $("#addressid").html(data.Address);
                    $("#phoneid").html(data.Phone);
                    $("#shopid").html(data.ShopName);
                }
            });
            // $.ajax ({
			//         type: "POST",
			//         url: "<?= base_url('Welcome/GetVendorInfo')?>",
			//         data:{
            //         Vendors:Vendors,
            //     	},
			//         dataType: 'JSON',
			//         success: function(data) {
			//             // console.debug(data);
			//             $('#ShopName').val(data.ShopName);
			//             $('#Phone').val(data.Phone);
			//             $('#Address').val(data.Address);
			//         }
    		// });
         });

        $("#btn-add-row").click(function(){
          var row="<tr><td><select name='pname[]' class='form-control select2'><option value=''>Select Product</option><?php foreach ($product->result() as $key => $value) { ?><option value='<?= $value->ProductID?>'><?= $value->ProductName?></option><?php }?></select></td> <td><input type='text' required name='price[]' class='form-control price'></td> <td><input type='text' required name='qty[]' class='form-control qty'></td> <td><input type='text' required name='total[]' class='form-control total'></td> <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td> </tr>";
          $("#product_tbody").append(row);
        });
        
        $("body").on("click",".btn-row-remove",function(){
          if(confirm("Are You Sure?")){
            $(this).closest("tr").remove();
            grand_total();
          }
        });

        $("body").on("keyup",".price",function(){
          var price=Number($(this).val());
          var qty=Number($(this).closest("tr").find(".qty").val());
          $(this).closest("tr").find(".total").val(price*qty);
          grand_total();
        });
        
        $("body").on("keyup",".qty",function(){
          var qty=Number($(this).val());
          var price=Number($(this).closest("tr").find(".price").val());
          $(this).closest("tr").find(".total").val(price*qty);
          grand_total();
        });      
        
        function grand_total(){
          var tot=0;
          $(".total").each(function(){
            tot+=Number($(this).val());
          });
          $("#grand_total").val(tot);
        }
    });
</script>
</html>