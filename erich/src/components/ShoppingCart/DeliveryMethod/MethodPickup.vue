<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          class="pa-15"
        >

          <div> 
            <h4
              class="fontTitle font-weight-bold"
            >
            Contact Information</h4>

            <v-row class="nContact mx-0 ma-3">
              <v-col cols="6">
                <p
                class="ma-0 pa-0 fontDesc"
              >{{usersFName}}&nbsp;{{usersLName}}</p>
              </v-col>

              <v-col cols="6">
                <p
                class="ma-0 pa-0 fontDesc d-flex justify-end"
              >{{usersMobileNumber}}</p>
              </v-col>
            </v-row>
          </div>
          
          <div
            class="pt-4"
          >
            <h4
              class="fontTitle font-weight-bold"
            >Pickup date and time</h4>
            <div class="pt-3">
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
                  :max="maxDate"
                  :min="minDate"
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
                    label="Pick Time"
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
                  :allowed-hours="allowedHours"
                  format="24hr"
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
      minDate: null,
      maxDate: null,
    }),

    computed: {
      usersFName(){
        return localStorage.getItem('firstName');
      },
      usersLName(){
        return localStorage.getItem('lastName');
      },
      usersMobileNumber(){
        return localStorage.getItem('mobileNumber');
      },
    },

    methods: {
      allowedHours: v => v < 17 && v > 5,
      ydm (date) {
        // console.log(date);
        this.menu = false;
        this.$store.commit('pickupDate', date);
      },
      saveTime(data) {
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes();

        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var year = today.getFullYear();
        var date = year + "-" + month + "-" + day;

        var oras = "16"+ ":" + "00";

        if(data > time){
          this.oras = data;
          this.modal2 = false
          this.$store.commit('pickupTime', data);
        }
        else if(date < this.date){
          this.oras = data == null ? oras : data;
          this.modal2 = false
          this.$store.commit('pickupTime', data);
        }
        else{
          this.oras = oras;
          this.modal2 = false
          this.$store.commit('pickupTime', oras);
        }
      },
      setTimeAndDate() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var year = today.getFullYear();
        
        var oras = "16"+ ":" + "00";
        var time = today.getHours() + ":" + today.getMinutes();

        if(time > oras){
          this.minDate = year + "-" + month + "-" + (String(today.getDate() + 1).padStart(2, '0'));
          this.maxDate = (year + 1) + "-" + month + "-" + day;
          var date = year + "-" + month + "-" + (String(today.getDate() + 1).padStart(2, '0'));
        }
        else{
          this.minDate = year + "-" + month + "-" + day;
          this.maxDate = (year + 1) + "-" + month + "-" + day;
          var date = year + "-" + month + "-" + day;
        }

        this.date = date;
        this.oras = oras;
        
        this.ydm(date);
        this.saveTime(oras);
      }
    },
     

    watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },

    beforeMount() {
      this.setTimeAndDate();

    }
  }
</script>

<style scoped>
  .fontTitle{
    color:#464646;
  }
  .fontDesc{
    color: #787885;
  }

  .nContact{
    border: 1px solid #787885;
    border-radius: 5px;
    border-right: 1px solid;
    line-height: 10px;
  }
  .nDelivery{
    border: 1px solid #787885;
    border-radius: 5px;
  }

</style>