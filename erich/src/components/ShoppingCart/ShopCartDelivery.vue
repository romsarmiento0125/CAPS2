<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          offset="1"
          cols="4"
        >
          <v-sheet
            width="100%"
            height="100%"
          >
            <div
              class="ma-5 pa-10"
            >
              <v-row>
                <v-col cols="2">
                  <v-img
                  contain
                  src="../../assets/check.svg"
                  max-height="50px"
                  max-width="50px"
                  
                  
                ></v-img>
                </v-col>
                
                <v-col cols="8">
                  <v-row class="">
                    <v-col cols="12" class="ma-0 pa-0">
                      <p
                        class="subtitle-1 font-weight-bold my-0 "
                        >Order #{{customerOrder.InvoiceNumber}}</p>
                    </v-col>
                    </v-row>

                    <v-row class="ma-0 pa-0">
                      <v-col cols="12" class="subtitle-1 my-0">
                       <p>Thank you! &nbsp;{{customerOrder.Name}}</p>
                      </v-col>
                    </v-row>
                </v-col>
              </v-row>
              <div>
                <div>
                  <p>Your Order is confirmed</p>
                  <p>Please give our driver the exact amount.</p>
                </div>
                <div>
                  <p
                    class="title"
                  >Customer Information</p>
                  <div
                    class="d-flex"
                  >
                    <div>
                      <p>Contact Information</p>
                      <p>{{customerOrder.Mobilenumber}}</p>
                    </div>
                  </div>
                  <div>
                    <p>Shipping Adress</p>
                    <p>{{customerOrder.CompleteAddress}}</p>
                  </div>
                  <div>
                    <p>Shipping Fee</p>
                    <p>{{customerOrder.Shipping}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="d-flex justify-end pa-5"
            >
              <v-btn
                color="primary"
                @click="checkOut()"
              >
                <p>Continue Shopping</p>
              </v-btn>
            </div>
          </v-sheet>
        </v-col>
        <v-col
          offset="1"
          cols="5"
        >
          <!-- <checkout-items></checkout-items> -->
          <order-items></order-items>
        </v-col>
      </v-row>
      <v-row>
        <v-dialog
          v-model="dialog"
          persistent
          max-width="290"
        >
          <v-card>
            <v-card-title class="text-h5">
              Tapos kana umorder.
            </v-card-title>
            <v-card-text>Eto ang iyong receipt number:&nbsp;{{customerOrder.InvoiceNumber}}</v-card-text>
            <v-card-text>Yung order mo pending pa antayin mo may mag text sayo</v-card-text>
            <v-card-text></v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="green darken-1"
                text
                @click="closeDialog"
              >
                Agree
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </v-container>
    
  </div>
</template>

<script>
  import CheckOutItems from './CheckoutItems.vue'
  import ShopCartPlaceOrderItems from './ShopCartPlaceOrderItems.vue'
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    components: {
      'checkout-items': CheckOutItems,
      'order-items': ShopCartPlaceOrderItems
    },

    data: () => ({
      dialog: false,
      customerOrder: {
        Email: "",
        Name: "",
        Mobilenumber: "",
        Municipality: "",
        Barangay: "",
        UBarangay: "",
        HomeAddress: "",
        CompleteAddress: "",
        Shipping: "",
        InvoiceNumber: "",
        OrderYear: "",
        OrderMonth: "",
        OrderDay: "",
        AdjustedDate: "",
        OrderStatus: "Pending",
        OrderTax: 0,
        Discount: 0,
        SubTotal: 0,
        Total: 0,
      },
      customerOrderItems: [

      ]
    }),

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      customerAddress() {
        return this.$store.state.customerAddress;
      },
      storeCustomerItems() {
        return this.$store.state.customerItems;
      },
 
    },

    methods: {
      checkOut() {
        //alert('delivery checout');
        this.insertCustomerItems();
        console.log("Email: " + this.customerOrder.Email);
        console.log("Name: " + this.customerOrder.Name);
        console.log("Mobile Number:  " + this.customerOrder.Mobilenumber);
        console.log("Complete Address: " + this.customerOrder.CompleteAddress);
        console.log("Shipping: " + this.customerOrder.Shipping);
        console.log("Invoice Number: " + this.customerOrder.InvoiceNumber);
        console.log("Adjusted Date: " + this.customerOrder.AdjustedDate);
        console.log("Order Status: " + this.customerOrder.OrderStatus);
        console.log("Order Tax: " + this.customerOrder.OrderTax);
        console.log("Discount: " + this.customerOrder.Discount);
        console.log("SubTotal: " + this.customerOrder.SubTotal);
        console.log("Total: " + this.customerOrder.Total);
        console.log(this.customerOrderItems);
        this.$router.push({path: '/'});

        this.cleanCart();

        axios.post(this.getDomain()+'api/customerorder/store', {
          register: this.customerOrder
        })
        .then(res => {
          this.storeCustomerOrderItems()
          console.log(res);  
        })
        //.then(res => console.log(res.data))
        .catch(err => console.error(err));

        this.showMessage();
      },
      storeCustomerOrderItems() {
        axios.post(this.getDomain()+'api/customerorderitems/store', {
            register: this.customerOrderItems
          })
          .then(res => {
            console.log(res.data);  
          })
          .catch(err => console.error(err));
      },
      cleanCart(){
        for(var i = 0; i < this.customerOrderItems.length; i++){
          axios.delete(this.getDomain()+'api/getcart/'+ this.customerOrderItems[i].id)
          .then( res => {
            console.log("Delete")
            console.log(res.data);
          })
          .catch(err => console.error(err))
        }
        this.$store.commit('cleanCustomerItems');
      },
      showMessage(){
        this.dialog = true;
      },
      closeDialog() {
        this.dialog = false;
        this.$router.push({path: '/'});
      },
      generateInvoiceNum(){
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var year = today.getFullYear();
        var r1 = Math.floor(Math.random() * 9) + 1;
        var r2 = Math.floor(Math.random() * 9) + 1;
        var r3 = Math.floor(Math.random() * 9) + 1;
        var r4 = Math.floor(Math.random() * 9) + 1;
        var r5 = Math.floor(Math.random() * 9) + 1;
        this.customerOrder.InvoiceNumber = "1" + year + month + day + r1 + r2 + r3 + r4 + r5;
        this.customerOrder.OrderYear = year;
        this.customerOrder.OrderMonth = month;
        this.customerOrder.OrderDay = day;
        this.customerOrder.AdjustedDate = year + "-" + month + "-" + (day * 1 + 2);
      },
      insertAddress() {
        // console.log(this.customerAddress);
        // console.log(this.customerAddress[0].Default);
        // console.log(this.customerAddress.length);
        for(var i = 0; i < this.customerAddress.length; i++){
          if(this.customerAddress[i].Default == "True"){
            this.customerOrder.Municipality = this.customerAddress[i].Municipality;
            this.customerOrder.Barangay = this.customerAddress[i].Barangay;
            this.customerOrder.UBarangay = this.customerAddress[i].UnderBarangay;
            this.customerOrder.HomeAddress = this.customerAddress[i].HomeAddress;
            this.customerOrder.Shipping = this.customerAddress[i].ShipFee;
            this.customerOrder.CompleteAddress = this.customerOrder.Municipality + " " + this.customerOrder.Barangay + " " + this.customerOrder.UBarangay + " " + this.customerOrder.HomeAddress;
          }
        }
      },
      insertCustomerItems() {
        this.customerOrderItems = [];
        var item;
        var subtotal = 0;
        console.log("Insert Customer Items");
        console.log(this.storeCustomerItems);
        console.log(this.storeCustomerItems.length);
        for(var i = 0; i < this.storeCustomerItems.length; i++){
          item = {id: this.storeCustomerItems[i].id,
            item_invNumber: this.customerOrder.InvoiceNumber,
            item_Name: this.storeCustomerItems[i].item_name,
            item_Desc: this.storeCustomerItems[i].item_desc,
            item_Image: this.storeCustomerItems[i].item_image,
            item_Discount: this.storeCustomerItems[i].item_discount,
            item_Quantity: this.storeCustomerItems[i].item_quantity,
            item_Price: this.storeCustomerItems[i].item_price,
            item_Code: this.storeCustomerItems[i].item_code,}
          this.customerOrderItems.push(item);
          subtotal = (subtotal + ((this.storeCustomerItems[i].item_quantity * this.storeCustomerItems[i].item_price * 1) - ((this.storeCustomerItems[i].item_quantity * this.storeCustomerItems[i].item_price * 1) * (this.storeCustomerItems[i].item_discount / 100) )));
        }
        this.customerOrder.SubTotal = subtotal;
        if(this.customerOrder.Shipping == "Free"){
          this.customerOrder.Total = this.customerOrder.SubTotal;
        }
        else{
          this.customerOrder.Total = this.customerOrder.SubTotal + (this.customerOrder.Shipping * 1);
        }
      }
    },

    beforeMount() {
      //this.getCustomerInfo();
      console.log("gg");
      console.log(this.customerInfos);
      console.log(this.customerAddress);
      console.log("Store Customer Items");
      console.log(this.storeCustomerItems);
      this.customerOrder.Email = this.customerInfos.Email;
      this.customerOrder.Name = this.customerInfos.First_Name + " " + this.customerInfos.Last_Name;
      this.customerOrder.Mobilenumber = this.customerInfos.Mobile_Number;
      this.generateInvoiceNum();
      this.insertAddress();
    }
  }
</script>