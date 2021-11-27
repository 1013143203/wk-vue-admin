<template>
  <div>
    <el-cascader :props="props"></el-cascader>
  </div>
</template>

<script>
  import { index } from "@/api/region";
  export default {
    name: "region",
    props: {
      value:[String, Array, Object],
    },
    data() {
      return {
        props: {
          lazy: true,
          lazyLoad (node, resolve) {
            console.log(node)
            var code = 0,type = 0;
            if (node.data){
              code = node.data.code
              type = ++node.data.type
            }
            index(code,type).then(response=>{
              const { data } = response;
              const nodes = data.map(item => ({
                  value:item.id,
                  label: item.short_name,
                  type: item.type,
                  code: item.code,
                  leaf: type >= 3
              }));
              console.log(nodes)
              // 通过调用resolve将子节点数据返回，通知组件数据加载完成
              resolve(nodes);
            })
          }
        },
        provinces:[],
        citys:[],
        areas:[],
        streets:[],
      }
    },
    watch:{
      value:{
        handler(val, oldVal){
          console.log(val)
          this.$nextTick(() => {
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
