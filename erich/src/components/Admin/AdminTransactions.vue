<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col>
          <div>
            <v-btn
              @click="transComponents('ol')"
            >
              <p>Online</p>
            </v-btn>
            <v-btn
              @click="transComponents('ph')"
            >
              <p>Physical</p>
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