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
                      v-if="item.Discount != 0"
                      style="border: 1px solid red; border-radius: 5px"
                    >
                      -{{item.Discount}}%
                    </p>
                    <p
                      class="pb-4"
                      v-else
                    >
                      
                    </p>
                  </div>
                

                  <v-img
                    :src="require('../../assets/itemPhotos/'+item.Image)"
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
                    {{priceRound(item.RetailPrice - ((item.Discount / 100) * item.RetailPrice))}}
                  </v-card-title>

                  <v-card-subtitle
                    class="py-0"
                  >
                    <span 
                      class="text-decoration-line-through"
                      v-if="item.Discount != 0"
                    >
                      <v-icon
                        small
                      >
                        mdi-currency-php
                      </v-icon>
                      {{priceRound((item.SupplierPrice * 1) + (item.SupplierPrice * .05))}}
                    </span>
                    <br>
                    <span
                      class="d-inline-block text-truncate subtitle-1"
                      style="max-width: 200px;" 
                    >{{item.Name}}</span>
                    <br>
                    <span>
                      {{item.Size}}
                    </span>
                    <br>
                    <span
                      class="d-inline-block text-truncate"
                      style="max-width: 200px;" 
                    >{{item.Description}}</span>
                    <br>
                    
                    <span>{{item.Quantity}} &nbsp; Pcs Available</span>
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
                      @click="addToCartItems(item.ItemCode)"
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
  export default {
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
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      cartQuantity(){
        return this.$store.state.cartQuantity;
      },
      searchKeyWords() {
        return this.$store.state.searchItem;
      },
      computedShowItems(){
        // return this.showItems.filter((item) => {
        //   return item.Name.match(this.searchKeyWord);
        // });
        var sk = this.searchKeyWords;
        var re = new RegExp(sk, 'gi');
        return this.showItems.filter((item) => {
          return item.Name.match(re);
        });
        // return this.showItems.filter((item) => {
        //   return item;
        // });
      }
    },

    watch: {
      // cartItems: function(data){
      //   console.log("watch",data);
      // }
      searchKeyWords() {
        this.filterItems();
      }
    }, 

    // mounted(){
    //   setTimeout(() => {
    //     this.$store.state.cartItems = {cart: 0};
    //   }, 3000);
    // },

    // How Process Works. Ang i ssave mo lang sa cart ay yung email, itemcode at quantity.
    // Then if existing nayung item i update lang yung quantity.
    methods: {
      filterItems(){
        //console.log(this.searchKeyWords)
        this.showItems = this.categoryItems;
        this.showItems = this.computedShowItems;
      },
      
      addToCartItems(code) {
        console.log("add to cart");
        this.cartItems.Email = this.customerInfos.Email;
        this.cartItems.ItemCode = code;

        console.log(this.cartItems.Email);
        console.log(this.customerInfos.Email);

        //The if condition fire if there is no account login
        //The else condition fire there is account login
        if(this.cartItems.Email == undefined){
          console.log("login ka muna");
          this.$router.push('/login');
        }
        else {
          console.log(this.cartItems.id);
          console.log(this.cartItems.Email);
          console.log(this.cartItems.Quantity);
          console.log(this.cartItems.ItemCode);

          //do axios post request to try to add items in cart
          console.log("axios Fire");
          console.log(this.cartItems);
          axios.post('http://127.0.0.1:8000/api/customercart/store', {
            register: this.cartItems
          })
          .then(res => {
            this.updateCartCounter(res.data)
            //console.log(res);  
          })
          //.then(res => console.log(res.data))
          .catch(err => console.error(err));
        }
      },
      updateCartCounter(data){
        console.log("update cart counter");
        console.log(data);
        
        //check if the post id success in adding items in cart.
        //if not success in adding items in cart it will fire update in quantity
        if(data === "addSuccess"){
          console.log("item added succesfully");
          this.$store.commit('storeCartQuantity', this.$store.state.cartQuantity + 1);
          console.log(data);
        }
        else{
          console.log("Fire Axios");
          console.log(data);
          console.log(data.id);
          axios.put('http://127.0.0.1:8000/api/customercart/' + data.id, {
            itemupdate: this.cartItems
          })
          .then(res => {
            console.log(res.data)
            this.showQuantity(res.data)
          })
          .catch(err => console.error(err));
          console.log("axios fired");
        }
      },
      showQuantity(data){
        this.$store.commit('storeCartItems', data);
        this.$store.commit('storeCartQuantity', this.$store.state.cartQuantity + 1);
      },
      getCategoryItems() {
        //console.log("Get Items");
        axios.get('http://127.0.0.1:8000/api/categoryitem')
        .then(res => {
          this.storeCategoryItems(res.data)
          this.showItems = res.data;
          })
        .catch(err => console.error(err));
      },
      storeCategoryItems(data) {
        //console.log("This is items data: ");
        //console.log(data);
        this.$store.commit('storeCategoryItem', data);
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
