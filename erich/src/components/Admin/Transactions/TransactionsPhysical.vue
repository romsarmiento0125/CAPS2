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
            <div>
              <v-text-field
                append-icon="mdi-magnify"
                hide-details="auto"
                outlined
                dense
                rounded
                color="#1106A0"
                height="small"
                background-color="white"
                placeholder="Search for entire store here.."
                v-model="searchKey"
                v-on:keyup="toSearchItems(searchKey)"
              >
              </v-text-field>
            </div>

        </v-col>
        <v-col cols="6" class="d-flex justify-end">
           <div class="mx-5">
              <v-btn
                dark
                color="#1106A0"
                class="my-1"
                @click="exportTheTable"
              >
                <h4
                >Generate Report</h4>
              </v-btn>
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
        { text: 'Date Complete', value: 'completeDate'},
        { text: 'Total', value: 'total'},
      ],
      expanded: [],
      singleExpand: false,
      searchKey: "",
      allItems: null,
      showItems: [],
    }),

    computed: {
      adminDataPhysical(){
        return this.$store.state.adminDataPhysical;
      },
      adminPhysicalData(){
        return this.showPhysicalTransactions();
      },
      computedShowItems(){
        var sk = this.searchKey;
        var re = new RegExp(sk, 'gi');
        return this.showItems.filter((item) => {
          return item.invoiceNumber.match(re);
        });
      },
    },

    watch: {
      adminDataPhysical(){
        this.adminPhysicalData;
      },
      startDate(){
        this.adminPhysicalData;
      },
      endDate(){
        this.adminPhysicalData;
      }
    },

    methods: {
      exportTheTable(){
        console.log("export");
        console.log(this.showItems);
      },
      toSearchItems(){
        this.showItems = this.adminPhysicalData;
        this.showItems = this.computedShowItems;
      },
      showPhysicalTransactions(){
        if(this.adminDataPhysical == null){
          return [];
        }
        else{
          var physicalData = this.adminDataPhysical;
          var tempItem = [];

          for(var i = 0; i < physicalData.length; i++){
            if((physicalData[i].completeDate >= this.startDate) && (physicalData[i].completeDate <= this.endDate)){
              tempItem.push({
                invoiceNumber: physicalData[i].invoiceNumber,
                completeDate: physicalData[i].completeDate,
                total: physicalData[i].total,
                orders: physicalData[i].orders
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
      this.adminPhysicalData;
    }
  }
</script>