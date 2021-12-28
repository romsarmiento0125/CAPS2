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
              v-for="item in items"
              :key="item.id"
              cols="6"
              sm="4"
              md="3"
              lg="3"
              xl="2"
            >
              <v-card
                width="275px"
                class="ma-2"
              >
                <v-card-text
                  class="pb-0"
                >
                  <p
                    class="ma-0"
                    v-if="item.Discount != 0"
                  >{{item.Discount}}</p>
                </v-card-text>

                <v-img
                  :src="require('../../assets/itemPhotos/'+item.Image)"
                  contain
                  max-height="200px"
                ></v-img>

                <v-card-title>
                  {{item.RetailPrice}}
                </v-card-title>

                <v-card-subtitle>
                  <span class="text-decoration-line-through">{{(item.SupplierPrice * 1) + (item.SupplierPrice * .05)}}</span>
                  <br>
                  <span>{{item.Name}}</span>
                  <br>
                  <span>{{item.Description}}</span>
                  <br>
                  <span>{{item.Quantity}}</span>
                </v-card-subtitle>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    icon
                    @click="addToCartItems(item.ItemCode)"
                  >
                    <v-icon>
                      mdi-cart-outline
                    </v-icon>
                  </v-btn>
                </v-card-actions>
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
      // items: [
      //   {id: 1, Name: "Mini Oreo", Description: "Chocolate Flavored Cream", Price: 41.10, Size: "67 Grams", Quantity: 99,
      //     ItemCode:"7622300761363", Category: "Biscuits", ExpirationDate: "01\/24\/2024", Image:"SamplePhoto.png", Discount: 10, Weigth: 0.1000},
      // ],
      items: null,
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
      }
    },

    // watch: {
    //   cartItems: function(data){
    //     console.log("watch",data);
    //   }
    // }, 

    // mounted(){
    //   setTimeout(() => {
    //     this.$store.state.cartItems = {cart: 0};
    //   }, 3000);
    // },

    // How Process Works. Ang i ssave mo lang sa cart ay yung email, itemcode at quantity.
    // Then if existing nayung item i update lang yung quantity.
    methods: {
      addToCartItems(code) {
        console.log("add to cart");
        this.cartItems.Email = this.customerInfos.Email;
        this.cartItems.ItemCode = code;

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
        console.log("Get Items");
        axios.get('http://127.0.0.1:8000/api/categoryitem')
        .then(res => this.storeCategoryItems(res.data))
        .catch(err => console.error(err));
      },
      storeCategoryItems(data) {
        console.log("This is items data: ");
        console.log(data);
        this.$store.commit('storeCategoryItem', data);
        this.showItems();
      },
      showItems() {
        console.log("showItems: ");
        console.log(this.categoryItems);
        this.items = this.categoryItems;
      },
      
    },

    beforeMount() {
      this.getCategoryItems();
      //this.items = this.categoryItems();
      alert('Categories Item');
      this.showItems();
    },
  }
</script>

