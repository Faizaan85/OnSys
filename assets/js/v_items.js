new Vue(
{
	el: '#vue-app',
	data:
	{
		name: '',
		alerts: {
			show: false,
			message: ''
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
    	}
	},
	methods: {
		save_item() {
			this.alerts.show = true;
			this.showAdd = false;
		},
		validate_item_add() {
			
		}
	}


});
