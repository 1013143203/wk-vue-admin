<template>
  <el-form inline v-if='isHandle'>
    <el-form-item v-for="(item, index) in btn" :key="index">
      <el-button
        class="pull-right"
        :key="`item.label${index}`"
        :type="item.type"
        @click="item.click()"
        v-auth="item.auth"
      >{{ item.label }}</el-button>
    </el-form-item>
  </el-form>
</template>

<script>
  export default {
    name: "table-btn",
    props:{
      isHandle:{
        type:Boolean,
        default:true
      },
      btn:{
        type:Array,
        default:()=>[]
      },
    }
  }
</script>
