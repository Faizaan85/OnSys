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
            <v-btn color="primary" dark @click.stop="open">New Item</v-btn>
            <v-dialog v-model="dialog" max-width="80%">

              <v-card>
                <v-card-title>
                  <span class="headline">{{ formTitle }}</span>
                </v-card-title>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-form v-model="editedItem.valid" ref="addEditItem">
                    <v-layout wrap>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Part No"
                        v-model="editedItem.PART_NO"
                        @blur="checkIfExists('part_no',$event)"
                        required
                        counter="15"
                        :rules="[rules.required, rules.max15]"
                        :error-messages="errorMessage.part_no"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Supplier No"
                        v-model="editedItem.SSNO"
                        @blur="checkIfExists('ssno',$event)"
                        required
                        :counter="15"
                        :rules="[rules.required , rules.max15]"
                        :error-messages="errorMessage.ssno"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Description"
                        v-model="editedItem.DESC"
                        clearable
                        required
                        :counter="100"
                        :rules="[rules.required , rules.max100]"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Equipment"
                        v-model="editedItem.EQUIPMENT"
                        :counter="15"
                        :rules="[rules.required , rules.max15]"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="OEM Number"
                        v-model="editedItem.CO_NAME"
                        :counter="30"
                        :rules="[rules.max30]"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Remark"
                        v-model="editedItem.REMARK"
                        :counter="80"
                        :rules="[rules.max80]"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Bin"
                        v-model="editedItem.BIN"
                        :counter="20"
                        :rules="[rules.max20]"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Unit"
                        v-model="editedItem.UNIT"
                        :counter="10"
                        :rules="[rules.required, rules.max10]"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Package Qty"
                        v-model="editedItem.PKG_QTY"
                        type="number"
                        :rules="[rules.required]"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Weight"
                        v-model="editedItem.WT"
                        type="number"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Cost Price"
                        v-model="editedItem.UNIT_COST"
                        type="number"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Sell Price"
                        v-model="editedItem.SALES_PRIC"
                        type="number"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Stock"
                        v-model="editedItem.QTY_HAND"
                        type="number"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Reserved Qty"
                        v-model="editedItem.QTY_RES"
                        type="number"
                        disabled
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Max Level"
                        v-model="editedItem.MAX_LEVEL"
                        type="number"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Min Level"
                        v-model="editedItem.MIN_LEVEL"
                        type="number"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Qty in Order"
                        v-model="editedItem.QTY_ORDER"
                        type="number"
                        disabled
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Opening Stock"
                        v-model="editedItem.OP_STOCK"
                        type="number"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12  sm6  md4 >
                        <v-text-field
                        label="Frieght"
                        v-model="editedItem.FRRATE"
                        type="number"
                        ></v-text-field>
                      </v-flex>
                    </v-layout>
                    </v-form>
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
              <td class="justify-center layout px-0">
                <v-btn icon class="mx-0" @click="editItem(props.item)">
                  <v-icon color="teal">edit</v-icon>
                </v-btn>
                <v-btn icon class="mx-0" @click="deleteItem(props.item)">
                  <v-icon color="pink">delete</v-icon>
                </v-btn>
              </td>
            </template>

          </v-data-table>

        </v-flex>

      </v-layout>



    </v-container>

  </v-content>

</v-app>
</div>







<!--

<div class="row">

  <div class="col-sm-2">

    <button class="btn btn-success" v-on:click="showAdd = !showAdd">Add <span class="glyphicon glyphicon-plus"></span></button>

  </div>

</div>

<div class="container" v-if="showAdd">

  <form class  action="index.html" method="post">

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

</div> -->
