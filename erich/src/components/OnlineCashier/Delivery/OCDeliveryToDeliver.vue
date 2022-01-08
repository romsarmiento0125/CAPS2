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
                  <td>{{info.name}} <br> {{info.mobileNumber}}</td>
                  <td><oc-orderdetails
                    :ivNumber="info.invoiceNumber"
                    :orders="info.orders"
                    :odDate="info.adjustedDate"
                    :sTotal="info.subTotal"
                    :shipMethod="info.shipFee"
                    :dDiscount="info.discount"
                    :tTax="info.tax"
                    :tTotal="info.total"
                  ></oc-orderdetails></td>
                  <td>{{info.completeAddress}}</td>
                  <td>{{info.status}} <br> Pa deliver na</td>
                  <td>
                    <v-btn
                      @click="toComplete(info.id, info.email, info.invoiceNumber, info.name, info.mobileNumber, info.completeAddress,
                        info.orderYear, info.orderMonth, info.orderDay, info.adjustedDate, info.shipFee, info.discount,
                        info.tax, info.subTotal, info.total
                      )"
                    >
                      <p>Complete</p>
                    </v-btn>
                    <v-btn
                      @click="toCancel(info.id, info.email, info.invoiceNumber, info.name, info.mobileNumber, info.completeAddress,
                        info.orderYear, info.orderMonth, info.orderDay, info.adjustedDate, info.shipFee, info.discount,
                        info.tax, info.subTotal, info.total
                      )"
                    >
                      <p>Cancel</p>
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
  import {Mixins} from '../../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

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
      orderCancel: {
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
        OrderStatus: "Cancel",
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
      usersToken(){
        return localStorage.getItem('token');
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
        console.log(this.orderDeliver);
        axios.post(this.getDomain()+'api/customercompleteitems/store', {
            register: this.orderDeliver,
            userid: this.orderid
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.getAllDeliver();
          })
          .catch(err => console.error(err));
      },
      toCancel(id, Email, InvoiceNumber, Name, MobileNumber, CompleteAddress, OrderYear, OrderMonth, 
        OrderDay, AdjustedDate, ShipFee, Discount, Tax, SubTotal, Total) {
        this.orderCancel.Email = Email;
        this.orderCancel.Name = Name;
        this.orderCancel.Mobilenumber = MobileNumber;
        this.orderCancel.CompleteAddress = CompleteAddress;
        this.orderCancel.Shipping = ShipFee;
        this.orderCancel.InvoiceNumber = InvoiceNumber;
        this.orderCancel.OrderYear = OrderYear;
        this.orderCancel.OrderMonth = OrderMonth;
        this.orderCancel.OrderDay = OrderDay;
        this.orderCancel.AdjustedDate = AdjustedDate;
        this.orderCancel.OrderTax = Tax;
        this.orderCancel.Discount = Discount;
        this.orderCancel.SubTotal = SubTotal;
        this.orderCancel.Total = Total;
        this.orderid = id;
        // console.log("to Cancel");
        // console.log(this.orderDeliver);
        axios.post(this.getDomain()+'api/customerordercancel/store', {
          register: this.orderCancel,
          userid: this.orderid
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          // console.log(res.data);
          this.getAllDeliver();
        })
        .catch(err => console.error(err));
      },
      // toDelete(){
      //   axios.delete(this.getDomain()+'api/customerdeliveritems/'+ this.orderid,
      //     {
      //       headers:{
      //         "Authorization": `Bearer ${this.usersToken}`,
      //     }
      //     })
      //     .then( res => {
      //       console.log("Delete")
      //       console.log(res.data);
      //       this.getAllDeliver();
      //     })
      //     .catch(err => console.error(err))
      // },
      getAllDeliver(){
        axios.get(this.getDomain()+'api/customerdeliveritems',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
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