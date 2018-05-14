<template>
  <div id="app">
    Wehe Vue! {{ test }}
  </div>
</template>

<script>
export default {
  computed: {
    test: function () {
      if (this.$store.getters.getIsRecording === false) {
        return 'funciona!'
      }
      return 'no'
    }
  }
}
</script>

<style scoped="true">
</style>
