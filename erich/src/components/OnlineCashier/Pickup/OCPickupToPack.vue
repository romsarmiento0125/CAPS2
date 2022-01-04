<template>
  <div>
    <v-container fluid>
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
                      @click="toPickupProcess(info.id, info.email, info.invoiceNumber, info.name, info.mobileNumber, info.pickupDate,
                                info.pickupTime, info.discount, info.tax, info.subTotal, info.total)"
                    >Accept</v-btn>
                  </td>
                  <td v-else-if="info.status == 'Pickup'">
                    <v-btn
                      @click="toPickupPickup(info.id, info.email, info.invoiceNumber, info.name, info.mobileNumber, info.pickupDate,
                                info.pickupTime, info.discount, info.tax, info.subTotal, info.total)"
                    >To Claim</v-btn>
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
    },

    methods: {
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

        console.log(id);
        console.log(this.orderPickup);

        axios.put(this.getDomain()+'api/customerpickup/' + id, {
            register: this.orderPickup
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            console.log(res.data);
            this.getPickupOrder();
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
            register: this.orderPickup
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.toDelete(id);
            console.log(res.data);  
          })
          .catch(err => console.error(err));
      },
      toDelete(id){
        axios.delete(this.getDomain()+'api/customerpickup/'+ id,
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then( res => {
            console.log("Delete")
            console.log(res.data);
            this.getPickupOrder();
          })
          .catch(err => console.error(err))
        
      },
      getPickupOrder(){
        axios.get(this.getDomain()+'api/customerpickup',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserPickupOrders', res.data);
          })
          .catch(err => console.error(err));
      },
    },

    beforeMount() {
      this.getPickupOrder();
    }
  }
</script>