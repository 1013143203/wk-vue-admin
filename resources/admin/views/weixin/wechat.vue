<template>
  <div class="app-container">
    <el-card class="show">
      <div slot="header" class="clearfix">
        <aside>
          使用微信公众平台直接模式时，需要在微信公众号平台配置授权IP及网页授权域名，将公众号平台获取到的参数填写到下面。
          <br>😉 想体验一下系统的功能，可以申请一个微信官方测试账号试试→<a href="https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login">马上申请</a>
        </aside>
      </div>
      <el-form :rules="rules" ref="form" :model="form" >
        <el-form-item label="Token" prop="token">
          <el-input v-model="form.token"></el-input>
          <span class="desc">公众号平台与系统对接认证Token，请优先填写此参数并保存，然后再在微信公众号平台操作对接。</span>
        </el-form-item>
        <el-form-item label="AppId" prop="appid">
          <el-input v-model="form.appid"></el-input>
          <span class="desc">公众号APPID是所有接口必要参数，可以在公众号平台 [ 开发 > 基本配置 ] 页面获取。</span>
        </el-form-item>
        <el-form-item label="AppSecret" prop="appsecret">
          <el-input v-model="form.appsecret" maxLength='32'></el-input>
          <span class="desc">公众号应用密钥是所有接口必要参数，可以在公众号平台 [ 开发 > 基本配置 ] 页面授权后获取。</span>
        </el-form-item>
        <el-form-item label="AesKey" prop="aesKey">
          <el-input v-model="form.aesKey"></el-input>
          <span class="desc">若开启了消息加密时必需填写，消息加密密钥必需填写并保持与公众号平台一致。</span>
        </el-form-item>
        <el-form-item label="PushApi" prop="pushApi">
          <el-input v-model="form.pushApi"></el-input>
          <span class="desc">公众号服务平台消息推送接口及服务器授权IP地址，需在公众号接口开发处配置。</span>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存配置</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  import {load, wechat} from "@/api/weixin";
  export default {
    name: "wechat",
    data () {
      return {
        form: {
          appid: '',
          appsecret: '',
          token: '',
          aesKey:'',
          pushApi:'',
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
            {
              min: 32,
              max: 32,
              message: "请输入32位公众号接口密钥AppSecret",
              trigger: 'blur',
            },
          ],
        }
      };
    },
    created() {
      load('wechat').then((response) => {
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
.desc{
  color: #999;
  font-size: 12px;
}
</style>
