<template>
  <div>
    <signup-header></signup-header>
    <h1>Signup</h1>
  </div>
</template>

<script>
  import SignupHeader from '../components/Signup/SignupHeader.vue'

  export default {
    name: 'Signup',
    
    components: {
      'signup-header': SignupHeader,
    }
  }
</script>