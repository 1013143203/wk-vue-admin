<template>
  <div class="app-container">
    <el-card class="show">
      <wk-search
        :query = "search.query"
        :cols = "search.cols"
        @queryClick="queryClick"
      ></wk-search>
      <wk-table-btn
        :btn = "table.btn"
      >
      </wk-table-btn>
      <el-row :gutter="15">
        <wk-table
          v-auth="'member:index'"
          :total="table.total"
          :cols="table.cols"
          :lst="table.lst"
          @pageChange="pageChange"
        ></wk-table>
      </el-row>
    </el-card>
    <wk-detail
      ref="form"
      @submit="submit"
      :cols="form.cols"
      :data="form.data"
    ></wk-detail>
  </div>
</template>

<script>
  import { index ,update ,edit } from "@/api/member";
  import { validateMobile } from "@/utils/validate.js";
  const validatorMobile=(rule, value, callback)=>{
    if (validateMobile(value)){
      callback()
    }else{
      return callback(new Error('请输入正确手机号'))
    }
  }
  export default {
    inject:['reload'],
    name: "index",
    data() {
      return {
        form: {
          cols: {
            avatar:{
              type: "upload",
              label: "头像", //字段
              prop: "avatar", //字段名
              fileType: 'image',
              selected:(item)=>{
                this.form.data.avatar.push(item);
              }
            },
            nickname:{
              type: "upload",
              label: "昵称", //字段
              prop: "nickname", //字段名
              placeholder: "请填写名称", //提示内容
              rules: [
                { required: true, message: "请输入昵称", trigger: "blur" },
                {
                  min: 1,
                  max: 15,
                  message: "长度在 1 到 15 个昵称",
                  trigger: "change",
                },
              ],
            },
            realname:{
              type: "input",
              label: "真实姓名", //字段
              prop: "realname", //字段名
              placeholder: "请填写名称", //提示内容
              rules: [
                {
                  min: 1,
                  max: 15,
                  message: "长度在 1 到 15 个字符",
                  trigger: "change",
                },
              ],
            },
            agentid:{
              type: "select",
              label: "上级用户", //字段
              prop: "agentid", //字段名
            },
            level:{
              type: "select",
              label: "等级", //字段
              prop: "level", //字段名
              options:[],
            },
            mobile:{
              type: "input",
              label: "手机号", //字段
              prop: "mobile", //字段名
              placeholder: "请填写手机号", //提示内容
              rules: [
                { required: true, message: "请输入手机号", trigger: "blur" },
                { validator: validatorMobile, trigger: 'blur'},
              ],
            },
            password:{
              label: "密码",
              prop: "password",
              type: "password",
              rules: [
                { required: true, message: "请输入密码", trigger: "blur" },
                {
                  min: 5,
                  max: 15,
                  message: "长度在 5 到 15 个字符",
                  trigger: "change",
                },
              ],
            },
            credit1:{
              type: "input",
              label: "积分", //字段
              prop: "credit1", //字段名
            },
            credit2:{
              type: "input",
              label: "余额", //字段
              prop: "credit2", //字段名
            },
            sex:{
              type: "switch",
              label: "性别", //字段
              prop: "sex", //字段名
              active: 1,
              inactive: 2,
            },
            pid:{
              type: "select",
              label: "省", //字段
              prop: "pid", //字段名
            },
            cid:{
              type: "select",
              label: "市", //字段
              prop: "cid", //字段名
            },
            aid:{
              type: "select",
              label: "区", //字段
              prop: "aid", //字段名
            },
            sid:{
              type: "select",
              label: "街道(镇)", //字段
              prop: "sid", //字段名
            },
            address_info:{
              type: "input",
              label: "具体地址", //字段
              prop: "address_info", //字段名
            },
            status:{
              type: "switch",
              label: "状态", //字段
              prop: "status", //字段名
              active: 1,
              inactive: 2,
            },
          },
          data:{
            level: '',
            avatar:[]
          }
        },
        table: {
          cols: [
            {label:'ID', prop: "id" },
            {label:'用户名', prop: "realname" },
            {label:'昵称', prop: "nickname" },
            {label:'手机号', prop: "mobile" },
            {label:'等级', prop: "level_name" },
            {label:'加入时间', prop: "created_at" },
            {
              label:'操作',
              type: "btn",
              btn:[
                {
                  label:'查看',
                  auth:'member:edit',
                  click:(index , item)=>{
                    if (item.id) {
                      edit(item.id)
                        .then((response) => {
                          const res = response.data;
                          const { data , level } = res
                          this.form.cols.level.options=level
                          this.form.cols.password.rules=[]
                          this.form.data = data;
                        })
                        .catch((error) => {
                          console.log(error);
                        });
                    }
                  },
                },
              ], width:150
            },
          ],
          lst: [],
          total: 0,
        },
        search:{
          query:{},
          cols:[
            {type:'input',label:'名称',prop:'query',placeholder:'请输入名称'},
            {type:'date',prop:'date'},
          ],
        },
      }
    },
    created() {
      this.index();
    },
    methods: {
      index() {
        index(this.search.query)
          .then((response) => {
            const { data } = response;
            const { lst, total } = data;
            this.table.lst = lst;
            this.table.total = total;
          })
          .catch((error) => {
            console.log(error);
          });
      },
      submit(form) {
        update(form).then((response) => {
          this.$message({
            type: 'success',
            message: response.msg
          });
          this.reload();
        }).catch((error) => {
          console.log(error);
        });
      },
      pageChange(val) {
        this.search.query.page = val
        this.index()
      },
      queryClick(query){
        this.search.query=query
        this.index()
      },
    }
  }
</script>

<style scoped>

</style>
