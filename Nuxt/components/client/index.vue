<template>
  <el-row type="flex" class="row-bg" justify="center">
    <el-col :span="18">
      <div>
        <h1>Nuxt Posts</h1>

        <br />
        <NuxtLink to="/posts/create" class="no-decoration" >
          <el-button size="mini" type="success">
              Tạo vài viết mới
          </el-button>
        </NuxtLink>
        <el-table
          :data="posts"
          style="width: 100%">
          <el-table-column label="#" prop="id"></el-table-column>
          <el-table-column label="Tiêu đề" prop="title"></el-table-column>
          <el-table-column label="Tác giả" prop="author"></el-table-column>
          <el-table-column align="right">
          <template slot="header">
            <el-input
            size="mini"
            placeholder="Type to search"/>
          </template>
          <template slot-scope="scope">
              <el-button
                size="mini"
                @click="handleEdit(scope.row)">Edit
              </el-button>
              <el-button
                size="mini"
                type="danger"
                @click="handleDelete(scope.row)">Delete
              </el-button>
          </template>
          </el-table-column>
        </el-table>
      </div>
    </el-col>
  </el-row>
</template>

<script>
  import Vue from 'vue'
  import router from 'vue-router'
  import axios from 'axios'
  Vue.use(router)

  export default {
    data() {
      return {
        posts: []
      }
    },

    async created() {
      this.posts = await this.$axios.$get(`posts`)
    },

    // async fetch() {
    //   this.posts = await this.$axios.$get(`posts`)
    // },

    methods: {
      handleEdit(row) {
        console.log(row)
        console.log(this.posts);
        this.$router.push({ name: 'posts-edit', params: {row :row}})
      },

      async handleDelete(row) {
        console.log(this.posts)
        let status
        if(confirm('Bạn có muốn xóa không?')){
          await this.$axios.$delete(`posts/${ row['id'] }`,{
            //param here
          }).then(function (response) {
            status = response['deleted'];
            console.log(response)
          });
          if(status === true) {
            const idx = this.posts.indexOf(row)
            this.posts.splice(idx, 1)
            this.$notify({
              group: 'foo',
              title: 'Thành công',
              text: 'Đã xóa bài viết'
            })
          } else {
            this.$notify({
              group: 'foo',
              type: 'warn',
              title: 'Thất bại',
              text: 'Xóa bài viết không thành công'
            })
          }
        }
      },

    },
  }
</script>
