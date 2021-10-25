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
  </div>
</template>

<script>
  import { index, status, edit, update, create ,del} from "@/api/member-level";
  export default {
    name: "level",
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
            {label:'等级', prop: "level" },
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
      queryClick(query){
        this.search.query=query
        this.index()
      },
    }
  }
</script>

<style scoped>

</style>
