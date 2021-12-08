<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          class="ma-0 pa-0"
        >
          <div
            class="pl-5 pt-5"
          > 
            <p
              class="title ma-0 pa-0"
            >Contact Information</p>
            <p
              class="ma-0 pa-0"
            >Reyster Del Rosario</p>
            <p
              class="ma-0 pa-0"
            >09098675786</p>
          </div>
          <div
            class="pl-5 pt-5"
          >
            <p
              class="title ma-0 pa-0 "
            >Delivery Address</p>
            <p>adresskasdfjghsdkfjgsdkfjgsdfkjgsd sdf;gshdfg sd;fjgn ;jsadfg</p>
            <div
              class="d-flex justify-end"
            >
              <v-btn
                class="justify-end"
                plain
                color="blue"
                small
                right
                @click="changeAddress"
              >
                Change Adress
              </v-btn>
            </div>
          </div>
          <div
            class="pl-5 pt-5"
          >
            <p
              class="title ma-0 pa-0 "
            >Delivery Method</p>
            <div class="pa-5">
              <p>Free</p>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
    }),
    methods: {
      changeAddress() {
        this.$store.commit('goToAddress');
        this.$router.push({path: '/profile'});
      }
    }
  }
</script>