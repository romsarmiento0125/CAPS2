<template>
  <div>
    <v-container fluid>
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
              color="#858585"
              outlined
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
              @click="getPickupOrder"
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
                    Pick up Date
                  </th>
                  <th>
                    Status
                  </th>
                  <th>
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(info, n) in userPickupOrders"
                  :key="n"
                >
                  <td>{{info.name}} <br> {{info.mobileNumber}}</td>
                  <td><oc-orderdetails
                    :ivNumber="info.invoiceNumber"
                    :orders="info.orders"
                    :odDate="info.pickupDate"
                    :sTotal="info.subTotal"
                    shipMethod="Pickup"
                    :dDiscount="info.discount"
                    :tTax="info.tax"
                    :tTotal="info.total"
                  ></oc-orderdetails></td>
                  <td>{{info.pickupDate}} <br> {{info.pickupTime}}</td>
                  <td>{{info.status}}</td>
                  <td v-if="info.status == 'Pending'">
                    <v-btn
                      color="#1106A0"
                      dark
                      
                      @click="toPickupProcess(info.id, info.email, info.invoiceNumber, info.name, info.mobileNumber, info.pickupDate,
                                info.pickupTime, info.discount, info.tax, info.subTotal, info.total)"
                    ><h6> Accept </h6></v-btn>
                  </td>
                  <td v-else-if="info.status == 'Pickup'">
                    <v-btn
                      dark
                      color="#1106A0"
                      @click="toPickupPickup(info.id, info.email, info.invoiceNumber, info.name, info.mobileNumber, info.pickupDate,
                                info.pickupTime, info.discount, info.tax, info.subTotal, info.total)"
                    ><h6>To Claim</h6></v-btn>
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
      orderPickup: {
        Email: "",
        InvoiceNumber: "",
        Name: "",
        Mobilenumber: "",
        OrderStatus: "Pending",
        PickupDate: "",
        PickupTime: "",
        Discount: 0,
        OrderTax: 0,
        SubTotal: 0,
        Total: 0,
      },
    }),

    computed: {
      userPickupOrders() {
        return this.$store.state.userPickupOrders;
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
        console.log(this.orderPickup);
        console.log(this.userPickupOrders);

        var tempId = 0; 

        for(var p = 0; p < this.userPickupOrders.length; p++){
          if(this.orderPickup.InvoiceNumber == this.userPickupOrders[p].InvoiceNumber){
            tempId = p;
          }
        }

        var rn = this.orderPickup.InvoiceNumber;
        var name = this.usersFName + " " + this.usersLName;

        var oqty = "";
        var oname = "";
        var odes = "";
        var oprice = "";

        var hgth = 3.2

        var date = new Date();

        for(var i = 0; i < this.userPickupOrders[tempId].orders.length; i++){
          oqty = oqty + this.userPickupOrders[tempId].orders[i].quantity + "\n";
          oname = oname + this.userPickupOrders[tempId].orders[i].itemName + "\n";
          odes = odes + this.userPickupOrders[tempId].orders[i].itemDesc + "\n";
          oprice = oprice + (this.priceRound((this.userPickupOrders[tempId].orders[i].retailPrice * 1) * this.userPickupOrders[tempId].orders[i].quantity)) + "\n";
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
        pdf.text("Pick Up", .6, 1.2);
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
        pdf.text("" + this.priceRound(this.orderPickup.SubTotal), 2.4, hgth - 1.5);

        pdf.text("-------------------------------------------------------------------------", .6, hgth - 1.4)

        pdf.text("Discount", .6, hgth - 1.3);
        pdf.text("" + this.orderPickup.Discount, 2.4, hgth - 1.3);
        pdf.text("Tax", .6, hgth - 1.2);
        pdf.text("" + this.orderPickup.OrderTax, 2.4, hgth - 1.2);
        pdf.text("Shipping Fee", .6, hgth - 1.1);
        pdf.text("Free", 2.4, hgth - 1.1);
        pdf.text("Total", .6, hgth - 1);
        pdf.text("" + this.priceRound(this.orderPickup.Total), 2.4, hgth - 1);

        pdf.text("-------------------------------------------------------------------------", .6, hgth - .9)

        pdf.text(date+"", 1.6, hgth - .8, null, null, 'center');

        pdf.text("Name: " + this.orderPickup.Name, .6, hgth - .6);
        pdf.text("Contact Number: " + this.orderPickup.Mobilenumber, .6, hgth - .5);
        pdf.text("Pick up date: " + this.orderPickup.PickupDate, .6, hgth - .4);
        pdf.text("Pick up Time: " + this.orderPickup.PickupTime, .6, hgth - .3);
        
        pdf.save(rn +'.pdf');
      },
      showAllToPack(){
        this.$store.commit('showAllPickupItems');
      },
      showToProcessToPack(){
        this.$store.commit('filterAllPickupItems', 'Pending');
      },
      showProcessedToPack(){
        this.$store.commit('filterAllPickupItems', 'Pickup');
      },
      toPickupProcess(id, email, ivNumber, name, mobileNum, pickupDate, pickupTime, discount, tax, subTotal, total){
        this.orderPickup.Email = email;
        this.orderPickup.InvoiceNumber = ivNumber;
        this.orderPickup.Name = name;
        this.orderPickup.Mobilenumber = mobileNum;
        this.orderPickup.OrderStatus = "Pickup"
        this.orderPickup.PickupDate = pickupDate;
        this.orderPickup.PickupTime = pickupTime;
        this.orderPickup.Discount = discount;
        this.orderPickup.OrderTax = tax;
        this.orderPickup.SubTotal = subTotal;
        this.orderPickup.Total = total;

        // console.log(id);
        // console.log(this.orderPickup);

        axios.put(this.getDomain()+'api/customerpickup/' + id, {
            register: this.orderPickup
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeUserPickupOrders', res.data.data);
          })
          .catch(err => console.error(err));

        
      },
      toPickupPickup(id, email, ivNumber, name, mobileNum, pickupDate, pickupTime, discount, tax, subTotal, total){
        this.orderPickup.Email = email;
        this.orderPickup.InvoiceNumber = ivNumber;
        this.orderPickup.Name = name;
        this.orderPickup.Mobilenumber = mobileNum;
        this.orderPickup.OrderStatus = "Claim"
        this.orderPickup.PickupDate = pickupDate;
        this.orderPickup.PickupTime = pickupTime;
        this.orderPickup.Discount = discount;
        this.orderPickup.OrderTax = tax;
        this.orderPickup.SubTotal = subTotal;
        this.orderPickup.Total = total;
        
        axios.post(this.getDomain()+'api/customerpickuppickup/store', {
            register: this.orderPickup,
            userid: id
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            if(res.data.status){
              this.generateReciept();
              this.$store.commit('storeUserPickupOrders', res.data.data);
            }
            else{
              alert(res.data.data);
            }
          })
          .catch(err => console.error(err));
      },
      getPickupOrder(){
        axios.get(this.getDomain()+'api/customerpickup',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data);
            this.$store.commit('storeUserPickupOrders', res.data);
          })
          .catch(err => console.error(err));
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
    },

    beforeMount() {
      this.getPickupOrder();
    }
  }
</script>