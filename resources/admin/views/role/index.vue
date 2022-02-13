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
    <wk-edit-form ref="form"
      @submit="submit"
      :cols="form.cols"
      :data="form.data"></wk-edit-form>
  </div>
</template>
<script>
import { index, status, edit, del, update, create, permission, savePermission} from "@/api/role";
import { confirm } from "@/utils/message-box.js";
export default {
  inject:['reload'],
  data() {
    return {
      table: {
        cols: [
          {label:'ID', prop: "id" },
          {label:'角色', prop: "name" },
          {
            label:'状态',
            prop: "status",
            type: "switch" ,
            auth: "role:status" ,
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
            label:'操作',
            type: "btn",
            btn:[
              {
                label:'编辑',
                icon:"el-icon-edit",
                auth:'role:edit' ,
                click:(index , item)=>{
                  if (item.id) {
                    this.form.cols = this.form.option1
                    this.form.type = 1
                    edit(item.id)
                      .then((response) => {
                        const { data } = response;
                        this.form.data = {
                          name:data.name,
                          status:data.status,
                          id:item.id,
                        }
                      })
                      .catch((error) => {
                        console.log(error);
                      });
                  }
                },
                hidden:true
              },
              {
                label: "分配权限" ,
                icon:"el-icon-finished",
                auth:'role:permission',
                click:(index , item)=>{
                  this.form.cols = this.form.option2
                  this.form.type = 2
                  permission(item.id)
                    .then((response) => {
                      const { data } = response;
                      this.form.cols.permission.data = data.menus;
                      this.form.data = {}
                      this.form.data.permission = data.permission
                      this.form.data.id = item.id
                    })
                    .catch((error) => {
                      console.log(error);
                    });
                },hidden:true
              },
              {
                label: "删除" ,
                icon:"el-icon-delete",
                auth:'role:delete',
                click:(index , item)=>{
                  let fn = () => {
                    del(item.id).then((response) => {
                      this.$message({
                        type: 'info',
                        message: response.msg
                      });
                      this.reload("global");
                    }).catch((error) => {
                      console.log(error);
                    })
                  }
                  confirm("是否永久删除该数据？", fn);
                },hidden:true
              },
            ], width:300
          },
        ],
        lst: [],
        total: 0,
        btn:[
          {
            label:'添加',
            auth:'role:create',
            type:'primary',
            icon:'el-icon-plus',
            click:()=>{
              this.form.cols = this.form.option1
              this.form.type = 1
              this.form.data = {}
            }
          },
        ]
      },
      form:{
        type:1,
        cols:{},
        option2:{
          permission:{
            label: "权限",
            type: "tree",
            data: [],
          },
        },
        option1: {
          name:{
            type: "input",
            label: "角色", //字段
            placeholder: "请填写角色", //提示内容
            rules: [
              { required: true, message: "请输入角色", trigger: "blur" },
              {
                min: 3,
                max: 10,
                message: "长度在 3 到 10 个字符",
                trigger: 'blur',
              },
            ],
          },
          status:{
            label: "状态",
            type: "switch",
            active: 1,
            inactive: 2,
          },
        },
        data: {
          name: "",
          permission: [],
          status: 2,
        },
      },
      search:{
        query:{
        },
        cols:[
          {prop:'query',type:'input',label:'名称',placeholder:'请输入角色'},
          {prop:'date',type:'date'},
        ],
      },
    }
  },
  created() {
    this.index();
  },
  methods: {
    submit(form) {
      let l
      if ( this.form.type ==1 ){
        l = form.id ? update(form) : create(form);
      }else{
        l = savePermission(form);
      }
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
    queryClick(query){
      this.search.query=query
      this.index()
    },
  },
};
</script>
