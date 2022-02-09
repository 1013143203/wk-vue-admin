<template>
  <div class="app-container" >
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
      <wk-table
        v-auth="'crontab:index'"
        :total="table.total"
        :cols="table.cols"
        :lst="table.lst"
        :options="table.options"
        ref="table"
      ></wk-table>
    </el-card>
    <edit-form :data="form.data" ref="edit" ></edit-form>
  </div>
</template>

<script>
  import { index, status, edit } from "@/api/crontab";
  import editForm from "./components/edit-form";
  export default {
    name: "crontab",
    components: {
      editForm
    },
    data() {
      return {
        table: {
          cols: [
            {label:'任务', prop: "name"},
            {label:'周期', prop: "status"},
            {label:'保存数量', prop: "status"},
            {label:'上次执行时间', prop: "status"},
            {
              label:'状态',
              prop: "status",
              type: "switch" ,
              auth: "crontab:status" ,
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
                  auth:'crontab:edit',
                  click:(index , item)=>{
                    edit(item.id).then((response) => {
                      const { data } = response;
                      this.form.data = data
                    })
                      .catch((error) => {
                        console.log(error);
                      });
                  }
                },
                {label: "删除" ,icon:"el-icon-delete" , auth:'menu:delete'},
              ], width:250,
            },
          ],
          lst: [],
          total: 0,
          btn:[
            {
              label:'添加',
              auth:'crontab:create',
              click:()=>{
                this.form.data = {}
              }
            },
          ],
        },
        search:{

        },
        form: {
          cols: {
            sType:{
              label: "任务类型",
              prop: "sType",
              type: "select",
            },
            name:{
              type: "input",
              disabled:false,
              label: "任务名称", //字段
              prop: "name", //字段名
              placeholder: "请填写任务名称", //提示内容
              rules: [
                { required: true, message: "请输入任务名称", trigger: "blur" },
              ],
            },
            tType:{
              prop: "tType",
              type: "select",
            },
            week:{
              prop: "week",
              type: "select",
            },
            tt:{
              prop: "tType",
              type: "select",
              options: [],
            },
            ss:{
              prop: "tType",
              type: "select",
              options: [],
            },
          },
          data:{}
        }
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
      queryClick(query){
        this.search.query=query
        this.index()
      },
    }
  }
</script>

<style scoped>

</style>
