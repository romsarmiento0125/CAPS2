<template>
  <div>
    <v-container>
      <v-row>
        <v-col
          xl="11"
          cols="12"
        >
          <v-row>
            <v-col
              v-for="item in showItems"
              :key="item.id"
              xl="2"
              lg="3"
              md="4"
              sm="4"
              cols="6"
            >
              <v-card
                min-height="335px"
                min-width="230px"
                max-height="335px"
                max-width="230px"
                class="elevation-1 d-none d-sm-block"
              >
                <div>
                  <div
                    class="d-flex pt-1 pl-2"
                  >
                   <v-row >
                      <v-col cols="6" class="d-flex">
                        <h4
                          class="borderDisc mt-1 px-2  pink--text"
                          v-if="item.discount != 0"

                          >
                            - {{item.discount}}%
                        </h4>
                      </v-col>
                      <v-col cols="6" class="d-flex justify-center">
                        <h5
                          class="borderQuan px-1 mt-1 ml-4 d-flex justify-center white--text"
                          v-if="(item.quantity - item.qtyLimit) >= 1"
                        >{{item.quantity - item.qtyLimit}} Pcs</h5>
                        <h5
                          v-else
                          class="borderQuan px-1 mt-1 ml-4 d-flex justify-center white--text"
                        >Sold Out</h5>
                      </v-col>
                    </v-row>
                  </div>

                  <div class="d-flex justify-center">
                    <v-img
                      :src="imagePath+'/'+item.image"
                      min-height="150px"
                      min-width="180px"
                      max-height="150px"
                      max-width="180px"
                      contain
                    ></v-img>
                  </div>
                  
                    <div class="d-flex px-5">
                      <v-icon
                      color="#1106A0"
                      size="18px"
                      class="mr-1 mx-0 my-0 py-0 px-0"
                    >
                      mdi-currency-php
                    </v-icon>
                    <h3 class="fontBlue fontStyle font-weight-Black">{{priceRound(item.retailPrice - ((item.discount / 100) * item.retailPrice))}}</h3>                   
                    </div>
                    
                 
                  <div class="mx-5">
                    <h5 
                      class="text-decoration-line-through fontDesc"
                      v-if="item.discount != 0"
                    >
                      <v-icon
                        small
                      >
                        mdi-currency-php
                      </v-icon>
                      {{priceRound((item.supplierPrice * 1) + (item.supplierPrice * .05))}}
                    </h5>
                  </div>
                  
                  <div class="px-5 mt-1">
                    <h4
                      class="d-inline-block text-truncate"
                      style="max-width: 200px;" 
                    >{{item.name}}</h4>
                  </div>

                  <div class="px-5 mt-n2">
                    <h5
                      class="d-inline-block text-truncate fontDesc"
                      style="max-width: 200px;" 
                    >{{item.description}}</h5>
                  </div>
                  
                  <div>
                    <v-row>
                      <v-col cols="" class="ml-5 mt-n2">
                        <h5 class="fontDesc font-weight-black">
                          {{item.size}}
                        </h5> 
                      </v-col>

                      <v-col>
                        <v-col cols="">
                          <div
                            class="d-flex"
                            >
                            <v-spacer></v-spacer>
                              <v-btn
                                class="mr-3 mt-n1"
                                large
                                icon
                                white
                                text
                                color="#1106A0"
                                @click="addToCartItems(item.itemCode)"
                                v-if="(item.quantity - item.qtyLimit) >= 1"
                                :disabled="timerCount > 0"
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
                        </v-col> 
                      </v-col>
                    </v-row>
                  </div>
                </div>
              </v-card>

              <v-card
                min-height="335px"
                min-width="150px"
                max-height="335px"
                max-width="150px"
                class="elevation-1 d-sm-none"
              >
                <div>
                  <div
                    class="d-flex pt-1"
                  >
                   <v-row >
                      <v-col cols="6" class="d-flex">
                        <h4
                          class="borderDisc mt-1 px-2 ml-1 pink--text"
                          v-if="item.discount != 0"

                          >
                            - {{item.discount}}%
                        </h4>
                      </v-col>
                      <v-col cols="6" class="d-flex justify-center">
                        <h5
                          class="borderQuan px-1 mt-1 d-flex justify-center white--text"
                          v-if="(item.quantity - item.qtyLimit) >= 1"
                        >{{item.quantity - item.qtyLimit}} Pcs</h5>
                        <h5
                          v-else
                          class="borderQuan px-1 mt-1 d-flex justify-center white--text"
                        >Sold Out</h5>
                      </v-col>
                    </v-row>
                  </div>

                  <div class="d-flex justify-center">
                    <v-img
                      :src="imagePath+'/'+item.image"
                      min-height="100px"
                      min-width="130px"
                      max-height="100px"
                      max-width="130px"
                      contain
                    ></v-img>
                  </div>
                  
                    <div class="d-flex px-5">
                      <v-icon
                      color="#1106A0"
                      size="18px"
                      class="mr-1 mx-0 my-0 py-0 px-0"
                    >
                      mdi-currency-php
                    </v-icon>
                    <h3 class="fontBlue fontStyle font-weight-Black">{{priceRound(item.retailPrice - ((item.discount / 100) * item.retailPrice))}}</h3>                   
                    </div>
                    
                 
                  <div class="mx-5">
                    <h5 
                      class="text-decoration-line-through fontDesc"
                      v-if="item.discount != 0"
                    >
                      <v-icon
                        small
                      >
                        mdi-currency-php
                      </v-icon>
                      {{priceRound((item.supplierPrice * 1) + (item.supplierPrice * .05))}}
                    </h5>
                  </div>
                  
                  <div class="px-5 mt-1">
                    <h4
                      class="d-inline-block text-truncate"
                      style="max-width: 130px;" 
                    >{{item.name}}</h4>
                  </div>

                  <div class="px-5 mt-n2">
                    <h5
                      class="d-inline-block text-truncate fontDesc"
                      style="max-width: 130px;" 
                    >{{item.description}}</h5>
                  </div>
                  
                  <div>
                    <v-row>
                      <v-col cols="12" class="ml-5 mt-n2">
                        <h5 class="fontDesc font-weight-black">
                          {{item.size}}
                        </h5> 
                      </v-col>

                      <v-col>
                        <v-col cols="">
                          <div
                            class="d-flex"
                            >
                            <v-spacer></v-spacer>
                              <v-btn
                                class="mr-3 mt-n1"
                                large
                                icon
                                white
                                text
                                color="#1106A0"
                                @click="addToCartItems(item.itemCode)"
                                v-if="(item.quantity - item.qtyLimit) >= 1"
                                :disabled="timerCount > 0"
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
                        </v-col> 
                      </v-col>
                    </v-row>
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

    props: ["categ"],

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
      timerCount: 0,
      myInterval: null,
    }),

    computed: {
      categoryItems() {
        return this.$store.state.categoryItems;
      },
      imagePath() {
        return this.$store.state.imagePath;
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
      },
      categ() {
        // console.log(this.categ);
        // console.log(this.categoryItems);
        if(!this.categ.length){
          this.showItems = this.categoryItems;
        }
        else{
          var allItems = this.categoryItems;
          var filteredItems = [];
          this.categ.forEach(cat => {
            allItems.forEach(item => {
              if(item.underCategory == cat){
                filteredItems.push(item);
              }
            });
          });
          // console.log(filteredItems);
          this.showItems = filteredItems;
        }
      }
    }, 

    methods: {
      Timer(){
        this.timerCount = 1;
        this.myInterval = setInterval(this.myTimer, 1000);
      },
      myTimer() {
        // console.log("disable");
        this.timerCount--;
        if(this.timerCount <= 0){
          this.myStopFunction();
        }
      },
      myStopFunction() {
        // console.log("enable");
        clearInterval(this.myInterval);
      },
      filterItems(){
        this.showItems = this.categoryItems;
        this.showItems = this.computedShowItems;
      },
      addToCartItems(code) {
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
            if(res.data == "false"){
              console.log("Too many request");
            }
            else{
              this.$store.commit('storeCartQuantity');
            }
          })
          .catch(err => console.error(err));
        }
        this.Timer();
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
.fontTitle{
  color: #464646;
}
.fontDesc{
  color:#858585;
}
@font-face {
  font-family: "RedHatDisplay";
  src: local("RedHatDisplay"),
   url(../../assets/Fonts/RedHatDisplay-VariableFont_wght.ttf) format("truetype");
}
.fontStyle{
     font-family: "RedHatDisplay", Helvetica, Arial;
  }
.borderQuan{
  background-color: #ffA600;
  border: 1px solid #ffA600;
  width: 65px;
  height: 25px;
  border-radius: 8px;
}
.borderDisc{
  border: 1px solid #ff0000;
  border-radius: 5px;
}

</style>