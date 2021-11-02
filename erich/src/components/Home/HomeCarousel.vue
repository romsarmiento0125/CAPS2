<template>
  <div
    class="ma-3 d-none d-sm-flex mt-16 pt-16"
  >
    <v-container>
      <v-row>
        <v-col
          cols="12"
        >
          <v-carousel
            v-model="model"
            class="rounded-xl"
            height="26vw"
            hide-delimiters
            hide-delimiter-background
            cycle
            progress
            >
            <v-carousel-item
              v-for="(item,i) in items"
              :key="i"
              :src="item.src"
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
          src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
        },
      ],
    }) 
  }
</script>