<template>
  <div class="app-container">
    <el-card class="show">
      <div slot="header" class="clearfix">
      </div>
      <el-form :rules="rules" ref="form" :model="form" >
        <el-form-item label="微信支付商户号" prop="mchid">
          <el-input v-model="form.mchid"></el-input>
        </el-form-item>
        <el-form-item label="微信支付密钥" prop="key">
          <el-input v-model="form.key"></el-input>
        </el-form-item>
        <el-form-item label="微信回调地址" prop="notify_url">
          <el-input v-model="form.notify_url"></el-input>
        </el-form-item>
        <el-form-item label="apiclient_cert.pem" prop="apiclient_cert">
          <el-input v-model="form.apiclient_cert"  type="textarea"></el-input>
          <span class="desc">使用文本编辑器打开apiclient_cert.pem文件，将文件的全部内容复制进来</span>
        </el-form-item>
        <el-form-item label="apiclient_key.pem" prop="apiclient_key">
          <el-input v-model="form.apiclient_key"  type="textarea"></el-input>
          <span class="desc">使用文本编辑器打开apiclient_key.pem文件，将文件的全部内容复制进来</span>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" v-auth="'weixin:pay'" @click="onSubmit">保存配置</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  import {load, pay} from "@/api/weixin";
  export default {
    name: "pay",
    data () {
      return {
        form: {
          mchid: '',
          key: '',
          apiclient_cert: '',
          apiclient_key:'',
          notify_url:''
        },
        rules: {
          mchid: [
            {required: true, message: '请输入微信支付商户号', trigger: 'blur'},
          ],
          key: [
            {required: true, message: '请输入微信支付密钥', trigger: 'blur'},
          ],
          apiclient_cert: [
            {required: true, message: '请输入apiclient_cert', trigger: 'blur'},
          ],
          apiclient_key: [
            {required: true, message: '请输入apiclient_key', trigger: 'blur'},
          ],
        }
      };
    },
    created() {
      load('pay').then((response) => {
        const { data } = response
        if (data){
          this.form = data
        }
      }).catch((error) => {
        console.log(error);
      });
    },
    methods:{
      onSubmit() {
        this.$refs.form.validate((valid) => {
          if (valid) {
            pay(this.form).then((response) => {
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
