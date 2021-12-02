<template>
  <div class="app-container">
    <el-card class="show">
      <div slot="header" class="clearfix">
      </div>
      <el-form :rules="rules" ref="form" :model="form" >
        <el-form-item label="微信支付商户号MCHID" prop="mchid">
          <el-input v-model="form.mchid"></el-input>
        </el-form-item>
        <el-form-item label="微信支付密钥KEY" prop="key">
          <el-input v-model="form.key"></el-input>
        </el-form-item>
        <el-form-item label="apiclient_cert.pem" prop="apiclient_cert">
          <el-input v-model="form.apiclient_cert"  type="textarea"></el-input>
        </el-form-item>
        <el-form-item label="apiclient_key.pem" prop="apiclient_key">
          <el-input v-model="form.apiclient_key"  type="textarea"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存配置</el-button>
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
