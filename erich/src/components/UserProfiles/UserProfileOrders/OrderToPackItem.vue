<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col>
          <div
            class="my-sm-2 mx-sm-4"
            v-for="order in userProfileOrders"
            :key="order.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{order.status}}</h4>
              </v-col>
              <v-col cols="9" class="d-flex justify-end ">
                <h4
                  class="fontBlue"
                >Delivery</h4>
              </v-col>
            </v-row>
            
            <v-row class="mx-2 mt-n5">
              <v-col>
                <h5
                  class="my-0 fontDesc font-weight-regular"
                >Invoice &nbsp; #: &nbsp; {{order.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-sm-2">
              <v-col>
                <orderdeliveritems :orders="order.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                xl="1"
                lg="2"
                md="3"
                sm="3"
                cols="6"
              >
                <v-btn
                  v-if="order.status == 'Pending'"
                  color="#1106A0"
                  dark
                  outlined
                  @click="openDeliveryDialog(order)"
                >
                  <p
                    class="my-0"
                  >
                    Cancel
                  </p>
                </v-btn>
              </v-col>
              <v-col
                offset-xl="7"
                offset-lg="6"
                offset-md="3"
                offset-sm="3"
                xl="2"
                lg="2"
                md="3"
                sm="3"
                cols="6"
                class="mb-sm-0 mb-5"
              >
                
                <h4
                  class="mb-sm-10 pl-sm-16"
                >
                  Order total: 
                </h4>
                <div class="d-flex d-sm-none">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(order.total)}}
                  </h4>
                </div>
              </v-col>

              <v-col
                xl="1"
                lg="1"
                md="2"
                sm="2"
                cols="5"
                class="mr-5 d-none d-sm-block"
              >
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(order.total)}}
                  </h4>
                </div>
              </v-col>
            </v-row>
            <v-divider></v-divider>
          </div>

          <div
            class="my-sm-2 mx-sm-4"
            v-for="order in userPickupOrders"
            :key="order.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{order.status}}</h4>
              </v-col>
               <v-col cols="9" class="d-flex justify-end ">
                <h4
                  class="fontBlue"
                >Pickup</h4>
              </v-col>
            </v-row>

            <v-row class="mx-2 mt-n5">
              <v-col>
                <h5
                  class="my-0 fontDesc font-weight-regular"
                >Invoice &nbsp; #: &nbsp; {{order.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-sm-2">
              <v-col>
                <orderdeliveritems :orders="order.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                xl="1"
                lg="2"
                md="3"
                sm="3"
                cols="6"
              >
                <v-btn
                  v-if="order.status == 'Pending'"
                  color="#1106A0"
                  dark
                  outlined
                  @click="openPickupDialog(order)"
                >
                  <p
                    class="my-0"
                  >
                    Cancel
                  </p>
                </v-btn>
              </v-col>
              <v-col
                offset-xl="7"
                offset-lg="6"
                offset-md="3"
                offset-sm="3"
                xl="2"
                lg="2"
                md="3"
                sm="3"
                cols="6"
                class="mb-sm-0 mb-5"
              >
                
                <h4
                  class="mb-sm-10 pl-sm-16"
                >
                  Order total:
                </h4>
                <div class="d-flex d-sm-none">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(order.total)}}
                  </h4>
                </div>
              </v-col>

              <v-col
                xl="1"
                lg="1"
                md="2"
                sm="2"
                cols="5"
                class="mr-5 d-none d-sm-block"
              >
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                     &nbsp;{{priceRound(order.total)}}
                  </h4>
                </div>
                
              </v-col>
            </v-row>
            <v-divider></v-divider>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <v-dialog
      v-model="deliveryDialog"
      persistent
      max-width="400"
    >
      <v-card>
        <v-card-title>
          <h5 class="fontTitle mx-1"> Can you please tell us the reason why you want to cancel your order? </h5>
          
        </v-card-title>
        <v-card-text
          class="mb-0 pb-0"
        >
          <v-textarea
            outlined
            v-model="customerCancelReason"
            label="Leave your comment here..."
          ></v-textarea>
        </v-card-text>
        <v-card-actions class="mr-2">
          <v-spacer></v-spacer>
          <v-btn
            color="#1106A0"
            outlined
            class="px-10"
            @click="deliveryDialog = false"
          >
            No
          </v-btn>
          <v-btn
            color="#1106A0"
            dark
            class="px-10"
            @click="cancelDeliveryItem()"
          >
            Yes
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="pickupDialog"
      persistent
      max-width="400"
    >
      <v-card>
        <v-card-title>
          <h5 class="fontTitle mx-1"> Can you please tell us the reason why you want to cancel your order? </h5>
        </v-card-title>
        <v-card-text
          class="mb-0 pb-0"
        >
          <v-textarea
            label="Leave your comment here..."
            outlined
            v-model="customerCancelReason"
          ></v-textarea>
        </v-card-text>
        <v-card-actions class="mr-2">
          <v-spacer></v-spacer>
          <v-btn
            color="#1106A0"
            outlined
            class="px-10"
            @click="pickupDialog = false"
          >
            No
          </v-btn>
          <v-btn
            color="#1106A0"
            dark
            class="px-10"
            @click="cancelPickupItem()"
          >
            Yes
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  import ODI from './OrderDeliverItem.vue'
  import {Mixins} from '../../../Mixins/mixins.js'

  export default {
    mixins: [Mixins],

    components: {
      "orderdeliveritems": ODI,
    },

    data: () => ({
       orders: [],
       items: [],
       deliveryDialog: false,
       pickupDialog: false,
       customerCancelReason: "",
       toCancelOrder: [],
    }),

    computed: {
      userProfileOrders() {
        return this.$store.state.userProfileOrders;
      },
      userPickupOrders() {
        return this.$store.state.userPickupOrders;
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {
      openPickupDialog(data){
        this.toCancelOrder = data;
        this.pickupDialog = true;
      },
      cancelPickupItem(){
        this.pickupDialog= false;
        // console.log(this.customerCancelReason);
        // console.log(this.toCancelOrder);
        axios.post(this.getDomain()+'api/customerpdelete', {
          register: this.toCancelOrder,
          userid: this.toCancelOrder.id,
          cancelReason: this.customerCancelReason
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          // console.log(res.data);
          if(res.data.status){
            this.$store.commit('storeUserPickupOrders', res.data.data);
            this.$store.commit('storeUserPickupToCancel', res.data.delete);
          }
          else{
            alert(res.data.data);
          }
        })
        .catch(err => console.error(err));
      },
      openDeliveryDialog(data){
        this.toCancelOrder = data;
        this.deliveryDialog = true;
      },
      cancelDeliveryItem(){
        this.deliveryDialog= false;
        // console.log(this.customerCancelReason);
        // console.log(this.toCancelOrder);
        axios.post(this.getDomain()+'api/customerdelete', {
          register: this.toCancelOrder,
          userid: this.toCancelOrder.id,
          cancelReason: this.customerCancelReason
        },
        {
          headers:{
            "Authorization": `Bearer ${this.usersToken}`,
        }
        })
        .then(res => {
          if(res.data.status){
            this.$store.commit('storeUserProfileOrders', res.data.data);
            this.$store.commit('storeUserToCancel', res.data.delete);
          }
          else{
            alert(res.data.data);
          }
        })
        .catch(err => console.error(err));
      },
      priceRound(price){
        var rounded = (Math.round(price * 100) / 100).toFixed(2);
        return rounded;
      },
    },

    mounted(){
      // console.log(this.userProfileOrders);
    },

    beforeMount(){
    }
    
  }
</script>
<style scoped>
.fontBlue{
  color: #1106A0;
}
.fontTitle{
  color: #464646;
}
.fontDesc{
  color: #858585
}
</style>