<template>
  <div> 
    <transaction-online v-if="true"></transaction-online>
    <transaction-physical v-else></transaction-physical>
  </div>
</template>

<script>
  import TransactionOnline from './Transactions/TransactionsOnline.vue'
  import TransactionPhysical from './Transactions/TransactionsPhysical.vue'
  
  export default {
    components: {
      "transaction-online": TransactionOnline,
      "transaction-physical": TransactionPhysical,
    }
  }
</script>