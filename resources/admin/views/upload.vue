<template>
  <div class="app-container">
    <div class="source">
      <div>
        <ul class="el-upload-list el-upload-list--picture-card">
          <li tabindex="0" class="el-upload-list__item is-ready">
            <div>
              <img src="blob:https://element.eleme.cn/e67968a5-14b6-47ba-b010-f9d889bd2090" alt="" class="el-upload-list__item-thumbnail">
              <span class="el-upload-list__item-actions"><span class="el-upload-list__item-preview"><i class="el-icon-zoom-in"></i></span>
                <span class="el-upload-list__item-delete">
                  <i class="el-icon-download"></i>
                </span> <span class="el-upload-list__item-delete">
                  <i class="el-icon-delete"></i>
                </span>
              </span>
            </div>
          </li>
        </ul>
      </div>
    </div>
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
  import { index } from '@/api/upload'
  export default {
    components: {
      WkUploader
    },
    data() {
      return {
      }
    },
    created() {

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
           // 传入的参数
        })
      }
    }
  }
</script>

<style lang="scss">

</style>
