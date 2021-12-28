<template>
  <div>
    <v-container>
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
          <v-simple-table height="300px">
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
                  v-for="(info, n) in infos"
                  :key="n"
                >
                  <td>{{info.IvNumber}} {{info.Name}}</td>
                  <td><oc-orderdetails></oc-orderdetails></td>
                  <td>{{info.Address}}</td>
                  <td>{{info.Status}} {{info.DueDate}}</td>
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
  import OCOrderDetails from '../OCOrderDetails.vue'

  export default {
    components: {
      "oc-orderdetails": OCOrderDetails,
    },

    data () {
      return {
        infos: [
          { IvNumber: '001', Name: "Rom Paulo Sarmiento", Address: "Norzagaray Poblacion Antonia Heights Subd. Block 0 Lot 0", Status: "Prepairing",
            DueDate: "Dec 19 2021", SubTotal: "900", ShipFee: "50", Discount: "0", Tax: "50", Total: "1000"},
          { IvNumber: '002', Name: "Reyster Del Rosario", Address: "Sta.Maria Pulong Buhangin Gulod Lot 0 Block 0", Status: "Prepariring",
            DueDate: "Dec 19 2021", SubTotal: "800", ShipFee: "50", Discount: "0", Tax: "50", Total: "900"},
        ],
        items: [
          { IvNumber: '001', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
          { IvNumber: '001', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
          { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
          { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
          { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        ],
      }
    },

    computed: {

    },

    methods: {
    }
  }
</script>