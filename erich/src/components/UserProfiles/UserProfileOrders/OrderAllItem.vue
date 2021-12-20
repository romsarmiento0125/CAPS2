<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col
          offset=""
          cols=""
          class=""
        >
          <v-list>
            <v-list-item-group
            >
              <v-list-item
                v-for="order in orders"
                :key="order.id"
              >
                <v-list-item-content
                  class="border ma-2 rounded-lg"
                >
                  <v-row
                  >
                    <v-col
                      cols=""
                    >
                      <div
                        class="d-flex align-center"
                      >
                        <v-list-item-title>
                          <div
                            class="d-flex"
                          >
                            <div
                              class="ma-5 pa-5"
                            >
                              <span>{{order.InvoiceNumber}}</span>
                            </div>
                            <div
                              class="ma-5 pa-5"
                            >
                              <span>{{order.Total}}</span>
                            </div>
                          </div>
                        </v-list-item-title>
                      </div>
                    </v-col>
                  </v-row>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
       orders: [],
    }),

    computed: {
      userProfileOrders() {
        return this.$store.state.userProfileOrders;
      },
      userProfileOrderItems() {
        return this.$store.state.userProfileOrderItems;
      }
    },

   

    methods: {
      
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
    },

    beforeMount(){
      console.log("All items");
      console.log(this.userProfileOrders);
      console.log(this.userProfileOrderItems);
      this.orders = this.userProfileOrders;
    }
    
  }
</script>