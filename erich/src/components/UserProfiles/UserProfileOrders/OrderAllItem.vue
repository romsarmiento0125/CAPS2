<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col>

          <!-- Deliver To Pack -->
          <div
            class="my-2 mx-4"
            v-for="orderto in userProfileOrders"
            :key="orderto.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{orderto.status}}</h4>
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
                >Invoice &nbsp; #: &nbsp; {{orderto.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="orderto.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                cols="2"
              >
                <v-btn
                  v-if="orderto.status == 'Pending'"
                  color="#1106A0"
                  dark
                  outlined
                  @click="openDeliveryDialog(orderto)"
                >
                  <p
                    class="my-0"
                  >
                    Cancel
                  </p>
                </v-btn>
              </v-col>
              <v-col 
              cols="2"
              offset="6"
                
              >
                <h4
                  class="mb-10 pl-16"
                >  
                  Order total: 
                </h4>
                
              </v-col>

              <v-col cols="1" class="mr-5">
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(orderto.total)}}
                  </h4>
                </div>
                
              </v-col>
            </v-row>

            <v-divider></v-divider>
          </div>
        </v-col>
      </v-row>

      <!-- Delivery To Deliver -->
      <v-row>
        <v-col>
          <div
            class="my-2 mx-4"
            v-for="ordertd in userProfileToDeliver"
            :key="ordertd.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{ordertd.status}}</h4>
                
              </v-col>
              <v-col cols="9" class="d-flex justify-end ">
                <h4
                  class="fontBlue"
                >Deliver</h4>
              </v-col>
            </v-row>

            <v-row class="mx-2 mt-n5">
              <v-col>
                <h5
                  class="my-0 fontDesc font-weight-regular"
                >Invoice &nbsp; #: &nbsp; {{ordertd.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="ordertd.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                 cols="5"
              >
                <h4
                  class="mb-10 ml-5"
                >
                  Expected receive date: {{ordertd.adjustedDate}}
                </h4> 
              </v-col>
            
              <v-col
                 cols="3"
                 offset="4"
                 class="d-flex"
              >
                <h4
                  class="mb-10 ml-10 mr-2"
                >
                  Order total: 
                </h4>
                <h4 class="fontBlue">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  &nbsp;{{priceRound(ordertd.total)}}
                </h4>
              </v-col>
              
              <!-- <v-col
                cols="2"
                offset="8"
              >
                
                <h4
                  class="mb-10 pl-16"
                >
                  Order total: 
                </h4>
                
              </v-col>
              <v-col cols="1" class="mr-5">
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(ordertd.total)}}
                  </h4>
                </div>
                
              </v-col> -->
            </v-row>
            <v-divider></v-divider>
          </div>
        </v-col>
      </v-row>

      <!-- Delivery Complete -->
      <v-row>
        <v-col>
          <div
            class="my-2 mx-4"
            v-for="ordertc in userProfileToComplete"
            :key="ordertc.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{ordertc.status}}</h4>
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
                >Invoice &nbsp; #: &nbsp; {{ordertc.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="ordertc.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                cols="2"
                offset="8"
              >
                
                <h4
                  class="mb-10 pl-16"
                >
                  Order total: 
                </h4>
                
              </v-col>
               <v-col cols="1" class="mr-5">
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(ordertc.total)}}
                  </h4>
                </div>
                
              </v-col>

            </v-row>
            <v-divider></v-divider>
          </div>

          <!-- Pickup To Pack -->
          <div
            class="my-2 mx-4"
            v-for="orderpo in userPickupOrders"
            :key="orderpo.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="mb-0 fontTitle"
                >Status: &nbsp;{{orderpo.status}}</h4>
                
              </v-col>
              <v-col cols="9" class="d-flex justify-end">
                  <h4
                  class="my-0 fontBlue"
                  >Pickup</h4>
              </v-col>
            </v-row>

            <v-row class="mx-2 mt-n5">
              <v-col>
                <h5
                  class="my-0 fontDesc font-weight-regular"
                >Invoice &nbsp; #: &nbsp; {{orderpo.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="orderpo.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                cols="2"
              >
                <v-btn
                  v-if="orderpo.status == 'Pending'"
                  color="#1106A0"
                  dark
                  outlined
                  @click="openPickupDialog(orderpo)"
                >
                  <p
                    class="my-0"
                  >
                    Cancel
                  </p>
                </v-btn>
              </v-col>
              <v-col
                cols="2"
                offset="6"
              >

                <h4
                  class="mb-10 pl-16"
                >
                  Order total: 
                </h4>
                
              </v-col>
              <v-col cols="1" class="mr-5">
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(orderpo.total)}}
                  </h4>
                </div>
                
              </v-col>
              
            </v-row>
            <v-divider></v-divider>
          </div>

          <!-- Pickup To Pickup -->
          <div
            class="my-2 mx-4"
            v-for="orderpp in userPickupToPickup"
            :key="orderpp.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{orderpp.status}}</h4>
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
                >Invoice &nbsp; #: &nbsp; {{orderpp.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="orderpp.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                 cols="5"
              >
                <h4
                  class="mb-10 ml-5"
                >
                  Expected pick up date: {{orderpp.pickupDate}}
                </h4> 
              </v-col>
            
              <v-col
                 cols="3"
                 offset="4"
                 class="d-flex"
              >
                <h4
                  class="mb-10 ml-10 mr-2"
                >
                  Order total: 
                </h4>
                  
                <h4 class="fontBlue">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  &nbsp;{{priceRound(orderpp.total)}}
                </h4>
              </v-col>
              <!-- <v-col
                cols="2"
                offset="8"
              >
                
                <h4
                  class="mb-10 pl-16"
                >
                  Order total: 
                </h4>
                
              </v-col>
              <v-col cols="1" class="mr-5">
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(orderpp.total)}}
                  </h4>
                </div>
                
              </v-col> -->
            </v-row>
            <v-divider></v-divider>
          </div>

          <!-- Pickup Complete -->
          <div
            class="my-2 mx-4"
            v-for="orderpc in userPickupToComplete"
            :key="orderpc.invoiceNumber"
          >
            <v-divider></v-divider>
            <v-row class="mt-2 mx-2">
              <v-col cols="3">
                <h4
                  class="my-0 fontTitle"
                >Status: &nbsp;{{orderpc.status}}</h4>
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
                >Invoice &nbsp; #: &nbsp; {{orderpc.invoiceNumber}}</h5>
              </v-col>
            </v-row>

            <v-row class="mx-2">
              <v-col>
                <orderdeliveritems :orders="orderpc.orders"></orderdeliveritems>
              </v-col>
            </v-row>

            <v-row class="d-flex justify-end">
              <v-col
                cols="2"
                offset="8"
              >
                
                <h4
                  class="mb-10 pl-16"
                >
                  Order total: 
                </h4>
                
              </v-col>
              <v-col cols="1" class="mr-5">
                <div class="d-flex">
                  <v-icon
                    color="#1106A0"
                    size="18px"
                    class=""
                  >
                    mdi-currency-php
                  </v-icon>
                  <h4 class="fontBlue">
                    &nbsp;{{priceRound(orderpc.total)}}
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
            label="Leave your comment here..."
            outlined
            v-model="customerCancelReason"
          ></v-textarea>
        </v-card-text>
        <v-card-actions>
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
        <v-card-title class="text-h5">
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
        <v-card-actions>
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
      userProfileToDeliver() {
        return this.$store.state.userProfileToDeliver;
      },
      userProfileToComplete() {
        return this.$store.state.userProfileToComplete;
      },
      userProfileToCancel() {
        return this.$store.state.userProfileToCancel;
      },
      userPickupOrders() {
        return this.$store.state.userPickupOrders;
      },
      userPickupToPickup() {
        return this.$store.state.userPickupToPickup;
      },
      userPickupToComplete() {
        return this.$store.state.userPickupToComplete;
      },
      userPickupToCancel() {
        return this.$store.state.userPickupToCancel;
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