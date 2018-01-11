$(document).ready(function() {
	var columnsList = new Array();
	$('.thRow').each(function()
	{
		var colName = $(this).attr('data-colname');
		var col = {"data": (colName=="")? null : colName };
		columnsList.push(col);
	});
	var dataTable = $('#returnslist').DataTable({
		"ajax":{
			"url": $base_url+"returns/get_creditnotes_json",
			"dataSrc": ""
		},
		"columns": columnsList

	});
	
});