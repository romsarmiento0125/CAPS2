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
                      <!-- <v-menu offset-y>
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
                      </v-menu> -->
                      
                      <v-menu
                        :close-on-content-click="false"
                        transition="scale-transition"
                        left
                        offset-x
                        min-width="auto"
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <!-- <v-text-field
                            v-model="date"
                            outlined
                            readonly
                            v-bind="attrs"
                            v-on="on"
                          ></v-text-field> -->
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
                        <v-date-picker
                          v-model="date"
                          @input="toProcess(date, info.id, info.email, info.mobileNumber, info.invoiceNumber, info.name, info.completeAddress,
                              info.orderYear, info.orderMonth, info.orderDay, info.shipFee, info.discount, info.tax,
                              info.subTotal, info.total)"
                        ></v-date-picker>
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
  import jsPDF from 'jspdf'

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
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu2: false,
    }),

    computed: {
      userAllOrders() {
        return this.$store.state.userAllOrders;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
      usersFName(){
        return localStorage.getItem('firstName');
      },
      usersLName(){
        return localStorage.getItem('lastName');
      },
    },

    methods: {
      generateReciept(){
        // console.log(this.orderUpdate);
        // console.log(this.userAllOrders);

        var tempId = 0; 

        for(var p = 0; p < this.userAllOrders.length; p++){
          if(this.orderUpdate.InvoiceNumber == this.userAllOrders[p].InvoiceNumber){
            tempId = p;
          }
        }

        var rn = this.orderUpdate.InvoiceNumber;
        var name = this.usersFName + " " + this.usersLName;

        var oqty = "";
        var oname = "";
        var odes = "";
        var oprice = "";

        var ship = 0;
        if(this.orderUpdate.Shipping != "Free"){
          ship = this.orderUpdate.Shipping;
        }

        var hgth = 3.2

        var date = new Date();

        for(var i = 0; i < this.userAllOrders[tempId].orders.length; i++){
          oqty = oqty + this.userAllOrders[tempId].orders[i].quantity + "\n";
          oname = oname + this.userAllOrders[tempId].orders[i].itemName + "\n";
          odes = odes + this.userAllOrders[tempId].orders[i].itemDesc + "\n";
          oprice = oprice + (this.priceRound((this.userAllOrders[tempId].orders[i].retailPrice * 1) * this.userAllOrders[tempId].orders[i].quantity)) + "\n";
          hgth = hgth + .1;
        }

        var pdf = new jsPDF({
          unit: "in",
          format: [3.2, hgth]
        });
        
        pdf.setFont("helvetica", "bold");
        pdf.setFontSize(10);
        pdf.text("ERICH GROCERY", 1.6, .5, null, null, 'center');

        pdf.setFont("helvetica", "normal");
        pdf.setFontSize(6);
        pdf.text("Owner & Optd By: Jhona S. Pontejo", 1.6, .6, null, null, 'center');
        pdf.text("Km. 38 Pulong Buhangin Sta. Maria Bulacan", 1.6, .7, null, null, 'center');
        pdf.text("Vat Reg Tin: 123-456-789-0000", 1.6, .8, null, null, 'center');

        pdf.setFont("helvetica", "bold");
        pdf.setFontSize(8);
        pdf.text("Official Receipt #:"+rn, .6, 1.1);

        pdf.setFont("helvetica", "normal");
        pdf.setFontSize(6);
        pdf.text("Delivery", .6, 1.2);
        pdf.text("Cashier: " + name, .6, 1.3);

        pdf.text("-------------------------------------------------------------------------", .6, 1.4)

        pdf.text("Qty", .6, 1.5);
        pdf.text("Name", .9, 1.5);
        pdf.text("Description", 1.6, 1.5);
        pdf.text("Price", 2.4, 1.5);

        pdf.text(oqty, .6, 1.6);
        pdf.text(oname, .9, 1.6);
        pdf.text(odes, 1.6, 1.6);
        pdf.text(oprice, 2.4, 1.6);

        pdf.text("-------------------------------------------------------------------------", .6, hgth - 1.6)

        pdf.text("Sub Total", .6, hgth - 1.5);
        pdf.text("" + this.priceRound(this.orderUpdate.SubTotal), 2.4, hgth - 1.5);

        pdf.text("-------------------------------------------------------------------------", .6, hgth - 1.4)

        pdf.text("Vatable Sales", .6, hgth - 1.3);
        pdf.text("" + this.priceRound(this.orderUpdate.Total - this.orderUpdate.OrderTax), 2.4, hgth - 1.3);
        pdf.text("Vat Amount", .6, hgth - 1.2);
        pdf.text("" + this.orderUpdate.OrderTax, 2.4, hgth - 1.2);
        pdf.text("Shipping Fee", .6, hgth - 1.1);
        pdf.text("" + this.orderUpdate.Shipping, 2.4, hgth - 1.1);
        pdf.text("Total", .6, hgth - 1);
        pdf.text("" + this.priceRound(this.orderUpdate.Total + ship), 2.4, hgth - 1);

        pdf.text("-------------------------------------------------------------------------", .6, hgth - .9)

        pdf.text(date+"", 1.6, hgth - .8, null, null, 'center');

        pdf.text("Name: " + this.orderUpdate.Name, .6, hgth - .6);
        pdf.text("Contact Number: " + this.orderUpdate.Mobilenumber, .6, hgth - .5);
        pdf.text("Address: ", .6, hgth - .4);
        pdf.text("" + this.orderUpdate.CompleteAddress, 1.5, hgth - .3, null, null, 'center');
        
        pdf.save(rn +'.pdf');
      },
      showAllToPack(){
        this.$store.commit('showAllOrdersItems');
      },
      showToProcessToPack(){
        this.$store.commit('filterAllOrdersItems', 'Pending');
      },
      showProcessedToPack(){
        this.$store.commit('filterAllOrdersItems', 'Process');
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
        this.orderUpdate.OrderStatus = "Process";
        this.orderUpdate.OrderTax = Tax;
        this.orderUpdate.Discount = Discount;
        this.orderUpdate.SubTotal = SubTotal;
        this.orderUpdate.Total = Total;
        
        //   // console.log("process items");

        axios.put(this.getDomain()+'api/customerorder/' + id, {
          register: this.orderUpdate
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          // console.log(res.data);
          this.$store.commit('storeUserAllOrders', res.data.data);
        })
        .catch(err => console.error(err));

        // console.log(data);
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
        this.orderUpdate.OrderTax = this.priceRound(Total * .12);
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
            // this.getAllOrder();
            if(res.data.status){
              this.generateReciept();
              this.$store.commit('storeUserAllOrders', res.data.data);
            }
            else{
              alert(res.data.data);
            }
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
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
    },

    beforeMount(){
      this.getAllOrder();
    }
  }
</script>