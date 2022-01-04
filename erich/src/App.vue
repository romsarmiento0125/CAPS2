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
  import {Mixins} from './Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: 'App',

    data: () => ({
      usersData: {
        usersEmail: "",
      },
    }),

    computed: {
      usersEmail(){
        return localStorage.getItem('email');
      },
      usersToken(){
        return localStorage.getItem('token');
      },
    },

    methods: {
      getAddress(){
        this.usersData.usersEmail = this.usersEmail;
        if(this.usersEmail){
          axios.post(this.getDomain()+'api/loginaddress/store',{
            clientCred: this.usersData
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {

            this.$store.commit('storeCustomerAddress', res.data);
          })
        } 
      },
      getCategoryItems() {
        axios.get(this.getDomain()+'api/categoryitem',)
        .then(res => {
          this.$store.commit('storeCategoryItem', res.data);
          // console.log(res.data);
          })
        .catch(err => console.error(err));
      }
    },
    beforeMount(){
      this.getCategoryItems();
      this.getAddress()
    }
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

  /* pag nabasa moto ibig sabihin sanay ka mag basa hahahahaha */
</style>

