<template>
  <div
    class=" d-none d-sm-flex mt-15 pt-15"
  >
    <v-container fluid>
      <v-row>
        <v-col
          offset="1"
          cols="10"
        >
          <v-carousel
            v-model="model"
            class="rounded-xl color=black"
            height="29vw"
            hide-delimiters
            hide-delimiter-background
            cycle
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
          src: 'carousel1.jpg',
        },
        // {
        //   src: 'carousel1.jpg',
        // },
        // {
        //   src: 'carousel1.jpg',
        // },
      ],
    }) 
  }
</script>