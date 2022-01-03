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
                  <td>{{info.Name}} <br> {{info.MobileNumber}}</td>
                  <td><oc-orderdetails
                    :ivNumber="info.InvoiceNumber"
                    :orders="info.orders"
                    :odDate="info.PickupDate"
                    :sTotal="info.SubTotal"
                    shipMethod="Pickup"
                    :dDiscount="info.Discount"
                    :tTax="info.Tax"
                    :tTotal="info.Total"
                  ></oc-orderdetails></td>
                  <td>{{info.PickupDate}} <br> {{info.PickupTime}}</td>
                  <td>{{info.Status}}</td>
                  <td v-if="info.Status == 'Pending'">
                    <v-btn
                      @click="toPickupProcess(info.id, info.Email, info.InvoiceNumber, info.Name, info.MobileNumber, info.PickupDate,
                                info.PickupTime, info.Discount, info.Tax, info.SubTotal, info.Total)"
                    >Accept</v-btn>
                  </td>
                  <td v-else-if="info.Status == 'Pickup'">
                    <v-btn
                      @click="toPickupPickup(info.id, info.Email, info.InvoiceNumber, info.Name, info.MobileNumber, info.PickupDate,
                                info.PickupTime, info.Discount, info.Tax, info.SubTotal, info.Total)"
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
          })
          .then(res => {
            this.toDelete(id);
            console.log(res.data);  
          })
          .catch(err => console.error(err));
      },
      toDelete(id){
        axios.delete(this.getDomain()+'api/customerpickup/'+ id)
          .then( res => {
            console.log("Delete")
            console.log(res.data);
            this.getPickupOrder();
          })
          .catch(err => console.error(err))
        
      },
      getPickupOrder(){
        axios.get(this.getDomain()+'api/customerpickup')
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