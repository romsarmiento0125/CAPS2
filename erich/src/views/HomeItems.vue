<template>
  <div
    style="background-color:#FFFFFF"
  >
    <home-header v-if="headerCond"></home-header>
    <home-header-acc v-else></home-header-acc>
    <home-carousel></home-carousel>
    <home-categories></home-categories>
    <categories-item></categories-item>
    <home-footer></home-footer>
  </div>
</template>

<script>
  import HomeHeader from '../components/Home/HomeHeaderVisitor.vue'
  import HomeCarousel from '../components/Home/HomeCarousel.vue'
  import HomeCategories from '../components/Home/HomeCategories.vue'
  import Footer from '../components/Footer.vue'
  import HomeHeaderAcc from '../components/Home/HomeHeaderAccount.vue'

  import CategoriesItem from '../components/HomeItems/CategoriesItem.vue'

  export default{
    name: 'Home',

    data: () => ({
      promodeals: true,
      categoriesItem: false,
      headerCond: true,
    }),

    components: {
      'home-header': HomeHeader,
      'home-carousel': HomeCarousel,
      'home-categories': HomeCategories,
      'categories-item': CategoriesItem,
      'home-footer': Footer,
      'home-header-acc': HomeHeaderAcc,
    },

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      }
    },

    methods: {
      navbarPicker() {
        console.log("navbar picker");
        console.log(this.customerInfos.Tag);
        if(this.customerInfos.Tag == "Customer" || this.customerInfos.Tag == "Admin"|| this.customerInfos.Tag == "Cashier"|| this.customerInfos.Tag == "Encoder"){
          this.headerCond = false;
          console.log("headerCond false");
        }
      },
    },

    beforeMount() {
      this.navbarPicker();
    },

  }
</script>
