<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col>
          <div
            class="my-2 mx-4"
            v-for="order in userProfileToDeliver"
            :key="order.id"
          >
            <v-divider></v-divider>
            <v-row>
              <v-col>
                <p
                  class="mb-0 mt-6 title"
                >Status: &nbsp;{{order.Status}}</p>
                <p
                  class="my-0 Caption"
                >Deliver</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p
                  class="my-0 subtitle-1"
                >Invoice &nbsp; #: &nbsp; {{order.InvoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <orderdeliveritems :orders="order.orders"></orderdeliveritems>
              </v-col>
            </v-row>
            <v-row>
              <v-col
                class="d-flex"
              >
                <v-spacer></v-spacer>
                <p
                  class="title mx-5"
                >
                  Total: &nbsp;{{priceRound(order.Total)}}
                </p>
                
              </v-col>
            </v-row>
            <v-divider></v-divider>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import ODI from './OrderDeliverItem.vue'

  export default {
    components: {
      "orderdeliveritems": ODI,
    },

    data: () => ({
       orders: [],
       items: [],
    }),

    computed: {
      userProfileToDeliver() {
        return this.$store.state.userProfileToDeliver;
      },
    },

   

    methods: {
      
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
    },

    beforeMount(){
    }
    
  }
</script>