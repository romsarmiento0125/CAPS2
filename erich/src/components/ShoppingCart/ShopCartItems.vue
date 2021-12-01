<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col
          offset="1"
          cols="7"
          class="d-flex justify-center"
        >
          <v-sheet
            color="#FFFFFF"
            width="100%"
            class="my-10"
          >
            <v-row>
              <v-col>
                <p
                  class="mt-3 mx-10"
                >Product</p>
              </v-col>
              <v-col>
                <div
                  class="d-flex mt-3"
                >
                  <p
                    class="mx-10"
                  >Quantity</p>
                  <p
                    class="mx-10"
                  >Total Price</p>
                  <p
                    class="mx-10"
                  >Action</p>
                </div>
              </v-col>
            </v-row>

            <v-divider></v-divider>

            <v-row>
              <v-col>
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
                            cols="6"
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
                                <span>{{item.item_name}}</span>
                                <br>
                                <span>{{item.item_desc}}</span>
                              </v-list-item-title>
                            </div>
                          </v-col>
                          <v-col
                            cols="6"
                            class="d-flex align-center"
                          >
                            <div
                              class="d-flex align-center"
                            >
                              <div
                                class="qtt d-flex align-center justify-center"
                              >
                                <v-btn
                                  depressed
                                  color="transparent"
                                  class=""
                                >
                                  <v-icon
                                    x-large
                                  >
                                    mdi-minus-box-outline
                                  </v-icon>
                                </v-btn>
                                <p
                                  class=" my-0 px-2"
                                >
                                  {{item.item_quantity}}
                                </p>
                                <v-btn
                                  depressed
                                  color="transparent"
                                >
                                  <v-icon
                                    x-large
                                  >
                                    mdi-plus-box-outline
                                  </v-icon>
                                </v-btn>
                              </div>

                              <div
                                class="tp my-0 d-flex align-center justify-center"
                              >
                                <v-icon>
                                  mdi-currency-php
                                </v-icon>
                                <p>
                                  {{item.item_price * item.item_quantity}}
                                </p>
                              </div>

                              <v-btn
                                class="act justify-center"
                                color="primary"
                                plain
                                @click="deleteItems(item.item_code)"
                              >
                                Delete
                              </v-btn>
                            </div>
                          </v-col>
                        </v-row>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list-item-group>
                </v-list>
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
        <v-col
          cols="4"
          class="d-flex justify-center"
        >
          <v-sheet
            color="#FFFFFF"
            height="200"
            width="80%"
            class="my-10"
          >
            <v-row>
              <v-col>
                <h2
                >Total</h2>
              </v-col>
              <v-col>
                <h2><v-icon>mdi-currency-php</v-icon>{{totPrice}}</h2>
              </v-col>
            </v-row>

            <v-divider></v-divider>

            <v-row>
              <v-col>
                <p>Taxes and <a class="text-decoration-underline">Shipping</a> are calculted at checkout</p>
                <v-btn
                  color="primary"
                  :to="{name: 'Cart' , params: { id: 'place-order', title: 'Place Order'}}"
                  @click="showPlaceOrder()"
                >
                  Checkout
                </v-btn>
              </v-col>
            </v-row>
          </v-sheet>
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
      showPlaceOrder() {
        this.$emit('scItemsEmit');
      },
      showCartItems(data) {
        var item;
        
        console.log("cart items");
        console.log(data);
        console.log(data[0]);
        console.log(data[0].ItemCode);
        console.log(data[0].Quantity);
        console.log(data[0].id);
        console.log(data.length);

        console.log("category items");
        console.log(this.categoryItems);
        console.log(this.categoryItems[0]);
        console.log(this.categoryItems[0].ItemCode);
        console.log(this.categoryItems.length)
        for(var i = 0; i < data.length; i++){
          for(var j = 0; j < this.categoryItems.length; j++){
            if(data[i].ItemCode == this.categoryItems[j].ItemCode){
            item = {id: i,
            item_name: this.categoryItems[i].Name,
            item_desc: this.categoryItems[i].Description,
            item_code: data[i].id,
            item_quantity: data[i].Quantity,
            item_price: this.categoryItems[i].RetailPrice,
            item_image: 'SamplePhoto.png'}
            this.items.push(item);
            this.totPrice = this.totPrice + (data[i].Quantity * this.categoryItems[i].RetailPrice * 1);
            console.log(i);
            }
          }
        }
        this.totPrice = (Math.round(this.totPrice * 100) / 100).toFixed(2);
      },
      getCartItems() {
        this.items = [];
        console.log(this.customerInfos.Email);
        axios.post('http://127.0.0.1:8000/api/headercart/store', {
          register: this.customerInfos.Email
        })
        .then(res => this.showCartItems(res.data))
        //.then(res => console.log(res.data))
        .catch(err => console.error(err));
      },
      deleteItems(code){
        console.log("Delete this item");
        console.log(code);
        axios.delete('http://127.0.0.1:8000/api/getcart/'+ code)
        //.then( res => console.log(res))
        .then( res => this.getCartItems())
        .catch(err => console.error(err))
      }
    },

    beforeMount() {
      this.getCartItems();
      //this.showCartItems();
    }
  }
</script>