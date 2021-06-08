<template>
    <el-row type="flex" class="row-bg" justify="center">
        <el-col :span="18">
            <h3 v-if="$fetchState.pending">Đang tải bài viết...</h3>
            <p v-else-if="$fetchState.error">Lỗi rồi :(</p>
            <div v-else>
                <h1>Nuxt Posts</h1>
                <br />
                <NuxtLink to="/posts/create" class="no-decoration">
                    <el-button size="mini" type="success">
                        Tạo vài viết mới
                    </el-button>
                </NuxtLink>
                <el-table v-loading="loading"
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

        async fetch() {
            this.posts = await fetch(
                'http://localhost:8000/api/posts'
            ).then(res => res.json())
        },

        methods: {
            handleEdit(row) {
                this.$router.push({ name: 'posts-edit', params: {row :row}})
            },
            handleDelete(row) {
                console.log(row['id']);
                if(confirm('Bạn có muốn xóa không?')){
                    axios.delete(`http://localhost:8000/api/posts/${ row['id'] }`,{
                        //param here
                    }).then(function (response) {
                        window.location.reload();
                    });
                }
            }
        },
    }
</script>

