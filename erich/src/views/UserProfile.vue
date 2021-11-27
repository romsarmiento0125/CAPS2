<template>
  <div>
    <profile-header></profile-header>
    <v-container fluid>
      <v-row>
        <v-col>
          <v-breadcrumbs :items="items">
            <template v-slot:divider>
              <v-icon>mdi-chevron-right</v-icon>
            </template>
          </v-breadcrumbs>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-sheet
            color="white"
            elevation="1"
            height="200"
            width="100"
          ></v-sheet>
        </v-col>
        <v-col>
          <profile-myprofile></profile-myprofile>
          <profile-myorders></profile-myorders>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import ProfileHeader from '../components/UserProfiles/ProfileHeader.vue'
  import ProfileMyProfile from '../components/UserProfiles/ProfileMyProfile.vue'
  import profileMyOrders from '../components/UserProfiles/ProfileMyOrders.vue'

  export default {
    components: {
      'profile-header': ProfileHeader,
      'profile-myprofile': ProfileMyProfile,
      'profile-myorders': profileMyOrders
    },

    data: () => ({
      items: [
        {
          text: 'Dashboard',
          disabled: false,
        },
        {
          text: 'Link 1',
          disabled: false,
        },
        {
          text: 'Link 2',
          disabled: true,
        },
      ],
    }),
  }
</script>