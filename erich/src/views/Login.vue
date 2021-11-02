<template>
  <div>
    <login-header></login-header>
    <h1>Login</h1>
  </div>
</template>

<script>
  import LoginHeader from '../components/Login/LoginHeader.vue'

  export default {
    name: 'Login',

    components: {
      'login-header': LoginHeader,
    }
  }
</script>