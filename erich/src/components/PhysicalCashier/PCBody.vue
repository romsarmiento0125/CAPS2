<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          cols="8"
        >
          <v-row>
            <v-col cols="5">
              <div
                class="d-flex"
              >
                <v-row>
                  <v-col 
                  cols="2"
                  class="mt-2"
                  
                  >
                    <h4>Name:&nbsp;</h4>
                  </v-col>
                  
                  <v-col 
                  cols="10" 
                  class="nBorder ml-n5 mt-2 fontDesc">
                    
                    <h5 >{{itemName}}</h5>
                  </v-col>
                </v-row>
              </div>
            </v-col>
            <v-col cols="7">
              <div
                class="d-flex"
              >
              <v-row>
                <v-col cols="2" class="mt-2">
                  <h4>Description:&nbsp;</h4>
                </v-col>

                <v-col cols="10" class="nBorder ml-n1  mt-2 fontDesc">
                  <h5>{{itemDesc}}</h5>
                </v-col>
              </v-row>
                
                
              </div>
            </v-col>
          </v-row>

          <v-row>
            <v-col
              cols="12"
            >
              <div class="mt-2">
                <h3 class="fontBlue">Barcode</h3>
              </div>
            </v-col>
            <v-col>
              <div class="mt-n5 ">
                <v-text-field
                  label="Outlined"
                  placeholder="Placeholder"
                  outlined
                  v-model="barcodeBuy"
                  v-on:keyup.enter.shift="saveItem"
                ></v-text-field>
              </div>
            </v-col>
            <!-- <v-col>
              <div>
                <p>menu</p>
              </div>
            </v-col> -->
          </v-row>

          <v-row>
            <v-col>
              <div>
                <v-simple-table height="650px">
                  <template v-slot:default>
                    <thead>
                      <tr>
                        <th class="text-left">
                          Item
                        </th>
                        <th>
                          Qty
                        </th>
                        <th>
                          Price
                        </th>
                        <th>
                          Total
                        </th>
                        <th>
                          Actions
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(order, n) in orders"
                        :key="n"
                      >
                        <td>{{order.itemName}} &nbsp; {{order.itemDesc}} &nbsp; {{order.itemSize}}</td>
                        <td>{{order.itemQty}}</td>
                        <td>{{order.itemPrice}}</td>
                        <td>{{priceRound(order.itemQty * order.itemPrice)}}</td>
                        <td>
                          <v-btn
                            @click="openDialog(n)"
                          >
                            <p>Update</p>
                          </v-btn>
                          <v-btn
                            @click="deleteItem(n)"
                          >
                            <p>Delete</p>
                          </v-btn>
                        </td>
                      </tr>
                    </tbody>
                  </template>
                </v-simple-table>
              </div>
            </v-col>
          </v-row>
        </v-col>

        <v-col
          cols="4"
        >
          <v-row>
            <v-col>
              <div class="mx-10">
                <h1 class="display-2 font-weight-black fontTitle">TOTAL</h1>
                  <v-row>
                    <v-col class="d-flex justify-center tBorder mt-1">
                      <h4
                      class="display-3 py-8 fontDesc"
                      >{{priceRound(totalPrice)}}</h4>
                    </v-col>
                  </v-row>
                
                
              </div>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <div>
                <p>Product Info</p>
                <p
                  class="title"
                >
                  {{itemName}}
                </p>
                <p
                  class="title"
                >
                  {{itemDesc}}
                </p>
                <p
                  class="title"
                >
                  {{itemSize}}
                </p>
              </div>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <div>
                <v-btn
                  @click="dialog = true"
                >
                  <p>Confirm</p>
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Order Confirm</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-list>
              <v-list-item-group
              >
                <v-list-item
                  v-for="(order, i) in orders"
                  :key="i"
                >
                  <v-list-item-content
                  >
                    <div class="mt-10">
                      <h3>{{order.itemName}}</h3>
                      
                      <div
                        class="d-flex"
                      >
                        <h3>{{order.itemDesc}}</h3>
                        <v-spacer></v-spacer>
                        <h3>{{priceRound(order.itemPrice * order.itemQty)}}</h3>
                      </div>
                    </div>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
            <p>{{priceRound(totalPrice)}}</p>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="finishOrder"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
      v-model="updateDialog"
      persistent
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5"></span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-text-field
              v-model="initialQty"
            ></v-text-field>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="updateDialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="updateItem"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  import {Mixins} from '../../Mixins/mixins.js'
  
  export default {
    mixins: [Mixins],

    data: () => ({
      orders: [],
      barcodeBuy: '',
      barcode: '',
      interval: 0,
      itemName: "",
      itemDesc: "",
      itemSize: "",
      dialog: false,
      updateDialog: false,
      initialQty: 0,
      initialId: 0,
      orderInfo: {
        InvoiceNumber: "",
        CompleteDate: "",
        OrderTax: 0,
        Discount: 0,
        SubTotal: 0,
        Total: 0,
      }
    }),

    computed: {
      categoryItems() {
        return this.$store.state.categoryItems;
      },
      totalPrice() {
        var total = 0;
        this.orders.forEach(item => {
          total = (total + (item.itemPrice * item.itemQty) * 1);
        })
        return total;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {
      openDialog(i){
        this.updateDialog = true;
        this.initialQty = this.orders[i].itemQty;
        this.initialId = i;
      },
      finishOrder(){
        this.dialog = false;
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var year = today.getFullYear();
        var r1 = Math.floor(Math.random() * 9) + 1;
        var r2 = Math.floor(Math.random() * 9) + 1;
        var r3 = Math.floor(Math.random() * 9) + 1;
        var r4 = Math.floor(Math.random() * 9) + 1;
        var r5 = Math.floor(Math.random() * 9) + 1;
        this.orderInfo.InvoiceNumber = "3" + year + month + day + r1 + r2 + r3 + r4 + r5;
        this.orderInfo.CompleteDate = year + "-" + month + "-" + day;
        this.orderInfo.SubTotal = this.totalPrice;
        this.orderInfo.Total = this.totalPrice;

        // console.log(this.orders);
        // console.log(this.orderInfo);

        axios.post(this.getDomain()+'api/physicalorder/store', {
          orderinfo: this.orderInfo,
          register: this.orders
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          console.log(res.data);
        })

        this.orders = [];
        this.itemName = "";
        this.itemDesc = "";
        this.itemSize = "";
        this.barcodeBuy = "";
      },
      saveItem() {
        // console.log(this.barcodeBuy);
        // console.log(this.categoryItems);
        var item;
        var qtyCond = true;
        for(var i = 0; i < this.categoryItems.length; i++){
          if(this.categoryItems[i].itemCode == this.barcodeBuy){
            this.itemName = this.categoryItems[i].name;
            this.itemDesc = this.categoryItems[i].description;
            this.itemSize = this.categoryItems[i].size;
            for(var j = 0; j < this.orders.length; j++){
              if(this.orders[j].itemCode == this.barcodeBuy){
                this.orders[j].itemQty++;
                qtyCond = false;
                j = this.orders.length + 1;
              }
            }
            if(qtyCond){
              item = {
                itemName: this.categoryItems[i].name,
                itemDesc: this.categoryItems[i].description,
                itemSize: this.categoryItems[i].size,
                itemCode: this.categoryItems[i].itemCode,
                itemQty: 1,
                itemPrice: this.categoryItems[i].retailPrice,
                itemDiscount: this.categoryItems[i].discount,
              }
              this.orders.push(item);
              i = this.categoryItems.length + 1;
            }
          }
        }
      },
      deleteItem(id){
        // console.log(this.orders);
        // console.log(id);
        this.orders.splice(id,1);
      },
      updateItem(){
        console.log("update");
        this.orders[this.initialId].itemQty = this.initialQty;
        this.updateDialog = false;
      },
      handleBarcode(scanned_barcode) {
          this.barcodeBuy = scanned_barcode;
          this.saveItem();
      },
      myfunc(evt){
        if (this.interval){
          clearInterval(this.interval);
        }
        if (evt.code == 'Enter') {
            if (this.barcode){
              this.handleBarcode(this.barcode);
            }
            this.barcode = '';
            return;
        }
        if (evt.key != 'Shift'){
          this.barcode += evt.key;
        }
        this.interval = setInterval(() => this.barcode = '', 20);
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      }
    },

    mounted() {
      window.addEventListener('keydown', this.myfunc);
    },
  }
</script>

<style scoped>
.fontBlue{
  color: #1106a0;
}
.fontDesc{
  color: #858585;
}
.fontTitle{
  color: #464646;
}
.nBorder{
    border: 1px solid #787885;
    border-radius: 5px; 
  }
.tBorder{
  border: 5px solid #464646;
  border-radius: 10px;
}
</style>