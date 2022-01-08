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
                  v-for="(info, n) in userAllCancel"
                  :key="n"
                >
                  <td>#{{info.invoiceNumber}} <br> {{info.name}}</td>
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
                  <td>{{info.status}}</td>
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

    }),

    computed: {
      userAllCancel() {
        return this.$store.state.userAllCancel;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {
      getAllCancel(){
        axios.get(this.getDomain()+'api/customerordercancel',
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
        .then(res => {
          console.log(res.data);
          this.$store.commit('storeUserAllCancel', res.data);
        })
        .catch(err => console.error(err));
      },
    },

    beforeMount(){
      this.getAllCancel();
    }
  }
</script>