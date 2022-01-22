<template>
  <div class="aboutBg">
    <about-header></about-header>
    <about-refund v-if="aboutCond == 'ref'"></about-refund>
    <about-shipping v-if="aboutCond == 'ship'"></about-shipping>
    <about-privacy v-if="aboutCond == 'priv'"></about-privacy>
    <about-terms v-if="aboutCond == 'term'"></about-terms>
    <about-frequent v-if="aboutCond == 'faq'"></about-frequent>
    <about-aucu v-if="aboutCond == 'aucu'"></about-aucu>
    <about-footer></about-footer>
    
    
  </div>
</template>

<script>
  import Footer from '../components/Footer.vue'
  import RefundPolicy from '../components/About/RefundPolicy.vue'
  import ShippingPolicy from '../components/About/ShipPolicy.vue'
  import PrivacyPolicy from '../components/About/PrivacyPolicy.vue'
  import TermOfService from '../components/About/TOS.vue'
  import FrequentlyQuestion from '../components/About/FAQ.vue'
  import AbouUsContactUs from '../components/About/AboutUsContancUs.vue'
  import HeaderAbout from '../components/About/HeaderAbout.vue'

  export default {
    name: "About",

    components: {
      "about-refund": RefundPolicy,
      "about-shipping": ShippingPolicy,
      "about-privacy": PrivacyPolicy,
      "about-terms": TermOfService,
      "about-frequent": FrequentlyQuestion,
      "about-aucu": AbouUsContactUs,
      "about-header": HeaderAbout,
      "about-footer": Footer,
    },

    computed: {
      aboutCond(){
        return this.$store.state.aboutCond;
      }
    },
  }
</script>

<style scoped>
.aboutBg{
  background-color: #fff;
}
</style>