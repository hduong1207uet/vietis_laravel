<template>
  <div>
    <h1>{{ data.title }}</h1>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
        async asyncData ({ params }) {
          // return console.log(params);
          const { data } = await axios.get(`http://localhost:8000/api/posts/${ params.id }`)
          return { data }
        }
    }
</script>

