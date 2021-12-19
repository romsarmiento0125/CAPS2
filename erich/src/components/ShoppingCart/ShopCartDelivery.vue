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
              >Order #{{customerOrder.InvoiceNumber}}</p>
              <p>Thank you&nbsp;{{customerOrder.Name}}<p>
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
      customerOrder: {
        Name: "",
        Mobilenumber: "",
        Municipality: "",
        Barangay: "",
        UBarangay: "",
        HomeAddress: "",
        CompleteAddress: "",
        Shipping: "",
        InvoiceNumber: "",
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
        //this.$router.push({path: '/'});

        //this.cleanCart();

        axios.post('http://127.0.0.1:8000/api/customerorder/store', {
          register: this.customerOrder
        })
        .then(res => {
          this.storeCustomerOrderItems()
          console.log(res);  
        })
        //.then(res => console.log(res.data))
        .catch(err => console.error(err));
      },
      storeCustomerOrderItems() {
        console.log("customer order items");
        for(var i = 0; i < this.customerOrderItems.length; i++){
          axios.post('http://127.0.0.1:8000/api/customerorderitems/store', {
            register: this.customerOrderItems[i]
          })
          .then(res => {
            this.cleanCart()
            console.log(res);  
          })
          //.then(res => console.log(res.data))
          .catch(err => console.error(err));
        }
      },
      cleanCart(){
        for(var i = 0; i < this.customerOrderItems.length; i++){
          //console.log(this.customerOrderItems[i].id)
          axios.delete('http://127.0.0.1:8000/api/getcart/'+ this.customerOrderItems[i].id)
          .then( res => {
            //this.getCartItems()
            console.log(res.data)
          })
          .catch(err => console.error(err))
        }
        this.$store.commit('cleanCustomerItems');

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
        this.customerOrder.AdjustedDate = year + "-" + month + "-" + (day * 1 + 3);
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
            item_Quantity: this.storeCustomerItems[i].item_quantity,
            item_Price: this.storeCustomerItems[i].item_price,
            item_Code: this.storeCustomerItems[i].item_code,}
          this.customerOrderItems.push(item);
          subtotal = subtotal + this.storeCustomerItems[i].item_quantity * this.storeCustomerItems[i].item_price;
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
      this.customerOrder.Name = this.customerInfos.First_Name + " " + this.customerInfos.Last_Name;
      this.customerOrder.Mobilenumber = this.customerInfos.Mobile_Number;
      this.generateInvoiceNum();
      this.insertAddress();
    }
  }
</script>