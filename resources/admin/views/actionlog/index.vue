<template>
  <div class="app-container" >
    <wk-search
      :query = "search.query"
      :cols = "search.cols"
      @queryClick="queryClick"
    ></wk-search>
    <wk-table
      v-auth="'actionlog'"
      :total="table.total"
      :currentPage="search.query.page"
      :cols="table.cols"
      :lst="table.lst"
      @pageChange="pageChange"
      ref="table"
    ></wk-table>
  </div>
</template>

<script>
  import { index } from "@/api/actionlog";
  export default {
    name: "index",
    data() {
      return {
        table: {
          cols: [
            {label:'操作用户', prop: "username"},
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
          cols:[
            {prop:'date',type:'date'},
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
