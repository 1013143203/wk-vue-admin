<template>
  <div class="app-container" >
    <wk-search
      :query = "search.query"
      :cols = "search.cols"
      @queryClick="queryClick"
    ></wk-search>
    <el-card class="show">
      <el-row :gutter="15">
        <div id="tableList">
          <el-table
            :data="table.lst"
            size="medium"
            row-key="code"
            v-if="table.refreshTable"
            lazy
            :load="load"
            v-auth="'city'"
          >
            <template v-for="(v, k) in table.cols">
              <el-table-column
                show-overflow-tooltip
                :label="v.label"
                :width="v.width"
                :key="`v.label${k}`"
                :prop="v.prop"
              >
                <template  slot-scope="scope">
                <span v-if="v.prop=='level_name'">
                  <el-tag :color="scope.row.color" effect="dark" size="mini" :hit="false">
                    {{scope.row[v.prop]}}
                  </el-tag>
                </span>
                <span v-else>
                  {{scope.row[v.prop]}}
                </span>
                </template>
              </el-table-column>
            </template>
          </el-table>
        </div>
      </el-row>
    </el-card>
  </div>
</template>

<script>
  import { index } from "@/api/city";
    export default {
      data() {
        return {
          table: {
            cols: [
              {label:'城市名称', prop: "name"},
              {label:'城市级别', prop: "level_name"},
              {label:'城市编码', prop: "code"},
              {label:'简称', prop: "short_name"},
              {label:'经度', prop: "lng"},
              {label:'纬度', prop: "lat"},
            ],
            refreshTable:true,
            lst:[]
          },
          search:{
            query:{
              level:1,
            },
            cols:[
              {
                type:'select',
                prop:'level',
                options:[
                  {label:'省',value:1},
                  {label:'市',value:2},
                  {label:'区',value:3},
                  {label:'镇/街',value:4}
                ],
                change:(res)=>{
                  this.search.query.level = res
                }
              },
              {type:'input',prop:'name',label:'名称'},
            ],
          },
        }
      },
      created() {
        this.index();
      },
      methods: {
        load(tree, treeNode, resolve) {
          this.search.query.level=tree.level
          this.search.query.pid=tree.code
          delete this.search.query.name
          index(this.search.query).then(response=>{
            const { data } = response;
            if (data && data.length > 0) {
              resolve(data);
            }
          })
        },
        index() {
          delete this.search.query.code
          index(this.search.query).then(response=>{
            const { data } = response;
            this.table.lst = data
          })
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
