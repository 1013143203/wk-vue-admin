<template>
  <div class="app-container">
    <el-card class="show">
      <div slot="header" class="clearfix">
      </div>
      <el-form :rules="rules" ref="form" :model="form" >
        <el-form-item label="AppId" prop="appid">
          <el-input v-model="form.appid"></el-input>
        </el-form-item>
        <el-form-item label="AppSecret" prop="appsecret">
          <el-input v-model="form.appsecret"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存配置</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  import {load, wxapp} from "@/api/weixin";
  export default {
    name: "wechat",
    data () {
      return {
        form: {
          appid: '',
          appsecret: '',
        },
        rules: {
          appid: [
            {required: true, message: '请输入AppId', trigger: 'blur'},
          ],
          appsecret: [
            {required: true, message: '请输入AppSecret', trigger: 'blur'},
          ],
        }
      };
    },
    created() {
      load('wxapp').then((response) => {
        const { data } = response
        this.form = data
      }).catch((error) => {
        console.log(error);
      });
    },
    methods:{
      onSubmit() {
        this.$refs.form.validate((valid) => {
          if (valid) {
            wxapp(this.form).then((response) => {
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
  .desc{
    color: #999;
    font-size: 12px;
  }
</style>
