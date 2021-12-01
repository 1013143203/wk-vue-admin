<template>
  <div>
    <el-cascader
      :props="props"
      :options="options"
      v-model="currentArr"
      v-if="cascaderShow"
      @change = 'change'
      clearable
    ></el-cascader>
  </div>
</template>

<script>
  import { index, loadProvince } from "@/api/region";
  export default {
    name: "region",
    props: {
      value:Object,
  // {
  //   pid:4,
  //     cid:21,
  //   aid:276,
  //   sid:3806,
  // }
    },
    data() {
      return {
        cascaderShow:false,
        currentArr:[],
        options: [],
        props: {
          lazy: true,
          lazyLoad (node, resolve) {
            if (node.level > 0 ) {
              index(node.data.code,node.level).then(response=>{
                const { data } = response;
                // 通过调用resolve将子节点数据返回，通知组件数据加载完成
                resolve(data);
              })
            }
          },
          value:'id',
          label:'short_name'
        },
      }
    },
    methods:{
      async getProvince() {//获取1级省列表
        let that = this
        let { data, code } = await loadProvince(this.value);
        if (code === 200) {
          that.$set(that, 'options',data)
        }
      },
      change(value){
        let obj = {}
        if(value[0]){
          obj.pid = value[0]
        }
        if(value[1]){
          obj.cid = value[1]
        }
        if(value[2]){
          obj.aid = value[2]
        }
        if(value[3]){
          obj.sid = value[3]
        }
        this.$emit('current',obj)
      }
    },
    watch:{
      value:{
        handler(val, oldVal){
          this.cascaderShow = false
          this.$nextTick(() => {
            if (val){
              if (val.pid){
                this.currentArr.push(val.pid)
              }
              if (val.cid){
                this.currentArr.push(val.cid)
              }
              if (val.aid){
                this.currentArr.push(val.aid)
              }
              if (val.sid){
                this.currentArr.push(val.sid)
              }
            }else{
              this.currentArr = []
            }
            this.getProvince()
            this.cascaderShow = true
          })

        },
        deep:true //true 深度监听
      }
    },
  }
</script>

<style scoped>
  .el-cascader--medium{
    width: 100%;
  }
</style>
