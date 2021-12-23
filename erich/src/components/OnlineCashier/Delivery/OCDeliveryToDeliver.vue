<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div
          >
            <p>Order</p>
          </div>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-simple-table height="650px">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">
                    Customer Details
                  </th>
                  <th>
                    Order Details
                  </th>
                  <th>
                    Customer Address
                  </th>
                  <th>
                    Status/Countdown
                  </th>
                  <th>
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(info, n) in userAllDeliver"
                  :key="n"
                >
                  <td>#{{info.InvoiceNumber}} <br> {{info.Name}}</td>
                  <td><oc-orderdetails
                    :ivNumber="info.InvoiceNumber"
                    :orders="info.orders"
                    :odDate="info.AdjustedDate"
                    :sTotal="info.SubTotal"
                    :shipMethod="info.ShipFee"
                    :dDiscount="info.Discount"
                    :tTax="info.Tax"
                    :tTotal="info.Total"
                  ></oc-orderdetails></td>
                  <td>{{info.CompleteAddress}}</td>
                  <td>{{info.Status}} <br> Pa deliver na</td>
                  <td>
                    <v-btn
                      @click="toComplete(info.id, info.Email, info.InvoiceNumber, info.Name, info.MobileNumber, info.CompleteAddress,
                        info.OrderYear, info.OrderMonth, info.OrderDay, info.AdjustedDate, info.ShipFee, info.Discount,
                        info.Tax, info.SubTotal, info.Total
                      )"
                    >
                      <p>Complete</p>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import OCOrderDetails from '../OCOrderDetails.vue'

  export default {
    components: {
      "oc-orderdetails": OCOrderDetails,
    },

    data: () => ({
      orderid: 0,
      orderDeliver: {
        Email: "",
        Name: "",
        Mobilenumber: "",
        CompleteAddress: "",
        Shipping: "",
        InvoiceNumber: "",
        OrderYear: "",
        OrderMonth: "",
        OrderDay: "",
        AdjustedDate: "",
        OrderStatus: "Complete",
        OrderTax: 0,
        Discount: 0,
        SubTotal: 0,
        Total: 0,
      },
    }),

    computed: {
      userAllDeliver() {
        return this.$store.state.userAllDeliver;
      },
    },

    methods: {
      toComplete(id, Email, InvoiceNumber, Name, MobileNumber, CompleteAddress, OrderYear, OrderMonth, 
        OrderDay, AdjustedDate, ShipFee, Discount, Tax, SubTotal, Total) {
        this.orderDeliver.Email = Email;
        this.orderDeliver.Name = Name;
        this.orderDeliver.Mobilenumber = MobileNumber;
        this.orderDeliver.CompleteAddress = CompleteAddress;
        this.orderDeliver.Shipping = ShipFee;
        this.orderDeliver.InvoiceNumber = InvoiceNumber;
        this.orderDeliver.OrderYear = OrderYear;
        this.orderDeliver.OrderMonth = OrderMonth;
        this.orderDeliver.OrderDay = OrderDay;
        this.orderDeliver.AdjustedDate = AdjustedDate;
        this.orderDeliver.OrderTax = Tax;
        this.orderDeliver.Discount = Discount;
        this.orderDeliver.SubTotal = SubTotal;
        this.orderDeliver.Total = Total;
        this.orderid = id;
        console.log("to Complete");
        axios.post('http://127.0.0.1:8000/api/customercompleteitems/store', {
            register: this.orderDeliver
          })
          .then(res => {
            this.toDelete();
            console.log(res.data);  
          })
          .catch(err => console.error(err));
      },
      toDelete(){
        axios.delete('http://127.0.0.1:8000/api/customerdeliveritems/'+ this.orderid)
          .then( res => {
            console.log("Delete")
            console.log(res.data);
            this.getAllDeliver();
          })
          .catch(err => console.error(err))
      },
      getAllDeliver(){
        axios.get('http://127.0.0.1:8000/api/customerdeliveritems')
        .then(res => {
          console.log(res.data);
          this.$store.commit('storeUserAllDeliver', res.data);
        })
        .catch(err => console.error(err));
      },
    },

    beforeMount(){
      this.getAllDeliver();
      // console.log(this.userProfileOrders);
      // console.log(this.userProfileOrderItems);
      //this.infos = this.userAllOrders;
    }
  }
</script>