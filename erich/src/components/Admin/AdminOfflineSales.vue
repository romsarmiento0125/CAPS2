<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div
            class="d-flex justify-end"
          >
            <h2>Total Earned and Profile</h2>
          </div>
        </v-col>
      </v-row>

      <!-- Date rows -->
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
        <!-- Total sales column -->
        <v-col>
          <v-sheet>
            <div
              class="d-flex justify-end"
            >
              <h1>{{totalSales}}</h1>
            </div>
            <div
              class="d-flex justify-end light-green lighten-1"
            >
              <p
                class="white--text headline"
              >Total Sales</p>
            </div>
          </v-sheet>
        </v-col>
      </v-row>

      <v-row>
        <!-- Graph column -->
        <v-col>
          <v-card
            class="mx-auto text-center"
            color="green"
            dark
            max-width="600"
          >
            <v-card-text>
              <div class="text-h4 font-weight-thin">
                Total Sales
              </div>
            </v-card-text>

            <v-card-text>
              <v-sheet color="rgba(0, 0, 0, .12)">
                <v-sparkline
                  :value="value"
                  color="rgba(255, 255, 255, .7)"
                  height="100"
                  padding="24"
                  stroke-linecap="round"
                  smooth
                >
                  <template v-slot:label="item">
                    ${{ item.value }}
                  </template>
                </v-sparkline>
              </v-sheet>
            </v-card-text>
          </v-card>
        </v-col>
        
        <!-- High in demand column -->
        <v-col>
          <v-card
            class="mx-auto"
            max-width="300"
            tile
          >
            <v-list dense>
              <v-subheader>High in Demand</v-subheader>
              <v-list-item-group
                color="primary"
              >
                <v-list-item
                  v-for="(item, i) in highDemand"
                  :key="i"
                >
                  <v-list-item-icon>
                    <v-icon v-text="i + 1"></v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title>{{item.name}}&nbsp;{{item.size}}&nbsp;{{item.qty}}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card>
        </v-col>

        <!-- Low in demand column -->
        <v-col>
          <v-card
            class="mx-auto"
            max-width="300"
            tile
          >
            <v-list dense>
              <v-subheader>Low in Demand</v-subheader>
              <v-list-item-group
                color="primary"
              >
                <v-list-item
                  v-for="(item, i) in lowDemand"
                  :key="i"
                >
                  <v-list-item-icon>
                    <v-icon v-text="i + 1"></v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title>{{item.name}}&nbsp;{{item.size}}&nbsp;{{item.qty}}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      value: [
        0,
        0,
      ],
      hDemand: [],
      lDemand: [],
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      endmenu: false,
      startmenu: false,
      startDate: "2022-01-09",
      endDate: new Date().toISOString().slice(0, 10),
    }),

    computed: {
      adminDataPhysical(){
        return this.$store.state.adminDataPhysical;
      },
      totalSales(){
        return this.showTotalSales();
      },
      highDemand(){
        return this.showDemand("high");
      },
      lowDemand(){
        return this.showDemand("low");
      },
      categoryItems() {
        return this.$store.state.categoryItems;
      },
    },

    watch: {
      adminDataPhysical(){
        this.showTotalSales;
      },
    },

    methods: {
      showDemand(cond){
        if(this.adminDataPhysical == null){
          return null;
        }
        else{
          var physicalData = this.adminDataPhysical;
          var tempItem = [];

          var showItem = [];

          // console.log(physicalData);

          for(var i = 0; i < physicalData.length; i++){
            if((physicalData[i].completeDate >= this.startDate) && (physicalData[i].completeDate <= this.endDate)){
              var physicalDataOrders = physicalData[i].orders;
              for(var j = 0; j < physicalData[i].orders.length; j++){
                tempItem.push({
                  itemCode: physicalDataOrders[j].itemCode,
                  itemQty: physicalDataOrders[j].quantity,
                  itemDate: physicalData[i].completeDate
                });
              }
            }
          }

          // console.log(tempItem);

          tempItem.sort((a,b) => (a.itemCode > b.itemCode) ? 1 : ((b.itemCode > a.itemCode) ? -1 : 0))

          var tempStore = "";
          var items = [];
          var itr = 0;

          for(var i = 0; i < tempItem.length; i++){
            if(tempStore == tempItem[i].itemCode){
              items[itr-1].qty = items[itr-1].qty + tempItem[i].itemQty;
            }
            else{
              tempStore = tempItem[i].itemCode;
              items.push({
                code: tempItem[i].itemCode,
                qty: tempItem[i].itemQty
              });
              itr++;
            }
          }

          items.sort((a,b) => (a.qty > b.qty) ? 1 : ((b.qty > a.qty) ? -1 : 0))
          if(cond == "high"){
            items.reverse();
            items = items.slice(0,10);
            // console.log(this.categoryItems);

            for(var i = 0; i < items.length; i++){
              // console.log("loop");
              this.categoryItems.forEach(dat => {
                if(dat.itemCode == items[i].code){
                  // console.log(dat);
                  showItem.push({
                    name: dat.name,
                    desc: dat.description,
                    size: dat.size,
                    qty: items[i].qty
                  })
                }
              });
            }
            return showItem;
          }
          else if(cond == "low"){
            items = items.slice(0,10);
            // console.log(this.categoryItems);

            for(var i = 0; i < items.length; i++){
              // console.log("loop");
              this.categoryItems.forEach(dat => {
                if(dat.itemCode == items[i].code){
                  // console.log(dat);
                  showItem.push({
                    name: dat.name,
                    desc: dat.description,
                    size: dat.size,
                    qty: items[i].qty
                  })
                }
              });
            }
            return showItem;
          }
        }
      },
      showTotalSales(){
        if(this.adminDataPhysical == null){
          return "0";
        }
        else{
          // console.log(this.adminDataPhysical);
          var physicalData = this.adminDataPhysical;
          var physicalTotal = 0;
          var total = 0;

          var val = [];
          var dpval = [];
          
          var tempDate = physicalData[0].completeDate;
          var tempTotal = 0;
          var roundedTotal = 0;

          // console.log(physicalData);
          // console.log(physicalData.length);
          for(var i = 0; i < physicalData.length; i++){
            if((physicalData[i].completeDate >= this.startDate) && (physicalData[i].completeDate <= this.endDate)){
    
              if(physicalData[i].completeDate == tempDate){
                tempTotal = tempTotal + (physicalData[i].total * 1);
              }
              else{
                if(tempTotal == 0){
                  tempTotal = tempTotal + (physicalData[i].total * 1);
                  tempDate = physicalData[i].completeDate;
                }
                else{
                  roundedTotal = parseFloat(this.priceRound(tempTotal));
                  val.push(
                    {date: tempDate, total: roundedTotal}
                  );
                  tempTotal = (physicalData[i].total * 1);
                  tempDate = physicalData[i].completeDate;
                }
              }
            }
          }
          roundedTotal = parseFloat(this.priceRound(tempTotal));
          val.push(
            {date: tempDate, total: roundedTotal}
          );

          // console.log(val);

          var tempDate = val[0].date;
          var tempTotal = 0;
          var roundedTotal = 0;
          
          for(var i = 0; i < val.length; i++){
            if((val[i].date >= this.startDate) && (val[i].date <= this.endDate)){
              physicalTotal = physicalTotal + (val[i].total * 1);
              if(val[i].date == tempDate){
                tempTotal = tempTotal + (val[i].total * 1);
              }
              else{
                if(tempTotal == 0){
                  tempTotal = tempTotal + (val[i].total * 1);
                  tempDate = val[i].date;
                }
                else{
                  roundedTotal = parseFloat(this.priceRound(tempTotal));
                  dpval.push(roundedTotal);
                  tempTotal = (val[i].total * 1);
                  tempDate = val[i].date;
                }
              }
            }
          }
          roundedTotal = parseFloat(this.priceRound(tempTotal));
          dpval.push(roundedTotal);
          this.value = dpval;
          total = this.priceRound(physicalTotal);
          
          // console.log(dpval);

          return total;          
        }
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      }
    },

    mounted() {

    },

  }
</script>