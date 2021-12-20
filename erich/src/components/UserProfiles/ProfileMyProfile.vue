<template>
  <div>
    <v-container
      fluid
    >
      <v-row>
        <v-col
          cols="9"
        >
          <v-sheet>
            <v-row>
              <v-col>
                <div>
                  <p>My Profile</p>
                  <p
                    class="display-1"
                  >{{Username}}</p>
                </div>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col
                cols="7"
              >
                <div
                  class="d-flex"
                >
                  <p
                    class="title mr-2"
                  >Name:</p>
                  <p
                    class="title"
                  >{{Name}}</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="title mr-2"
                  >Surname:</p>
                  <p
                    class="title"
                  >{{Surname}}</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="title mr-2"
                  >Email:</p>
                  <p
                    class="title"
                  >{{Email}}</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="title mr-2"
                  >Phone number:</p>
                  <p
                    class="title"
                  >{{Mobilenumber}}</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="title mr-2"
                  >Date of birth:</p>
                  <p
                    class="title"
                  >{{Birthday}}</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p
                    class="title mr-2"
                  >Gender:</p>
                  <p
                    class="title"
                  >{{Gender}}</p>
                </div>
                <div>
                  <v-btn
                    color="blue"
                  >
                    <p>save</p>
                  </v-btn>
                </div>
              </v-col>
              <v-divider
                vertical
              ></v-divider>
              <v-col
                cols="2"
              >
                <div>
                  <v-img
                    src="https://picsum.photos/510/300?random"
                    aspect-ratio="1.7"
                  ></v-img>
                </div>
                <div>
                  <v-file-input
                    :rules="rules"
                    accept="image/png, image/jpeg, image/bmp"
                    placeholder="Pick an avatar"
                    prepend-icon="mdi-camera"
                    label="Avatar"
                  ></v-file-input>
                </div>
              </v-col>
            </v-row>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  export default {
    data: () => ({
      Username: "",
      Name: "",
      Surname: "",
      Email: "",
      Password: "",
      Mobilenumber: "",
      Birthday: "",
      Gender: "",
      rules: [
        value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
      ],
    }),

    computed: {
      customerInfos() {
        return this.$store.state.customerInfos;
      }
    },

    watch: {
      menu(val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },

    methods: {
      save(date) {
        this.$refs.menu.save(date)
      },
      getCustomerInfo() {
        console.log(this.customerInfos);
      }
    },
    
    beforeMount() {
      //this.getCustomerInfo();
      //console.log(this.customerInfos);
      this.Username = this.customerInfos.First_Name + this.customerInfos.Last_Name;
      this.Name = this.customerInfos.First_Name;
      this.Surname = this.customerInfos.Last_Name;
      this.Email = this.customerInfos.Email;
      this.Password = this.customerInfos.Password;
      this.Mobilenumber = this.customerInfos.Mobile_Number;
      this.Birthday = this.customerInfos.Birthday;
      this.Gender = this.customerInfos.Gender;
    }
  }
</script>