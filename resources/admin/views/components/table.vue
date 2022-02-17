<template>
  <div slot="header" class="clearfix">
    <el-row class="table-tool" style="padding: 5px 0;">
      <el-col :span="1.5" :key="index" v-for="(item,index) in table.btn">
        <el-button @click="item.click()" v-auth="item.auth?item.auth:''" size="mini" :type="item.type" :icon="item.icon" plain>{{ item.label }}</el-button>
      </el-col>
      <div class="tool">
        <div class="item">
          <el-button size="mini" icon="el-icon-refresh-right" round circle @click="getTable()"></el-button>
        </div>
        <el-popover
          placement="top"
          width="160"
          v-model="popoverVisible">
          <div class="table-tool-column"></div>
          <el-checkbox
            v-model="cols.all"
            @change="(val) => colsChange(val,'all')"
            :indeterminate="cols.isIndeterminate"
          >全选</el-checkbox>
          <el-divider></el-divider>
          <el-checkbox-group
            v-model="cols.data"
            @change="(value) => colsChange(value)"
          >
            <draggable  filter=".move" @end="toolColumnSort" animation="300" >
              <div class="colsbox" v-for="col in cols.lst" :key="col.label">
                <div class="table-tool-column" :class="(col.type=='btn'?'move':'')">::</div>
                <el-checkbox :label="col.label" :key="col.label">{{col.label}}</el-checkbox>
              </div>
            </draggable>
          </el-checkbox-group>
          <div class="item" slot="reference">
            <el-button size="mini" icon="el-icon-s-operation" round circle></el-button>
          </div>
        </el-popover>
      </div>
    </el-row>
    <el-row :gutter="15">
      <el-table
        :data="lst"
        size="medium"
        @cell-click="cellClick"
        @row-click="rowClick"
        row-key="id"
        ref="dragTable"
        :default-expand-all="expands"
        v-if="refreshTable && cols.lst.length > 0 "
      >
        <template v-for="(v, k) in cols.lst">
          <!-- 是否多选 -->
          <el-table-column
            type="selection"
            :key="`col_${k}`"
            v-if="options.mutiSelect && v.type == 'mutiSelect' && v.show"
          ></el-table-column>
          <!-- 常规列数据 -->
          <el-table-column
            :label="v.label"
            :width="v.width"
            v-if="!v.type && v.show"
            :key="`col_${k}`"
            :prop="v.prop"
            :formatter="v.formatter"
          >
          </el-table-column>
          <!-- icon -->
          <el-table-column
            :label="v.label"
            :width="v.width"
            v-if="v.type == 'icon' && v.show"
            :key="`col_${k}`"
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
            v-if="v.type == 'switch' && v.show"
            :key="`col_${k}`"
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
            v-if="v.type == 'image' && v.show"
            :key="`col_${k}`"
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
            v-if="v.type == 'btn' && v.show"
            :key="`col_${k}`"
            fixed="right"
          >
            <!-- 处理自定义操作中的按钮 -->
            <template slot-scope="scope">
              <el-link
                v-for="(item, index) in v.btn"
                :key="`item.label${index}`"
                type="primary"
                :icon="item.icon"
                v-auth="item.auth ? item.auth : ''"
                v-if="!(scope.row.hidden && item.hidden)"
                :underline="false"
                @click="item.click(scope.$index, scope.row)"
              >{{ item.label }}</el-link>
            </template>
          </el-table-column>
        </template>
      </el-table>
      <div class="block"  v-if="table.total > 0">
        <!--是否有分页-->
        <wk-pagination
          @pageChange="pageChange"
          :total="table.total"
          :currentPage="currentPage"
        >
        </wk-pagination>
      </div>
    </el-row>
  </div>
</template>

<script>
  import draggable from 'vuedraggable'
  import Sortable from 'sortablejs';
  export default {
    name: "wk-table",
    components: { draggable },
    props: {
      table:{
        type:Object,
        default:()=>{}
      },
      btn:{
        type:Array,
        default:()=>[]
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
      },
      table:{
        handler(val, oldVal){
          let data = [],cols = val.cols
          cols = [{label:'列选项',type:'mutiSelect'}].concat(cols)
          for (let item of cols) {
            item.show = true
            data.push(item.label);
          }
          this.cols.data = data;
          this.cols.lst = cols
          this.lst = val.lst

        },
        deep:true //true 深度监听
      },
      cols:{
        handler(val, oldVal){
          if (val.lst.length){
            const that = this
            this.$nextTick(() => {
              this.columnDrop(that)
            })
          }
        },
        deep:true //true 深度监听
      }
    },
    mounted(){
    },
    data() {
      return {
        cols:{
          data:[],
          lst:[],
          all: true,
          isIndeterminate:false,
        },
        lst:[],
        currentPage:1,
        expands:false,
        refreshTable:true,
        popoverVisible:false,
        options: {
          mutiSelect: true, //boolean 是否多选
          isindex: false, //boolean 是否展示序列号
          stripe: true, //boolean 斑马纹
          border: true, //boolean 纵向边框
          size: "medium", //String  medium / small / mini  table尺寸
          fit: true, //自动撑开
        },
      };
    },
    methods: {
      toolColumnSort(evt){
        evt.preventDefault();
        const $colsLst = this.cols.lst
        const $lst = this.lst
        this.columnSort(this,evt,$colsLst,$lst)
      },
      toolColumnMove(evt){
        if (evt.relatedContext.element.type == 'btn') return false;
        return true;
      },
      columnDrop(that){
        const wrapperTr = that.$refs.dragTable.$el.querySelector('.el-table__header-wrapper tr')
        const $colsLst = that.cols.lst
        const $lst = that.lst

        Sortable.create(wrapperTr, {
          animation: 180,
          delay: 0,
          onEnd: evt => {
            that.columnSort(that,evt,$colsLst,$lst)
          }
        });
      },
      columnSort(that,evt,$colsLst,$lst){
        const oldItem = $colsLst[evt.oldIndex];
        $colsLst.splice(evt.oldIndex, 1);
        $colsLst.splice(evt.newIndex, 0, oldItem);
        that.lst = that.cols.lst = [];
        setTimeout(() => {
          that.cols.lst = $colsLst
          that.lst = $lst
        }, 5);
      },
      colsChange(val,flag=''){
        let data = []
        if (flag=='all'){
          if (val){
            for (let item of this.cols.lst) {
              item.show = true
              data.push(item.label);
            }
          }else{
            for (let item of this.cols.lst) {
              item.show = false
            }
          }
          this.cols.isIndeterminate = false;
        }else{
          data = val;
          let length = this.cols.lst.length
          let checkedCount = val.length;
          for (let item of this.cols.lst){
            item.show = val.indexOf(item.label) > -1
          }
          this.cols.all = checkedCount === length;
          this.cols.isIndeterminate = checkedCount > 0 && checkedCount < length;
        }

        this.cols.data = data
      },
      getTable(){
        this.$parent.$parent.index()
      },
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
        this.currentPage = val
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
  .el-link+.el-link{
    margin-left: 10px;
  }
  .table-tool .el-col{
    float: left;
    margin-right: 6px;
  }
  .table-tool .tool{
    float: right;
  }
  .table-tool .tool .item{
    display: inline-block;
    margin-left: 6px;
  }
  .el-divider{
    margin: 10px 0;
  }
  .colsbox{
    margin-top: 6px;
  }
  .table-tool-column{
    width: 20px;display: inline-block;font-size: 14px;color: #606266;cursor:move;
  }
</style>
