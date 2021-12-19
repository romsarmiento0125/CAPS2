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
          <h3>Browse by Category</h3>
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
                <v-card
                  height="110px"
                  width="250px"
                  class="rounded-lg mx-5"
                  color="grey"
                  @click="toCategoriseItem(categorie.ccond)"
                >
                  <v-img
                    height="50px"
                    width="300px"
                    src="https://picsum.photos/1920/1080?random"
                  >
                  </v-img>
                  <v-card-title
                    class="d-flex justify-center ma-0 pa-0"
                  >
                    <h4>
                      {{categorie.cname}}
                    </h4>
                  </v-card-title>
                </v-card>
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
        { id: 1, cname: "Snacks", cimg: "SamplePhoto.png", ccond: "snacks"},
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