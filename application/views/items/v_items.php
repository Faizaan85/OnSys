<div id="vue-app" class="container-fluid">
  <div class="alert alert-info" role="alert" v-if="alerts.show">
    <!-- for the data flash -->
    <button type="button" class="close" data-dissmiss="alert" aria-label="Close" v-on:click="alerts.show = !alerts.show" ><span aria-hidden="true">&times;</span></button>
    <span>{{alerts.message}}</span>
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
            <label for="part_no">Part No: </label><input type="text" class="form-control" id="part_no" v-model="itemAddData.part_no" required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="ssno">Supplier No: </label><input type="text" class="form-control" id="ssno" v-model="itemAddData.ssno">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="desc">Description: </label><input type="text" class="form-control" id="desc" v-model="itemAddData.desc">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="equipment">Equipment: </label><input type="text" class="form-control" id="equipment" v-model="itemAddData.equipment">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="co_name">Company Name: </label><input type="text" class="form-control" id="co_name" v-model="itemAddData.co_name">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="remark">Remark: </label><input type="text" class="form-control" id="remark" v-model="itemAddData.remark">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="bin">Bin: </label><input type="text" class="form-control" id="bin" v-model="itemAddData.bin">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="unit">Unit: </label><input type="text" class="form-control" id="unit" v-model="itemAddData.unit">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="pkg_qty">Package Quantity: </label><input type="text" class="form-control" id="pkg_qty" v-model="itemAddData.pkg_qty">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="wt">Weight: </label><input type="text" class="form-control" id="wt" v-model="itemAddData.wt">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="unit_cost">{{itemAddData.unit}} Cost: </label><input type="text" class="form-control" id="unit_cost" v-model="itemAddData.unit_cost">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="sales_pric">Selling Price: </label><input type="text" class="form-control" id="sales_pric" v-model="itemAddData.sales_pric">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="qty_hand">Current Stock: </label><input type="text" class="form-control" id="qty_hand" v-model="itemAddData.qty_hand">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="qty_res">Quantity Reserved: </label><input type="text" class="form-control" id="qty_res" v-model="itemAddData.qty_res">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="max_level">Max Quantity Level: </label><input type="text" class="form-control" id="max_level" v-model="itemAddData.max_level">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="min_level">Min Quantity Level: </label><input type="text" class="form-control" id="min_level" v-model="itemAddData.min_level">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="qty_order">Quantity in order: </label><input type="text" class="form-control" id="qty_order" v-model="itemAddData.qty_order">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="op_stock">Opening Stock: </label><input type="text" class="form-control" id="op_stock" v-model="itemAddData.op_stock">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="qty_res">Quantity Reserved: </label><input type="text" class="form-control" id="qty_res" v-model="itemAddData.qty_res" disabled>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="frrate">Freight Rate: </label><input type="text" class="form-control" id="frrate" v-model="itemAddData.frrate">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <div class="form-group">
            <button type="button" class="btn btn-success" v-on:click="save_item()">Save <span class="glyphicon glyphicon-floppy-disk"></span></button>
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
