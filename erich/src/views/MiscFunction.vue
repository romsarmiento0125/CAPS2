<template>
  <div>
    <mf-header></mf-header>
    <mf-verify></mf-verify>
  </div>
</template>

<script>
  import MiscFunctionsHeader from '../components/MFunctions/MuscFunctionsHeader.vue'
  import MiscFunctionsVerifyAccount from '../components/MFunctions/MFVerifyAccount.vue'
  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: 'MiscFunctions',

    data: () => ({
    }),

    components: {
      "mf-header": MiscFunctionsHeader,
      "mf-verify": MiscFunctionsVerifyAccount,
    },

    methods: {
      
    }
  }
</script>