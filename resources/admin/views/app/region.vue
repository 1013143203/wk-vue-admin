<template>
  <div class="app-container" >
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
            v-auth="'region'"
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
  import { index } from "@/api/region";
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
        type:0,
        code:0,
      }
    },
    created() {
      this.index();
    },
    methods: {
      load(tree, treeNode, resolve) {
        index(tree.code,++tree.type).then(response=>{
          const { data } = response;
          if (data && data.length > 0) {
            resolve(data);
          }
        })
      },
      index() {
        index(this.code,this.type).then(response=>{
          const { data } = response;
          this.table.lst = data
        })
      },
    }
  }
</script>

<style scoped>
</style>
