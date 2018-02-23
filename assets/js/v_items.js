new Vue(
{
	el: '#vue-app',
  data:
  {
    name: '',
    alerts: {
      status: "",
      show: false,
      message: ''
    },
    dialog: false,
    editedIndex: -1,
    editedItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      },
    showAdd: false,
    itemAddData: {
      part_no: '',
      equipment: '',
      co_name: '',
      desc: '',
      remark: '',
      bin: '',
      unit: '',
      pkg_qty: '',
      wt: '',
      unit_cost: '',
      sales_pric: '',
      qty_hand: '',
      max_level: '',
      min_level: '',
      qty_order: '',
      op_stock: '',
      qty_res: '',
      ssno: '',
      frrate: ''
    },
    itemTable: {
      headers: [
        {
          text: 'Part No',
          value: 'PART_NO',
          align: 'left',
          sortable: true
        },
        {
          text: 'Description',
          value: 'DESC',
          align: 'left',
          sortable: true
        },
        {
          text: 'Supplier #',
          value: 'SSNO',
          align: 'left',
          sortable: true
        },
        {
          text: 'Stock',
          value: 'QTY_HAND',
          align: 'right',
          sortable: false
        },
        {
          text: 'Sell Price',
          value: 'SALES_PRIC',
          align: 'right',
          sortable: false
        },
        {
          text: 'Cost Price',
          value: 'UNIT_COST',
          align: 'right',
          sortable: false
        }
      ],
      items: [],
      rowsPerPage: [10, 50, 100, { "text":"All","value":-1}],
      search: ''
    }
	},
  methods: {
    editItem (item) {
      this.editedIndex = this.items.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      const index = this.items.indexOf(item)
      confirm('Are you sure you want to delete this item?') && this.items.splice(index, 1)
    },

    close () {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },

    save () {
      if (this.editedIndex > -1) {
        Object.assign(this.items[this.editedIndex], this.editedItem)
      } else {
        this.items.push(this.editedItem)
      }
      this.close()
    }
	},
  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    }
  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },
  created() {
    this.$http.get($base_url+'items/get').then(response => {
      this.itemTable.items=response.body;
      console.log(this.itemTable.items);
    }, response =>{
      console.log("ERROR!!");
    });
  }


});
