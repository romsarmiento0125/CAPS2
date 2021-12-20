<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div>
            <v-btn
              @click="deliverPickupPicker('deliver')"
            >
              <p>Delivery</p>
            </v-btn>
            <v-btn
              @click="deliverPickupPicker('pickup')"
            >
              <p>Pickup</p>
            </v-btn>
          </div>
        </v-col>
        <v-col>
          <div>
            <v-btn>
              <p>To Pack</p>
            </v-btn>
            <v-btn>
              <p>On Delivery</p>
            </v-btn>
            <v-btn>
              <p>Complete</p>
            </v-btn>
            <v-btn>
              <p>Return/Replace</p>
            </v-btn>
            <v-btn>
              <p>Cancelled</p>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      
      <v-divider></v-divider>

      <v-row>
        <v-col>
          <div>
            <v-btn>
              <p>All</p>
            </v-btn>
            <v-btn>
              <p>To Process</p>
            </v-btn>
            <v-btn>
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
        <v-col>
          <div
            class="d-flex"
          >
              <p><v-text-field
                append-icon="mdi-magnify"
                hide-details="auto"
                outlined
                dense
                height="small"
                background-color="white"
                placeholder="Search for entire store here.."
              >
              </v-text-field></p>
              <v-btn>Sort</v-btn>
            </div>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-simple-table height="">
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
                  <td>#{{info.InvoiceNumber}} <br> {{info.Name}}</td>
                  <td><oc-orderdetails
                    :ivNumber="info.InvoiceNumber"
                    :odDate="info.AdjustedDate"
                    :sTotal="info.SubTotal"
                    :shipMethod="info.ShipFee"
                    :dDiscount="info.Discount"
                    :tTax="info.Tax"
                    :tTotal="info.Total"
                  ></oc-orderdetails></td>
                  <td>{{info.CompleteAddress}}</td>
                  <td>{{info.Status}} <br> To Avoid cancellation please send the <br> products until &nbsp;{{info.AdjustedDate}}</td>
                  <td>
                    <v-btn>Actions</v-btn>
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
  import OCOrderDetails from './OCOrderDetails.vue'

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
    }),

    computed: {
      userAllOrders() {
        return this.$store.state.userAllOrders;
      },
    },

    methods: {
      deliverPickupPicker(cond) {
        if(cond == "deliver"){
          this.$store.commit('oCashierDeliver');
        }
        else if(cond == "pickup"){
          this.$store.commit('oCashierPickup');
        }
      }
    },

    beforeMount(){
      // console.log(this.userProfileOrders);
      // console.log(this.userProfileOrderItems);
      //this.infos = this.userAllOrders;
    }
  }
</script>