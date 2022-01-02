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
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(info, n) in userAllComplete"
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
                  <td>{{info.Status}} <br> Recieve na</td>
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
    }),

    computed: {
      userAllComplete() {
        return this.$store.state.userAllComplete;
      },
    },

    methods: {
      getAllComplete(){
        axios.get(this.getDomain()+'api/customercompleteitems')
        .then(res => {
          console.log(res.data);
          this.$store.commit('storeUserAllComplete', res.data);
        })
        .catch(err => console.error(err));
      },
    },

    beforeMount(){
      this.getAllComplete();
      // console.log(this.userProfileOrders);
      // console.log(this.userProfileOrderItems);
      //this.infos = this.userAllOrders;
    }
  }
</script>