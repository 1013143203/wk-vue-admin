<template>
  <div class="app-container">
    <el-card class="show">
      <div slot="header" class="clearfix">
        <aside>
        </aside>
      </div>
      <el-form :rules="rules" ref="form" :model="form" >
        <el-form-item label="默认上传方式" prop="token">
          <el-radio-group v-model="form.storage" prop="storage">
            <el-radio label="local">本地</el-radio>
            <el-radio label="ali">阿里云OSS</el-radio>
          </el-radio-group>
        </el-form-item>
        <div v-if="form.storage == 'ali'">
          <el-form-item label="存储空间名称 Bucket" prop="bucket">
            <el-input v-model="form.ali.BUCKET_NAME"></el-input>
          </el-form-item>
          <el-form-item label="AccessKey" prop="accessKey">
            <el-input v-model="form.ali.ACCESS_KEY_ID"></el-input>
          </el-form-item>
          <el-form-item label="AccessSecret" prop="accessSecret">
            <el-input v-model="form.ali.ACCESS_KEY_SECRET"></el-input>
          </el-form-item>
          <el-form-item label="空间域名" prop="endpoint">
            <el-input v-model="form.ali.END_POINT"></el-input>
          </el-form-item>
        </div>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存配置</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  import {load, update} from "@/api/attachment";
  export default {
    data () {
      return {
        form: {
          ali:{
            BUCKET_NAME:'',
            ACCESS_KEY_ID:'',
            ACCESS_KEY_SECRET:'',
            END_POINT:'',
          },
          storage:'',
        },
        rules: {
          // bucket: [
          //   {required: true, message: '请输入存储空间名称', trigger: 'blur'},
          // ],
          // accessKey: [
          //   {required: true, message: '请输入AccessKey', trigger: 'blur'},
          // ],
          // accessSecret: [
          //   {required: true, message: '请输入AccessSecret', trigger: 'blur'},
          // ],
          // endpoint: [
          //   {required: true, message: '请输入空间域名', trigger: 'blur'},
          // ],
        }
      };
    },
    created() {
      load().then((response) => {
        const { data } = response
        data.ali = Object.assign({},data.ali)
        this.form = data
      }).catch((error) => {
        console.log(error);
      });
    },
    methods:{
      onSubmit() {
        this.$refs.form.validate((valid) => {
          if (valid) {
            update(this.form).then((response) => {
              console.log(response)
              this.$message({
                type: 'info',
                message: response.msg
              });
            }).catch((error) => {
              console.log(error);
            });
          }
        });
      },
    }
  }
</script>

<style scoped>

</style>
