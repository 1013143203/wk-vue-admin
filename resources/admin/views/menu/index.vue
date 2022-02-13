<template>
  <div class="app-container" >
    <el-card class="show">
      <wk-search
        :query = "search.query"
        :cols = "search.cols"
        @queryClick="queryClick"
      ></wk-search>
      <wk-table
        :table="table"
        ref="table"
      ></wk-table>
    </el-card>
    <edit-form ref="edit" :data="formData" :menus_types="menus_types" :category="category" :menus_nodes="menus_nodes"></edit-form>
  </div>
</template>
<script>
import { index, status, edit ,del, loadedit } from "@/api/menu";
import editForm from "./components/edit-form";
import { confirm } from "@/utils/message-box.js";
export default {
  inject:['reload'],
  components: {editForm},
  data() {
    return {
      table: {
        cols: [
          {label:'菜单名称', prop: "label"},
          {label:'图标', prop: "icon" ,type: "icon"},
          {label:'类型', prop: "type_" },
          {label:'菜单地址', prop: "path"},
          {label:'权限标识', prop: "permission"},
          {
            label:'状态',
            prop: "status",
            type: "switch" ,
            auth: "menu:status" ,
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
                auth:'menu:edit',
                click:(index , item)=>{
                  this.loadedit()
                  edit(item.id).then((response) => {
                    const { data } = response;
                    this.formData = data
                  })
                  .catch((error) => {
                    console.log(error);
                  });
                }
              },
              {
                label: "删除" ,icon:"el-icon-delete" , auth:'menu:delete',
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
                }
              },
              {
                label: "添加" ,
                icon: "el-icon-plus" ,
                auth:'menu:create',
                click:(index , item)=>{
                  const obj={}
                  if(item){
                    this.loadedit()
                    obj.permission=item.permission
                    obj.pid=item.id
                  }
                  this.formData = obj
                },
                hidden:true
              }
            ], width:250
          },
        ],
        lst: [],
        total: 0,
        btn:[
          {
            label:'添加',
            type:'primary',
            icon:'el-icon-plus',
            auth:'menu:create',
            click:()=>{
              this.loadedit()
              this.formData = {}
            }
          },
          {
            label: "全部展开" ,
            auth:'menu:expandAll',
            click:()=>{
              this.table.expand = true
            }
          },
          {
            label: "全部折叠" ,
            auth:'menu:foldAll',
            click:()=>{
              this.table.expand = false
            }
          }
        ],
        expand:false
      },
      search:{
        query:{
        },
        cols:[
          {prop:'query',type:'input',label:'名称',placeholder:'请输入菜单名称'},
        ],
      },
      menus_nodes:[],
      menus_types:[],
      category:[],
      formData:{},
    }
  },
  created() {
    this.index();
  },
  methods: {
    loadedit(){
      loadedit()
        .then((response) => {
          const { data } = response;
          const { menus_nodes, menus_types ,category } = data;
          this.menus_nodes = menus_nodes;
          this.menus_types = menus_types;
          this.category = category;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    index() {
      index(this.search.query)
        .then((response) => {
          const { data } = response;
          this.table.lst = data;
        })
        .catch((error) => {
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
