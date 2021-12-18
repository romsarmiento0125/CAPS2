<template>
  <div>
    <v-app-bar
      color="#FFFFFF"
      height="auto"
    >
      <v-container fluid>
        <v-row>
          <v-col
            cols="5"
          >
            <div
              class="d-flex"
            >
              <router-link
                to="/"
              >
                <v-img
                  contain
                  src="../../assets/ERICH.svg"
                  max-height="120px"
                  max-width="120px"
                  class="mr-1"
                ></v-img>
              </router-link>
              <v-divider
                vertical
              ></v-divider>
              <p
                class="text-h5 ml-3 pt-1 grey--text text--darken-1"
              >Login</p>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  
  data: () => ({

  }),

  methods: {
    getcreds() {
      axios.get('http://127.0.0.1:8000/api/customers')
      .then(res => console.log(res))
      .catch(err => console.error(err));
    }
  },

  beforeMount(){
    //this.getcreds();
  },
}
</script>