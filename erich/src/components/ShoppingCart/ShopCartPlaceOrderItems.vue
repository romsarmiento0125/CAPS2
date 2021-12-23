<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col
          offset=""
          cols=""
          class="mx-15 mb-5 pa-0"
        >
          <div
            class="d-flex justify-center"
          >
            <v-list
              color="transparent"
              class="ma-0 pa-0"
            >
              <v-list-item-group
              >
                <v-simple-table
                  height="500px"
                >
                  <v-list-item
                    v-for="item in items"
                    :key="item.id"
                    class="ma-0 pa-0"
                  >
                    <v-list-item-content
                    >
                      <v-row
                      >
                        <v-col
                          cols=""
                          class="ma-0 pa-0"
                        >
                          <div
                            class="d-flex align-center grey lighten-3"
                            
                          >
                            <div>
                              <v-img
                                height="120px"
                                width="120px"
                                contain
                                :src="require('../../assets/itemPhotos/'+item.item_image)"
                              ></v-img>
                            </div>
                            
                            <v-list-item-title>
                              <div
                                class="d-flex"
                              >
                                <div
                                  class="ma-5 pa-5"
                                >
                                  <span>{{item.item_name}}</span>
                                  <br>
                                  <span>{{item.item_desc}}</span>
                                </div>
                                <div
                                  class="ma-5 pa-5"
                                >
                                  <span>{{priceRound(item.item_price * item.item_quantity)}}</span>
                                  <br>
                                  <span>{{item.item_quantity}}</span>
                                </div>
                              </div>
                            </v-list-item-title>
                          </div>
                        </v-col>
                      </v-row>
                    </v-list-item-content>
                  </v-list-item>
                </v-simple-table>
              </v-list-item-group>
            </v-list>
          </div>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-row
        class="mt-3"
      >
        <v-col>
          <div
            class="d-flex"
          >
             <p
              class="title"
            >Subtotal</p>
            <v-spacer></v-spacer>
            <p
              class="title"
            >{{subTotPrice}}</p>
          </div>
          <div
             class="d-flex"
          >
            <p
              class="title"
            >Shipping</p>
            <v-spacer></v-spacer>
             <p
              class="title"
            >{{shipFee}}</p>
          </div>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-row>
        <v-col>
          <div
            class="d-flex"
          >
            <p
              class="title"
            >Total</p>
            <v-spacer></v-spacer>
            <p
              class="title"
            >{{totPrice}}</p>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      items: [
        // {id: 0, item_name: "Koko Crunch", item_desc: "this is item description", item_price: 156.50, item_image: 'SamplePhoto.png'},
        // {id: 1, item_name: "Pancake Plus", item_desc: "this is item description", item_price: 79.95, item_image: 'SamplePhoto.png'},
        // {id: 2, item_name: "Gardenia", item_desc: "this is item description", item_price: 67.50, item_image: 'SamplePhoto.png'},
      ],
      subTotPrice: 0,
      totPrice: 0,
      shipFee: "",
    }),

    computed: {
      categoryItems() {
        return this.$store.state.categoryItems;
      },
      cartItems() {
        return this.$store.state.cartItems;
      },
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      customerAddress() {
        return this.$store.state.customerAddress;
      },
      toPickUp() {
        return this.$store.state.userPickUp;
      }
    },

    watch: {
      toPickUp() {
        this.showCartItems();
      }
    },

    methods: {
      showCartItems(){
        this.items = [];
        this.shipFee = "";
        this.subTotPrice = 0;
        this.totPrice = 0;
        var item;

        // console.log("show items");
        // console.log("category items");
        // console.log(this.categoryItems);
        // console.log(this.categoryItems[0]);
        // console.log(this.categoryItems[2].ItemCode);
        // console.log(this.categoryItems.length);

        // console.log("cart items");
        // console.log(this.cartItems);
        // console.log(this.cartItems[0]);
        // console.log(this.cartItems[2].item_code);
        // console.log(this.cartItems.length);

        for(var i = 0; i < this.cartItems.length; i++){
          item = {id: this.cartItems[i].id,
            item_name: this.cartItems[i].item_name,
            item_desc: this.cartItems[i].item_desc,
            item_code: this.cartItems[i].item_code,
            item_quantity: this.cartItems[i].item_quantity,
            item_price: this.cartItems[i].item_price,
            item_image: this.cartItems[i].item_image}
            this.items.push(item);
            this.subTotPrice = this.subTotPrice + (this.cartItems[i].item_quantity * this.cartItems[i].item_price * 1);
        }
        this.findShipFee();
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
      findShipFee(){
        if(this.toPickUp){
          this.totPrice = this.subTotPrice;
          this.shipFee = "Pick Up";
        }
        else{
          for(var i = 0; i < this.customerAddress.length; i++){
            if(this.customerAddress[i].Default == "True"){
              if(this.customerAddress[i].ShipFee == "Free"){
                this.totPrice = this.subTotPrice;
                this.shipFee = this.customerAddress[i].ShipFee;
              }
              else{
                this.shipFee = this.customerAddress[i].ShipFee;
                this.totPrice = this.subTotPrice + (this.customerAddress[i].ShipFee * 1);
              }
            }
          }
        }
        // console.log("items");
        // console.log(this.items);
        this.$store.commit('storeCustomerItems', this.items);
      }
    },

    beforeMount(){
      this.showCartItems();
      // console.log("Cart Items");
      // console.log(this.cartItems);
      //console.log(this.customerAddress);
    }
    
  }
</script>