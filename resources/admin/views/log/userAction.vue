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
        @pageChange="pageChange"
        ref="table"
      ></wk-table>
    </el-card>
  </div>
</template>

<script>
  import { userAction } from "@/api/log";
  export default {
    name: "index",
    data() {
      return {
        table: {
          cols: [
            {label:'操作用户', prop: "user_name"},
            {label:'日志标题', prop: "title"},
            {label:'URL地址', prop: "url"},
            {label:'请求方式', prop: "method" },
            {label:'参数', prop: "params",width:200},
            {label:'IP', prop: "ip" },
            {label:'操作时间', prop: "created_at" },
          ],
          lst: [],
          total: 0,
        },
        search:{
          query:{
          },
          cols: {
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
        userAction(this.search.query)
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
        this.search.query = query
        this.index()
      },
      pageChange(val) {
        this.search.query.page = val
        this.index()
      },
    }
  }
</script>

<style scoped>

</style>
