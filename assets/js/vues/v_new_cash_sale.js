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
      customers:{}
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

    }
  }
});
