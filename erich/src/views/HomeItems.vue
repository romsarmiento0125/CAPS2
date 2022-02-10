<template>
  <div style="background-color: #ffffff">
    <v-navigation-drawer
      v-model="drawer"
      absolute
      temporary
    >
      <div
        class="ma-2"
      >
        <p
          class="title"
        >
          Categories
        </p>
        <v-treeview
          v-model="pickCategory"
          :items="items"
          selection-type="independent"
          selectable
          return-object
          dense
        ></v-treeview>
      </div>
     
    </v-navigation-drawer>

    <div
      class="d-none d-sm-block"
    >
      <home-header v-if="headerCond"></home-header>
      <home-header-acc v-else></home-header-acc>
    </div>

    <div
      class="d-sm-none"
    >
      <home-header-mobile v-if="headerCond"></home-header-mobile>
      <home-account-mobile v-else></home-account-mobile>
    </div>

    <!-- <home-header v-if="headerCond"></home-header>
    <home-header-acc v-else></home-header-acc> -->
    <home-carousel></home-carousel>

    <div
    class="d-none d-md-block"
    >
      <v-row
        class="mt-10"
      >
        <v-col
          cols="2"
        >
          <v-treeview
            v-model="pickCategory"
            :items="items"
            selection-type="independent"
            selectable
            return-object
            dense
          ></v-treeview>
        </v-col>
        <v-col
          cols="10"
        >
          <categories-item :categ="userCat"></categories-item>
        </v-col>
      </v-row>
    </div>

    <div class="d-md-none">
      
      <v-row
        class="mt-10"
      >
        
        <!-- <v-col
          offset-xl="1"
          cols="2"
        >
          <v-treeview
            v-model="pickCategory"
            :items="items"
            selection-type="independent"
            selectable
            return-object
            dense
          ></v-treeview>
        </v-col> -->
        <v-col>
          <div
            class="mx-3"
          >
            <v-btn
              @click="drawer = true"
            >
              <v-icon>
                mdi-menu
              </v-icon>
            </v-btn>
          </div>
          <categories-item :categ="userCat"></categories-item>
        </v-col>
      </v-row>
    </div>
    
    <home-footer></home-footer>

    
  </div>
</template>

