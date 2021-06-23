<template>
    <!-- Button show create post form-->
    <div>

        <el-button
            size="mini"
            @click="dialogVisible=true">Edit
        </el-button>

        <el-dialog
            :visible.sync="dialogVisible"
            width="50%"
            >
            <el-row type="flex" class="row-bg" justify="center" :span="24">
                <el-col align="left">
                    <notifications group="foo" position='top right'/>
                    <el-row><h2>Sửa bài viết ---- </h2></el-row>
                    <br />
                    <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label="Form" class="demo-ruleForm">
                        <el-form-item label="Tiêu đề" prop="title">
                            <el-input type="text" v-model="ruleForm.title"></el-input>
                        </el-form-item>
                        <el-form-item label="Tác giả" prop="author">
                            <el-input type="text" v-model="ruleForm.author"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">Submit</el-button>
                            <el-button @click="resetForm(ruleForm)">Reset</el-button>
                        </el-form-item>
                    </el-form>
                </el-col>
            </el-row>
        </el-dialog>
    </div>
</template>

<script>
import Vue from 'vue'
export default {
    props: [
        'scope', 'posts'
    ],

    data() {
        var validateTitle = (rule, value, callback) => {
          if (!value) {
            return callback(new Error('Hãy nhập tiêu đề bài viết !'));
          } else {
            callback();
          }
        };

        var validateAuthor = (rule, value, callback) => {
          if (value === '') {
            callback(new Error('Hãy nhập tên tác giả'));
          } else {
            callback();
          }
        };

        return {
          dialogVisible: false,

          ruleForm: {
            title : this.scope.row['title'],
            author: this.scope.row['author']
          },

          rules: {
            title : [
                { validator: validateTitle, trigger: 'blur' }
            ],

            author : [
                { validator: validateAuthor, trigger: 'blur' }
            ],
          }
      };
    },

    methods: {
      async submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            let title = this.ruleForm.title;
            let author = this.ruleForm.author;
            console.log(title, author);
            this.$axios.$patch(`posts/${ this.scope.row['id'] }`, {
                title: title,
                author: author
            })
            .then(function (response){
              if (response.edited === true)
                Vue.notify({
                group: 'foo',
                title: 'Thành công',
                text: 'Sửa bài viết thành công !'
                })
            });

            setTimeout(() => {
                this.dialogVisible = false
            }, 0.7 * 1000)

            this.$emit('reloadCurrentPage')
          } else {
            console.log('Error submit!!');
            return false;
          }
        });
      },

      resetForm(formName) {
        this.$refs[formName].resetFields();
      },
    }

}
</script>