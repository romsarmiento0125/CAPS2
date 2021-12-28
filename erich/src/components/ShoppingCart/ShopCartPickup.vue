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
              <p
                class="title"
              >Order #:{{customerPickup.InvoiceNumber}}</p>
              <p>Thank you&nbsp;{{customerInfos.First_Name}}&nbsp;{{customerInfos.Last_Name}}<p>
              <div>
                <div>
                  <p>Your Order is confirmed</p>
                  <p>Please give our driver the exact amount.</p>
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
                Continue Shopping
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
            <v-card-text>Eto ang iyong receipt number:&nbsp;{{customerPickup.InvoiceNumber}}</v-card-text>
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

  export default {
    components: {
      'checkout-items': CheckOutItems,
      'order-items': ShopCartPlaceOrderItems
    },

    data: () => ({
      dialog: false,
      customerPickup: {
        Email: "",
        Name: "",
        Mobilenumber: "",
        InvoiceNumber: "",
        Status: "Pending",
        pickupDate: "",
        pickupTime: "",
        OrderTax: 0,
        Discount: 0,
        SubTotal: 0,
        Total: 0,
      },
      customerPickupItems: [

      ],
    }),

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      pickupDate() {
        return this.$store.state.pickupDate;
      },
      pickupTime() {
        return this.$store.state.pickupTime;
      },
      storeCustomerItems() {
        return this.$store.state.customerItems;
      },
    },

    methods: {
      checkOut() {
        //console.log("Check out");
        // console.log(this.customerInfos);
        // console.log(this.customerPickup);
        // console.log(this.pickupDate);
        // console.log(this.pickupTime);
        //this.$router.push({path: '/'});

        

        this.customerPickup.Name = this.customerInfos.First_Name + " " + this.customerInfos.Last_Name;
        this.customerPickup.Email = this.customerInfos.Email;
        this.customerPickup.Mobilenumber = this.customerInfos.Mobile_Number;
        this.customerPickup.pickupDate = this.pickupDate;
        this.customerPickup.pickupTime = this.pickupTime;
        
        axios.post('http://127.0.0.1:8000/api/customerpickup/store', {
          register: this.customerPickup
        })
        .then(res => {
          this.storeCustomerPickupItems()
          //console.log(res.data);  
        })
        .catch(err => console.error(err));

        this.cleanCart();
        this.showMessage();
      },
      storeCustomerPickupItems(){
        axios.post('http://127.0.0.1:8000/api/customerpickupitems/store', {
            register: this.customerPickupItems
          })
          .then(res => {
            //console.log(res.data);  
          })
          .catch(err => console.error(err));
      },
      cleanCart(){
        // console.log("Clean Cart");
        // console.log(this.customerPickupItems);
        for(var i = 0; i < this.customerPickupItems.length; i++){
          axios.delete('http://127.0.0.1:8000/api/getcart/'+ this.customerPickupItems[i].id)
          .then( res => {
            //console.log("Delete")
            //console.log(res.data);
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
        this.customerPickup.InvoiceNumber = "2" + year + month + day + r1 + r2 + r3 + r4 + r5;
      },
      insertCustomerItems() {
        this.customerPickupItems = [];
        var item;
        var subtotal = 0;
        // console.log("Insert Customer Items");
        // console.log(this.storeCustomerItems);
        // console.log(this.storeCustomerItems.length);
        for(var i = 0; i < this.storeCustomerItems.length; i++){
          item = {id: this.storeCustomerItems[i].id,
            item_invNumber: this.customerPickup.InvoiceNumber,
            item_Name: this.storeCustomerItems[i].item_name,
            item_Desc: this.storeCustomerItems[i].item_desc,
            item_Image: this.storeCustomerItems[i].item_image,
            item_Quantity: this.storeCustomerItems[i].item_quantity,
            item_Price: this.storeCustomerItems[i].item_price,
            item_Code: this.storeCustomerItems[i].item_code,}
          this.customerPickupItems.push(item);
          subtotal = subtotal + this.storeCustomerItems[i].item_quantity * this.storeCustomerItems[i].item_price;
        }
        this.customerPickup.SubTotal = subtotal;
        this.customerPickup.Total = subtotal;
      }
    },

    beforeMount() {
      this.generateInvoiceNum();
      this.insertCustomerItems();
    }
  }
</script>