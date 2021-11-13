<template>
  <div
    style="background-color:#FFFFFF"
  >
    <home-header></home-header>
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

  import CategoriesItem from '../components/Home Items/CategoriesItem.vue'

  export default{
    name: 'Home',

    data: () => ({
      promodeals: true,
      categoriesItem: false,
    }),

    components: {
      'home-header': HomeHeader,
      'home-carousel': HomeCarousel,
      'home-categories': HomeCategories,
      'categories-item': CategoriesItem,
      'home-footer': Footer,
    },

    methods: {
      toCategories(cond) {
        if(cond == "pd"){
          this.promodeals = false;
          this.categoriesItem = true;
        }
      }
    }

  }
</script>
