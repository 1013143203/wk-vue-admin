<template>
  <el-card class="show">
    <el-row :gutter="15">
      <el-table
        :data="lst"
        size="medium"
        @cell-click="cellClick"
        @row-click="rowClick"
        row-key="id"
        :default-expand-all="expands"
        v-if="refreshTable"
      >
        <!-- 是否多选 -->
        <el-table-column
          type="selection"
          v-if="options.mutiSelect"
        ></el-table-column>
        <!-- 是否展示序列号 -->
        <el-table-column
          type="index"
          v-if="options.isindex"
          :index="indexMethod"
        ></el-table-column>
        <template v-for="(v, k) in cols">
          <!-- 常规列数据 -->
          <el-table-column
            show-overflow-tooltip
            :label="v.label"
            :width="v.width"
            v-if="!v.type"
            :key="`v.label${k}`"
            :prop="v.prop"
            :formatter="v.formatter"
          >
          </el-table-column>
          <!-- icon -->
          <el-table-column
            show-overflow-tooltip
            :label="v.label"
            :width="v.width"
            v-if="v.type == 'icon'"
            :key="`v.label${k}`"
            :prop="v.prop"
          >
            <template slot-scope="scope" v-if="scope.row.icon">
              <i v-if="iconLoad(scope.row.icon,'el-icon')" :class="scope.row.icon + ' sub-el-icon'" />
              <i v-else-if="iconLoad(scope.row.icon,'fa fa-')" :class="scope.row.icon + ' sub-el-icon'" />
              <svg-icon :icon-class=scope.row.icon v-else/>
            </template>
          </el-table-column>
          <!-- 状态switch -->
          <el-table-column
            :label="v.label"
            :width="v.width"
            v-if="v.type == 'switch'"
            :key="`v.type${k}`"
          >
            <template slot-scope="scope">
              <el-switch
                :active-value="v.switchData.active"
                :inactive-value="v.switchData.inactive"
                v-model="scope.row.status"
                v-auth="v.auth ? v.auth : ''"
                v-if="!scope.row.hidden"
                @change="v.switch($event, scope.row.id)"
              >
              </el-switch>
            </template>
          </el-table-column>
          <!-- 图片数据列 -->
          <el-table-column
            :label="v.label"
            :width="v.width"
            v-if="v.type == 'image'"
            :key="`v.label${k}`"
          >
            <template slot-scope="scope" :formatter="v.format">
              <img
                class="cell-img"
                :src="scope.row[v.prop]"
                :formatter="v.format"
                alt=""
              />
            </template>
          </el-table-column>
          <!-- 处理type=btn，自定义按钮 -->
          <el-table-column
            :label="v.label"
            :width="v.width"
            v-if="v.type == 'btn'"
            :key="`v.type${k}`"
            fixed="right"
          >
            <!-- 处理自定义操作中的按钮 -->
            <template slot-scope="scope">
              <el-button
                v-for="(item, index) in v.btn"
                :key="`item.label${index}`"
                :size="item.size || 'mini'"
                class="operateLink"
                :type="item.type"
                v-auth="item.auth ? item.auth : ''"
                v-if="!(scope.row.hidden && item.hidden)"
                @click="item.click(scope.$index, scope.row)"
              >{{ item.label }}</el-button
              >
            </template>
          </el-table-column>
        </template>
      </el-table>
      <div class="block"  v-if="total > 0">
        <!--是否有分页-->
        <wk-pagination
          @pageChange="pageChange"
          :total="total"
          :currentPage="currentPage"
        >
        </wk-pagination>
      </div>
    </el-row>
  </el-card>
</template>

<script>

export default {
  name: "wk-table",
  props: {
    lst: {
      type: Array,
      default: () => [],
    },
    options: {
      type: Object,
      default: (data) => {
        return (data = {
          mutiSelect: false, //boolean 是否多选
          isindex: false, //boolean 是否展示序列号
          stripe: true, //boolean 斑马纹
          border: true, //boolean 纵向边框
          size: "medium", //String  medium / small / mini  table尺寸
          fit: true, //自动撑开
        });
      },
    },
    currentPage: {
      type: Number,
      default: 1,
    },
    total: {
      type: Number,
      default: 0,
    },
    cols: {
      type: Array,
      default: function () {
        return [];
      },
    },
    expand: {
      type: Boolean,
      default:false,
    },
  },
  watch:{
    expand:{
      handler(val, oldVal){
        this.refreshTable = false;
        this.$nextTick(() => {
          this.expands=val
          this.refreshTable = true;
        })
      },
      deep:true //true 深度监听
    }
  },
  data() {
    return {
      expands:false,
      refreshTable:true
    };
  },
  methods: {
    iconLoad(icon,c){
      if (icon){
        return icon.includes(c)
      }
    },
    cellClick(row, column, cell, event) {},
    rowClick(row, column, cell, event) {
      this.$emit("rowClick", row, column, cell, event);
    },
    // 序列号相关
    indexMethod(index) {
      return index + 1;
    },
    // 分页相关
    pageChange(val) {
      this.$emit("pageChange", val);
    },
  },
};
</script>
<style scoped>
  .sub-el-icon {
    color: currentColor;
    width: 1em;
    height: 1em;
  }
</style>
