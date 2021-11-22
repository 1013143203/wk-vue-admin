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
          v-auth="'role:index'"
          :total="table.total"
          :cols="table.cols"
          :lst="table.lst"
          @pageChange="pageChange"
        ></wk-table>
      </el-row>
    </el-card>
    <wk-edit-form
      ref="form"
      @submit="submit"
      :cols="form.cols"
      :data="form.data"
      @close="close"
    ></wk-edit-form>
  </div>
</template>
<script>
import { index, status, edit, update, create ,del} from "@/api/role";
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
                auth:'role:edit' ,
                click:(index , item)=>{
                  if (item.id) {
                    edit(item.id)
                      .then((response) => {
                        const { data } = response;
                        this.form.data.name = data.name;
                        this.form.data.status = data.status;
                        this.form.data.id = item.id;
                        this.form.data.permission=data.menu
                      })
                      .catch((error) => {
                        console.log(error);
                      });
                  }
                },
                hidden:true
              },
              {label: "删除" ,type: "danger" , auth:'role:delete',
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
            ], width:150
          },
        ],
        lst: [],
        total: 0,
        btn:[
          {
            label:'添加',
            auth:'role:create',
            click:()=>{
              this.form.data = {};
            }
          },
        ]
      },
      form: {
        cols: {
          name:{
            type: "input",
            label: "角色", //字段
            prop: "name", //字段名
            placeholder: "请填写角色名", //提示内容
            rules: [
              { required: true, message: "请输入角色名", trigger: "blur" },
              {
                min: 3,
                max: 10,
                message: "长度在 3 到 10 个字符",
                trigger: 'blur',
              },
            ],
          },
          permission:{
            label: "权限",
            prop: "permission",
            type: "tree",
            data: [],
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
          name: "",
          permission: [],
          status: 2,
          id:0
        },
      },
      search:{
        query:{
        },
        cols:[
          {type:'input',label:'角色',prop:'name',placeholder:'请输入角色'},
          {type:'date',prop:'date'},
        ],
      },
    }
  },
  created() {
    this.index();
  },
  methods: {
    close(){
        this.$refs.form.$refs.permission[0].setCheckedKeys([])
    },
    index() {
      index(this.search.query)
        .then((response) => {
          const { data } = response;
          const { lst, total , permission} = data;
          this.table.lst = lst;
          this.table.total = total;

          this.form.cols.permission.data= permission;
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
