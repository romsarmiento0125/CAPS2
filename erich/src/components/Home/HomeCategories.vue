<template>
  <div
    class=""
  >
    <v-container fluid>
      <v-row>
        <v-col
          offset-xl="1"
          xl="10"
          lg="12"
          md="12"
          cols="12"
        >
          <h2>Browse by Category</h2>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          class="d-flex"
          offset-xl="1"
          xl="10"
          lg="12"
          md="12"
          cols="12"
        >
          <!-- <div
            v-for="categorie in categories"
            :key="categorie.id"
          >
            <v-card
              height="130px"
              width="130px"
              class="rounded-lg mx-5"
              @click="toCategoriseItem()"
            >
              <v-img
                height="70px"
                width="300px"
                src="https://picsum.photos/1920/1080?random"
              >
              </v-img>
              <v-card-title
                class="d-flex justify-center"
              >
                <h4>
                  {{categorie.cname}}
                </h4>
              </v-card-title>
            </v-card>
          </div> -->
    
          <v-slide-group
            multiple
            show-arrows       
          >
            <v-slide-item
              v-for="categorie in categories"
              :key="categorie.id"
            >
              <div
                class="ma-2"
                rounded

              >
                <v-hover>
                  <template v-slot:default="{hover}">
                  <v-card
                    
                    :elevation="hover? 4:0"
                    height="100px"
                    width="300px"
                    class="rounded-lg mx-5 elevation-0"
                    
                    :style="{'background-color':hover ?'#E2E0FF':'#EDEDF0'}"
                    @click="toCategoriseItem(categorie.ccond)"
                  >
                    <div class="d-flex justify-center">
                      <div class="mt-5" >
                        <v-img contain
                          height="100%"
                          width="100%"
                          :src="require('../../assets/CategoryPics/'+categorie.cimg)"
                          >
                        </v-img>
                      </div> 
                    </div>          
                    <v-card-title
                      class="d-flex justify-center ma-0 pa-0"
                    >
                      <h5 class="grey--text text--darken-2">
                        {{categorie.cname}}
                      </h5>
                    </v-card-title>
                  </v-card>
                  </template>
                </v-hover>
                
              </div>
            </v-slide-item>
          </v-slide-group>

        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      categories: [
        { id: 1, cname: "Snacks", cimg: "Snacks.png", ccond: "snacks"},
        { id: 2, cname: "Bakery", cimg: "Breads.png", ccond: "bakery"},
        { id: 3, cname: "Sweets", cimg: "Snacks.png", ccond: "sweets"},
        { id: 4, cname: "Pasta", cimg: "Pantry.png", ccond: "pasta"},
        { id: 5, cname: "Personal Care", cimg: "Pantry.png", ccond: "personalCare"},
        { id: 6, cname: "Baking", cimg: "Beverages.png", ccond: "baking"},
        { id: 7, cname: "Powdered", cimg: "Pantry.png", ccond: "powdered"},
        { id: 8, cname: "Frozen Goods", cimg: "Frozen.png", ccond: "frozenGoods"},
        { id: 9, cname: "Canned Goods", cimg: "Snacks.png", ccond: "cannedGoods"},
        { id: 10, cname: "Promo Deals", cimg: "Pantry.png", ccond: "sweets"},
      ],
    }),
    methods: {
      toCategoriseItem(cond) {
        this.$router.push('/item');
      }
    }
  }
</script>