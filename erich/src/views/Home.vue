<template>
  <div style="background-color: #ffffff">
    <home-header v-if="headerCond"></home-header>
    <home-header-acc v-else></home-header-acc>
    <home-carousel></home-carousel>
    <home-categories></home-categories>
    <home-categories-item></home-categories-item>
    <!-- <home-promodeals></home-promodeals> -->
    <home-footer></home-footer>
  </div>
</template>

<script>
  import HomeHeader from "../components/Home/HomeHeaderVisitor.vue";
  import HomeCarousel from "../components/Home/HomeCarousel.vue";
  import HomeCategories from "../components/Home/HomeCategories.vue";
  import HomePromoDeals from "../components/Home/HomePromoDeals.vue";
  import Footer from "../components/Footer.vue";
  import HomeHeaderAcc from "../components/Home/HomeHeaderAccount.vue";

  import HomeCategoriesItem from '../components/HomeItems/HomeCategoriesItem.vue'

  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: "Home",

    components: {
      "home-header": HomeHeader,
      "home-carousel": HomeCarousel,
      "home-categories": HomeCategories,
      "home-promodeals": HomePromoDeals,
      "home-footer": Footer,
      "home-header-acc": HomeHeaderAcc,
      'home-categories-item': HomeCategoriesItem,
    },

    data: () => ({
      promodeals: true,
      categoriesItem: false,
      headerCond: true,
      usersData: {
        usersEmail: "",
        usersPassword: "",
      }
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
      }
    },

    watch:{
      usersTag(){
        this.navbarPicker();
      }
    },

    methods: {
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
    },
    beforeMount() {
      this.navbarPicker();
    },
  }
</script>
