<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
			<p><?php echo $title; ?></p>
		</div>
		<div class="col-md-2">
			<button type="button" id="autoReload" class="btn btn-success" data-state=FALSE>Auto Reload</button>
		</div>
	</div>
	<table id="returnslist" class="table table-striped table-bordered" data-order='[[0,"desc"]]' data-page-length='25' cellspacing="0" width="100%">
		<thead>
			<tr>
				<th class="thRow" data-colname="cnmId">Credit Note</th>
				<th class="thRow" data-colname="cnmInId">Invoice #</th>
				<!-- <th class="thRow" data-colname="OmId">Order #</th> -->
				<th class="thRow" data-colname="InOmCompanyName">Name</th>
				<th class="thRow" data-colname="CnmLpo">LPO</th>
				<th class="thRow" data-colname="CnmNetAmount">Amount</th>
				<th class="thRow" data-colname="CnmCreatedOn">Date</th>
				<!-- <th class="thRow" data-colname="CreatedBy">By</th> -->
				<!-- <th class="thRow options" data-colname="">Options</th> -->
			</tr>
		</thead>

	</table>
</div>