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
import { index, status, edit, update, create, del, loadedit } from "@/api/user";
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
            placeholder: "请填写用户名", //提示内容
            rules: [
              { required: true, message: "请输入用户名", trigger: "blur" },
              {
                min: 5,
                max: 10,
                message: "长度在 5 到 10 个字符",
                trigger: 'blur',
              },
            ],
          },
          password:{
            label: "密码",
            type: "password",
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
          role:{
            label: "角色",
            type: "select",
            multiple: true,
            options: [],
          },
          status:{
            label: "状态",
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
            auth:'user:ee',
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
                icon:"el-icon-edit",
                click:(index , item)=>{
                  const that = this;
                  if (item.id) {
                    this.loadedit()
                    edit(item.id)
                      .then((response) => {
                        const { data } = response;
                        this.form.cols.username.disabled = true;
                        this.form.data = {
                          id:item.id,
                          role:data.role,
                          status:data.status,
                          username:data.username,
                        }
                        this.form.cols.password.rules=[]
                      })
                      .catch((error) => {
                        console.log(error);
                      });
                  }
                },
                hidden:true
              },
              {label: "删除" ,icon:"el-icon-delete",auth:'user:delete',
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
            type:'primary',
            icon:'el-icon-plus',
            auth:'user:create',
            click:()=>{
              this.loadedit()
              this.form.cols.username.disabled = false;
              this.form.cols.password.rules=[
                { required: true, message: "请输入密码", trigger: "blur" },
                {
                  min: 5,
                  max: 15,
                  message: "长度在 5 到 15 个字符",
                  trigger: 'blur',
                },
              ]
              this.form.data = {}
            }
          },
        ],
      },
      search:{
        query:{},
        cols: {
          query: {type: 'input', label: '名称', placeholder: '请输入名称'},
          date: {type: 'date'},
        },
      },
    };
  },
  created() {
    this.index();
  },
  methods: {
    loadedit(){
      loadedit()
        .then((response) => {
          const { data } = response;
          this.form.cols.role.options = data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
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
