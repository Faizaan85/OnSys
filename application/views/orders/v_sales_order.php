<div id="vue-app">
  <v-app>
    <v-content>
      <v-container fluid>
        <v-layout row wrap>
          <v-flex>
            <v-tabs
              v-model="active"
              color="cyan"
              dark=""
              slider-color="yellow"
            >
              <v-tab key="1" ripple>Customer Details</v-tab>
              <v-tab key="2" ripple>Item </v-tab>
              <v-tab-item key="1">
                <v-card>
                  <v-card-title>
                    <span class="headline">CASH INVOICE</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container grid-list-md>
                      <v-form v-model="customerForm">
                        <v-layout wrap>
                          <v-flex xs12 sm4 md4>
                            <v-text-field label="Code" value="C2018" readonly></v-text-field>
                          </v-flex>
                          <v-flex xs12 sm4 md4>
                            <v-text-field
                            label="Name"
                            v-model="customer.name"
                            ></v-text-field>
                          </v-flex>
                          <v-flex xs12 sm4 md4>
                            <v-text-field
                            label="LPO"

                            ></v-text-field>
                          </v-flex>
                          <v-flex xs12 sm4 md4>
                            <v-text-field label="Address"></v-text-field>
                          </v-flex>
                          <v-flex xs12 sm4 md4>
                            <v-text-field label="Phone 1"></v-text-field>
                          </v-flex>
                          <v-flex xs12 sm4 md4>
                            <v-text-field label="Phone 2"></v-text-field>
                          </v-flex>
                        </v-layout>
                        <!-- <v-select
                        label="Customer"
                        autocomplete
                        :loading="customer.loading"
                        cache-items
                        chips
                        required
                        :items="customer.items"
                        :rules="[() => customers.select.length > 0 || 'Please Select Customer']"
                        :search-input.sync="customer.search"
                        v-model="customer.select"
                        ></v-select> -->
                      </v-form>
                    </v-container>
                  </v-card-text>
                </v-card>

              </v-tab-item>
              <v-tab-item key="2">
                {{items}}
              </v-tab-item>
            </v-tabs>
          </v-flex>
        </v-layout>
        <v-layout>
          <v-flex xs12>
            <v-text-field
            append-icon="search"
            label="Search"
            single-line
            hide-details
            v-model="orderTable.search"
            ></v-text-field>
            <v-data-table
            :headers = "orderTable.headers"
            :items = "orderTable.orders"
            :rows-per-page-items = "orderTable.rowsPerPage"
            :search = "orderTable.search"
            class="elevation-2"
            >
            <template
            slot="items"
            slot-scope="props"
            >
              <td>{{props.item.OmId}}</td>
              <td>{{props.item.OmCompanyName}}</td>
              <td>{{props.item.Lpo}}</td>
              <td>{{props.item.InId}}</td>
              <td>{{props.item.OmStatus}}</td>
              <td>{{props.item.OmStore1}}</td>
              <td>{{props.item.OmStore2}}</td>
              <td>{{props.item.OmPrinted}}</td>
              <td>{{props.item.OmCreatedOn}}</td>
              <td>{{props.item.OmCreatedBy}}</td>
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
