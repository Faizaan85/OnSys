<div class="container-fluid">
    <div class="row">
        <div id="something" class="hidden">
            <a href="<?php echo base_url(); ?>" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!!</strong>OrderSaved
        </div>
    </div>
    <div id="toggle-section">
        <div class="row">
            <form id="form_main" class="form-group">
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label for="inv_num">Invoice #:</label>
                    <input type="text" id="inv_num" name="inv_num" class="form-control" value="" onkeydown='allowButton(event,"number")' disabled="disabled">
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label for="order_num">Order #:</label>
                    <input type="text" id="order_num" name="order_num" class="form-control"
                    value="" onkeydown='allowButton(event,"ALL")'>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label for="date_created">Date:</label>
                    <input type="date" id="date_created" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label>VAT #:
                        <span id="vat_info"></span>
                    </label>
                    <br>
                    <label >Current Balance: <span id="cur_bal"></span></label>
                </div>
            </form>
        </div>
        <hr>
        <form id="form_details" class="form-group">
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <label for="customer_code">Code:</label>
                    <input type="text" id="customer_code" class="form-control" value="" placeholder="Select" onkeyup='whichButton(event,"customer_name")' required>
                </div>

                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label for="customer_name">Customer Name:</label>
                    <input type="text" id="customer_name" class="form-control"
                    value="" placeholder="Customer Name." onkeyup='whichButton(event,"lpo")' required>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label for="lpo">LPO:</label>
                    <input type="text" id="lpo" class="form-control"
                    value="" placeholder="LPO value" onkeyup='whichButton(event,"term_pay")'>

                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <label for="term_pay">Terms of Payment:</label>
                    <select id="term_pay" class="form-control" onkeyup='whichButton(event,"address")'>
                        <option value="Cash">Cash</option>
                        <option value="30 Days">30 Days</option>
                        <option value="60 Days">60 Days</option>
                        <option value="90 Days">90 Days</option>
                        <option value="120 Days">120 Days</option>
                    </select>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <label for="due_date">Due Date:</label>
                    <input type="date" id="due_date" class="form-control" value="" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <label for="address">Address:</label>
                    <input type="text" id="address" class="form-control"
                    value="" placeholder="Address..." onkeyup='whichButton(event,"phone1")'>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label for="phone1">Phone 1:</label>
                    <input type="text" id="phone1" class="form-control"
                    value="" placeholder="Phone Number" onkeyup='whichButton(event,"phone2")'>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <label for="phone2">Phone 2:</label>
                    <input type="text" id="phone2" class="form-control" value="" placeholder="Phone Number" onkeyup='whichButton(event,"Part_no")'>
                </div>
            </div>
        </form>
    </div>
    <div class="row form-group">
        <div class="col-sm-2 col-md-2 col-lg-2" style="top: 25px;">
            <input type="button" id="cancel_new" class="btn btn-danger form-control" value="Cancel / New">
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2" style="top: 25px;">
            <input type="button" id="save" class="btn btn-info form-control" value="Save (F2)">
        </div>

        <div class="col-sm-2 col-md-2 col-lg-2">
            <label for="total_amount">Total Amount:</label>
            <input type="text" id="total_amount" class="form-control" disabled>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1">
            <label for="discount">Discount:</label>
            <input type="number" id="discount" class="form-control"
            value="0.00" onkeyup='allowButton(event,"number")'>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1">
            <label for="vat">VAT 5%:</label>
            <input type="text" id="vat" class="form-control" data-vat-val="5" disabled>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <label for="net_amount">Net Amount:</label>
            <input type="text" id="net_amount" class="form-control" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <hr>
        </div>
        <div class="col-lg-1">
            <a id="open-close-toggle">
                <img class="toggle-section" src="<?php echo base_url(); ?>assets/icons/navigate-up.png" alt="UP">
                <img class="toggle-section" src="<?php echo base_url(); ?>assets/icons/navigate-down.png" alt="DOWN" style="display: none;">
            </a>
        </div>
        <div class="col-lg-6">
            <hr>
        </div>
    </div>
    <form id="form_input" class="form-group">
        <div class="row">
            <div class="col-xs-1">
                <label for="Add_Row">Select</label>
                <input class="form-control" id="Add_Row" type="button" value="ADD" onclick="addRow('OutputBody')" onkeyup='whichButton(event, "Part_no")'>
            </div>
            <div class="col-xs-2">
                <label for="Part_no">Part No</label>
                <input class="form-control" id="Part_no" type="text" placeholder="Part No (F9)" onfocus="clearInput()" accesskey="p"  onkeyup='whichButton(event, "Qty_R")' required>
            </div>
            <div class="col-xs-2">
                <label for="Supplier_no">Supplier No</label>
                <input class="form-control" id="Supplier_no" type="text" onkeyup='whichButton(event, "Qty_R")'minlength="2" required>
            </div>
            <div class="col-xs-3">
                <label for="Desc_">Description</label>
                <input type="text" class="form-control" id="Desc_" onkeyup='whichButton(event, "Qty_R")' minlength="2" required>
            </div>
            <div class="col-xs-1">
                <label for="Qty_R">Qty R</label>
                <input type="number" class="form-control qty" id="Qty_R" value="0" min="0"  onkeyup='whichButton(event, "Qty_L")' onkeydown='allowButton(event,"number")'>
            </div>
            <div class="col-xs-1">
                <label for="Qty_L">Qty L</label>
                <input type="number" class="form-control qty" id="Qty_L" value="0" min="0" onkeyup='whichButton(event, "Total_")' onkeydown='allowButton(event,"number")'>
            </div>
            <div class="col-xs-1">
                <label for="Total_">Total</label>
                <input type="number" class="form-control" id="Total_" min="1" onkeyup='whichButton(event, "Price_")' onkeydown='allowButton(event,"number")'>
            </div>
            <div class="col-xs-1">
                <label for="Price_">Price</label>
                <input type="number" class="form-control" id="Price_" min="0" data-tgp="-1" onkeyup='whichButton(event, "Add_Row")' onkeydown='allowButton(event,"float")'>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-6 col-lg-2">
                <label id="info_last_price"></label>
            </div>
            <div class="col-lg-2 hidden">
                <label>Cost:<span id="info_cost"></span></label>
            </div>
            <div class="col-lg-2">
                <label >Stock:<span id="info_stock"></span></label>
            </div>
        </div>
    </form>
    <hr>
    <div class="row">
        <table id="Output" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Part #</th>
                    <th>Supplier #</th>
                    <th>Description</th>
                    <th>Qty R</th>
                    <th>Qty L</th>
                    <th>Total</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="OutputBody">

            </tbody>
        </table>
    </div>
</div>
