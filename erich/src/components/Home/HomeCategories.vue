<template>
  <div
    class=""
  >
    <v-container fluid>
      <v-row>
        <v-col
          offset="1"
          cols="2"
        >
          <h2>Browse by Category</h2>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="1"></v-col>
        <v-col
          class="d-flex"
          cols="10"
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
                    height="110px"
                    width="300px"
                    class="rounded-lg mx-5"
                    
                    :style="{'background-color':hover ?'#E2E0FF':'#EDEDF0'}"
                    @click="toCategoriseItem(categorie.ccond)"
                  >
                    <div class="d-flex justify-center">
                      <div class="mt-5" >
                        <v-img contain
                          height="100%"
                          width="100%"
                          src="../../assets/CategoryPics/Breads.png"
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
        { id: 1, cname: "Snacks", cimg: "Breads.png", ccond: "snacks"},
        { id: 2, cname: "Bakery", cimg: "SamplePhoto.png", ccond: "bakery"},
        { id: 3, cname: "Sweets", cimg: "SamplePhoto.png", ccond: "sweets"},
        { id: 4, cname: "Pasta", cimg: "SamplePhoto.png", ccond: "pasta"},
        { id: 5, cname: "Personal Care", cimg: "SamplePhoto.png", ccond: "personalCare"},
        { id: 6, cname: "Baking", cimg: "SamplePhoto.png", ccond: "baking"},
        { id: 7, cname: "Powdered", cimg: "SamplePhoto.png", ccond: "powdered"},
        { id: 8, cname: "Frozen Goods", cimg: "SamplePhoto.png", ccond: "frozenGoods"},
        { id: 9, cname: "Canned Goods", cimg: "SamplePhoto.png", ccond: "cannedGoods"},
      ],
    }),
    methods: {
      toCategoriseItem(cond) {
        alert(cond);
        this.$router.push('/item');
      }
    }
  }
</script>