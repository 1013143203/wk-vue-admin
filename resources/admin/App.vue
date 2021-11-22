<template>
  <div id="app">
    <router-view v-if="isRouterAlive" />
  </div>
</template>

<script>
export default {
  name: 'App',
  provide (){
    return {
      reload:this.reload
    }
  },
  data(){
    return {
      isRouterAlive:true
    }
  },
  methods:{
    //global全局local本页面
    reload (type='local'){
      if(type=='local'){
        this.isRouterAlive = false
        this.$nextTick(function(){
          this.isRouterAlive = true
        })
      }else{
        setTimeout(() => {
          location.reload();
        }, 500);
      }
    }
  }
}
</script>
