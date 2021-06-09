<template>
    <el-button
        size="mini"
        type="danger"
        @click="handleDelete(scope.row)">Delete
    </el-button>
</template>

<script>
export default {
    props: {
      posts : Array
    },

    methods: {
      //
    }
}
</script>
