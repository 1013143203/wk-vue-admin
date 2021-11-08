<template>
  <div>
    <el-button @click="upload">上传</el-button>
    <wk-uploader
      tenantId="1"
      target="file/chunk"
      ref="upload"
    ></wk-uploader>

  </div>
</template>

<script>
  import WkUploader from '@/components/WkUploader/Uploader.vue'
  export default {
    components: {
      WkUploader
    },
    data() {
      return {
      }
    },
    mounted() {
      // 文件选择后的回调
      this.$on('fileAdded', () => {
        console.log('文件已选择')
      });
      // 文件上传成功的回调
      this.$on('fileSuccess', () => {
        console.log('文件上传成功')
      });
    },
    methods: {
      upload() {
        this.$refs.upload.$emit('openUploader', {
          id: '1111'  // 传入的参数
        })
      }
    }
  }
</script>

<style lang="scss">

</style>
