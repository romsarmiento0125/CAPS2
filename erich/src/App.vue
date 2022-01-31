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
      userAddress() {
        return this.$store.state.userAddress;
      },
      adminSupplier() {
        return this.$store.state.suppliers;
      },
    },

    watch: {
      userAddress(){
        // console.log("get address");
        this.getAddress();
      },
      adminSupplier(){
        this.getCategoryItems();
      }
    },

    methods: {
      getAddress(){
        this.usersData.usersEmail = this.usersEmail;
        if(this.usersEmail){
          // console.log('get address');
          axios.post(this.getDomain()+'api/loginaddress/store',{
            clientCred: this.usersData
          },
          {
            headers:{
              "Authorization": `Bearer ${this.usersToken}`,
          }
          })
          .then(res => {
            // console.log(res.data.tag.tag);
            if(!(res.data.status.status == 'Inactive')){
              this.$store.commit('storeCustomerAddress', res.data.data);
              this.$store.commit('userTag', res.data.tag.tag);
            }
            else{
              localStorage.removeItem("firstName");
              localStorage.removeItem("lastName");
              localStorage.removeItem("email");
              localStorage.removeItem("mobileNumber");
              localStorage.removeItem("birthday");
              localStorage.removeItem("gender");
              localStorage.removeItem("token");
              localStorage.removeItem("id");
              window.location.href = this.getLogout();
            }
            
          })
        }
      },
      getCategoryItems() {
        axios.get(this.getDomain()+'api/categoryitem',)
        .then(res => {
          this.$store.commit('storeCategoryItem', res.data.data);
          this.$store.commit('imagePath', res.data.path);
          // localStorage.setItem("token", res.data.token);
          // console.log(res.data);
          })
        .catch(err => console.error(err));
      },
      
    },
    beforeMount(){
      this.getAddress()
      this.getCategoryItems();
      
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

