<template>
  <div>
    <mf-header></mf-header>
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
              Registered Customer
            </v-card-title>
            
            <v-divider></v-divider>
            
            <v-card-text
              class="pa-0 mt-5"
            >
              <v-text-field
                outlined
                dense
                class="mt-1"
                label="Email"
              ></v-text-field>
            </v-card-text>

            <v-btn
              dark
              class="rounded-lg px-10"
              color="#1106A0"
              
            >
              Sign in
            </v-btn>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import MiscFunctionsHeader from '../components/MFunctions/MuscFunctionsHeader.vue'
  import {Mixins} from '../Mixins/mixins.js'

  export default {
    mixins: [Mixins],
    name: 'MiscFunctions',

    data: () => ({
    }),

    components: {
      "mf-header": MiscFunctionsHeader,
    },

    methods: {
      
    }
  }
</script>