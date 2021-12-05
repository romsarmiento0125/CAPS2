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
                  <p>Manage and protect your account</p>
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
                  <p>Username</p>
                  <v-text-field
                    outlined
                  ></v-text-field>
                </div>
                <div
                  class="d-flex"
                >
                  <p>Name</p>
                  <v-text-field
                    outlined
                  ></v-text-field>
                </div>
                <div
                  class="d-flex"
                >
                  <p>Email</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p>Password</p>
                </div>
                <div
                  class="d-flex"
                >
                  <p>Phone number</p>
                </div>
                <div
                  class=""
                >
                  <p>Date of birth</p>
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
                        label="Birthday date"
                        prepend-icon="mdi-calendar"
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
      activePicker: null,
      date: null,
      menu: false,
      rules: [
        value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
      ],
    }),
    watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },
    methods: {
      save (date) {
        this.$refs.menu.save(date)
      },
    },
  }
</script>