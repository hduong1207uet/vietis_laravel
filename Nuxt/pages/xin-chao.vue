<template>
  <h1 class="red">Hello World, {{ name }}</h1>
</template>

<script>
  export default {
    asyncData (context) {
        return {
            name : 'Duong Hoang'
        }
    },

    head() {
        return {
            title: 'Duong dep trai',
            meta: [
                { charset : 'utf-8' },
                { name: 'viewport', content: 'width=device-width, initial-scale=1'}
            ],
            link: [
                {}
            ]
        }
    }
    // ...
  }
</script>

<style>
  .red {
    color: red;
  }
</style>
