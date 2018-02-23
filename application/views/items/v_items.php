<div id="vue-app" class="container-fluid">
  <v-app>
    <v-content>
      <v-container fluid>
        <v-layout row wrap>
          <v-flex xs12 v-if="alerts.show">
            <v-alert v-bind:type="alerts.status" dismissible v-model="alerts.show">
              {{alerts.message}}
            </v-alert>
          </v-flex>
          <v-flex>


            <v-dialog v-model="dialog" max-width="80%">
      <v-btn color="primary" dark slot="activator" class="mb-2">New Item</v-btn>
      <v-card>
        <v-card-title>
          <span class="headline">{{ formTitle }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6 md4>
                <v-text-field label="Dessert name" v-model="editedItem.name"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field label="Calories" v-model="editedItem.calories"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field label="Fat (g)" v-model="editedItem.fat"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field label="Carbs (g)" v-model="editedItem.carbs"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field label="Protein (g)" v-model="editedItem.protein"></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>


            <v-text-field
            append-icon="search"
            label="Search"
            single-line
            hide-details
            v-model="itemTable.search"
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout>
          <v-flex xs12>
            <v-data-table
            :headers = "itemTable.headers"
            :items = "itemTable.items"
            :rows-per-page-items = "itemTable.rowsPerPage"
            :search = "itemTable.search"
            class="elevation-1"
            >
              <template slot="items" slot-scope="props">
                <td>{{props.item.PART_NO}}</td>
                <td>{{props.item.DESC}}</td>
                <td>{{props.item.SSNO}}</td>
                <td class="text-xs-right">{{props.item.QTY_HAND}}</td>
                <td class="text-xs-right">{{props.item.SALES_PRIC}}</td>
                <td class="text-xs-right">{{props.item.UNIT_COST}}</td>
              </template>
            </v-data-table>
          </v-flex>
        </v-layout>

      </v-container>
    </v-content>
  </v-app>




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
