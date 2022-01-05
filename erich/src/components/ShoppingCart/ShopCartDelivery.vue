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
                
                <v-col cols="10" class="mt-4 pl-0">
                  <v-row >
                    <v-col cols="12" class="ma-0 pa-0">
                      <h5
                        class="font-weight-bold my-0 fontDesc "
                        >Order #{{customerOrder.InvoiceNumber}}</h5>
                    </v-col>
                    </v-row>

                    <v-row>
                      <v-col cols="12" class="ma-0 pa-0">
                       <h5
                        class="my-0 font-weight-black fontTitle" 
                       >Thank you! &nbsp;{{customerOrder.Name}}</h5>
                      </v-col>
                    </v-row>
                </v-col>
              </v-row>

              <div>
                <div class="mt-5 nOrder elevation-1">
                  <div class="ma-4 pa-0">
                    <h4 class="my-0 font-weight-bold fontTitle">Your Order is confirmed</h4>
                    <h5 class="my-0 font-weight-regular">Please give our driver the exact amount.</h5>
                  </div>
                  
                </div>

                <div class="mt-5 nContact elevation-1">
                  <div class="ma-4 pa-0">
                    <h4
                    class="fontTitle font-weight-bold"
                  >Customer Information</h4>
                  <div
                    class="d-flex pt-6"
                  >
                    <div class="my-1">
                      <h5 class="fontDesc">Contact Information</h5>
                      <h5 class="fontTitle font-weight-regular mt-3">{{customerOrder.Mobilenumber}}</h5>
                    </div>
                  </div>

                  <div class="my-4">
                    <h5 class="fontDesc">Shipping Address</h5>
                    <h5 class="fontTitle font-weight-regular mt-3">{{customerOrder.CompleteAddress}}</h5>
                  </div>

                  <div class="my-4">
                    <h5 class="fontDesc">Shipping Fee</h5>
                    <h5 class="fontTitle font-weight-regular mt-3">{{customerOrder.Shipping}}</h5>
                  </div>

                  </div>
                  
                </div>
              </div>
            </div>
            <div
              class="d-flex justify-end pa-15"
            >
              <v-btn
                dark
                class="px-6 pt-4"
                color="#1106A0"
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
          max-width="22%"
          class=""
          
        >
          <v-sheet>
            <v-row>
              <v-col cols="12" class="d-flex justify-center mt-5">
                 <v-img
                  contain
                  src="../../assets/checkG.svg"
                  max-height="40px"
                  max-width="40px"
                  class=" ma-2" 
                ></v-img>
                  <h1 class="mt-1 fontTitle">Order Complete.</h1>
                </v-col>
            </v-row>
              <div class="d-flex justify-center mt-2">
                <h4 class="fontDesc">Receipt number:&nbsp;{{customerOrder.InvoiceNumber}}</h4>
              </div>

              <div class="ma-10">
                <div class="d-flex justify-center mt-10 fontBlue">
                 <h2 class="mt-5">Thankyou!.</h2>
                </div>   

                <div class="d-flex justify-center fontDesc">
                  <h3 class="">Your order is pending.</h3>
                </div>    
                          
                <div class="d-flex justify-center fontDesc">
                 <h4 class="">Kindly wait for the confirmation text.</h4>
                </div>
              </div>
              <div class="mx-10 d-flex justify-end">
                <v-btn
                  block
                  class="pa-5 "
                  color="#1106A0"
                  outlined
                  @click="closeDialog"
                >
                  ok
                </v-btn>
                <p></p>
                
              </div>
              
           
          </v-sheet>
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
      customerAddress() {
        return this.$store.state.customerAddress;
      },
      storeCustomerItems() {
        return this.$store.state.customerItems;
      },
      usersEmail(){
        return localStorage.getItem('email');
      },
      usersFName(){
        return localStorage.getItem('firstName');
      },
      usersLName(){
        return localStorage.getItem('lastName');
      },
      usersMobileNumber(){
        return localStorage.getItem('mobileNumber');
      },
      usersToken(){
        return localStorage.getItem('token');
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

        this.cleanCart();
        this.showMessage();

        axios.post(this.getDomain()+'api/customerorder/store', {
          register: this.customerOrder
        },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
        .then(res => {
          this.storeCustomerOrderItems()
          console.log(res);  
        })
        //.then(res => console.log(res.data))
        .catch(err => console.error(err));

        
      },
      storeCustomerOrderItems() {
        axios.post(this.getDomain()+'api/customerorderitems/store', {
            register: this.customerOrderItems
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            console.log(res.data);  
          })
          .catch(err => console.error(err));
      },
      cleanCart(){
        for(var i = 0; i < this.customerOrderItems.length; i++){
          axios.delete(this.getDomain()+'api/getcart/'+ this.customerOrderItems[i].id,
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
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
          if(this.customerAddress[i].default == "True"){
            this.customerOrder.Municipality = this.customerAddress[i].municipality;
            this.customerOrder.Barangay = this.customerAddress[i].barangay;
            this.customerOrder.UBarangay = this.customerAddress[i].underBarangay;
            this.customerOrder.HomeAddress = this.customerAddress[i].homeAddress;
            this.customerOrder.Shipping = this.customerAddress[i].shipFee;
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
      this.customerOrder.Email = this.usersEmail;
      this.customerOrder.Name = this.usersFName + " " + this.usersLName;
      this.customerOrder.Mobilenumber = this.usersMobileNumber;
      this.generateInvoiceNum();
      this.insertAddress();
    }
  }
</script>

<style scoped>
.fontTitle{
    color:#464646;
  }
  .fontDesc{
    color: #787885;
  }
.fontBlue{
  color: #1106A0;
}

  .nContact{
    border: 1px solid #787885;
    border-radius: 5px;
    border-right: 1px solid;
    line-height: 10px;
  }
  .nOrder{
    border: 1px solid #787885;
    border-radius: 5px;
  }
</style>