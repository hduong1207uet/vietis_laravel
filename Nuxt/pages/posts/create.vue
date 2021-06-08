<template>
    <el-row type="flex" class="row-bg" justify="center">
        <el-col :span="18">
            <h2 align="center">Tạo bài viết mới</h2>
            <br />
            <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="120px" label="Form" class="demo-ruleForm">
              <el-form-item label="Tiêu đề" prop="title">
                  <el-input type="text" v-model="ruleForm.title" autocomplete="off"></el-input>
              </el-form-item>
              <el-form-item label="Confirm" prop="author">
                  <el-input type="text" v-model="ruleForm.author" autocomplete="off"></el-input>
              </el-form-item>
              <el-form-item>
                  <el-button type="primary" @click="submitForm('ruleForm')">Submit</el-button>
                  <el-button @click="resetForm('ruleForm')">Reset</el-button>
              </el-form-item>
            </el-form>
        </el-col>
    </el-row>
</template>
<script>
  import axios from 'axios';

  export default {
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
          ruleForm: {
            title : '',
            author: ''
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
            axios.post(`http://localhost:8000/api/posts`, {
              author: author,
              title: title
            }).then(function (response) {
              window.history.back();
            })
          } else {
            console.log('Error submit!!');
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      }
    }
  }
</script>
