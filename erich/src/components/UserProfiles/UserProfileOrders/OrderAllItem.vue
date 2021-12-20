<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col>
          <div
            class="my-2"
            v-for="order in orders"
            :key="order.id"
          >
            <v-divider></v-divider>
            <v-row>
              <v-col>
                <p>{{order.Status}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <p>Invoice &nbsp; #: &nbsp; {{order.InvoiceNumber}}</p>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <div
                  v-for="item in items"
                  :key="item.id"
                >
                  <div
                    v-if="order.InvoiceNumber == item.InvoiceNumber"
                    class="d-flex"
                  >
                    <div>
                      <v-img
                        :src="require('../../../assets/itemPhotos/'+item.ItemImage)"
                        contain
                        max-width="100px"
                        max-height="100px"
                      ></v-img>
                    </div>
                    <div>
                      <p>{{item.ItemName}}</p>
                      <p>{{item.ItemDesc}}</p>
                      <p>{{item.Quantity}}</p>
                    </div>
                    <v-spacer></v-spacer>
                    <div>
                       <p>{{item.Quantity * item.RetailPrice}}</p>
                    </div>
                  </div>
                  
                </div>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                {{order.Total}}
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
  export default {
    data: () => ({
       orders: [],
       items: [],
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
      this.items = this.userProfileOrderItems;
    }
    
  }
</script>