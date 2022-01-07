<template>
  <div>
    <v-container>
      <v-row>
        <v-col
          offset-xl="1"
          xl="10"
          lg="12"
          md="12"
          cols="12"
        >
          <v-row>
            <v-col
              v-for="item in showItems"
              :key="item.id"
              xl="2"
              lg="3"
              md="4"
            >
              <v-card
                min-height="465px"
                min-width="230px"
                max-height="465px"
                max-width="230px"
                class="elevation-1"
              >
                <div>
                  <div
                    class="d-flex pt-1 pl-2"
                  >
                    <h4
                      class="border ma-0 py-0 mt-1 px-1  pink--text"
                      v-if="item.discount != 0"
                      style="border: 1px solid red; border-radius: 5px"
                    >
                      - {{item.discount}}%
                    </h4>
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
                    class="fontStyle fontBlue"
                    
                  >
                    <div class="d-flex">
                      <v-icon
                      color="#1106A0"
                      size="18px"
                      class="mr-1"
                    >
                      mdi-currency-php
                    </v-icon>
                    <h5>{{priceRound(item.retailPrice - ((item.discount / 100) * item.retailPrice))}}</h5>
                    
                    </div>
                    
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
                    <span
                      class="d-inline-block text-truncate"
                      style="max-width: 200px;" 
                    >{{item.description}}</span>
                    <br>
                    <span>
                      {{item.size}}
                    </span>
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
                    class="mr-5"
                      large
                      icon
                      white
                      text
                      color="#1106A0"
                      @click="addToCartItems(item.itemCode, item.id)"
                    >
                      <v-img
                        contain
                        src="../../assets/Cart.svg"
                        max-height="40px"
                        max-width="40px"
                        >
                        
                      </v-img>
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
      
      addToCartItems(code, id) {
        // console.log("add to cart");
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
            // console.log(res.data);
            this.$store.commit('storeCartQuantity');
          })
          .catch(err => console.error(err));
        }
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

<style scoped>
.fontBlue{
  color: #1106A0;
}
@font-face {
  font-family: "RedHatDisplay";
  src: local("RedHatDisplay"),
   url(../../assets/Fonts/RedHatDisplay-VariableFont_wght.ttf) format("truetype");
}
.fontStyle{
     font-family: "RedHatDisplay", Helvetica, Arial;
  }

</style>