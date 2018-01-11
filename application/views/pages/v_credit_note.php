<div class="container-fluid">
	<div class="row">
		<div id='something' class="hidden">
			<a href="" class='close' data-dissmiss='alert' arai-label='close'>&times;</a>
			<span><strong>Success!</strong>Credit Note Created!.</span>
		</div>
	</div>
	<div class="row form-group">
		<!-- <div class="col-sm-3 col-md-3 col-lg-3">
			<label for="inv_search">Invoice No:</label>
			<input type="text" id="inv_search" name="inv_search" class="form-control">
			<button type="button" id="btn_inv_search">Search</button>
		</div>
		<div class="col-sm-2 col-md-2 col-lg-2">
			<label for="inv_date">Invoice Date:</label>
			<input type="date" id="inv_date" name="inv_date" class="form-control" disabled>
		</div> -->
		<div class="col-offset-sm-4 col-sm-3 col-offset-md-4 col-md-3 col-offset-lg-4 col-lg-3">
			<div class="input-group">
				<input type="text" id="inv_search" class="form-control" placeholder="Search Invoice ...">
				<span class="input-group-btn">
					<button id="btn_inv_search" class="btn btn-default" type="button">Go!</button>
				</span>
			</div><!-- /input-group -->

		</div>
	</div>
	<div id="tabs" style="display: none;">
		<ul class="tabs-ul">
			<li><a href="#inv_tab">Invoice</a></li>
			<li><a href="#new_cn_tab">New Credit Note</a></li>
			
			<!-- <li><a href="#tabs-1">Nunc tincidunt</a></li> -->
			<!-- <li><a href="ajax/">inv</a></li> -->
			
		</ul>
		<div id="inv_tab" class="row_tab container-fluid">
        	<div class="row details">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label >Inv No:</label>
                    <span id="inv_id"></span>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label >Order No:</label>
                    <span id="inv_omid"></span>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label >Date:</label>
                    <span id="inv_createdon"></span>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label >Vat No:</label>
                    <span id="inv_clvatno"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <label >Code:</label>
                    <span id="inv_ccode"></span>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label >Name:</label>
                    <span id="inv_cname"></span>
                        
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label >LPO:</label>
                    <span id="inv_lpo"></span>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 text-right">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <label >Total Amount:</label>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <span id="inv_amount" class="text-right"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <label >Total Discount:</label>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <span id="inv_discount" class="text-right"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <label id="inv_vatpercent"></label>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <span id="inv_vatamount" class="text-right"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <label >Net Amount:</label>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <label class="text-right"><strong id="inv_netamount"></strong></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label for="">Address:</label>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label for="">Phone 1:</label>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <label for="">Phone 2:</label>
                </div>
            </div>
        	</div>
        	<div class="row items">
            <table id="inv_table" class="table table-striped table-bordered">
                <tr>
                    <th>Select</th>
                    <th>Part #</th>
                    <th>Supplier#</th>
                    <th>Description</th>
                    <th>Left Qty</th>
                    <th>Right Qty</th>
                    <th>Total Qty</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>`;
			<!-- <div class="row">
			<div class="col-sm-2 col-md-2 col-lg-2">
				<label >Code:</label>
				<label for="">{data}.im.InOmCompanyCode</label>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3">
				<label >Name:</label>
				<label for="">{data}.im.InOmCompanyName</label>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3">
				<label >LPO:</label>
				<label for="">{data}.im.InOmLpo</label>
			</div>
			<div class="col-sm-4 col-md-4 col-lg-4">
				<label >Total Amount:</label>
				<label for="">{data}.im.InAmount</label>
				<br>
				<label >Total Discount::</label>
				<label for="">{data}.im.InDiscount</label>

			</div>
			</div> -->
			<!-- <div id="tabs-1">
			
			</div>
			<div id="tabs-2">
				<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
			</div> -->
			</table>
			<button id="inv_next" class="btn btn-info">NEXT >> </button>
		</div>
		</div>
		<div id="new_cn_tab">
			<table id="rtn_table" class="table table-striped table-bordered">
                <tr>
                    <th>Part #</th>
                    <th>Supplier#</th>
                    <th>Description</th>
                    <th>Left Qty</th>
                    <th>Right Qty</th>
                    <th>Total Qty</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
			</table>
            <button id="rtn_save" class="btn btn-info">Save</button>    
		</div>
