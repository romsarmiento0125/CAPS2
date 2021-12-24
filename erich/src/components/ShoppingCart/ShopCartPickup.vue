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
        alert('pickup checkout');
        console.log("Check out");
        console.log(this.customerPickupItems);
        console.log(this.customerPickup);
        console.log(this.pickupDate);
        console.log(this.pickupTime);
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
        this.customerPickup.InvoiceNumber = "2" + year + month + day + r1 + r2 + r3 + r4 + r5;
      },
      insertCustomerItems() {
        this.customerPickupItems = [];
        var item;
        var subtotal = 0;
        console.log("Insert Customer Items");
        console.log(this.storeCustomerItems);
        console.log(this.storeCustomerItems.length);
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
      }
    },

    beforeMount() {
      this.generateInvoiceNum();
      this.insertCustomerItems();
    }
  }
</script>