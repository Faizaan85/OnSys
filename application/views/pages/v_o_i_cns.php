<!-- 
	data needed:
	$orderinfo
	$orderitems
	$invinfo
	$invitems
	$cr_notes 
	$cr_notes_items

 -->
 <?php
	if(!isset($invinfo))
	{
		$invinfo = "";
	}
	if(!isset($cr_notes))
	{
		$cr_notes = "";
	}
 ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-6 col-md-6 col-lg-6">
			<table id="cust_details" class="table table-bordered table-striped">
				<thead>
					<tr>
						<td colspan="4" style="text-align: center;"><h2>Customer Details</h2></td>
					</tr>
				</thead>
				<tr>
					<td><strong>Name :</strong></td>
					<td><label><?php echo($invinfo=="" ? $orderinfo['OmCompanyName'] : $invinfo['InOmCompanyName']);?></label></td>
					<td><strong>Order # :</strong></td>
					<td><label><?php echo($orderinfo['OmId']);?></label></td>
				</tr>
				<tr>
					<td><strong>Code :</strong></td>
					<td><label ><?php echo($invinfo=="" ? $orderinfo['OmCompanyCode'] : $invinfo['InOmCompanyCode']);?></label></td>
					<td><strong>Order Date :</strong></td>
					<td><label><?php echo($orderinfo['OmCreatedOn']); ?></label></td>
				</tr>
				<tr>
					<td><strong>Address :</strong></td>
					<td><label><?php echo($invinfo=="" ? $orderinfo['OmAdd'] : $invinfo['InOmAdd']);?></label></td>
					<td><strong>Invoice # :</strong></td>
					<td><label><?php echo($invinfo=="" ? '--' : $invinfo['InId']);?></label></td>
				</tr>
				<tr>
					<td><strong>Telephone 1:</strong></td>
					<td><label><?php echo($invinfo=="" ? $orderinfo['OmTel1'] : $invinfo['InOmTel1']);?></label></td>
					<td><strong>Credit Notes :</strong></td>
					<td><label><?php echo($cr_notes=="" ? "0" : sizeof($cr_notes));?></label></td>
				</tr>
				<tr>
					<td><strong>VAT # :</strong></td>
					<td><label><?php echo($invinfo=="" ? $orderinfo['ClVatNo'] : $invinfo['ClVatNo']);?></label></td>
					<td><strong>LPO :</strong></td>
					<td><label><?php echo($invinfo=="" ? $orderinfo['OmLpo'] : $invinfo['InOmLpo']);?></label></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div id="tabs" class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-10 col-md-10 col-lg-10">
			<ul>
				<!-- there can only be 1 order and 1 invoice
				so there is no need to set id/href as order_{ordernumber} or invoice_{invoicenumber} -->
				<li><a href='#order'>Order-<?php echo($orderinfo['OmId']);  ?></a></li>
				<?php if($invinfo!=""): ?>
				<li><a href='#invoice'>Invoice-<?php echo($invinfo['InId']);?></a></li>

				<!--  php loop for n credit notes -->
				<?php
				endif; 
				if($cr_notes!="")
				{
					foreach($cr_notes as $key => $value)
					{
						$cr_num = $value['cnmId'];
						echo('<li><a href="#cr_'.$cr_num.'">CrNote:'.$cr_num.'</a></li>');
					}
				}
				?>
				
			</ul>
			<div id="order">
				<!-- php loop for order table -->
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
						foreach($orderitems as $item):?>
						<tr>
							<td id="<?php echo ($item['OiId']); ?>"><?php echo($i); ?> </td>
							<td><?php echo $item['OiPartNo']; ?></td>
							<td><?php echo $item['OiSupplierNo']; ?></td>
							<td><?php echo $item['OiDescription']; ?></td>
							<td><?php echo $item['OiLeftQty']; ?></td>
							<td><?php echo $item['OiRightQty']; ?></td>
							<td><?php echo $item['OiTotalQty']; ?></td>
							<td><?php echo $item['OiPrice']; ?></td>
							<td style="text-align: right;"><?php 
								$amount = $amount + ($item['OiTotalQty'] * $item['OiPrice']);
								echo number_format($item['OiTotalQty'] * $item['OiPrice'],2); 
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
							<td style="text-align: right;"><?php echo number_format($amount,2); ?></td>
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
							<td style="text-align: right;"><?php echo(number_format($orderinfo['OmDiscount'],2));?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>VAT <?php echo($invinfo=="" ? "5" : $invinfo['InVatPercent']); ?>%:</td>
							<td  style="text-align: right;" >
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
								$netamt = ($amount - $orderinfo['OmDiscount'])+$vatamt;
								echo number_format($netamt,2);
							?></strong></td>
						</tr>
					</tbody>
    			</table>
			</div>
			<?php if($invinfo!=""): ?>
			<div id="invoice">
				<!-- php loop for invoice table -->
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
						foreach($invitems as $item):?>
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
							<td style="text-align: right;" data-amount="<?php echo($invinfo['InAmount']);  ?>"><?php echo number_format($amount,2); ?></td>
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
							<td style="text-align: right;"><?php echo(number_format($invinfo['InDiscount'],2));?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>VAT <?php echo($invinfo['InVatPercent']); ?>%:</td>
							<td  style="text-align: right;" data-vatamount="<?php echo($invinfo['InVatPercent']); ?>">
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
								$netamt = ($amount - $invinfo['InDiscount'])+$vatamt;
								echo number_format($netamt,2);
							?></strong></td>
						</tr>
					</tbody>
				</table>
			</div>

			<!-- php loop for table for n credit notes -->
			<?php
			endif; 
			if($cr_notes!=""):
			
				foreach($cr_notes as $key => $value): 
				$cr_num = $value['cnmId'];	
			?>
				<div id='cr_<?php echo($cr_num);?>'>
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
							$items = $cr_notes_items[$cr_num];

							foreach($items as $item):?>
						<tr>
							<!-- <?php print_r($item);
							echo("<br>");?> -->
							<td id="<?php echo ($item['CniId']); ?>"><?php echo($i); ?> </td>
							<td><?php echo $item['CniPartNo']; ?></td>
							<td><?php echo $item['CniSupplierNo']; ?></td>
							<td><?php echo $item['CniDescription']; ?></td>
							<td><?php echo $item['CniLeftQty']; ?></td>
							<td><?php echo $item['CniRightQty']; ?></td>
							<td><?php echo $item['CniTotalQty']; ?></td>
							<td><?php echo $item['CniPrice']; ?></td>
							<td style="text-align: right;"><?php 
								$amount = $amount + ($item['CniTotalQty'] * $item['CniPrice']);
								echo number_format($item['CniTotalQty'] * $item['CniPrice'],2); 
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
							<td style="text-align: right;"><?php echo number_format($amount,2); ?></td>
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
							<td style="text-align: right;">0.00</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>VAT <?php echo($invinfo['InVatPercent']); ?>%:</td>
							<td  style="text-align: right;">
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
								$netamt = ($amount - 0.00)+$vatamt;
								echo number_format($netamt,2);
							?></strong></td>
						</tr>
					</tbody>
					</table>
				</div>
			<?php endforeach;
				endif; ?>
		</div>
	</div>
</div>
