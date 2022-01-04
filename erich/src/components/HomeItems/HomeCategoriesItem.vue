<template>
  <div>
    <v-container>
      <v-row>
        <v-col
          offset-lg="1"
          offset-xl="1"
          cols="12"
          sm="12"
          md="12"
          lg="10"
          xl="10"
        >
          <v-row>
            <v-col
              v-for="item in showItems"
              :key="item.id"
              cols="6"
              sm="4"
              md="3"
              lg="3"
              xl="2"
            >
              <v-card
                min-height="460px"
                min-width="230px"
                max-height="460px"
                max-width="230px"
                class=""
              >
                <div>
                  <div
                    class="d-flex pt-1 pl-2"
                  >
                    <p
                      class="border ma-0 py-0 px-1 title pink--text"
                      v-if="item.discount != 0"
                      style="border: 1px solid red; border-radius: 5px"
                    >
                      -{{item.discount}}%
                    </p>
                    <p
                      class="pb-4"
                      v-else
                    >
                      
                    </p>
                  </div>
                

                  <v-img
                    :src="require('../../assets/itemPhotos/'+item.image)"
                    min-height="200px"
                    min-width="230px"
                    max-height="200px"
                    max-width="230px"
                    contain
                  ></v-img>

                  <v-card-title
                    class="blue--text"
                  >
                    <v-icon
                      color="blue"
                    >
                      mdi-currency-php
                    </v-icon>
                    {{priceRound(item.retailPrice - ((item.discount / 100) * item.retailPrice))}}
                  </v-card-title>

                  <v-card-subtitle
                    class="py-0"
                  >
                    <span 
                      class="text-decoration-line-through"
                      v-if="item.discount != 0"
                    >
                      <v-icon
                        small
                      >
                        mdi-currency-php
                      </v-icon>
                      {{priceRound((item.supplierPrice * 1) + (item.supplierPrice * .05))}}
                    </span>
                    <br>
                    <span
                      class="d-inline-block text-truncate subtitle-1"
                      style="max-width: 200px;" 
                    >{{item.name}}</span>
                    <br>
                    <span>
                      {{item.size}}
                    </span>
                    <br>
                    <span
                      class="d-inline-block text-truncate"
                      style="max-width: 200px;" 
                    >{{item.description}}</span>
                    <br>
                    
                    <span>{{item.quantity}} &nbsp; Pcs Available</span>
                  </v-card-subtitle>
                </div>

                <div
                  class=""
                >
                  <div
                    class="d-flex"
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      x-large
                      icon
                      color="primary"
                      @click="addToCartItems(item.itemCode)"
                    >
                      <v-icon>
                        mdi-cart-outline
                      </v-icon>
                    </v-btn>
                  </div>
                </div>
              </v-card>
            </v-col>
          </v-row>
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
      showItems: null,
      searchKey: "",
      cartItems: {
        id: null,
        Email: "",
        Quantity: 1,
        ItemCode: "",
      },
      cartCounter: 0,
    }),

    computed: {
      categoryItems() {
        return this.$store.state.categoryItems;
      },
      cartQuantity(){
        return this.$store.state.cartQuantity;
      },
      searchKeyWords() {
        return this.$store.state.searchItem;
      },
      usersEmail(){
        return localStorage.getItem('email');
      },
      usersToken(){
        return localStorage.getItem('token');
      },
      computedShowItems(){
        var sk = this.searchKeyWords;
        var re = new RegExp(sk, 'gi');
        return this.showItems.filter((item) => {
          return item.name.match(re);
        });
      },
    },

    watch: {
      searchKeyWords() {
        this.filterItems();
      },
      categoryItems() {
        this.getCategoryItems();
      }
    }, 

    // mounted(){
    //   setTimeout(() => {
    //     this.$store.state.cartItems = {cart: 0};
    //   }, 3000);
    // },

    methods: {
      filterItems(){
        this.showItems = this.categoryItems;
        this.showItems = this.computedShowItems;
      },
      
      addToCartItems(code) {
        console.log("add to cart");
        this.cartItems.Email = this.usersEmail;
        this.cartItems.ItemCode = code;

        if(this.cartItems.Email == undefined){
          this.$router.push('/login');
        }
        else {
          axios.post(this.getDomain()+'api/customercart/store', {
            register: this.cartItems
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.updateCartCounter(res.data)
          })
          .catch(err => console.error(err));
        }
      },
      updateCartCounter(data){
        if(data === "addSuccess"){
          this.$store.commit('storeCartQuantity', this.$store.state.cartQuantity + 1);
        }
        else{
          axios.put(this.getDomain()+'api/customercart/' + data.id, {
            itemupdate: this.cartItems
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.showQuantity(res.data)
          })
          .catch(err => console.error(err));
        }
      },
      showQuantity(data){
        this.$store.commit('storeCartItems', data);
        this.$store.commit('storeCartQuantity', this.$store.state.cartQuantity + 1);
      },
      getCategoryItems() {
        if(!(this.categoryItems == null)){
          this.showItems = this.categoryItems;
        }
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      }
    },

    beforeMount() {
      this.getCategoryItems();
    },
  }
</script>
