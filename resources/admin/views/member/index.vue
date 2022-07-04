<template>
  <div class="app-container">
    <el-card class="show">
      <wk-search
        :query = "search.query"
        :cols = "search.cols"
        @queryClick="queryClick"
      ></wk-search>
      <wk-table
        :table="table"
        @pageChange="pageChange"
      ></wk-table>
    </el-card>
    <wk-edit-form
      ref="form"
      @submit="submit"
      :cols="form.cols"
      :data="form.data"
    ></wk-edit-form>
  </div>
</template>

<script>
  import { index ,update ,edit } from "@/api/member/index";
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
              fileType: 'image',
              current:(item)=>{
                this.$set(this.form.data,"avatar",item.url)
              },
              rules: [
                { required: true, message: "请选择头像", trigger: "blur" },
              ]
            },
            nickname:{
              type: "input",
              label: "昵称", //字段
              placeholder: "请填写名称", //提示内容
              rules: [
                { required: true, message: "请输入昵称", trigger: "blur" },
                {
                  min: 1,
                  max: 15,
                  message: "长度在 1 到 15 个昵称",
                  trigger: 'blur',
                },
              ],
            },
            realname:{
              type: "input",
              label: "真实姓名", //字段
              placeholder: "请填写名称", //提示内容
              rules: [
                {
                  min: 1,
                  max: 15,
                  message: "长度在 1 到 15 个字符",
                  trigger: 'blur',
                },
              ],
            },
            agentid:{
              type: "select",
              label: "上级用户", //字段
            },
            level:{
              type: "select",
              label: "等级", //字段
              options:[],
            },
            mobile:{
              type: "input",
              label: "手机号", //字段
              placeholder: "请填写手机号", //提示内容
              rules: [
                { required: true, message: "请输入手机号", trigger: "blur" },
                { validator: validatorMobile, trigger: 'blur'},
              ],
            },
            password:{
              label: "密码",
              prop: "password",
              rules: [
                { required: true, message: "请输入密码", trigger: "blur" },
                {
                  min: 5,
                  max: 15,
                  message: "长度在 5 到 15 个字符",
                  trigger: 'blur',
                },
              ],
            },
            credit1:{
              type: "input",
              label: "积分", //字段
            },
            credit2:{
              type: "input",
              label: "余额", //字段
            },
            sex:{
              type: "switch",
              label: "性别", //字段
              active: 1,
              inactive: 2,
            },
            region:{
              type: "region",
              label: "省市区", //字段
              current:(item)=>{
                this.form.data.pid = item.pid;
                this.form.data.cid = item.cid;
                this.form.data.aid = item.aid;
                this.form.data.sid = item.sid;
                console.log(item)
              },
            },
            address_info:{
              type: "input",
              label: "具体地址", //字段
            },
            status:{
              type: "switch",
              label: "状态", //字段
              active: 1,
              inactive: 2,
            },
          },
          data:{
            level: '',
            avatar:''
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
          cols: {
            query: {type: 'input', label: '名称', placeholder: '请输入名称'},
            date: {type: 'date'},
          },
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
