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
            >Pickup date and time</p>
            <div>
              <v-menu
                ref="menu"
                v-model="menu"
                :close-on-content-click="false"
                transition="scale-transition"
                offset-y
                min-width="auto"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="date"
                    label="Select a pickup date"
                    outlined
                    append-icon="mdi-chevron-down"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker
                  v-model="date"
                  :active-picker.sync="activePicker"
                  :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                  min="1950-01-01"
                  @change="save"
                ></v-date-picker>
              </v-menu>
            </div>
            <div>
              <v-menu
                ref="menu"
                v-model="menu2"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="time"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="time"
                    label="Select a pickup time"
                    append-icon="mdi-chevron-down"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    outlined
                  ></v-text-field>
                </template>
                <v-time-picker
                  v-if="menu2"
                  v-model="time"
                  full-width
                  @click:minute="$refs.menu.save(time)"
                ></v-time-picker>
              </v-menu>
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
      activePicker: null,
      date: null,
      menu: false,
      time: null,
      menu2: false,
    }),

    methods: {
      save (date) {
        console.log("save");
        this.$refs.menu.save(date)
        this.menu = false;
      },
    },
     

    watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },
  }
</script>