<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <v-sheet>
            <div
              class="d-flex mt-3"
            >
              <v-row>
                <v-col>
                  <v-sheet
                  max-height="90px"
                  height="90px"
                  >
                    <div class="pl-10 pt-2 fontTitle">
                      <h4>From - To</h4>

                    </div>

                    <div class="d-flex pl-10 mt-n4">
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
            </div>
          </v-sheet>
        </v-col>
      </v-row>
      
      
        <v-row class="mt-15">
          <v-col cols="6" class="py-5">
              <div class="">
                <v-text-field
                  class=""
                  append-icon="mdi-magnify"
                  hide-details="auto"
                  outlined
                  dense
                  rounded
                  height="small"
                  color="#1106A0"
                  background-color="white"
                  placeholder="Search for entire store here.."
                  v-model="searchKey"
                  v-on:keyup="toSearchItems(searchKey)"
                >
                </v-text-field>
              </div>
            
          </v-col>
          <v-col cols="6" class="d-flex justify-end">
            <div class="mx-6">
                <v-btn 
                dark
                color="#1106A0"
                class="my-1"
                @click="generateReport()"
                >
                  <h4>Generate Report</h4>
                </v-btn>
              </div>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="">
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
  import XLSX from 'xlsx';

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
      generateReport(){
        var wb = XLSX.utils.book_new();
        var ws_data = [['Invoice Number','Email' , 'Name', 'Item Name', 'Quantity', 'Price', 'Total', 'Date']];
        for(var i = 0; i < this.showItems.length; i++){
          for(var j =0; j < this.showItems[i].orders.length; j++){
            ws_data.push([this.showItems[i].invoiceNumber, this.showItems[i].email, this.showItems[i].name, 
              this.showItems[i].orders[j].itemName, this.showItems[i].orders[j].quantity, this.showItems[i].orders[j].retailPrice, 
              this.priceRound(this.showItems[i].orders[j].quantity * this.showItems[i].orders[j].retailPrice), this.showItems[i].adjustedDate]);
          }
        }
        // console.log(ws_data);
        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        XLSX.utils.book_append_sheet(wb, ws, "Online Transactions");
        XLSX.writeFile(wb, "Online Transactions.xlsx");
      },
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

<style scoped>
.fontTitle{
  color: #464646;
}
.fontDesc{
  color: #858585;
}
.bgYellow{
  background-color: #FFA600;
}
.bgWhite{
  background-color: #FFF;
}
.bgBlue{
  background-color: #1106A0;
}
.nBorder{
    border: 1px solid #787885;
    border-radius: 5px; 
  }
</style>