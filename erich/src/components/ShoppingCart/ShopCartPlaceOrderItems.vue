<template>
  <div>
    <v-container
      fluid
      class="con"
    >
      <v-row>
        <v-col
          offset="1"
          cols="10"
          class="mx-15 mb-5 pa-0"
        >
          <div
            class=""
          >
            <v-list
              color=""
              class="ma-0 pa-0"
            >
              <v-list-item-group
              >
                <v-simple-table
                  height="400px"
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
                          cols="8"
                          class="ma-0 pa-0"
                        >
                          <div
                            class="d-flex ma-2"
                            
                          >
                            <div
                              class="d-flex"
                            >
                              <div
                                class="imgbg ma-1 pa-0"
                              >
                                <v-img
                                  height="120px"
                                  width="120px"
                                  contain
                                  :src="require('../../assets/itemPhotos/'+item.item_image)"
                                ></v-img>
                              </div>
                            
                           
                              <div
                                class="d-flex align-center"
                              >
                                <span>{{item.item_name}}</span>
                                &nbsp;
                                <span>{{item.item_desc}}</span>
                              </div>
                            </div>
                      
                            
                        
                          </div>
                        </v-col>
                        <v-col
                          cols="4"
                          class="d-flex justify-end"
                        >
                          <div
                            class="d-flex align-center mr-5"
                          >
                            <div
                              class=""
                            >
                              <span>{{item.item_quantity}}&nbsp;x&nbsp;{{priceRound(item.item_price - ((item.item_discount / 100) * item.item_price))}}</span>
                              <br>
                              <span
                                class="title"
                              >P&nbsp;{{priceRound((item.item_price - ((item.item_discount / 100) * item.item_price)) * item.item_quantity)}}</span>
                            </div>
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
        <v-col
          offset="1"
          cols="10"
        >
          <div
            class="d-flex"
          >
             <p
              class="title"
            >Subtotal</p>
            <v-spacer></v-spacer>
            <p
              class="title"
            >{{priceRound(subTotPrice)}}</p>
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
        <v-col
          offset="1"
          cols="10"
        >
          <div
            class="d-flex"
          >
            <p
              class="title"
            >Total</p>
            <v-spacer></v-spacer>
            <p
              class="title"
            >{{priceRound(totPrice)}}</p>
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
            item_image: this.cartItems[i].item_image,
            item_discount: this.cartItems[i].item_discount
            }
            this.items.push(item);
            this.subTotPrice = (this.subTotPrice + ((this.cartItems[i].item_quantity * this.cartItems[i].item_price * 1) - ((this.cartItems[i].item_quantity * this.cartItems[i].item_price * 1) * (this.cartItems[i].item_discount / 100) )));
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

<style scoped>
  .con *{
    background-color: transparent;
  }
  .imgbg{
    border: 1px solid black;
    border-radius: 5px;
    background-color: white;
  }


</style>