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
        <v-col
          offset="7"
          cols="1"
        >
          <v-btn
            small
          >
            <v-icon>
              mdi-chevron-left
            </v-icon>
          </v-btn>
          <v-btn
            small>
            <v-icon>
              mdi-chevron-right
            </v-icon>
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="1"></v-col>
        <v-col
          v-for="categorie in categories"
          :key="categorie.id"
          cols="2"
        >
          <v-card
            height="130px"
            width="300px"
            class="rounded-lg"
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
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      categories: [
        { id: 1, cname: "Loafs & Breads", cimg: "SamplePhoto.png"},
        { id: 2, cname: "Frozen Products", cimg: "SamplePhoto.png"},
        { id: 3, cname: "Snacks", cimg: "SamplePhoto.png"},
        { id: 4, cname: "Beverages", cimg: "SamplePhoto.png"},
        { id: 5, cname: "Dairy", cimg: "SamplePhoto.png"},
      ],
    }),
    methods: {
      toCategoriseItem() {
        this.$router.push('/item');
      }
    }
  }
</script>