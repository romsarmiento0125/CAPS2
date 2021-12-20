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

  export default {
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
    }),

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      },
      categoryItems() {
        return this.$store.state.categoryItems;
      },
    },

    methods: {
      navbarPicker() {
        //console.log("navbar picker");
        //console.log(this.customerInfos.Tag);
        if(this.customerInfos.Tag == "Customer" || this.customerInfos.Tag == "Admin" || this.customerInfos.Tag == "Encoder"){
          this.headerCond = false;
          //console.log("headerCond false");
        }
        else if(this.customerInfos.Tag == "Ocashier"){
          this.$router.push("/onlinecashier")
        }
        else if(this.customerInfos.Tag == "Pcashier"){
          this.$router.push("/physicalcashier")
        }
      },
      getUserOrder() {
        axios.post('http://127.0.0.1:8000/api/userorder/store', {
            register: this.customerInfos.Email
          })
          .then(res => {
            this.$store.commit('storeUserProfileOrders', res.data);
            this.getUserOrderItems(res.data)
          })
          //.then(res => console.log(res.data))
          .catch(err => console.error(err));
        
      },
      getUserOrderItems(data) {
        //console.log("Get user order items");
        //console.log(data);
        //console.log(data.length);
        var items = [];
        for(var i = 0; i < data.length; i++){
          axios.post('http://127.0.0.1:8000/api/userorderitems/store', {
            register: data[i].InvoiceNumber
          })
          .then(res => {
            for(var j = 0; j < res.data.length; j++){
              items.push(res.data[j]);
            }
          })
          .catch(err => console.error(err));
        }
        //console.log(items);
        this.$store.commit('storeUserProfileOrderItems', items);
      }
    },

    beforeMount() {
      this.navbarPicker();
      this.getUserOrder();
    },
  }
</script>
