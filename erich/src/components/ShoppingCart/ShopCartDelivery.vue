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
              >Order #A8-6580</p>
              <p>Thank you Reyster<p>
              <div>
                <div>
                  <p>Your Order is confirmed</p>
                  <p>Please give our driver the exact amount.</p>
                </div>
                <div>
                  <p>Customer Information</p>
                  <div
                    class="d-flex"
                  >
                    <div>
                      <p>Contact Information</p>
                      <p>Lorem ipsum</p>
                    </div>
                    <div>
                      <p>Payment Method</p>
                      <p>Cash on Delivery</p>
                    </div>
                  </div>
                  <div>
                    <p>Shipping Adress</p>
                    <p>lorem ipsum</p>
                  </div>
                  <div>
                    <p>Shipping Method</p>
                    <p>Rate: P100</p>
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
      Surname: "",
      Mobilenumber: "",
      Municipality: "",
      Barangay: "",
      UBarangay: "",
      HomeAddress: "",
      Shipping: "",
    }),

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      customerAddress() {
        return this.$store.state.customerAddress;
      }
    },

    methods: {
      checkOut() {
        alert('delivery checout');
        this.$router.push({path: '/'});
      }
    },

    beforeMount() {
      //this.getCustomerInfo();
      console.log(this.customerInfos);
      this.Name = this.customerInfos.First_Name;
      this.Surname = this.customerInfos.Last_Name;
      this.Mobilenumber = this.customerInfos.Mobile_Number;
      this.Municipality = this.customerAddress.Municipality;
      this.Barangay = this.customerAddress.Barangay;
      this.UBarangay = this.customerAddress.UnderBarangay;
      this.HomeAddress = this.customerAddress.HomeAddress;
      this.Shipping = this.customerInfos.ShipFee;
    }
  }
</script>