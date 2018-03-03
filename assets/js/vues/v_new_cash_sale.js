new Vue({
  el:'#vue-app',
  data:
  {
    active: null,
    customerForm:false,
    name:'customer details here',
    items: 'item details here...',
    customer:{
      loading: false,
      items:[],
      search: null,
      select:[],
      customers: {},
      name:''
    },
    orderTable: {
      headers: [
        {
          text: 'Order #',
          value: 'OmId',
          align: 'left',
          sortable: true
        },
        {
          text: 'Name',
          value: 'OmCompanyName',
          align: 'left',
          sortable: true
        },
        {
          text: 'LPO',
          value: 'OmLpo',
          align: 'left',
          sortable: false
        },
        {
          text: 'Inv #',
          value: 'InId',
          align: 'left',
          sortable: true
        },
        {
          text: 'Status',
          value: 'OmStatus',
          align: 'center',
          sortable: true
        },
        {
          text: 'Store 1',
          value: 'OmStore1',
          align: 'left',
          sortable: true
        },
        {
          text: 'Store 2',
          value: 'OmStore2',
          align: 'left',
          sortable: true
        },
        {
          text: 'Invoiced',
          value: 'OmPrinted',
          align: 'left',
          sortable: true
        },
        {
          text: 'Date',
          value: 'OmCreatedOn',
          align: 'left',
          sortable: true
        },
        {
          text: 'By',
          value: 'OmCreatedBy',
          align: 'left',
          sortable: true
        }
      ],
      orders: [],
      rowsPerPage: [25, 50, 100, {"text":"All","value":-1}],
      search:''
    }
  },
  watch: {
    'customer.search'(val) {
      val && this.customerSelections(val);
    }
  },
  methods: {
    customerSelections(v){
      this.customer.loading=true;

    },
    initialize(){
      console.log($base_url+'orders/get');
      this.$http.get($base_url+'orders/get').then(response => {
        this.orderTable.orders = response.body;
        console.log(this.orderTable.orders);
      }, response => {
        console.log("Initialize Error!!");
        console.log(response.body);
      });
    }
  },
  created() {
    console.log("Hello world");
    this.initialize();
  },
  http: {
    emulateJSON: true,
    emulateHTTP: true
  }
});
