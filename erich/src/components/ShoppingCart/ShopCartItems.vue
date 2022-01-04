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
            class="py-2 my-10"
            rounded="lg"
          >
            <v-row class="pa-4">
              <v-col cols="5">
                <h4
                  class="mx-4 px-15 font-weight-bold fontTitle"
                >Product</h4>
              </v-col>
              <v-col cols="7" class="px-16">
                <div
                  class="d-flex justify-end"
                >
                  <h4
                    class="fontTitle px-11"
                  >Quantity</h4>
                  <h4
                    class="fontTitle px-14"
                  >Total Price</h4>
                  <h4
                    class="fontTitle px-10"
                  >Action</h4>
                </div>
              </v-col>
            </v-row>

            <v-divider></v-divider>

            <v-row>
              <v-col>
                <v-list
                  class="my-0 py-0"
                >
                  <v-list-item-group
                    v-for="(item, i) in items"
                      :key="i"
                  >
                    <v-list-item
                      class="my-0 py-0"
                    >
                      <v-list-item-content
                        class="border ma-2"
                      >
                        <v-row
                        >
                          <v-col
                            cols="6"
                            class="my-0 py-0"
                          >
                            <div
                              class="d-flex align-center"
                            >
                              <v-img
                                max-height="150px"
                                max-width="210px"
                                contain
                                :src="require('../../assets/itemPhotos/'+item.item_image)"
                              ></v-img>

                              <v-list-item-title>
                                <h3
                                  class="my-1"
                                >
                                  {{item.item_name}}
                                </h3>
                                <h4
                                  class="fontBlue my-1"
                                >
                                  {{item.item_desc}}
                                </h4>
                                <div class="d-flex my-1">
                                  <v-icon size="14px" class="pr-1">
                                  
                                    mdi-currency-php
                                  </v-icon>

                                  <h5
                                    class="fontDesc"
                                  >
                                    {{priceRound(item.item_price - ((item.item_discount / 100) * item.item_price))}}
                                  </h5>
                                </div>
                                
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
                                style="border-style: solid; border-width: 1px 1px; border-color: #BDBDBD"
                              >
                                <v-btn
                                  depressed
                                  color="transparent"
                                  class=""
                                  @click="decreaseQuantity(item.id, i, item.item_quantity)"
                                  
                                >
                                  <v-icon
                                    color="#757575"
                                  >
                                    mdi-minus
                                  </v-icon>
                                </v-btn>
                                <p
                                  class="my-0 px-2 subtitle-1 grey--text text--darken-2 font-weight-bold" 
                                >
                                  {{item.item_quantity}}
                                </p>
                                <v-btn
                                  depressed
                                  color="transparent"
                                  @click="addQuantity(item.id, i)"
                                  
                                >
                                  <v-icon
                                    color="#757575"
                                  >
                                    mdi-plus
                                  </v-icon>
                                </v-btn>
                              </div>

                              <div
                                class="my-0 mx-15 d-flex align-center justify-center"
                              >
                                <v-icon 
                                small
                                color="#858585" 
                                class="pr-1"
                                >
                                  mdi-currency-php
                                </v-icon>
                                <h4
                                  class="pa-0 ma-0 fontDesc"
                                >
                                  {{priceRound((item.item_price - ((item.item_discount / 100) * item.item_price)) * item.item_quantity)}}
                                </h4>
                              </div>

                              <v-btn
                                class="act justify-center mx-4 font-weight-bold"
                                color="#1106A0"
                                plain
                                @click="deleteItems(item.id)"
                                
                              >
                                Delete
                              </v-btn>
                            </div>
                          </v-col>
                        </v-row>
                      </v-list-item-content>
                    </v-list-item>
                    <v-divider></v-divider>
                  </v-list-item-group>
                </v-list>
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
        
        <v-col
          cols="3"
          class="d-flex justify-center"
        >
          <v-sheet
            color="#FFFFFF"
            height="240px"
            width="100%"
            class="py-2 my-10"
            rounded="lg"
            style="position: relative;"
          >
            <v-row>
              <v-col
              >
                <h3
                  class="my-4 mx-10 title fontTitle"
                >
                  Total
                </h3>
              </v-col>
              <v-col>
                <div
                  class="d-flex justify-end"
                >
                  <h3
                  class="my-4 mx-10 title fontTitle"
                  >
                    <v-icon color="#464646">mdi-currency-php</v-icon>{{totPrice}}
                  </h3>
                </div>
                
              </v-col>
            </v-row>

            <v-divider></v-divider>

            <v-row>
              <v-col>
                <p
                  class="my-3 mx-10"
                >
                  Taxes and <router-link to="/" class="text-decoration-underline indigo--text text--darken-4">Shipping</router-link> are calculted at checkout
                </p>
                <div
                  class="mx-8 pt-12"
                >
                  <v-btn
                    dark
                    color="#1106A0"
                    class="mx-2"
                    :to="{name: 'Cart' , params: { id: 'place-order', title: 'Place Order'}}"
                    @click="showPlaceOrder()"
                    block
                    :disabled="checkoutButton"
                  >
                    <p
                      class="py-0 my-0"
                    >
                      Checkout
                    </p>
                  </v-btn>
                </div>
                
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    
    data: () => ({
      items: [
        // {id: 0, item_name: "Koko Crunch", item_desc: "this is item description", item_price: 156.50, item_image: 'SamplePhoto.png'},
        // {id: 1, item_name: "Pancake Plus", item_desc: "this is item description", item_price: 79.95, item_image: 'SamplePhoto.png'},
        // {id: 2, item_name: "Gardenia", item_desc: "this is item description", item_price: 67.50, item_image: 'SamplePhoto.png'},
      ],
      totPrice: 0,
      checkoutButton: true,
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
      cartQuantity() {
        return this.$store.state.cartQuantity;
      }
    },
    
    methods: {
      showPlaceOrder() {
        this.$emit('scItemsEmit');
      },
      showCartItems(data) {
        var qty = 0;
        var item;
        this.totPrice = 0;
        // console.log("cart items");
        // console.log(data.length);
        // console.log(data[0].Email);
        // console.log(this.customerInfos.Email)
        // console.log(data);
        // console.log(this.categoryItems);
        // console.log(this.categoryItems[0].Discount)
        
        for(var i = 0; i < data.length; i++){
          if(data[i].Email == this.customerInfos.Email){
            for(var j = 0; j < this.categoryItems.length; j++){
              if(data[i].ItemCode == this.categoryItems[j].ItemCode){
              item = {id: data[i].id,
              item_name: this.categoryItems[j].Name,
              item_desc: this.categoryItems[j].Description,
              item_code: this.categoryItems[j].ItemCode,
              item_quantity: data[i].Quantity,
              item_price: this.categoryItems[j].RetailPrice,
              item_image: this.categoryItems[j].Image,
              item_email: this.customerInfos.Email,
              item_discount: this.categoryItems[j].Discount
              }
              this.items.push(item);
              this.totPrice = (this.totPrice + ((data[i].Quantity * this.categoryItems[j].RetailPrice * 1) - ((data[i].Quantity * this.categoryItems[j].RetailPrice * 1) * (this.categoryItems[j].Discount / 100) )));
              //console.log(i);
              }
              else{
                //console.log("this is else");
              }
            }
          }
        }
        this.totPrice = (Math.round(this.totPrice * 100) / 100).toFixed(2);
        this.$store.commit('storeCartItems', this.items);
        this.checkoutButtonChecker();
      },
      getCartItems() {
        this.items = [];
        //console.log("This is customerInfos Email: " + this.customerInfos.Email);
        axios.get(this.getDomain()+'api/headercart')
        .then(res => {
          this.showCartItems(res.data)
          // console.log(res.data)
          })
        .catch(err => console.error(err));
      },
      deleteItems(code) {
        // console.log("Delete this item");
        // console.log(code);
        axios.delete(this.getDomain()+'api/getcart/'+ code)
        //.then( res => console.log(res))
        //.then( res => this.getCartItems())
        .then( res => {
          this.getCartItems()
          // console.log(res.data)
        })
        .catch(err => console.error(err))
      },
      addQuantity(idcart, count) {
        // console.log("Quantity add");
        // console.log(this.cartItems);
        // console.log(this.cartItems[count].id);
        // console.log(idcart);
        // console.log(count);
        axios.put(this.getDomain()+'api/getcart/' + idcart, {
          itemupdate: this.cartItems[count]
        })
        .then(res => {
          //console.log(res.data)
          this.showQuantity(res.data)
        })
        .catch(err => console.error(err));
      },
      decreaseQuantity(idcart, count, quantity) {
        // console.log("Quantity decrease",);
        // console.log(quantity);
        if(quantity < 2){
          alert("Remove the item");
          this.deleteItems(idcart);
        }
        else{
          axios.put(this.getDomain()+'api/headercart/' + idcart, {
            itemupdate: this.cartItems[count]
          })
          .then(res => {
            //console.log(res.data)
            this.showQuantity(res.data)
          })
          .catch(err => console.error(err));
        }
      },
      showQuantity(data) {
        // console.log("show quantity");
        //console.log(data);
        this.$store.commit('storeCartItems', data);
        this.getCartItems();
      },
      checkoutButtonChecker(){
        // console.log("cartQutantity cheker");
        // console.log(this.cartQuantity);
        if(this.totPrice == 0){
          // console.log("items is null");
          this.checkoutButton = true;
        }
        else{
          // console.log("else");
          this.checkoutButton = false;
      }
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      }
    },

    beforeMount() {
      this.getCartItems();
      //this.showCartItems();
      //console.log("before mount");
    }
  }//export default closing bracket

  //showCartItems methods with comments
  // showCartItems(data) {
  //   var item;
    
  //   // console.log("cart items");
  //   // console.log(data);
  //   // console.log(data[0]);
  //   // console.log(data[1].ItemCode);
  //   // console.log(data[0].Quantity);
  //   // console.log(data[0].id);
  //   // console.log(data.length);

  //   // console.log("category items");
  //   // console.log(this.categoryItems);
  //   // console.log(this.categoryItems[0]);
  //   // console.log(this.categoryItems[2].ItemCode);
  //   // console.log(this.categoryItems.length)
  //   for(var i = 0; i < data.length; i++){
  //     for(var j = 0; j < this.categoryItems.length; j++){
  //       if(data[i].ItemCode == this.categoryItems[j].ItemCode){
  //       // alert("This is item Name " + this.categoryItems[j].Name + " " + this.categoryItems[j].Description
  //       // + " This is item Code " + this.categoryItems[j].ItemCode + " This is item Quantity " + 
  //       // data[i].Quantity + " This is item Retail Price " + this.categoryItems[j].RetailPrice + " This is item id " + i
  //       // )
  //       // console.log(i);
  //       // console.log(this.categoryItems[j].Name,);
  //       // console.log(this.categoryItems[j].ItemCode);
  //       // console.log(data[i].ItemCode)
  //       item = {id: i,
  //       item_name: this.categoryItems[j].Name,
  //       item_desc: this.categoryItems[j].Description,
  //       item_code: this.categoryItems[j].ItemCode,
  //       item_quantity: data[i].Quantity,
  //       item_price: this.categoryItems[j].RetailPrice,
  //       item_image: 'SamplePhoto.png'}
  //       this.items.push(item);
  //       this.totPrice = this.totPrice + (data[i].Quantity * this.categoryItems[j].RetailPrice * 1);
  //       console.log(i);
  //       }
  //       else{
  //         console.log("this is else");
  //       }
  //     }
  //   }
  //   this.totPrice = (Math.round(this.totPrice * 100) / 100).toFixed(2);
  //   this.$store.commit('storeCartItems', this.items);
  // },
</script>
<style scoped>
.fontTitle{
color: #464646;
}
.fontDesc{
color: #858585;
}
.fontBlue{
  color: #1106a0;
}
</style>