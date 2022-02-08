<template>
  <div
    class="mt-15 pt-15"
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
          <v-carousel
            v-model="model"
            class="rounded-xl color=black"
            height="35vw"
            hide-delimiters
            hide-delimiter-background
            progress
            >
            <v-carousel-item
              v-for="(item,i) in items"
              :key="i"
              :src="require('../../assets/'+item.src)"
              reverse-transition="fade-transition"
              transition="fade-transition"
            >
            </v-carousel-item>
          </v-carousel>  
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {

   data: () => ({
      model: 0,
      items: [
        {
          src: 'carouselFinal1.jpg',
        },
        {
          src: 'carouselFinal2.jpg',
        },
        {
          src: 'carouselFinal3.png',
        },
      ],
    }) 
  }
</script>