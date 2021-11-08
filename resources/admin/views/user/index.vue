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
          v-auth="'user:index'"
          :total="table.total"
          :cols="table.cols"
          :data="table.lst"
          @pageChange="pageChange"
        ></wk-table>
      </el-row>
    </el-card>
    <wk-detail
      ref="form"
      @submit="submit"
      :cols="form.cols"
    ></wk-detail>
  </div>
</template>
<script>
import { index, status, edit, update, create, del } from "@/api/user";
import { confirm } from "@/utils/message-box.js";
export default {
  inject:['reload'],
  data() {
    return {
      form: {
        cols: {
          username:{
            type: "input",
            disabled:false,
            label: "用户名", //字段
            prop: "username", //字段名
            placeholder: "请填写用户名", //提示内容
            rules: [
              { required: true, message: "请输入用户名", trigger: "blur" },
              {
                min: 5,
                max: 10,
                message: "长度在 5 到 10 个字符",
                trigger: "change",
              },
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
          role:{
            label: "角色",
            prop: "role",
            type: "select",
            multiple: true,
            options: [],
          },
          status:{
            label: "状态",
            prop: "status",
            type: "switch",
            active: 1,
            inactive: 2,
          },
        },
        data: {
          username: "",
          password: "",
          role: [],
          status: 2,
        },
      },
      table: {
        cols: [
          {label:'ID', prop: "id" },
          {label:'用户名', prop: "username" },
          {
            label:'状态',
            prop: "status",
            type: "switch" ,
            switchData: {
              active:1,
              inactive:2,
            },
            switch:(val,id)=>{
              status(val,id)
                .then((response) => {
                  console.log(response);
                })
                .catch((error) => {
                  console.log(error);
                });
            }
          },
          {
            label:'角色',
            prop: "role" ,
          },
          {
            label:'操作',
            type: "btn",
            btn:[
              {
                label:'编辑',
                auth:'user:edit',
                click:(index , item)=>{
                  const that = this;
                  if (item.id) {
                    edit(item.id)
                      .then((response) => {
                        const { data } = response;
                        this.form.cols.username.disabled = true;
                        this.form.data.username = data.username;
                        this.form.data.status = data.status;
                        this.form.data.id = item.id;
                        this.form.data.role=data.role
                        this.form.cols.password.rules=[]
                        that.$refs.form.handle(this.form.data);
                      })
                      .catch((error) => {
                        console.log(error);
                      });
                  }
                },
                hidden:true
              },
              {label: "删除" ,type: "danger",auth:'user:delete',
                click:(index , item)=>{
                  const that = this
                  let fn = () => {
                    del(item.id).then((response) => {
                      this.$message({
                        type: 'info',
                        message: response.msg,
                      });
                      that.table.lst.splice(index, 1)
                      that.table.total = that.table.total-1
                    }).catch((error) => {
                      console.log(error);
                    })
                  }
                  confirm("是否永久删除该数据？", fn);
                },
                hidden:true
              }
            ], width:150
          },
        ],
        lst: [],
        total: 0,
        btn:[
          {
            label:'添加',
            auth:'user:create',
            click:()=>{
              this.form.cols.username.disabled = false;
              this.form.cols.password.rules=[
                { required: true, message: "请输入密码", trigger: "blur" },
                {
                  min: 5,
                  max: 15,
                  message: "长度在 5 到 15 个字符",
                  trigger: "change",
                },
              ]
              this.$refs.form.handle({});
            }
          },
        ],
      },
      search:{
        query:{},
        cols:[
          {type:'input',label:'名称',prop:'username',placeholder:'请输入名称'},
          {type:'date',prop:'date'},
        ],
      },
    };
  },
  created() {
    this.index();
  },
  methods: {
    index() {
      index(this.search.query)
        .then((response) => {
          const { data } = response;
          const { lst, total, rolelst} = data;
          this.table.lst = lst;
          this.table.total = total;
          this.form.cols.role.options=rolelst
        })
        .catch((error) => {
          console.log(error);
        });
    },
    pageChange(val) {
      this.search.query.page = val
      this.index()
    },
    submit(form) {
      const l = form.id ? update(form) : create(form);
      l.then((response) => {
        this.$message({
          type: 'success',
          message: response.msg
        });
        this.reload('global');
      }).catch((error) => {
        console.log(error);
      });
    },
    queryClick(query){
      this.search.query=query
      this.index()
    },
  },
};
</script>
<style scoped>
  .el-select {
    width: 100%
  }
</style>