<script>
  import HomeHeader from "../components/Home/HomeHeaderVisitor.vue";
  import HomeCarousel from "../components/Home/HomeCarousel.vue";
  import Footer from "../components/Footer.vue";
  import HomeHeaderAcc from "../components/Home/HomeHeaderAccount.vue";
  import CategoriesItem from "../components/HomeItems/CategoriesItem.vue";
  import HomeHeaderMobile from "../components/Home/HomeHeaderMobile.vue";
  import HomeAccountMobile from "../components/Home/HomeAccountMobile.vue"


  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: "Home",

    components: {
      "home-header": HomeHeader,
      "home-carousel": HomeCarousel,
      "home-footer": Footer,
      "home-header-acc": HomeHeaderAcc,
      "categories-item": CategoriesItem,
      "home-header-mobile": HomeHeaderMobile,
      "home-account-mobile": HomeAccountMobile,
    },

    data: () => ({
      drawer: false,
      group: null,
      promodeals: true,
      categoriesItem: false,
      headerCond: true,
      usersData: {
        usersEmail: "",
        usersPassword: "",
      },
      items: [
        {
          id: 1,
          name: 'Baking',
          children: [
            { id: 2, name: 'Pasta' },
            { id: 3, name: 'Cereals' },
            { id: 4, name: 'Sugar' },
            { id: 5, name: 'Mixes' },
          ],
        },
        {
          id: 6,
          name: 'Beverage',
          children: [
            { id: 7, name: 'Cofee-Tea' },
            { id: 8, name: 'Carbonated Drinks' },
            { id: 9, name: 'Juice' },
            { id: 10, name: 'Milk' },
            { id: 11, name: 'Chocalate' },
            { id: 12, name: 'Energy Drinks' },
          ],
        },
        {
          id: 13,
          name: 'Bread-Bakery',
          children: [
            { id: 14, name: 'Sandwich' },
            { id: 15, name: 'Pastries' },
            { id: 16, name: 'Cakes' },
            { id: 17, name: 'Biscuit' },
          ],
        },
        {
          id: 18,
          name: 'Canned Goods',
          children: [
            { id: 19, name: 'Fish' },
            { id: 20, name: 'Meat' },
            { id: 21, name: 'Beef' },
            { id: 22, name: 'Vegetables' },
          ],
        },
        {
          id: 23,
          name: 'Condiments',
          children: [
            { id: 24, name: 'Sauce' },
            { id: 25, name: 'Paste' },
          ],
        },
        {
          id: 26,
          name: 'Dairy',
          children: [
            { id: 27, name: 'Cheese' },
            { id: 28, name: 'Butter' },
            { id: 29, name: 'Margarine' },
            { id: 30, name: 'Milk' },
            { id: 31, name: 'Cream' },
          ],
        },
        {
          id: 32,
          name: 'Frozen Foods',
          children: [
            { id: 33, name: 'Hotdog' },
            { id: 34, name: 'Nuggets' },
            { id: 35, name: 'Ham' },
          ],
        },
        {
          id: 36,
          name: 'Laundry',
          children: [
            { id: 37, name: 'Fabric Softener' },
            { id: 38, name: 'Liquid Detergent' },
            { id: 39, name: 'Powder Detergent' },
            { id: 40, name: 'Dishwashing Liquid' },
          ],
        },
        {
          id: 41,
          name: 'Noodles',
          children: [
            { id: 42, name: 'Cup Noodles' },
            { id: 43, name: 'Pancit Canton' },
            { id: 44, name: 'Instant noodles' },
          ],
        },
        {
          id: 45,
          name: 'Personal Care',
          children: [
            { id: 46, name: 'Shampoo' },
            { id: 47, name: 'Soap' },
            { id: 48, name: 'Toothpaste' },
          ],
        },
        {
          id: 49,
          name: 'Snacks',
          children: [
            { id: 50, name: 'Chips' },
            { id: 51, name: 'Crackers' },
            { id: 52, name: 'Nuts' },
            { id: 53, name: 'Pretzels' },
            { id: 54, name: 'Biscuits' },
            { id: 55, name: 'Popcorn' },
          ],
        },
        {
          id: 56,
          name: 'Sweets',
          children: [
            { id: 57, name: 'Candy' },
            { id: 58, name: 'Candy Bar' },
          ],
        }, 
      ],
      pickCategory: [],
      userCat: [],
    }),

    computed: {
      categoryItems() {
        return this.$store.state.categoryItems;
      },
      customerCredentials() {
        return this.$store.state.customerCredentials;
      },
      usersTag(){
        return this.$store.state.userTag;
      },
      categoryPick() {
        return this.$store.state.categoryPick;
      },
    },

    watch:{
      usersTag(){
        this.navbarPicker();
      },
      pickCategory(){
        this.categoryPicker();
      },
      group () {
        this.drawer = false
      },
    },

    methods: {
      categoryPicker(){
        this.userCat = [];

        this.pickCategory.forEach(res => {
          // console.log(res.name);
          if(res.name == "Baking"){
            this.userCat.push("Pasta");
            this.userCat.push("Cereals");
            this.userCat.push("Sugar");
            this.userCat.push("Mixes");
          }
          else if(res.name == "Beverage"){
            this.userCat.push("Cofee-Tea");
            this.userCat.push("Carbonated Drinks");
            this.userCat.push("Juice");
            this.userCat.push("Milk");
            this.userCat.push("Chocalate");
            this.userCat.push("Energy Drinks");
          }
          else if(res.name == "Bread-Bakery"){
            this.userCat.push("Sandwich");
            this.userCat.push("Pastries");
            this.userCat.push("Cakes");
            this.userCat.push("Biscuit");
          }
          else if(res.name == "Canned Goods"){
            this.userCat.push("Fish");
            this.userCat.push("Meat");
            this.userCat.push("Beef");
            this.userCat.push("Vegetables");
          }
          else if(res.name == "Condiments"){
            this.userCat.push("Sauce");
            this.userCat.push("Paste");
          }
          else if(res.name == "Dairy"){
            this.userCat.push("Cheese");
            this.userCat.push("Butter");
            this.userCat.push("Margarine");
            this.userCat.push("Milk");
            this.userCat.push("Cream");
          }
          else if(res.name == "Frozen Foods"){
            this.userCat.push("Hotdog");
            this.userCat.push("Nuggets");
            this.userCat.push("Ham");
          }
          else if(res.name == "Laundry"){
            this.userCat.push("Fabric Softener");
            this.userCat.push("Liquid Detergent");
            this.userCat.push("Powder Detergent");
            this.userCat.push("Dishwashing Liquid");
          }
          else if(res.name == "Noodles"){
            this.userCat.push("Cup Noodles");
            this.userCat.push("Pancit Canton");
            this.userCat.push("Instant noodles");
          }
          else if(res.name == "Personal Care"){
            this.userCat.push("Shampoo");
            this.userCat.push("Soap");
            this.userCat.push("Toothpaste");
          }
          else if(res.name == "Snacks"){
            this.userCat.push("Chips");
            this.userCat.push("Crackers");
            this.userCat.push("Nuts");
            this.userCat.push("Pretzels");
            this.userCat.push("Biscuits");
            this.userCat.push("Popcorn");
          }
          else if(res.name == "Sweets"){
            this.userCat.push("Candy");
            this.userCat.push("Candy Bar");
          }
          else{
            this.userCat.push(res.name);
          }  
        });

        var uniqueArray = [];

        uniqueArray = this.userCat.filter((item, pos) => {
            return this.userCat.indexOf(item) == pos;
        })

        // console.log(uniqueArray);
        this.userCat = uniqueArray;
      },
      navbarPicker() {
        if(this.usersTag == "Customer" || this.usersTag == "Unverified" || this.usersTag == "Admin" || this.usersTag == "Encoder"){
          this.headerCond = false;
        }
        else if(this.usersTag == "Ocashier"){
          this.$router.push("/onlinecashier")
        }
        else if(this.usersTag == "Pcashier"){
          this.$router.push("/physicalcashier")
        }
      },
      assignPickCat(){
        if(this.categoryPick == "Baking"){
          this.pickCategory = [
            {
              id: 1,
              name: 'Baking',
              children: [
                { id: 2, name: 'Pasta' },
                { id: 3, name: 'Cereals' },
                { id: 4, name: 'Sugar' },
                { id: 5, name: 'Mixes' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Beverage"){
          this.pickCategory = [
            {
              id: 6,
              name: 'Beverage',
              children: [
                { id: 7, name: 'Cofee-Tea' },
                { id: 8, name: 'Carbonated Drinks' },
                { id: 9, name: 'Juice' },
                { id: 10, name: 'Milk' },
                { id: 11, name: 'Chocalate' },
                { id: 12, name: 'Energy Drinks' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Bread-Bakery"){
          this.pickCategory = [
            {
              id: 13,
              name: 'Bread-Bakery',
              children: [
                { id: 14, name: 'Sandwich' },
                { id: 15, name: 'Pastries' },
                { id: 16, name: 'Cakes' },
                { id: 17, name: 'Biscuit' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Canned Goods"){
          this.pickCategory = [
            {
              id: 18,
              name: 'Canned Goods',
              children: [
                { id: 19, name: 'Fish' },
                { id: 20, name: 'Meat' },
                { id: 21, name: 'Beef' },
                { id: 22, name: 'Vegetables' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Condiments"){
          this.pickCategory = [
            {
              id: 23,
              name: 'Condiments',
              children: [
                { id: 24, name: 'Sauce' },
                { id: 25, name: 'Paste' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Dairy"){
          this.pickCategory = [
            {
              id: 26,
              name: 'Dairy',
              children: [
                { id: 27, name: 'Cheese' },
                { id: 28, name: 'Butter' },
                { id: 29, name: 'Margarine' },
                { id: 30, name: 'Milk' },
                { id: 31, name: 'Cream' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Frozen Foods"){
          this.pickCategory = [
            {
              id: 32,
              name: 'Frozen Foods',
              children: [
                { id: 33, name: 'Hotdog' },
                { id: 34, name: 'Nuggets' },
                { id: 35, name: 'Ham' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Laundry"){
          this.pickCategory = [
            {
              id: 36,
              name: 'Laundry',
              children: [
                { id: 37, name: 'Fabric Softener' },
                { id: 38, name: 'Liquid Detergent' },
                { id: 39, name: 'Powder Detergent' },
                { id: 40, name: 'Dishwashing Liquid' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Noodles"){
          this.pickCategory = [
            {
              id: 41,
              name: 'Noodles',
              children: [
                { id: 42, name: 'Cup Noodles' },
                { id: 43, name: 'Pancit Canton' },
                { id: 44, name: 'Instant noodles' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Personal Care"){
          this.pickCategory = [
            {
              id: 45,
              name: 'Personal Care',
              children: [
                { id: 46, name: 'Shampoo' },
                { id: 47, name: 'Soap' },
                { id: 48, name: 'Toothpaste' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Snacks"){
          this.pickCategory = [
            {
              id: 49,
              name: 'Snacks',
              children: [
                { id: 50, name: 'Chips' },
                { id: 51, name: 'Crackers' },
                { id: 52, name: 'Nuts' },
                { id: 53, name: 'Pretzels' },
                { id: 54, name: 'Biscuits' },
                { id: 55, name: 'Popcorn' },
              ],
            }
          ];
        }
        else if(this.categoryPick == "Sweets"){
          this.pickCategory = [
            {
              id: 56,
              name: 'Sweets',
              children: [
                { id: 57, name: 'Candy' },
                { id: 58, name: 'Candy Bar' },
              ],
            }
          ];
        }
      }
    },
    beforeMount() {
      this.navbarPicker();
      this.assignPickCat();
    },
  }
</script>
