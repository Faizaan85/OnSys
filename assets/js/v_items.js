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
		errorMessage:{
			part_no:[],
			ssno:[]
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
			partError: false,
      required: (value) => !!value || 'Required',
      max2: (v) => {
        if(v && v.length<=2){
          return 'Max 2 digits';
        }
        else{
          return true;
        }
      },
      max10: (v) => {
        if(v && v.length>=10){
          return 'Max 10 Characters';
        }
        else{
          return true;
        }
      },
			max15: (v) => {
				if(v && v.length>=15) {
					return 'Max 15 Characters';
				}
				return true;
			},
      max20: (v) => {
				if(v && v.length>=20) {
					return 'Max 20 Characters';
				}
				return true;
			},
      max30: (v) => {
				if(v && v.length>=30) {
					return 'Max 30 Characters';
				}
				return true;
			},
      max80: (v) => {
				if(v && v.length>=80) {
						return 'Max 80 Characters';
				}
				return true;
			},
      max100: (v) => {
				if(v && v.length>=100) {
					return 'Max 100 Characters';
				}
				return true;
			}
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
        this.$http.post($base_url+'items/put',{item: this.editedItem}).then(response =>{
          console.log(response.status);
          console.log(response.body);
          Object.assign(this.itemTable.items[this.editedIndex], this.editedItem);
        },response => {
          console.log("update error");
					console.log(response.status);
					console.log(response.body);
        })

        //replace item with index with editedItem.
      } else {
				this.$http.post($base_url+'items/post',{item: this.editedItem}).then(response => {
					console.log(response.status);
					console.log(response.body);
        	this.itemTable.items.push(this.editedItem);
				}, response => {
					console.log("Save error");
					console.log(response.status);
					console.log(response.body);
				});
      }
      this.close();
    },
    checkIfExists(val,event){
			if(this.editedIndex > -1) {
				return;
			}
			let searchField = val;
			let searchValue = event.path["0"].value;
			if(searchValue == '') {
				return;
			}
			this.$http.get($base_url+'items/search?field='+searchField+'&value='+searchValue+'&count=1').then(response => {
        this.errorMessage[searchField] = [searchValue + ' already exists.'];
				this.rules.partError = true;
			}, response =>{
        this.errorMessage[searchField] = [];
				this.rules.partError = false;
			});
    },
	},
  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    }
  },
  watch: {
    dialog (val) {
      val || this.close();
    }
  },
  created() {
    this.$http.get($base_url+'items/get?').then(response => {
      this.itemTable.items=response.body;
      console.log(this.itemTable.items);
    }, response => {
      console.log("ERROR!! loading item table");
    });
  },
	http: {
		emulateJSON: true,
		emulateHTTP: true
	}
});
