new Vue(
{
    el:'#vue-app',
    data:
    {
        name:'Purchase',
        invId: 'CmId',
        item:
        {
            partno: "",
            ssno: "",
            desc: "",
            lqty: 0,
            rqty: 0,
            tqty: 0,
            price: 0.00,
            amount:0.00,
            cost:0.00
        },
        items:
        []
    },
    methods:
    {
        add: function()
        {
            this.item.amount = this.item.tqty * this.item.price;
            this.items.push(Object.assign({},this.item));
            console.log(this.items);
        }
    }
});
