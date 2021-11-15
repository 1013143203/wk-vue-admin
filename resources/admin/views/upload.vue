<template>
  <div class="app-container">
    <el-card class="show">
      <div slot="header" class="clearfix">
        <div class="ces-search">
          <el-button @click="upload">上传</el-button>
        </div>
      </div>
      <div class="source">
        <ul class="el-upload-list el-upload-list--picture-card">
          <li v-for="(item,index) in lst" :tabindex="index" class="el-upload-list__item is-ready" style="border: 0">
            <img :src="item.thumb" alt="" class="el-upload-list__item-thumbnail">
            <span class="el-upload-list__item-actions">
              <span class="el-upload-list__item-preview">
                <i class="el-icon-zoom-in" @click="preview(item)"></i>
              </span>
              <span class="el-upload-list__item-delete">
                <i class="el-icon-position" @click="select(item)"></i>
              </span>
              <span class="el-upload-list__item-delete">
                <i class="el-icon-delete"></i>
              </span>
            </span>
          </li>
        </ul>
      </div>
    </el-card>
    <el-dialog
      :title="dialog.name"
      :visible.sync="centerDialogVisible"
      center
    >
      <div v-if="type=='video'">
        <video :src="dialog.url" style="width: 100%;height: 100%"></video>
      </div>
      <div v-else>
        <img :src="dialog.url" alt="" style="width: 100%;height: 100%">
      </div>

    </el-dialog>
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
  import video_thumb from '../assets/upload/video.png'
  import file_thumb from '../assets/upload/file.png'
  export default {
    components: {
      WkUploader
    },
    props: {
      type: String,
    },
    data() {
      return {
        dialog:{
          url:'',
          name:''
        },
        lst:[],
        centerDialogVisible: false,
        query:{},
        total:0
      }
    },
    created() {
      this.index();
    },
    methods: {
      index() {
        index(this.query)
          .then((response) => {
            const { data } = response;
            const { lst, total } = data;
            if (this.type == 'video'){
              lst.map(function(item){
                item.thumb = video_thumb
              })
            }else if (this.type == 'file'){
              lst.map(function(item){
                item.thumb = file_thumb
              })
            }

            this.lst = lst;
            this.total = total;
          })
          .catch((error) => {
            console.log(error);
          });
      },
      upload() {
        this.$refs.upload.$emit('openUploader', {
           // 传入的参数
        })
      },
      preview(item){
        this.centerDialogVisible=true
        this.dialog = item
      },
      select(item){

      },
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
  }
</script>

<style lang="scss">

</style>
