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
              >Order #{{InvoiceNumber}}</p>
              <p>Thank you&nbsp;{{Name}}<p>
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
                      <p>{{Mobilenumber}}</p>
                    </div>
                  </div>
                  <div>
                    <p>Shipping Adress</p>
                    <p>{{CompleteAddress}}</p>
                  </div>
                  <div>
                    <p>Shipping Fee</p>
                    <p>{{Shipping}}</p>
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
      Name: "",
      Mobilenumber: "",
      Municipality: "",
      Barangay: "",
      UBarangay: "",
      HomeAddress: "",
      CompleteAddress: "",
      Shipping: "",
      InvoiceNumber: "",
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
      }
    },

    methods: {
      checkOut() {
        alert('delivery checout');
        
        //this.$router.push({path: '/'});
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
        this.InvoiceNumber = "1" + year + month + day + r1 + r2 + r3 + r4 + r5;
      },
      insertAddress() {
        // console.log(this.customerAddress);
        // console.log(this.customerAddress[0].Default);
        // console.log(this.customerAddress.length);
        for(var i = 0; i < this.customerAddress.length; i++){
          if(this.customerAddress[i].Default == "True"){
            this.Municipality = this.customerAddress[i].Municipality;
            this.Barangay = this.customerAddress[i].Barangay;
            this.UBarangay = this.customerAddress[i].UnderBarangay;
            this.HomeAddress = this.customerAddress[i].HomeAddress;
            this.Shipping = this.customerAddress[i].ShipFee;
            this.CompleteAddress = this.Municipality + " " + this.Barangay + " " + this.UBarangay + " " + this.HomeAddress;
          }
        }
      }
    },

    beforeMount() {
      //this.getCustomerInfo();
      console.log("gg");
      console.log(this.customerInfos);
      console.log(this.customerAddress);
      console.log(this.storeCustomerItems);
      this.Name = this.customerInfos.First_Name + " " + this.customerInfos.Last_Name;
      this.Mobilenumber = this.customerInfos.Mobile_Number;
      this.Municipality = this.customerAddress.Municipality;
      this.generateInvoiceNum();
      this.insertAddress();
    }
  }
</script>