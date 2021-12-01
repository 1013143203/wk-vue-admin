<template>
  <div class="app-container">
    <el-card class="show">
      <div slot="header" class="clearfix">
        <aside>使用微信公众平台直接模式时，需要在微信公众号平台配置授权IP及网页授权域名，将公众号平台获取到的参数填写到下面。</aside>
      </div>
      <el-form :rules="rules" ref="form" :model="form" >
        <el-form-item label="Token" prop="token">
          <el-input v-model="form.token"></el-input>
        </el-form-item>
        <el-form-item label="AppId" prop="appid">
          <el-input v-model="form.appid"></el-input>
        </el-form-item>
        <el-form-item label="AppSecret" prop="appsecret">
          <el-input v-model="form.appsecret"></el-input>
        </el-form-item>
        <el-form-item label="AesKey">
          <el-input v-model="form.AesKey"></el-input>
        </el-form-item>
        <el-form-item label="PushApi">
          <el-input v-model="form.PushApi"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存配置</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  import {wechat} from "@/api/weixin";
  export default {
    name: "wechat",
    data () {
      return {
        form: {
          appid: '',
          appsecret: '',
          token: '',
          AesKey:'',
          PushApi:'',
        },
        rules: {
          token: [
            {required: true, message: '请输入消息推送对接认证Token', trigger: 'blur'},
          ],
          appid: [
            {required: true, message: '请输入以wx开头的18位公众号APPID', trigger: 'blur'},
          ],
          appsecret: [
            {required: true, message: '请输入32位公众号接口密钥AppSecret', trigger: 'blur'},
          ],
        }
      };
    },
    methods:{
      onSubmit() {
        this.$refs.form.validate((valid) => {
          if (valid) {
            wechat(this.form).then((response) => {
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
