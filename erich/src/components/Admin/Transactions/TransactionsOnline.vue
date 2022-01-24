<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-sheet>
            <div
              class="d-flex"
            >
              <div>
                <v-menu
                  v-model="startmenu"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="startDate"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="startDate"
                    scrollable
                    show-current="false"
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      text
                      color="primary"
                      @click="menu = false"
                    >
                      Cancel
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="menu = false"
                    >
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>
              </div>

              <div>
                <v-menu
                  v-model="endmenu"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="endDate"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="endDate"
                    scrollable
                    show-current="false"
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      text
                      color="primary"
                      @click="endmenu = false"
                    >
                      Cancel
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="endmenu = false"
                    >
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>
              </div>
            </div>
          </v-sheet>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <div
            class="d-flex"
          >
            <div>
              <v-text-field
                append-icon="mdi-magnify"
                hide-details="auto"
                outlined
                dense
                height="small"
                background-color="white"
                placeholder="Search for entire store here.."
                v-model="searchKey"
                v-on:keyup="toSearchItems(searchKey)"
              >
              </v-text-field>
            </div>
            <div>
              <v-btn>
                <p>Generate Report</p>
              </v-btn>
            </div>
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-data-table
            :headers="headers"
            :items="showItems"
            :single-expand="singleExpand"
            :expanded.sync="expanded"
            item-key="invoiceNumber"
            show-expand
            class="elevation-1"
          >
            <template v-slot:expanded-item="{ headers, item }">
              <td :colspan="headers.length">
                <v-simple-table 
                  dense
                  class="transparent"
                >
                  <template v-slot:default>
                    <thead>
                      <tr>
                        <th class="text-left">
                          Name
                        </th>
                        <th class="text-left">
                          Description
                        </th>
                        <th class="text-left">
                          Size
                        </th>
                        <th class="text-left">
                          Price
                        </th>
                        <th class="text-left">
                          Quantity
                        </th>
                        <th class="text-left">
                          Total
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="it in item.orders"
                        :key="it.id"
                      >
                        <td>{{ it.itemName }}</td>
                        <td>{{ it.itemDesc }}</td>
                        <td>{{ it.itemSize }}</td>
                        <td>{{ it.retailPrice }}</td>
                        <td>{{ it.quantity }}</td>
                        <td>{{ priceRound(it.retailPrice * it.quantity) }}</td>
                      </tr>
                    </tbody>
                  </template>
                </v-simple-table>
              </td>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      endmenu: false,
      startmenu: false,
      startDate: "2022-01-19",
      endDate: new Date().toISOString().slice(0, 10),
      headers: [
        { text: 'Invoice Number', value: 'invoiceNumber'},
        { text: 'Name', value: 'name'},
        { text: 'Email', value: 'email'},
        { text: 'Mobile Number', value: 'mobileNumber'},
        { text: 'Date Complete', value: 'adjustedDate'},
        { text: 'Total', value: 'total'},
      ],
      expanded: [],
      singleExpand: false,
      searchKey: "",
      showItems: [],
    }),

    computed: {
      adminDataDeliver(){
        return this.$store.state.adminDataDeliver;
      },
      adminDataPickup(){
        return this.$store.state.adminDataPickup;
      },
      adminAllData(){
        return this.mergeData();
      },
      computedShowItems(){
        var sk = this.searchKey;
        var re = new RegExp(sk, 'gi');
        return this.showItems.filter((item) => {
          return item.invoiceNumber.match(re) || item.name.match(re);
        });
      },
    },

    watch: {
      adminDataDeliver(){
        this.adminAllData;
      },
      adminDataPickup(){
        this.adminAllData;
      },
      startDate(){
        this.adminAllData;
      },
      endDate(){
        this.adminAllData;
      }
    },

    methods: {
      toSearchItems(){
        this.showItems = this.adminAllData;
        this.showItems = this.computedShowItems;
      },
      mergeData(){
        if((this.adminDataDeliver == null) || (this.adminDataPickup == null)){
          return [];
        }
        else{
          var deliverdata = this.adminDataDeliver;
          var pickupdata = this.adminDataPickup;
          var tempItem = [];

          for(var i = 0; i < deliverdata.length; i++){
            if((deliverdata[i].adjustedDate >= this.startDate) && (deliverdata[i].adjustedDate <= this.endDate)){
              tempItem.push({
                invoiceNumber: deliverdata[i].invoiceNumber, 
                name: deliverdata[i].name,
                email: deliverdata[i].email,
                mobileNumber: deliverdata[i].mobileNumber,
                adjustedDate: deliverdata[i].adjustedDate,
                total: deliverdata[i].total,
                orders: deliverdata[i].orders
              });
            }
          }
          for(var i = 0; i < pickupdata.length; i++){
            if((pickupdata[i].pickupDate >= this.startDate) && (pickupdata[i].pickupDate <= this.endDate)){
              tempItem.push({
                invoiceNumber: pickupdata[i].invoiceNumber, 
                name: pickupdata[i].name,
                email: pickupdata[i].email,
                mobileNumber: pickupdata[i].mobileNumber,
                adjustedDate: pickupdata[i].pickupDate,
                total: pickupdata[i].total,
                orders: pickupdata[i].orders
              });
            }
          }
          this.showItems = tempItem;
          return tempItem;
        }
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      }
    },

    beforeMount() {
      this.adminAllData;
    }
  }
</script>