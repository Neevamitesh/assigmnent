<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Invoice</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'>
    <script src="https://code.jquery.com/ui/1.13.0-rc.3/jquery-ui.min.js"></script>
    <style>
    	#Address{text-align: left;font-size:85%;}
    	#ToAddress{margin-left:36em; margin-top: -10em;font-size:85%;}
    	.uptable,.upth,.uptd{border:1px solid black; background-color: cornsilk;border-collapse: collapse;}
    	.dwtable,.dwth,.dwtd{border:1px solid black;border-collapse: collapse;}
    	.dwth{color: white;}
    	.dwtr{height: 30px;}
    	#shipadd{margin-left:28em; margin-top: -10em;font-size:85%;}
    	.ami{
    		color: white;
    		padding: 7px 0px 0px 10px;
			max-width: 200px;
			min-width:200;
			background:darkmagenta;
			display:inline-block;
			vertical-align: top;
    	}
    	.sarth{
    		color: white;
    		padding: 7px 0px 0px 10px;
    		max-width: 200px;
			min-width:200;
			background:darkmagenta;
			display:inline-block;
			vertical-align: top;
    	}
    </style>
</head>
<body>
	<div class="container">
		<div class="row">
            <div class="col-md-3" style="word-wrap: break-word;" id="Address">
                    <div class="class body">
                        <div class="textheight" > <b> OMUNIM SOFTWARE PVT LTD</b></div>
                        <div  class = "textheight"> 5050,5th floor,Marvel Fuego  </div> 
                        <div  class = "textheight"> Above Maruti Nexa Showroom </div>
                        <div  class = "textheight"> Opp to Season Mall (We Work Building)  </div>
                        <div  class = "textheight">  Hadapsar Pune  </div>
                        <div  class = "textheight">  411028 Maharashtra </div>
                        <div  class = "textheight">  India </div>
                        <div  class = "textheight"> <b> GSTIN is 27AADCO7276J1ZY  </b></div>
                    </div>
            </div>
            <div class="col-md-9" id="ToAddress">
            	<h4 style="color: lightblue; font-size: 20px; margin-left: -15px; margin-bottom: 10px;">PURCHASE ORDER</h4>
                 <table class="uptable">
                 	<tr class="uptr">
                 		<th class="upth">Invoice Date</th>
                 		<th class="upth"><?= $date;?></th>
                 	</tr>
                 	<tr class="uptr">
                 		<td class="uptd">OP#</td>
                 		<td class="uptd">1</td>
                 	</tr>
                 </table>
            </div>                        
        </div>
        <br>
        <br>
        <br>
        <div class="row">
        	<div class="col-md-3 ami">
    			<div class="">VENDOR</div>
            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <div class="col-md-3 sarth">
        		<div class="">SHIP TO</div>
        	</div>
        </div>
        <div class="row" style="margin-top: 3px;">
            <div class="col-md-3" style="word-wrap: break-word;" id="Address">
	            <div class="class body">
	                <div class="textheight" > <b>Name : <?= $VendorName;?></b></div>
	                <div  class = "textheight"><b>Phone : <?= $Phone;?> </b> </div> 
	                <div  class = "textheight"><b> Add : <?= $Address;?> </b></div>
	            </div>
            </div>
            <div class="col-md-9" id="shipadd">
            	<div class="class body">
	                <div  class = "textheight"> 5050,5th floor,Marvel Fuego  </div> 
	                <div  class = "textheight"> Above Maruti Nexa Showroom </div>
	                <div  class = "textheight"> Opp to Season Mall (We Work Building)  </div>
	                <div  class = "textheight">  Hadapsar Pune  </div>
	                <div  class = "textheight">  411028 Maharashtra </div>
	                <div  class = "textheight">  India </div>
	            </div>
            </div>                        
        </div>
        <br>
        <br>
        <div class="row">
        	<table class="dwtable" style="width: 100%;">
             	<tr class="dwtr" style="background-color: darkmagenta;">
             		<th class="dwth" style="width: 25%;font-size: 12px;text-align: center;">REQUISITIONER</th>
             		<th class="dwth" style="width: 25%;font-size: 12px;text-align: center;">SHIP VIA</th>
             		<th class="dwth" style="width: 25%;font-size: 12px;text-align: center;">FOB</th>
             		<th class="dwth" style="width: 25%;font-size: 12px;text-align: center;">SHIPPING TERMS</th>
             	</tr>
             	<tr class="dwtr">
             		<td class="dwtd"> . </td>
             		<td class="dwtd"> . </td>
             		<td class="dwtd"> . </td>
             		<td class="dwtd"> . </td>
             	</tr>
            </table>
        </div>
        <br>
        <br>
        <div class="row">
        	<table class="dwtable" style="width: 100%;">
             	<tr class="dwtr" style="background-color: darkmagenta;">
             		<th class="dwth" style="width: 25%;font-size: 12px;text-align: center;">DESCRIPTION</th>
             		<th class="dwth" style="width: 25%;font-size: 12px;text-align: center;">PRICE</th>
             		<th class="dwth" style="width: 25%;font-size: 12px;text-align: center;">QTY</th>
             		<th class="dwth" style="width: 25%;font-size: 12px;text-align: center;">TOTAL</th>
             	</tr>
             		<?php
                        foreach($list as $key){
                            ?>
                        <tbody>
                            <tr>
                                <td class="dwtd" style="text-align: center;"><?=$key['ProductName'];?></td>      
                                <td class="dwtd" style="text-align: center;"><?=$key['Price'];?></td>
                                <td class="dwtd" style="text-align: center;"><?=$key['Qty'];?></td>
                                <td class="dwtd" style="text-align: center;"><?=$key['Total'];?></td>
                            </tr>
                        </tbody>
                    <?php
                      }
                    ?>
            </table>
        </div>
        <br>
        <br>
        <div style="border: 1px solid black;width: 50%;height: 160px; float: left;">
        	<div style="color: black;padding: 5px 2px 5px 2px;background-color: #6d6767;"><b>Comments or Special Instructions</b></div>
            <div style="margin-top:8px; font-family: initial;">Bank : <?= $BankName;?> </div>
            <div style="margin-top:5px; font-family: initial;">Branch : <?= $BranchName;?> </div>
            <div style="margin-top:5px; font-family: initial;">A/C No : <?= $Account;?> </div>
            <div style="margin-top:5px; font-family: initial;">IDFC Code : <?= $Idfc;?> </div>
            <div style="margin-top:5px; font-family: initial;"><?= $Instruction;?></div>
        </div>
        <div style="border: 0px solid black;width: 25%;height: 120px;float: left;margin-left: 180px;background-color: #fffbdc;">
            <div style="margin-top:5px; font-size: 12px;font-family: initial;"><b>SUBTOTAL :  <?= $AllTotal;?></b> </div>
            <div style="margin-top:5px;font-size: 12px;font-family: initial;"><b>TAX :  <?= $Tax;?> </b></div>
            <div style="margin-top:5px;font-size: 12px;font-family: initial;"><b>SHIPPING :  <?= $Shipping;?></b></div>
            <div>---------------------------------</div>
            <div style="margin-top:5px;font-size: 12px;font-family: initial;"><b>SUBTOTAL :  <?= $FinalTotal;?>  </b></div>
        </div>
	</div>
</body>
</html>