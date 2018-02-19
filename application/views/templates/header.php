<?php
	header('Access-Control-Allow-Origin: *');
	if($this->session->logged_in === NULL)
	{
		redirect('login');
	}
?>
<!doctype html>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>
    <meta name="description" content="Order">
    <meta name="author" content="Faizaan Varteji">
	<?php
		$varsdefined = get_defined_vars();
		if(isset($varsdefined['autorefresh']))
		{
			if($autorefresh === TRUE)
			{
				echo ('<meta http-equiv="refresh" content="3; URL='. base_url().'orders">');
			}
		}
	?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jqvalid/dist/jquery.validate.js"></script>
	<script src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/shortcut.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>

	<?php if(isset($varsdefined['mode'])) : ?>
		<script type="text/javascript">
			var $global_mode="<?php echo $mode ?>";
		</script>
	<?php endif; ?>
	<script type="text/javascript">
		var $base_url = "<?php echo base_url(); ?>"
	</script>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/math.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>assets/DataTables/datatables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href=" <?php echo base_url(); ?>assets/css/bootstrap-select.min.css" type="text/css">
    <style type="text/css">
    input[type="number"] {
    	text-align: right;
    }
	.fz-danger {
	    background-color: #e46666 !important;
	}
	.fz-success {
		background-color: #44d055 !important;
	}
	.green {
		color: #44d055;
	}
	.red{
		color: #e46666;
	}
	.edit-toggle{
		border: none;
	}
    @media print
    {
        body,html{
            margin: 0;
            padding: 0;
        }
		div.divheader {

 		}
        .row1{
            font-size: small;
        }
        .row2{
            font-size: small;
        }
		input{
			border: none; !important
		}
        table{
            font-size: small;
        }
    }
	<?php if($title=="Order Details") // Put $title== "Order Print" to make it work
	{
		echo '@page {size: 6.33in 9.05in; position: relative;}';
	}
	else
	{
		echo '@page	{size: 8.27in 11.65in; position: relative;}';
	}

	?>


    </style>

    <script type="text/javascript">
    shortcut.add("Shift++", function()
    {
        window.location.replace("neworder");
    },
    {
        'keycode':187
    });
    shortcut.add("F1", function()
    {
        $("#search").focus();
    });
	function Search()
	{
		var str = $('#search').val();
		var changedURL = change_url(str);
		var url = "";
		if(changedURL == "http://192.168.2.100/jquery_sandbox/item_search1.php")
		{
			url = changedURL;
		}
		else
		{
			url = $base_url + changedURL;
		}

		//console.log(url);
        $('#frm_search').attr("action",url);
        $('#frm_search').submit();
	}
    </script>

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	<![endif]-->

</head>

<body>
	<nav class="navbar navbar-default hidden-print">
	    <div class="container-fluid">
	         <div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="#">Home</a>
	        </div>

	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	            <ul class="nav navbar-nav">
	                <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All<span class="caret"></span></a>
	                    <ul class="dropdown-menu">
	                        <li><a href="<?php echo base_url()?>orders">Orders</a></li>
	                        <li><a href="<?php echo base_url()?>neworder">New Orders</a></li>
	                        <li><a href="<?php echo base_url()?>new_credit_note">New Sales Return</a></li>
	                    </ul>
	                </li>
                    <li><a href="<?php echo base_url()?>orders" accesskey="o">Orders</a></li>
	                <li><a href="<?php echo base_url()?>neworder" accesskey="n">New Order</a></li>
	            </ul>
	            <form id="frm_search" <?php if($title
	            	!="Item Search") { echo ('target="_blank"');} ?> action="http://192.168.2.100/jquery_sandbox/item_search1.php" method="POST" class="navbar-form navbar-left">
                    <div class="form-group">
                    	<!-- <select name="search_options" id="sel_search_opt">
                    		<option value="http://192.168.2.100/jquery_sandbox/item_search1.php">Old Data</option>
                    	</select> -->
                        <input type="text" id="search" name="search_no1" class="form-control" placeholder="Search Order (F1)" onKeydown="Javascript: if (event.keyCode==13) Search();">
                    </div>
                        <button type="button" id="btnsubmit" class="btn btn-default" onClick="Search();" >Submit</button>
                </form>
                <ul class="nav navbar-nav">
                	<li><a href="<?php echo base_url()?>returns" accesskey="r">Returns</a></li>
                	<li><a href="<?php echo base_url()?>purchases" accesskey="p">Purchases</a></li>
                	<li><a href="<?php echo base_url()?>purchases/new_purchase" accesskey="i">Purchase Inv</a></li>
                </ul>
				<!-- Right Side Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" id="username" data-username="<?php echo ($this->session->username) ?>" data-level="<?php echo ($this->session->level) ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ($this->session->username) ?><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Profile</a></li>
							<li><a href="#">Settings</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url()?>logout">Logout</a></li>
						</ul>
					</li>
				</ul>
	        </div><!--/.nav-collapse-->
	    </div>
	</nav>
