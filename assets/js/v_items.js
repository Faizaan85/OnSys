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
      PART_NO:'',
      SSNO:'',
      DESC:'',
      EQUIPMENT:'',
      CO_NAME:'',
      REMARK:'',
      BIN:'',
      UNIT:'PC',
      PKG_QTY: 1,
      WT:0.00,
      UNIT_COST:0.00,
      SALES_PRIC:0.00,
      QTY_HAND:0,
      QTY_RES:0,
      MAX_LEVEL:0,
      MIN_LEVEL:0,
      QTY_ORDER:0,
      OP_STOCK:0,
      FRRATE:0,
      valid:false
    },
      defaultItem: {
        PART_NO:'',
        SSNO:'',
        DESC:'',
        EQUIPMENT:'',
        CO_NAME:'',
        REMARK:'',
        BIN:'',
        UNIT:'',
        PKG_QTY: 1,
        WT:0.00,
        UNIT_COST:0.00,
        SALES_PRIC:0.00,
        QTY_HAND:0,
        QTY_RES:0,
        MAX_LEVEL:0,
        MIN_LEVEL:0,
        QTY_ORDER:0,
        OP_STOCK:0,
        FRRATE:0
      },
    showAdd: false,
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
    },
    rules: {
      loading: false,
      required: (value) => !!value || 'Required',
      max2: (value) => {
        if(!value && value.length<=2){
          return 'Max 2 digits';
        }
        else{
          return true;
        }
      },
      max10: (value) => {
        if(!value && value.length<=10){
          return 'Max 10 Characters';
        }
        else{
          return true;
        }
      },
      max15: (value) => {
        if(value){
          if(value.length>15){
            return 'Max 15 digits';
          }
        }
        else{
          return true;
        }
      },
      max20: (value) => value.length<=20 || 'Max 20 Characters',
      max30: (value) => value.length<=30 || 'Max 30 Characters',
      max80: (value) => value.length<=80 || 'Max 80 Characters',
      max100: (value) => value.length<=100 || 'Max 100 Characters'
    }
	},
  methods: {
    editItem (item) {
      this.$refs.addEditItem.reset()
      this.editedIndex = this.itemTable.items.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },
    deleteItem (item) {
      const index = this.itemTable.items.indexOf(item)
      confirm('Are you sure you want to delete this item?') && this.itemTable.items.splice(index, 1)
    },
    open () {
      this.$refs.addEditItem.reset();
      this.editedItem.UNIT = "PC";
      this.dialog = true;
    },
    close () {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300);

    },
    save () {
      if(this.editedItem.valid==false){
        return;
      }
      if (this.editedIndex > -1) { // means its Editing
        Object.assign(this.itemTable.items[this.editedIndex], this.editedItem)
        //replace item with index with editedItem.
      } else {
        this.itemTable.items.push(this.editedItem)
      }
      this.close()
    },
    checkIfExists(val,event){
      // this.$http.get($base_url+'items/search?'+field+'='+value+'&count=1').then(response => {
      //   console.log(response.body);
      // });

      console.log(val);
      console.log(event);
    },
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
    this.$http.get($base_url+'items/get?count=50').then(response => {
      this.itemTable.items=response.body;
      console.log(this.itemTable.items);
    }, response =>{
      console.log("ERROR!!");
    });
  }
});
