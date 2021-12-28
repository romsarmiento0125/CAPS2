<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div>
            <v-btn
              @click="showAllToPack()"
            >
              <p>All</p>
            </v-btn>
            <v-btn
              @click="showToProcessToPack()"
            >
              <p>To Process</p>
            </v-btn>
            <v-btn
              @click="showProcessedToPack()"
            >
              <p>Processed</p>
            </v-btn>
          </div>
        </v-col>
      </v-row>

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
                  v-for="(info, n) in userAllOrders"
                  :key="n"
                >
                  <td>{{info.Name}} <br> {{info.MobileNumber}}</td>
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
                  <td>{{info.Status}} <br> To Avoid cancellation please send the <br> products until &nbsp;{{info.AdjustedDate}}</td>
                  <td v-if="info.Status == 'Pending'">
                    <div class="text-center">
                      <v-menu offset-y>
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn
                            color="primary"
                            dark
                            v-bind="attrs"
                            v-on="on"
                          >
                            Arrange Delivery
                          </v-btn>
                        </template>
                        <v-list>
                          <v-list-item
                            v-for="counter in counters"
                            :key="counter"
                          >
                            <v-list-item-title>
                              <v-btn
                                @click="toProcess(dateToAccept(info.OrderYear, info.OrderMonth, info.OrderDay, counter),
                                  info.id, info.Email, info.MobileNumber, info.InvoiceNumber, info.Name, info.CompleteAddress,
                                  info.OrderYear, info.OrderMonth, info.OrderDay, info.ShipFee, info.Discount, info.Tax,
                                  info.SubTotal, info.Total
                                )"
                              >{{dateToAccept(info.OrderYear, info.OrderMonth, info.OrderDay, counter)}}</v-btn>
                            </v-list-item-title>
                          </v-list-item>
                        </v-list>
                      </v-menu>
                    </div>
                  </td>
                  <td
                    v-else-if="info.Status == 'Process'"
                  >
                    <div class="text-center">
                      <v-btn
                        @click="toDeliver(info.AdjustedDate, info.id, info.Email, info.MobileNumber, info.InvoiceNumber, info.Name, info.CompleteAddress,
                                  info.OrderYear, info.OrderMonth, info.OrderDay, info.ShipFee, info.Discount, info.Tax,
                                  info.SubTotal, info.Total)"
                      >
                        <p> deliver </p>
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

  export default {
    components: {
      "oc-orderdetails": OCOrderDetails,
    },

    data: () => ({
      infos: [
        // { IvNumber: '001', Name: "Rom Paulo Sarmiento", Address: "Norzagaray Poblacion Antonia Heights Subd. Block 0 Lot 0", Status: "Prepairing",
        //   DueDate: "Dec 19 2021", SubTotal: "900", ShipFee: "50", Discount: "0", Tax: "50", Total: "1000"},
        // { IvNumber: '002', Name: "Reyster Del Rosario", Address: "Sta.Maria Pulong Buhangin Gulod Lot 0 Block 0", Status: "Prepariring",
        //   DueDate: "Dec 19 2021", SubTotal: "800", ShipFee: "50", Discount: "0", Tax: "50", Total: "900"},
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
          return yr + "-" + mn + "-" + (dy * 1 + (i-1));
        }
      },
      toProcess(data, id, Email, MobileNumber, InvoiceNumber, Name, CompleteAddress, OrderYear, OrderMonth,
        OrderDay, ShipFee, Discount, Tax, SubTotal, Total){
        console.log("To Process" + data);
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
        this.orderUpdate.OrderStatus = "Process";
        this.orderUpdate.OrderTax = Tax;
        this.orderUpdate.Discount = Discount;
        this.orderUpdate.SubTotal = SubTotal;
        this.orderUpdate.Total = Total;
        console.log("Order update");
        console.log(this.orderUpdate);
        axios.put('http://127.0.0.1:8000/api/customerorder/' + id, {
            register: this.orderUpdate
          })
          .then(res => {
            console.log(res.data);
            this.getAllOrder();
          })
          .catch(err => console.error(err));
      },
      toDeliver(date, id, Email, MobileNumber, InvoiceNumber, Name, CompleteAddress, OrderYear, OrderMonth,
        OrderDay, ShipFee, Discount, Tax, SubTotal, Total){
        console.log("To Deliver");
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
        axios.post('http://127.0.0.1:8000/api/customerdeliveritems/store', {
            register: this.orderUpdate
          })
          .then(res => {
            this.toDelete(id);
            console.log(res.data);  
          })
          .catch(err => console.error(err));
      },
      toDelete(id){
        axios.delete('http://127.0.0.1:8000/api/customerorder/'+ id)
          .then( res => {
            console.log("Delete")
            console.log(res.data);
            this.getAllOrder();
          })
          .catch(err => console.error(err))
        
      },
      getAllOrder(){
        axios.get('http://127.0.0.1:8000/api/customerorder')
        .then(res => {
          console.log(res.data);
          this.$store.commit('storeUserAllOrders', res.data);
        })
        .catch(err => console.error(err));
      },
    },

    beforeMount(){
      this.getAllOrder();
      // console.log(this.userProfileOrders);
      // console.log(this.userProfileOrderItems);
      //this.infos = this.userAllOrders;
    }
  }
</script>