<template>
  <div v-if="usersTag == 'Pcashier' || usersTag == 'Admin'"
    style="background-color: #FFFFFF"  
  >
    <pc-header></pc-header>
    <pc-body></pc-body>
  </div>
</template>

<script>
  import PCHeader from '../components/PhysicalCashier/PCHeader.vue'
  import PCBody from '../components/PhysicalCashier/PCBody.vue'  
  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: "PhysicalCashier",

    components: {
      "pc-header": PCHeader,
      "pc-body": PCBody,
    },

    data: () => ({
    }),

    computed: {
      usersTag(){
        return this.$store.state.userTag;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {

    },

    watch: {

    },

    beforeMount(){

    }
  }
</script>
