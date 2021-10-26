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
          v-auth="'memberLevel:index'"
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
  import { index, status, edit, update, create ,del} from "@/api/member-level";
  import { confirm } from "@/utils/message-box.js";
  export default {
    name: "level",
    inject:['reload'],
    data() {
      return {
        form: {
          cols: {
            name:{
              type: "input",
              label: "名称", //字段
              prop: "name", //字段名
              placeholder: "请填写名称", //提示内容
              rules: [
                { required: true, message: "请输入名称", trigger: "change" },
                {
                  min: 2,
                  max: 10,
                  message: "长度在 2 到 10 个字符",
                  trigger: "change",
                },
              ],
            },
            level:{
              label: "等级",
              prop: "level",
              type: "number",
              rules: [
                { required: true, message: "请输入等级", trigger: "change" },
              ],
              min: 1,
              max: 10,
            },
            status:{
              label: "状态",
              prop: "status",
              type: "switch",
              active: 1,
              inactive: 2,
            },
          },
        },
        table: {
          cols: [
            {label:'ID', prop: "id" },
            {label:'名称', prop: "name" },
            {label:'等级', prop: "level" },
            {
              label:'状态',
              prop: "status",
              type: "switch" ,
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
                  label:'查看',
                  auth:'memberLevel:edit',
                  click:(index , item)=>{
                    const that = this;
                    if (item.id) {
                      edit(item.id)
                        .then((response) => {
                          const { data } = response;
                          this.form.cols.level.disabled = true;
                          that.$refs.form.handle(data);
                        })
                        .catch((error) => {
                          console.log(error);
                        });
                    }
                  },
                },
                {
                  label: "删除" ,type: "danger",auth:'memberLevel:delete',
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
              auth:'memberLevel:create',
              click:()=>{
                this.form.cols.level.disabled = false;
                this.$refs.form.handle({});
              }
            },
          ],
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
      pageChange(val) {
        this.search.query.page = val
        this.index()
      },
      queryClick(query){
        this.search.query=query
        this.index()
      },
      submit(form) {
        const l = form.id ? update(form) : create(form);
        l.then((response) => {
          this.$message({
            type: 'success',
            message: response.msg
          });
          this.reload();
        }).catch((error) => {
          console.log(error);
        });
      },
    }
  }
</script>

<style scoped>

</style>
