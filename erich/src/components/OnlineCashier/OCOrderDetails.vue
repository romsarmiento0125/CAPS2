<template>
  <div>
    <v-dialog
      transition="dialog-top-transition"
      max-width="600"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          dark
          outlined
          color="#1106A0"
          v-bind="attrs"
          v-on="on"
        >
        <h6> View Order Details </h6>
        </v-btn>
      </template>
      <template v-slot:default="dialog">
        <v-card>
          <v-toolbar
            class="d-flex justify-center fontStyle fontTitle elevation-0 pa-2"
            color="white"
            
          >
          <h3> Order Details </h3>

          </v-toolbar>
          <div
            class="d-flex mx-10"
          >
            <h4 class="fontDesc">
              Invoice: #{{ivNumber}}
            </h4>
            <v-spacer></v-spacer>
            <h4 class="fontDesc">
              {{odDate}}
            </h4>
          </div>
          <v-card-text>
            <v-list>
              <v-list-item-group
              >
                <v-list-item
                  v-for="(item, i) in orders"
                  :key="i"
                >
                  <v-list-item-content
                  >
                    <div class="mt-10">
                      <h3>{{item.name}}</h3>
                      
                      <div
                        class="d-flex"
                      >
                        <h3>{{item.itemDesc}}</h3>
                        <v-spacer></v-spacer>
                        <h3>{{priceRound(item.retailPrice * item.quantity)}}</h3>
                      </div>
                    </div>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card-text>
          <div
            class="ma-10 fontDesc"
          >
            <div class="d-flex">
              <h4>SubTotal</h4>
               <v-spacer></v-spacer>
              <h4>{{sTotal}}</h4>
            </div>

            <div class="d-flex">
              <h4>Shipping Method</h4>
                <v-spacer></v-spacer>
              <h4>{{shipMethod}}</h4>
            </div>

            <div class="d-flex">
              <h4>Discount</h4>
                <v-spacer></v-spacer>
              <h4>{{dDiscount}}</h4>
            </div>

            <div class="d-flex">
              <h4>Tax</h4>
                <v-spacer></v-spacer>
              <h4>{{tTax}}</h4>
            </div>

            <v-divider class="my-5"></v-divider>

            <div class="d-flex fontTitle">
              <h3>Total</h3>
                <v-spacer></v-spacer>
              <h3>{{tTotal}}</h3>
            </div>

          </div>
          <v-card-actions class="justify-end mx-3">
            <v-btn
              text
              color="#1106A0"
              @click="dialog.value = false"
            >Close</v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-dialog>
  </div>
</template>

<script>
  export default {
    props: ['ivNumber', 'orders', 'odDate', 'sTotal', 'shipMethod', 'dDiscount', 'tTax', 'tTotal'],

    data: () => ({
      items: [
        // { IvNumber: '001', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        // { IvNumber: '001', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        // { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        // { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
        // { IvNumber: '002', ItemName: "Bonakid", ItemDesc: "Ang sarap mo pia", Quantity: "5", RPrice: "50"},
      ],
      ite: 0,
    }),

    computed: {

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



<style scoped>
  @font-face {
    font-family: "RedHatDisplay";
    src: local("RedHatDisplay"),
    url(../../assets/Fonts/RedHatDisplay-VariableFont_wght.ttf) format("truetype");
  }
  .fontStyle{
      font-family: "RedHatDisplay", Helvetica, Arial;
    }
  .fontTitle{
    color: #464646;
  }
  .fontDesc{
    color: #858585;
  }
</style>