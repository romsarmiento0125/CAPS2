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
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(info, n) in userPickupComplete"
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

    computed: {
      userPickupComplete() {
        return this.$store.state.userPickupComplete;
      },
    },

    methods: {
      getPickupComplete(){
        axios.get(this.getDomain()+'api/customerpickupcomplete')
          .then(res => {
            console.log(res.data);
            this.$store.commit('storeUserPickupComplete', res.data);
          })
          .catch(err => console.error(err));
      },
    },

    beforeMount() {
      this.getPickupComplete();
    }
  }
</script>