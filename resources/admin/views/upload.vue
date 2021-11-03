<template>
  <div>
    <el-upload
      action="#"
      list-type="picture-card"
      :on-preview="handlePictureCardPreview"
      :on-remove="handleRemove"
      :file-list="fileList"
      multiple
      :http-request="handleUploadRequest"
      :on-success="handleSuccess"
      :on-error="handleError"
      :on-progress="handleProgress"
    >
      <i class="el-icon-plus"></i>
    </el-upload>
    <el-progress :text-inside="true" :stroke-width="20" :percentage="progressNum" v-if="progressNum>0"></el-progress>
    <el-dialog :visible.sync="dialogVisible">
      <img width="100%" :src="dialogImageUrl" alt="">
    </el-dialog>
  </div>
</template>

<script>
  import { initUpload } from "@/utils/upload.js";
  export default {
    name: "upload",
    data() {
      return {
        fileList:[],
        dialogImageUrl: '',
        dialogVisible: false,
        uploadList:[],
        progressNum:0,
      };
    },
    created() {
      this.fileList= [{name: 'food.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}, {name: 'food2.jpeg', url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}]
    },
    watch: {
      uploadList (uploadList) {
        this.$nextTick(() => {
          this.dealUpload()
        })
      }
    },
    methods: {
      dealUpload(){
        initUpload({
          files: this.uploadList,
          pieceSize: 5,
          progress: (num) => {
            this.progress = '上传进度' + num + '%'
          },
          success: (data) => {
            this.progressNum = false
            this.$emit('uploaded', data)
          },
          error: (e) => {
          }
        })
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handleUploadRequest (back) {
        this.uploadList.push(back.file)
      },
      handlePictureCardPreview(file) {
        this.dialogImageUrl = file.url;
        this.dialogVisible = true;
      },
      handleSuccess(response, file, fileList){
        console.log(response, file, fileList)
      },
      handleError(err, file, fileList){

      },
      handleProgress(event, file, fileList){

      },
    }
  }
</script>

<style scoped>

</style>
