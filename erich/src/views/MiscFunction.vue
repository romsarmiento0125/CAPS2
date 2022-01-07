<template>
  <div>
    <mf-header></mf-header>
    <mf-verify v-if="notifCond == 'verify'"></mf-verify>
    <mf-forgotpass v-else-if="notifCond == 'forgotPass'"></mf-forgotpass>
  </div>
</template>

<script>
  import MiscFunctionsHeader from '../components/MFunctions/MuscFunctionsHeader.vue'
  import MiscFunctionsVerifyAccount from '../components/MFunctions/MFVerifyAccount.vue'
  import MiscFunctionsForgotPass from '../components/MFunctions/MFForgotPass.vue'
  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: 'MiscFunctions',

    components: {
      "mf-header": MiscFunctionsHeader,
      "mf-verify": MiscFunctionsVerifyAccount,
      "mf-forgotpass": MiscFunctionsForgotPass,
    },

    data: () => ({
      
    }),

    computed: {
      notifCond(){
        return this.$store.state.notifCond;
      }
    },

    methods: {
      
    }
  }
</script>