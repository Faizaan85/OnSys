        </v-container>
      </v-content>
    <v-footer color="indigo" app>
      <span class="white--text">&copy; 2017</span>
    </v-footer>
  </v-app>
</template>

</body>
<?php
  if(isset($jslist)):
  	foreach($jslist as $js): ?>
  		<script type="text/javascript" src="<?php echo base_url();?>assets/js/<?php echo $js;?>"></script>
  	<?php endforeach;
  endif;?>
<!-- <script type="text/javascript" src="http://192.168.1.125/OnSys/assets/js/v_new_purchase.js"></script> -->
<script type="text/javascript">
	function change_url(str)
	{
		var re = /[a-zA-Z]+-/g;
		var found ="";
		if(str.match(re))
		{
			found = str.match(re).toString().toLowerCase();
		}
		str = str.slice(found.length);
		var url="";
		switch(found)
		{
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
		console.log(url);
		return url;
	}
  new Vue({
    el:'#inspire',
    data:
    {
      drawer: null
    },
    props: {
      source: String
    }
  });
	// $('#btnsubmit').on('click',function(){
    //     var str = $('#search').val();
	// 	var url = $base_url + change_url(str);
	// 	//console.log(url);
    //     $('#frm_search').attr("action",url);
    //     $('#frm_search').submit();
    // });

</script>
</html>