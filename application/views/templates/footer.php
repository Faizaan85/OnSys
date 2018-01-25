

</body>
<script type="text/javascript">
	$('#btnsubmit').on('click',function(){
        var str = $('#search').val();
        var re = /[a-zA-Z]+-/g;
        var found = str.match(re).toString().toLowerCase();
        str = str.slice(found.length);
        var url=$base_url;
        switch(found){
            case "cn-":
                url = url+"view/return/"+str;
                break;
            case "i-":
                url = url+"view/invoice/"+str;
                break;
            case "o-":
                url = url+"view/order/"+str;
                break;
			case "n-":
				str = str.replace(" ","+");
				url = url+"items/item_search?search="+str;
				break;
            default:
                url = "http://192.168.2.100/jquery_sandbox/item_search1.php";
        }
        $('#frm_search').attr("action",url);
        $('#frm_search').submit();

    });
</script>
</html>
