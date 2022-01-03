<template>
  <div>
    <v-container fluid>
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
                  v-for="(info, n) in userPickupPickup"
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
                  <td>
                    <v-btn
                      @click="toPickupPickup(info.id, info.Email, info.InvoiceNumber, info.Name, info.MobileNumber, info.PickupDate,
                                info.PickupTime, info.Discount, info.Tax, info.SubTotal, info.Total)"
                    >Complete</v-btn>
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
      userPickupPickup() {
        return this.$store.state.userPickupPickup;
      },
    },

    methods: {
      toPickupPickup(id, email, ivNumber, name, mobileNum, pickupDate, pickupTime, discount, tax, subTotal, total){
        this.orderPickup.Email = email;
        this.orderPickup.InvoiceNumber = ivNumber;
        this.orderPickup.Name = name;
        this.orderPickup.Mobilenumber = mobileNum;
        this.orderPickup.OrderStatus = "Complete"
        this.orderPickup.PickupDate = pickupDate;
        this.orderPickup.PickupTime = pickupTime;
        this.orderPickup.Discount = discount;
        this.orderPickup.OrderTax = tax;
        this.orderPickup.SubTotal = subTotal;
        this.orderPickup.Total = total;

        axios.post(this.getDomain()+'api/customerpickupcomplete/store', {
            register: this.orderPickup
          })
          .then(res => {
            this.toDelete(id);
            console.log(res.data);  
          })
          .catch(err => console.error(err));
      },
      toDelete(id){
        axios.delete(this.getDomain()+'api/customerpickuppickup/'+ id)
          .then( res => {
            console.log("Delete")
            console.log(res.data);
            this.getPickupPickup();
          })
          .catch(err => console.error(err))
        
      },
      getPickupPickup(){
        axios.get(this.getDomain()+'api/customerpickuppickup')
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserAllPickup', res.data);
          })
          .catch(err => console.error(err));
      },
    },

    beforeMount() {
      this.getPickupPickup();
    }
  }
</script>