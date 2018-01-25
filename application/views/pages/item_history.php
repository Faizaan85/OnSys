<div class="container-fluid">
	<div class="table-responsive">
		<table id="history" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Date</th>
					<th>Type</th>
					<th>No</th>
					<th>Part #</th>
					<th>Supplier #</th>
					<th>Code</th>
					<th>Name</th>
					<th>Qty</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody >
				<?php foreach($item_sales as $row) :?>
					<tr>
						<td><?php echo $row['Date']; ?></td>
						<td><?php echo $row['Type']; ?></td>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['Part_No']; ?></td>
						<td><?php echo $row['Supplier_No']; ?></td>
						<td><?php echo $row['Code']; ?></td>
						<td><?php echo $row['Name']; ?></td>
						<td><?php echo $row['TQty']; ?></td>
						<td><?php echo $row['Price']; ?></td>
					</tr>
				<?php endforeach; ?>
				<?php foreach($item_returns as $row): ?>
					<tr>
						<td><?php echo $row['Date']; ?></td>
						<td><?php echo $row['Type']; ?></td>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['Part_No']; ?></td>
						<td><?php echo $row['Supplier_No']; ?></td>
						<td><?php echo $row['Code']; ?></td>
						<td><?php echo $row['Name']; ?></td>
						<td><?php echo $row['TQty']; ?></td>
						<td><?php echo $row['Price']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
