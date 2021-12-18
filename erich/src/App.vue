<template>
  <v-app>
    <v-main
      style="background-color:#EDEDF0"
      class="description"
    >
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
    //
  }),
};
</script>

<style>
@font-face {
  font-family: "RedHatDisplay";
  src: local("RedHatDisplay"),
   url(./assets/Fonts/RedHatDisplay-VariableFont_wght.ttf) format("truetype");
}
.description{
     font-family: "RedHatDisplay", Helvetica, Arial;
  }
</style>

