<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div class="pl-3">
            <v-btn
              class="px-10"
              dark
              color="#1106A0"
              @click="transComponents('ol')"
            >
            Online
            </v-btn>
            <v-btn
              class="ml-3 px-7"
              dark
              color="#FFA600"
              @click="transComponents('ph')"
            > Physical
            </v-btn>
          </div>
          <div>
            <transaction-online v-if="transOnline"></transaction-online>
            <transaction-physical v-else-if="transOffline"></transaction-physical>
          </div>
        </v-col>
      </v-row>
    </v-container>
    
  </div>
</template>

<script>
  import TransactionOnline from './Transactions/TransactionsOnline.vue'
  import TransactionPhysical from './Transactions/TransactionsPhysical.vue'
  
  export default {
    data: () => ({
      transOnline: true,
      transOffline: false,
    }),

    components: {
      "transaction-online": TransactionOnline,
      "transaction-physical": TransactionPhysical,
    },

    methods: {
      transComponents(cond) {
        if(cond == 'ol') {
          this.transOnline = true;
          this.transOffline = false;
        }
        else if(cond == "ph") {
          this.transOnline = false;
          this.transOffline = true;
        }
      }
    }
  }
</script>