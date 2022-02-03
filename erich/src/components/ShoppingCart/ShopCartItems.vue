<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col
          offset-xl="1"
          xl="7"
          lg="9"
          md="9"
          class="d-flex justify-center"
        >
          <v-sheet
            color="#FFFFFF"
            width="100%"
            class="py-2 my-10"
            rounded="lg"
          >
            <v-row class="pa-4">
              <v-col
                xl="5"
                lg="5"
                md="4"
              >
                <h4
                  class="mx-4 px-lg-15 font-weight-bold fontTitle"
                >Product</h4>
              </v-col>
              <v-col
                xl="7" 
                lg="7"
                class="pr-xl-16"
              >
                <div
                  class="d-flex justify-end"
                >
                  <h4
                    class="fontTitle px-lg-11 px-10"
                  >Quantity</h4>
                  <h4
                    class="fontTitle px-lg-14 px-5"
                  >Total Price</h4>
                  <h4
                    class="fontTitle px-lg-10 px-5"
                  >Action</h4>
                </div>
              </v-col>
            </v-row>

            <v-divider></v-divider>

            <v-row>
              <v-col
                cols="12"
              >
                <v-list
                  class="my-0 py-0"
                >
                  <v-list-item-group
                    v-for="(item, i) in cartItems"
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
                            xl="5"
                            lg="5"
                            md="5"
                            class="my-0 py-0"
                          >
                            <div
                              class="d-flex align-center"
                            >
                              <v-img
                                max-height="150px"
                                max-width="150px"
                                contain
                                :src="imagePath+'/'+item.item_image"
                              ></v-img>

                              <v-list-item-title>
                                <h3
                                  class="my-lg-1"
                                >
                                  {{item.item_name}}
                                </h3>
                                <h4
                                  class="fontBlue my-lg-1"
                                >
                                  {{item.item_desc}}
                                </h4>
                                <div class="d-flex my-lg-1">
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
                            xl="7"
                            lg="7"
                            md="7"
                            class="d-flex align-center justify-end pr-xl-16"
                          >
                            <div
                              class="d-flex align-center"
                            >
                              <div
                                class="qtt d-flex align-center justify-center mr-2 "
                                style="border-style: solid; border-width: 1px 1px; border-color: #BDBDBD"
                              >
                                <v-btn
                                  depressed
                                  color="transparent"
                                  class=""
                                  @click="updateQuantity(item.id, item.item_quantity, 'decrease')"
                                  small
                                  :disabled="timerCount > 0"
                                >
                                  <v-icon
                                    color="#757575"
                                  >
                                    mdi-minus
                                  </v-icon>
                                </v-btn>
                                <v-btn
                                  depressed
                                  color="#1106A0"
                                  dark
                                  class="rounded-0"
                                  @click="openUpdateQty(item.item_quantity, item.id, item.item_code)"
                                >
                                  <p
                                    class="my-0 px-2 subtitle-1 font-weight-bold" 
                                  >
                                    {{item.item_quantity}}
                                  </p>
                                </v-btn>
                                <!-- <p
                                  class="my-0 px-2 subtitle-1 grey--text text--darken-2 font-weight-bold" 
                                >
                                  {{item.item_quantity}}
                                </p> -->
                                <v-btn
                                  depressed
                                  color="transparent"
                                  @click="updateQuantity(item.id, item.item_quantity, 'increase', item.item_code)"
                                  small
                                  :disabled="timerCount > 0"
                                >
                                  <v-icon
                                    color="#757575"
                                  >
                                    mdi-plus
                                  </v-icon>
                                </v-btn>
                              </div>

                              <div
                                class="my-0 mx-lg-15 mx-4 d-flex align-center justify-center"
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
                                class="act justify-center mx-lg-4 font-weight-bold"
                                color="#1106A0"
                                plain
                                @click="openDeleteWarning(item.id)"
                                
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
          xl="3"
          lg="3"
          md="3"
          class="d-flex justify-center"
        >
          <v-sheet
            color="#FFFFFF"
            height="250px"
            width="100%"
            class="py-2 my-10"
            rounded="lg"
            style="position: relative;"
          >
            <v-row>
              <v-col
                xl="6"
                lg="4"
                md="3"
              >
                <h3
                  class="my-4 mx-10 title fontTitle"
                >
                  Total
                </h3>
              </v-col>
              <v-col
                xl="6"
                lg="8"
                md="9"
              >
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
              <v-col
                cols="12"
              >
                <p
                  class="my-3 mx-lg-10 mx-md-2 text-md-center text-lg-left"
                >
                  Taxes and <router-link to="/" class="text-decoration-underline indigo--text text--darken-4">Shipping</router-link> are calculted at checkout
                </p>
                <div
                  class="mx-8 pt-xl-12 pt-lg-6 pt-md-4"
                >
                  <p
                    v-if="(usersTag == 'Unverified')"
                    class="py-0 my-0 text-center subtitle-1"
                  >
                    Please Verify Your Account First.
                  </p>
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
    <v-dialog
      v-model="deleteItem"
      persistent
      max-width="400px"
    >
      <v-card>
        <v-card-title>
          <span class="">
           <h4>Remove Item.</h4>
           </span>
        </v-card-title>
        <v-card-text>
          <h4
            class="my-0"
          >
            Do you want to remove this item?
          </h4>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="#1106A0"
            outlined
            class="px-10"
            @click="deleteItem = false"
          >
            NO
          </v-btn>
          <v-btn
            color="#1106A0"
            dark
            class="px-10"
            @click="deleteItems(deleteId)"
          >
            YES
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
      v-model="updateDialog"
      persistent
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5"></span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-text-field
              type="number"
              v-model="initialQty"
            ></v-text-field>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="#1106A0"
            outlined
            class="px-10"
            @click="updateDialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="#1106A0"
            dark
            class="px-10"
            @click="updateItemQty"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
    >
      {{ prompt }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="blue"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>

<script>
  import {Mixins} from '../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    
    data: () => ({
      items: [],
      totPrice: 0,
      checkoutButton: true,
      deleteItem: false,
      deleteId: 0,
      updateDialog: false,
      initialQty: 0,
      initialId: 0,
      initialCode: '',
      snackbar: false,
      timeout: 4000,
      prompt: "",
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
      cartItems() {
        return this.items;
      },
      cartQuantity() {
        return this.$store.state.cartQuantity;
      },
      usersEmail(){
        return localStorage.getItem('email');
      },
      usersTag(){
        return this.$store.state.userTag;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
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
      openUpdateQty(qty, id, code){
        this.updateDialog = true;
        this.initialQty = qty;
        this.initialId = id;
        this.initialCode = code;
      },
      updateItemQty(){
        if(this.initialQty <= 0){
          alert("Input Invalid");
        }
        else{
          this.updateDialog = false;
          axios.put(this.getDomain()+'api/updatecart/' + this.initialId, {
            updateQty: this.initialQty,
            customerEmail: this.usersEmail,
            itemCode: this.initialCode
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            this.showCartItems(res.data.data);
          })
          .catch(err => console.error(err));
        }
      },
      openDeleteWarning(id){
        this.deleteItem = true;
        this.deleteId = id;
      },
      showPlaceOrder() {
        this.$emit('scItemsEmit');
      },
      showCartItems(data) {
        this.items = [];
        var item;
        this.totPrice = 0;
        // console.log("cart items");
        // console.log(data.length);
        // console.log(data[0].Email);
        // console.log(this.customerInfos.Email)
        // console.log(this.categoryItems[0].Discount)
        
        for(var i = 0; i < data.length; i++){
          for(var j = 0; j < this.categoryItems.length; j++){
            if(data[i].itemCode == this.categoryItems[j].itemCode){
              item = {id: data[i].id,
              item_name: this.categoryItems[j].name,
              item_desc: this.categoryItems[j].description,
              item_size: this.categoryItems[j].size,
              item_code: this.categoryItems[j].itemCode,
              item_quantity: data[i].quantity,
              item_price: this.categoryItems[j].retailPrice,
              item_image: this.categoryItems[j].image,
              item_email: this.usersEmail,
              item_discount: this.categoryItems[j].discount
              }
              this.items.push(item);
              this.totPrice = (this.totPrice + ((data[i].quantity * this.categoryItems[j].retailPrice * 1) - ((data[i].quantity * this.categoryItems[j].retailPrice * 1) * (this.categoryItems[j].discount / 100) )));
              //console.log(i);
            }
            else{
              //console.log("this is else");
            }
          }
        }
        this.totPrice = (Math.round(this.totPrice * 100) / 100).toFixed(2);
        this.$store.commit('storeCartItems', this.items);
        this.checkoutButtonChecker();
      },
      getCartItems() {
        this.items = [];
        axios.post(this.getDomain()+'api/getcart/store', {
          register: this.usersEmail
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          // console.log(res.data);
          this.showCartItems(res.data);
        })
        .catch(err => console.error(err));
      },
      deleteItems(code) {
        // console.log("Delete this item");
        // console.log(code);
        axios.post(this.getDomain()+'api/getcart',{
          register: this.usersEmail,
          id: code
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then( res => {
          this.snackbar = true;
          this.prompt = res.data.message;
          this.deleteItem = false;
          this.showCartItems(res.data.cart);
          // console.log(res.data);
        })
        .catch(err => console.error(err))
      },
      updateQuantity(idcart, quantity, cond, code) {
        this.Timer();
        if(cond == "increase"){
          axios.put(this.getDomain()+'api/getcart/' + idcart, {
            updateCond: cond,
            customerEmail: this.usersEmail,
            itemCode: code
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
              this.showCartItems(res.data);
            }
            
          })
          .catch(err => console.error(err));
        }
        else if(cond == "decrease"){
          if(quantity <= 1){
            this.deleteItem = true;
            this.deleteId = idcart;
          }
          else{
            axios.put(this.getDomain()+'api/getcart/' + idcart, {
              updateCond: cond,
              customerEmail: this.usersEmail
            },
            {
              headers:{
                "Authorization": `Bearer ${this.usersToken}`,
            }
            })
            .then(res => {
              // console.log(res.data);
              if(res.data == "false"){
                console.log("Too many request");
              }
              else{
                this.showCartItems(res.data);
              }
            })
            .catch(err => console.error(err));
          }
        }
        else{
          console.log("something wrong");
        }
        
      },
      checkoutButtonChecker(){
        if(!((this.totPrice == 0) || (this.usersTag == "Unverified"))){
          this.checkoutButton = false;
        }
        else{
          this.checkoutButton = true;
      }
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      }
    },

    beforeMount() {
      this.getCartItems();
      //console.log("before mount");
    }
  }
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