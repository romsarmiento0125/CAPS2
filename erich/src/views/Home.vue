<template>
  <div>
    <home-header></home-header>
    <home-carousel></home-carousel>
    <home-categories></home-categories>
    <home-promodeals></home-promodeals>
    <home-footer></home-footer>
  </div>
</template>

<script>
  import HomeHeader from '../components/Home/HomeHeader.vue'
  import HomeCarousel from '../components/Home/HomeCarousel.vue'
  import HomeCategories from '../components/Home/HomeCategories.vue'
  import HomePromoDeals from '../components/Home/HomePromoDeals.vue'
  import Footer from '../components/Footer.vue'

  export default{
    name: 'Home',

  components: {
    'home-header': HomeHeader,
    'home-carousel': HomeCarousel,
    'home-categories': HomeCategories,
    'home-promodeals': HomePromoDeals,
    'home-footer': Footer,
  }

  }
</script>
