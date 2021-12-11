<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col
          offset=""
          cols=""
          class=""
        >
          <v-list>
            <v-list-item-group
            >
              <v-list-item
                v-for="item in items"
                :key="item.id"
              >
                <v-list-item-content
                  class="border ma-2 rounded-lg"
                >
                  <v-row
                  >
                    <v-col
                      cols=""
                    >
                      <div
                        class="d-flex align-center"
                      >
                        <v-img
                          height="120px"
                          width="120px"
                          contain
                          :src="require('../../assets/'+item.item_image)"
                        ></v-img>
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
            </v-list-item-group>
          </v-list>
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
            >Receiving Method</p>
            <v-spacer></v-spacer>
             <p
              class="title"
            >pick up</p>
          </div>
          <div
             class="d-flex"
          >
            <p
              class="title"
            >Cost</p>
            <v-spacer></v-spacer>
             <p
              class="title"
            >Free</p>
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
            >{{subTotPrice}} + ship fee</p>
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
    },

    methods: {
      showCartItems(){
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
          item = {id: i,
            item_name: this.cartItems[i].item_name,
            item_desc: this.cartItems[i].item_desc,
            item_code: this.cartItems[i].item_code,
            item_quantity: this.cartItems[i].item_quantity,
            item_price: this.cartItems[i].item_price,
            item_image: this.cartItems[i].item_image}
            this.items.push(item);
            this.subTotPrice = this.subTotPrice + (this.cartItems[i].item_quantity * this.cartItems[i].item_price * 1);
        }
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      }
    },

    beforeMount(){
      this.showCartItems();
    }
    
  }
</script>