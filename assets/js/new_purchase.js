
$(document).ready(function()
{
    $('#customer_code').autocomplete(
    {
        source: $base_url + "customersearch/",
        minLength: 2,
        select: function(event, ui)
        {
            $('#customer_name').val(ui.item.clconame);
            $('#cur_bal').text(ui.item.clcubal + ui.item.clcudrcr);
            $('#address').val(ui.item.cladd1);
            $('#phone1').val(ui.item.cltel1);
            $('#phone2').val(ui.item.cltel2);
            $('#vat_info').text(ui.item.clvatno);
            $('#term_pay').val(ui.item.clpytime);
            $('#due_date').val(getDueDate('date_created','#term_pay'));
        }
    });

});
