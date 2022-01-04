<template>
  <div>
    <v-container
      fluid
      class="pa-16"
    >
      <v-row>
        <v-col
          offset="4"
          cols="4"
        >
          <v-card
            class="rounded-xl pa-12"
          >
            <v-card-title
              class="font-weight-black pt-0 pl-0 text-h5 fontTitle"
            >
              Verify Account
            </v-card-title>
            
            <v-divider></v-divider>
            
            <v-card-text
              class="pa-0 mt-5"
            >
              <v-text-field
                outlined
                dense
                class="mt-1"
                label="Verification Code"
              ></v-text-field>
            </v-card-text>

            <v-card-text
                class="d-flex justify-end py-0 mt-n3"
              >
                <v-btn
                  plain
                  class="pb-1 indigo--text text--darken-4"
                  @click="sendCode"
                >
                  <p
                    class="my-0 text-decoration-underline"
                  >Send Code Again</p>
                </v-btn>
              </v-card-text>

            <v-btn
              dark
              class="rounded-lg px-10"
              color="#1106A0"
              @click="verifyEmail"
            >
              Verify
            </v-btn>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
    }),

    components: {
    },

    methods: {
      sendCode(){
        console.log("code sent");
      },
      verifyEmail(){
        console.log("email verify");
      }
    }
  }
</script>