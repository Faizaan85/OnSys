<!-- 
	data variables
	$invoiceinfo
 -->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-sm-offset-6">
			<span id="invid" class="row1" data-invid="<?php echo ($invoiceinfo['InId']); ?>">Invoice #: <?php echo($invoiceinfo['InId']); ?></span>
		</div>
		<div class="col-sm-3">
			<span>Order #: <?php echo($invoiceinfo['InOmId']); ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<span class="row2">Name: <?php echo $invoiceinfo['InOmCompanyName']; ?></span>
		</div>
		<div class="col-sm-3">
			<span class="row2">LPO: <?php echo $invoiceinfo['InOmLpo'] ?></span>
		</div>
		<div class="col-sm-3">
			<span class="row1">Date: <?php echo date("d-m-Y",strtotime($invoiceinfo['InOmCreatedOn'])); ?></span>
		</div>
	</div>
	<hr>
	<div class="row">
		<!-- can put the link for pdf in the href -->
		<a href="#" id="print" class="btn btn-info" role="button">Print</a>
		<!-- <label id="TotAmount" class="pull-right"> </label> -->
    </div>
    <div class="row">
    	<table class="table table-striped table-bordered">
    		<thead>
    			<tr>
    				<th>Sr #</th>
    				<th>Part #</th>
    				<th>Supplier #</th>
    				<th>Description</th>
    				<th>L-Qty</th>
    				<th>R-Qty</th>
    				<th>T-Qty</th>
    				<th>Price</th>
    				<th>Amount</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 
    				$i=1; 
    				$amount=0;
    			foreach($items as $item):?>
    			<tr>
    				<td id="<?php echo ($item['IiId']); ?>"><?php echo($i); ?> </td>
    				<td><?php echo $item['IiOiPartNo']; ?></td>
    				<td><?php echo $item['IiOiSupplierNo']; ?></td>
    				<td><?php echo $item['IiOiDescription']; ?></td>
    				<td><?php echo $item['IiOiLeftQty']; ?></td>
    				<td><?php echo $item['IiOiRightQty']; ?></td>
    				<td><?php echo $item['IiOiTotalQty']; ?></td>
    				<td><?php echo $item['IiOiPrice']; ?></td>
    				<td style="text-align: right;"><?php 
    					$amount = $amount + ($item['IiOiTotalQty'] * $item['IiOiPrice']);
    					echo number_format($item['IiOiTotalQty'] * $item['IiOiPrice'],2); 
    					$i++;
    					?></td>
    			</tr>
    			<?php endforeach; ?>
    			<tr>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td>Total Amount:</td>
    				<td style="text-align: right;" data-amount="<?php echo($invoiceinfo['InAmount']);  ?>"><?php echo number_format($amount,2); ?></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
    				<td>-Discount:</td>
    				<td style="text-align: right;"><?php echo(number_format($invoiceinfo['InDiscount'],2));?></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td>VAT <?php echo($invoiceinfo['InVatPercent']); ?>%:</td>
    				<td  style="text-align: right;" data-vatamount="<?php echo($invoiceinfo['InVatPercent']); ?>">
    					<?php $vatamt = $amount*.05; 
    						echo(number_format($vatamt,2));
    					?></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td><strong>Net Amount:</strong></td>
    				<td style="text-align: right;"><strong >
    				<?php 
    					$netamt = ($amount - $invoiceinfo['InDiscount'])+$vatamt;
    					echo number_format($netamt,2);
    				 ?></strong></td>
    			</tr>
    		</tbody>
    	</table>
    </div>
</div>