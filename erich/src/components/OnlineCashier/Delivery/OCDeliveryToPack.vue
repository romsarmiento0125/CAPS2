<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div class="mt-15 ml-4">
            <v-btn
              color="#858585"
              outlined
              @click="showAllToPack()"
            >
              <h5>All</h5>
            </v-btn>
            <v-btn
              class="mx-1"
              outlined
              color="#858585"
              @click="showToProcessToPack()"
            >
              <h5>To Process</h5>
            </v-btn>
            <v-btn
              color="#858585"
              outlined
              @click="showProcessedToPack()"
            >
              <h5>Processed</h5>
            </v-btn>
          </div>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <div
          class="my-10 ml-4"
          >
            <v-btn
              dark
              color="#1106A0"
              @click="getAllOrder"
            >
              <p
                class="my-0"
              >
                Refresh
              </p>
            </v-btn>
          </div>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-simple-table light height="650px">
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
                  v-for="(info, n) in userAllOrders"
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
                  <td>{{info.status}} <br> To Avoid cancellation please send the <br> products until &nbsp;{{info.adjustedDate}}</td>
                  <td v-if="info.status == 'Pending'">
                    <div>
                      <v-menu offset-y>
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn
                            color="#1106A0"
                            dark
                            outlined
                            v-bind="attrs"
                            v-on="on"
                          >
                            <h6> Arrange Delivery </h6>
                          </v-btn>
                        </template>
                        <v-list>
                          <v-list-item
                            v-for="counter in counters"
                            :key="counter"
                          >
                            <v-list-item-title>
                              <v-btn
                                @click="toProcess(dateToAccept(info.orderYear, info.orderMonth, info.orderDay, counter),
                                  info.id, info.email, info.mobileNumber, info.invoiceNumber, info.name, info.completeAddress,
                                  info.orderYear, info.orderMonth, info.orderDay, info.shipFee, info.discount, info.tax,
                                  info.subTotal, info.total
                                )"
                              >{{dateToAccept(info.orderYear, info.orderMonth, info.orderDay, counter)}}</v-btn>
                            </v-list-item-title>
                          </v-list-item>
                        </v-list>
                      </v-menu>
                    </div>
                  </td>
                  <td
                    v-else-if="info.status == 'Process'"
                  >
                    <div>
                      <v-btn
                        dark
                        color="#1106A0"
                        @click="toDeliver(info.adjustedDate, info.id, info.email, info.mobileNumber, info.invoiceNumber, info.name, info.completeAddress,
                                  info.orderYear, info.orderMonth, info.orderDay, info.shipFee, info.discount, info.tax,
                                  info.subTotal, info.total)"
                      >
                        <h6> To Deliver </h6>
                      </v-btn>
                    </div>
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
      infos: [
        // { IvNumber: '001', Name: "Rom Paulo Sarmiento", Address: "Norzagaray Poblacion Antonia Heights Subd. Block 0 Lot 0", Status: "Prepairing",
        //   DueDate: "Dec 19 2021", SubTotal: "900", ShipFee: "50", Discount: "0", Tax: "50", Total: "1000"},
      ],
      counters: 3,
      orderUpdate: {
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
        OrderStatus: "Pending",
        OrderTax: 0,
        Discount: 0,
        SubTotal: 0,
        Total: 0,
      },
    }),

    computed: {
      userAllOrders() {
        return this.$store.state.userAllOrders;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {
      showAllToPack(){
        this.$store.commit('showAllOrdersItems');
      },
      showToProcessToPack(){
        this.$store.commit('filterAllOrdersItems', 'Pending');
      },
      showProcessedToPack(){
        this.$store.commit('filterAllOrdersItems', 'Process');
      },
      dateToAccept(yr, mn, dy, i) {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var year = today.getFullYear();
        var dt = year + "-" + month + "-" + (day * 1);
        // if(date == (yr + "-" + mn + "-" + (dy * 1 + i-1))){
        //   return "go";
        // }
        if(day > (dy * 1 + (i-1))){
          return "Cancel";
        }
        else{
          // return yr + "-" + mn + "-" + (dy * 1 + (i-1));
          var adjDate = new Date(today.setDate(today.getDate() + i));
          var adjDay = String(adjDate.getDate()).padStart(2, '0');
          var adjMonth = String(adjDate.getMonth() + 1).padStart(2, '0'); //January is 0!
          var adjYear = adjDate.getFullYear(); 
          return adjYear + "-" + adjMonth + "-" + adjDay;
        }
      },
      toProcess(data, id, Email, MobileNumber, InvoiceNumber, Name, CompleteAddress, OrderYear, OrderMonth,
        OrderDay, ShipFee, Discount, Tax, SubTotal, Total){
        this.orderUpdate.Email = Email;
        this.orderUpdate.Name = Name;
        this.orderUpdate.Mobilenumber = MobileNumber;
        this.orderUpdate.CompleteAddress = CompleteAddress;
        this.orderUpdate.Shipping = ShipFee;
        this.orderUpdate.InvoiceNumber = InvoiceNumber;
        this.orderUpdate.OrderYear = OrderYear;
        this.orderUpdate.OrderMonth = OrderMonth;
        this.orderUpdate.OrderDay = OrderDay;
        this.orderUpdate.AdjustedDate = data;
        this.orderUpdate.OrderStatus = "";
        this.orderUpdate.OrderTax = Tax;
        this.orderUpdate.Discount = Discount;
        this.orderUpdate.SubTotal = SubTotal;
        this.orderUpdate.Total = Total;
        if(data == "Cancel"){
          this.orderUpdate.OrderStatus = "Cancel";
          axios.post(this.getDomain()+'api/customercancel', {
            register: this.orderUpdate,
            userid: id
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.getAllOrder();
          })
          .catch(err => console.error(err));
        }
        else{
          // console.log("process items");
          this.orderUpdate.OrderStatus = "Process";
          axios.put(this.getDomain()+'api/customerorder/' + id, {
            register: this.orderUpdate
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.getAllOrder();
          })
          .catch(err => console.error(err));
        }
      },
      toDeliver(date, id, Email, MobileNumber, InvoiceNumber, Name, CompleteAddress, OrderYear, OrderMonth,
        OrderDay, ShipFee, Discount, Tax, SubTotal, Total){
        this.orderUpdate.Email = Email;
        this.orderUpdate.Name = Name;
        this.orderUpdate.Mobilenumber = MobileNumber;
        this.orderUpdate.CompleteAddress = CompleteAddress;
        this.orderUpdate.Shipping = ShipFee;
        this.orderUpdate.InvoiceNumber = InvoiceNumber;
        this.orderUpdate.OrderYear = OrderYear;
        this.orderUpdate.OrderMonth = OrderMonth;
        this.orderUpdate.OrderDay = OrderDay;
        this.orderUpdate.AdjustedDate = date;
        this.orderUpdate.OrderStatus = "Deliver";
        this.orderUpdate.OrderTax = Tax;
        this.orderUpdate.Discount = Discount;
        this.orderUpdate.SubTotal = SubTotal;
        this.orderUpdate.Total = Total;
        axios.post(this.getDomain()+'api/customerdeliveritems/store', {
            register: this.orderUpdate,
            userid: id
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.getAllOrder();
          })
          .catch(err => console.error(err));
      },
      getAllOrder(){
        axios.get(this.getDomain()+'api/customerorder',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
        .then(res => {
          // console.log(res.data);
          this.$store.commit('storeUserAllOrders', res.data);
        })
        .catch(err => console.error(err));
      },
    },

    beforeMount(){
      this.getAllOrder();
    }
  }
</script>