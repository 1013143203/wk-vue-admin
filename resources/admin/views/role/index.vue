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
          :total="table.total"
          :cols="table.cols"
          :lst="table.lst"
          @pageChange="pageChange"
        ></wk-table>
      </el-row>
    </el-card>
    <edit-form ref="edit" :data="formData" :permission="permission"></edit-form>
  </div>
</template>
<script>
import { index, status, edit, del} from "@/api/role";
import { confirm } from "@/utils/message-box.js";
import editForm from "../role/components/edit-form";
export default {
  inject:['reload'],
  components: {editForm},
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
                        this.formData = {
                          name:data.name,
                          status:data.status,
                          id:item.id,
                          permission:data.menu,
                        }
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
              this.formData = {};
            }
          },
        ]
      },
      search:{
        query:{
        },
        cols:[
          {prop:'query',type:'input',label:'名称',placeholder:'请输入角色'},
          {prop:'date',type:'date'},
        ],
      },
      permission:[],
      formData: {
        name: "",
        permission: [],
        status: 2,
        id:0
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
          const { lst, total , permission} = data;
          this.table.lst = lst;
          this.table.total = total;

          this.permission = permission;
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
