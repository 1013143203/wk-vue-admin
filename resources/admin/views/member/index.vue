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
          v-auth="'member:index'"
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
  import { index ,update ,edit } from "@/api/member";
  export default {
    name: "index",
    data() {
      return {
        form: {
          cols: {},
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
                    const that = this;
                    if (item.id) {
                      edit(item.id)
                        .then((response) => {
                          const { data } = response;
                          that.$refs.form.handle(data);
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
          cols:[
            {type:'input',label:'名称',prop:'query',placeholder:'请输入名称'},
            {type:'date',prop:'date'},
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
      submit(form) {
        update(form).then((response) => {
          this.$message({
            type: 'success',
            message: response.msg
          });
          this.reload('global');
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
