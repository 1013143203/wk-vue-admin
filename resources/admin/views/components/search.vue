<!-- 搜索表单 -->
<template>
  <div slot="header" class="clearfix">
    <div class="ces-search">
      <el-form inline :model="query" class="demo-form-inline">
        <el-form-item v-for='(item,index) in cols' :label="item.label" :key='index'>
          <!-- 输入框 -->
          <el-input v-if="item.type==='input'" v-model="query[index]" ></el-input>
          <!-- 下拉框 -->
          <el-select v-if="item.type==='select'" v-model="query[index]" @change="item.change(query[index])">
            <el-option v-for="op in item.options" :label="op.label" :value="op.value" :key="op.value"></el-option>
          </el-select>
          <!-- 单选 -->
          <el-radio-group v-if="item.type==='radio'" v-model="query[index]">
            <el-radio v-for="ra in item.radios" :label="ra.value" :key="ra.value">{{ra.label}}</el-radio>
          </el-radio-group>
          <!-- 复选框 -->
          <el-checkbox-group v-if="item.type==='checkbox'" v-model="query[index]" >
            <el-checkbox v-for="ch in item.checkboxs" :label="ch.value" :key="ch.value">{{ch.label}}</el-checkbox>
          </el-checkbox-group>
          <!-- 日期 -->
          <el-date-picker
            v-if="item.type==='date'"
            v-model="query[index]"
            type="daterange"
            range-separator="至"
            start-placeholder="开始日期"
            end-placeholder="结束日期"
            value-format="yyyy-MM-dd"
          >
          </el-date-picker>
          <!-- 开关 -->
          <el-switch v-if="item.type==='switch'" v-model="query[index]" ></el-switch>
        </el-form-item>
        <el-form-item v-for='item in searchClick' :key="item.label">
          <el-button :type="item.type" @click='item.click()'>{{item.label}}</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script>
  export default {
    name:'wk-search',
    props:{
      labelWidth:{
        type:String,
        default:'100px'
      },
      cols:{
        type:Array,
        default:()=>[]
      },
      query:{
        type:Object,
        default:()=>{}
      },
    },
    data () {
      return {
        searchClick:[
          {label:'查询',type:'primary',click:()=>{
              this.query.page = 1
              this.$emit("queryClick", this.query);
          }},
          {label:'重置',type:'primary',click:()=>{
              this.$emit("queryClick", {});
          }}
        ]
      };
    },
  }

</script>
<style>

</style>
