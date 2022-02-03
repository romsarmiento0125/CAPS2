<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          cols="8"
          class="mt-8"
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
                  label=""
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
                        <th class="">
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
                            dark
                            color="#FFA600"
                            class="pt-3"
                            @click="openDialog(n)"
                          >
                            <p>Update</p>
                          </v-btn>
                          <v-btn
                            dark
                            color="#1106A0"
                            class="pt-3 ml-2"
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
          class="mt-5"
        >
          <v-row>
            <v-col>
              <div class="mx-10">
                <h1 class="font-weight-black fontBlue">TOTAL</h1 >
                  <v-row>
                    <v-col class="d-flex justify-center tBorder mt-1">
                      <h4
                      class="display-3 font-weight-bold py-8 fontTitle"
                      >{{priceRound(totalPrice)}}</h4>
                    </v-col>
                  </v-row>
              </div>
            </v-col>
          </v-row>

          <v-row>
            <v-col>
              <div class="mx-7">
                <h2 class="font-weight-black fontBlue ml-5">Product Info</h2>
                <div class="tBorder mt-n1 py-16 fontTitle">

                  <div class="d-flex justify-center">
                    <h1
                        class="pr-1"
                      >
                        {{itemName}}
                        </h1>
                      <h1
                        class="pr-1"
                      >
                        {{itemDesc}}
                      </h1>
                  </div>
                    
                  
                  <div class="d-flex justify-center">
                    <h1
                        class="pr-1"
                      >
                        {{itemSize}}
                      </h1>
                  </div>       
                </div>
              </div>

            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <div class="ml-7">
                <v-btn
                  dark
                  color="#1106A0"
                  class="px-16 py-8"
                  @click="dialog = true"
                >
                  <h4>Confirm</h4>
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
        <v-card-title class="d-flex justify-center">
          <h4 class=" my-2">Order Confirm</h4>
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
                  class="mt-n4"
                  >
                    <div class="mt-10">
                      <h3>{{order.itemName}}</h3>
                      
                      <div
                        class="d-flex"
                      >
                        <h4 class="fontDesc">{{order.itemDesc}}</h4>
                        <v-spacer></v-spacer>
                        <h3 class="mt-n4">{{priceRound(order.itemPrice * order.itemQty)}}</h3>
                      </div>
                    </div>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
            <h3 class="fontBlue d-flex justify-end pr-4 mt-10">{{priceRound(totalPrice)}}</h3>
          </v-container>
        </v-card-text>
        <v-card-actions class="mr-2">
          <v-spacer></v-spacer>
          <v-btn
            color="#1106A0"
            class="px-10"
            outlined
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="#1106A0"
            dark
            class="px-10"
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
            color="#1106A0"
            outlined
            class="px-10"
            @click="updateDialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="#1106A0"
            dark
            class="px-10"
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
  import jsPDF from 'jspdf'
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
      usersFName(){
        return localStorage.getItem('firstName');
      },
      usersLName(){
        return localStorage.getItem('lastName');
      },
    },

    methods: {
      openDialog(i){
        this.updateDialog = true;
        this.initialQty = this.orders[i].itemQty;
        this.initialId = i;
      },
      generateReciept(){
        // console.log(this.orderInfo);
        // console.log(this.orders);
        var rn = this.orderInfo.InvoiceNumber;
        var name = this.usersFName + " " + this.usersLName;

        var oqty = "";
        var oname = "";
        var odes = "";
        var oprice = "";

        var hgth = 3

        var date = new Date();

        for(var i = 0; i < this.orders.length; i++){
          oqty = oqty + this.orders[i].itemQty + "\n";
          oname = oname + this.orders[i].itemName + "\n";
          odes = odes + this.orders[i].itemDesc + "\n";
          oprice = oprice + (this.priceRound((this.orders[i].itemPrice * 1) * this.orders[i].itemQty)) + "\n";
          hgth = hgth + .1;
        }

        var pdf = new jsPDF({
          unit: "in",
          format: [3, hgth]
        });
        
        pdf.setFont("helvetica", "bold");
        pdf.setFontSize(10);
        pdf.text("ERICH GROCERY", 1.5, .5, null, null, 'center');

        pdf.setFont("helvetica", "normal");
        pdf.setFontSize(6);
        pdf.text("Owner & Optd By: Jhona S. Pontejo", 1.5, .6, null, null, 'center');
        pdf.text("Km. 38 Pulong Buhangin Sta. Maria Bulacan", 1.5, .7, null, null, 'center');
        pdf.text("Vat Reg Tin: 123-456-789-0000", 1.5, .8, null, null, 'center');

        pdf.setFont("helvetica", "bold");
        pdf.setFontSize(8);
        pdf.text("Official Receipt #:"+rn, .5, 1.1);

        pdf.setFont("helvetica", "normal");
        pdf.setFontSize(6);
        pdf.text("Walk-In", .5, 1.2);
        pdf.text("Cashier: " + name, .5, 1.3);

        pdf.text("-------------------------------------------------------------------------", .5, 1.4)

        pdf.text("Qty", .5, 1.5);
        pdf.text("Name", .8, 1.5);
        pdf.text("Description", 1.5, 1.5);
        pdf.text("Price", 2.3, 1.5);

        pdf.text(oqty, .5, 1.6);
        pdf.text(oname, .8, 1.6);
        pdf.text(odes, 1.5, 1.6);
        pdf.text(oprice, 2.3, 1.6);

        pdf.text("-------------------------------------------------------------------------", .5, hgth - 1.4)

        pdf.text("Sub Total", .6, hgth - 1.3);
        pdf.text("" + this.priceRound(this.orderInfo.SubTotal), 2.3, hgth - 1.3);

        pdf.text("-------------------------------------------------------------------------", .5, hgth - 1.2)

        pdf.text("Discount", .6, hgth - 1.1);
        pdf.text("" + this.orderInfo.Discount, 2.3, hgth - 1.1);
        pdf.text("Tax", .6, hgth - 1);
        pdf.text("" + this.orderInfo.OrderTax, 2.3, hgth - 1);
        pdf.text("Total", .6, hgth - .9);
        pdf.text("" + this.priceRound(this.orderInfo.Total), 2.3, hgth - .9);

        pdf.text("-------------------------------------------------------------------------", .5, hgth - .8)

        pdf.text("Contact Number: 09123456789", 1.5, hgth - .7, null, null, 'center');
        pdf.text(date+"", 1.5, hgth - .6, null, null, 'center');

        pdf.save(rn +'.pdf');
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
          this.generateReciept();
          this.orders = [];
          this.itemName = "";
          this.itemDesc = "";
          this.itemSize = "";
          this.barcodeBuy = "";
          
        })

        
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
  border: 5px solid #FFA600;
  border-radius: 10px;
}

</style>