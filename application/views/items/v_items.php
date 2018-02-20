<div id="vue-app" class="container-fluid">
  <div class="row">
    <!-- for the data flash -->
  </div>
  <div class="row">
    <div class="col-sm-2">
      <button class="btn btn-success" v-on:click="showAdd = !showAdd">Add <span class="glyphicon glyphicon-plus"></span></button>
    </div>
  </div>
  <div class="container" v-if="showAdd">
    <form class="" action="index.html" method="post">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="part_no">Part No: </label><input type="text" class="form-control" id="part_no" required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="ssno">Supplier No: </label><input type="text" class="form-control" id="ssno">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="desc">Description: </label><input type="text" class="form-control" id="desc">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="equipment">Equipment: </label><input type="text" class="form-control" id="equipment">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="co_name">Company Name: </label><input type="text" class="form-control" id="co_name">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="remark">Remark: </label><input type="text" class="form-control" id="remark">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="bin">Bin: </label><input type="text" class="form-control" id="bin">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="unit">Unit: </label><input type="text" class="form-control" id="unit">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="pkg_qty">Package Quantity: </label><input type="text" class="form-control" id="pkg_qty">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="wt">Weight: </label><input type="text" class="form-control" id="wt">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="unit_cost">Unit Cost: </label><input type="text" class="form-control" id="unit_cost">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="sales_pric">Selling Price: </label><input type="text" class="form-control" id="sales_pric">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="qty_hand">Current Stock: </label><input type="text" class="form-control" id="qty_hand">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="qty_res">Quantity Reserved: </label><input type="text" class="form-control" id="qty_res">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="max_level">Max Quantity Level: </label><input type="text" class="form-control" id="max_level">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="min_level">Min Quantity Level: </label><input type="text" class="form-control" id="min_level">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="qty_order">Quantity in order: </label><input type="text" class="form-control" id="qty_order">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="op_stock">Opening Stock: </label><input type="text" class="form-control" id="op_stock">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="qty_res">Quantity Reserved: </label><input type="text" class="form-control" id="qty_res">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="frrate">Freight Rate: </label><input type="text" class="form-control" id="frrate">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <div class="form-group">
            <button type="button" class="btn btn-success">Save <span class="glyphicon glyphicon-floppy-disk"></span></button>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <button type="button" class="btn btn-warning" v-on:click="showAdd = !showAdd">Cancel <span class="glyphicon glyphicon-floppy-remove"></span></button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
