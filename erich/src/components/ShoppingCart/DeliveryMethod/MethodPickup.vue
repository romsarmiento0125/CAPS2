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
            >{{this.customerInfos.First_Name}}&nbsp;{{this.customerInfos.Last_Name}}</p>
            <p
              class="ma-0 pa-0"
            >{{this.customerInfos.Mobile_Number}}</p>
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
                  @change="ydm"
                ></v-date-picker>
              </v-menu>
            </div>
            <div>
              <v-dialog
                v-model="modal2"
                :return-value.sync="time"
                persistent
                width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="oras"
                    label="Picker in dialog"
                    outlined
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-time-picker
                  v-if="modal2"
                  v-model="time"
                  full-width
                >
                  <v-spacer></v-spacer>
                  <v-btn
                    text
                    color="primary"
                    @click="modal2 = false"
                  >
                    Cancel
                  </v-btn>
                  <v-btn
                    text
                    color="primary"
                    @click="saveTime(time)"
                  >
                    OK
                  </v-btn>
                </v-time-picker>
              </v-dialog>
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
      modal2: false,
      oras: null,
    }),

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      },
    },

    methods: {
      ydm (date) {
        console.log(date);
        this.menu = false;
        this.$store.commit('pickupDate', date);
      },
      saveTime(data) {
        console.log(data)
        this.oras = data;
        this.modal2 = false
        this.$store.commit('pickupTime', data);
      }
    },
     

    watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },
  }
</script>