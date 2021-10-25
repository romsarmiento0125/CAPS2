<template>
  <div>
    <h1>This is Test Views</h1>
    <test-components></test-components>
  </div>
</template>

<script>
  import TestComponents from '../components/TestComponents.vue'

  export default {
    name: 'TestViews',

    components: {
      'test-components': TestComponents,
    },
  }
</script>
