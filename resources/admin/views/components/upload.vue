<template>
  <div>
    <el-input placeholder="请选择文件" :value="values.length==1?values[0].name:'已选'+ values.length +'个文件'" readonly>
      <el-button slot="append" @click="chooseClick">选择</el-button>
    </el-input>
    <div class="demo-image__preview">
      <el-image
        style="width: 100px; height: 100px;margin: 0 2px;border-radius: 5px"
        v-for="(item,index) in values"
        :src="item.thumb"
        :key="index"
        v-if="values.length>0"
      >
        <div slot="placeholder" class="image-slot">
          加载中<span class="dot">...</span>
        </div>
      </el-image>
    </div>

    <el-dialog
      :visible.sync="lstVisible"
      center
      width="60%"
      :append-to-body='true'
    >
      <el-card class="show">
        <div slot="header" class="clearfix">
          <div class="ces-search">
            <el-button @click="openUploader">上传</el-button>
          </div>
        </div>
        <div class="source">
          <ul class="el-upload-list el-upload-list--picture-card">
            <li v-for="(item,index) in lst" :tabindex="index" class="el-upload-list__item is-ready" style="border: 0;width: 100px;height: 100px">
              <img :src="item.thumb" alt="" class="el-upload-list__item-thumbnail">
              <span class="el-upload-list__item-actions">
                <span class="el-upload-list__item-preview">
                  <i class="el-icon-zoom-in" @click="preview(item)"></i>
                </span>
                <span class="el-upload-list__item-delete">
                  <i class="el-icon-position" @click="current(item)"></i>
                </span>
                <span class="el-upload-list__item-delete">
                  <i class="el-icon-delete"></i>
                </span>
              </span>
            </li>
          </ul>
          <wk-pagination
            :currentPage="query.page"
            :total="total"
            @pageChange="pageChange"
          ></wk-pagination>
        </div>
      </el-card>
      <wk-uploader
        target="files/chunk"
        ref="upload"
        @fileSuccess="fileSuccess"
      ></wk-uploader>
    </el-dialog>
    <el-dialog
      :title="dialog.name"
      :visible.sync="detailVisible"
      center
      :append-to-body='true'
    >
      <div v-if="type=='video'">
        <video :src="dialog.url" style="width: 100%;height: 100%"></video>
      </div>
      <div v-else>
        <img :src="dialog.url" alt="" style="width: 100%;height: 100%">
      </div>

    </el-dialog>

  </div>
</template>

<script>
  import WkUploader from '@/components/WkUploader/Uploader.vue'
  import { index } from '@/api/upload'
  import video_thumb from '../../assets/upload/video.png'
  import file_thumb from '../../assets/upload/file.png'
  export default {
    components: {
      WkUploader
    },
    watch:{
      value:{
        handler(val, oldVal){
          this.$nextTick(() => {
            this.values = []
            if(!val || val == null || val == undefined) return

            if (Array.isArray(val)){
              this.values = val
            }else{
              if (val != null){
                if (typeof val == 'object'){
                  val = [val]
                }else if (typeof val == 'string'){
                  val = [{thumb:val}]
                }else if (typeof val == 'string'){
                  val = [{thumb:val}]
                }
                if (val){
                  this.values = val
                }
              }
            }
          })
        },
        deep:true //true 深度监听
      }
    },
    props: {
      type: String,
      value:[String, Array, Object],
    },
    data() {
      return {
        values:[],
        dialog:{
          url:'',
          name:''
        },
        lst:[],
        detailVisible: false,
        lstVisible: false,
        query:{
          type:this.type,
        },
        total:0
      }
    },
    destroyed() {
      this.$bus.$off('fileAdded');
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
      openUploader() {
        this.$bus.$emit('openUploader', {
          type:this.type
           // 传入的参数
        })
      },
      preview(item){
        this.detailVisible=true
        this.dialog = item
      },
      current(item){
        this.detailVisible = false
        this.lstVisible = false
        this.$emit('current',{
          url:item.url,
          name:item.name,
          thumb:item.thumb,
        })
      },
      chooseClick(){
        this.query.page = 1
        this.index();
        this.lstVisible=true
      },
      pageChange(val) {
        this.query.page = val
        this.index()
      },
      fileSuccess(res){
        if (res.data){
          this.lst.unshift(res.data)
          if (res.data.add){
            this.total = this.total + 1
          }
        }
      }
    },
    mounted() {
      this.$bus.$off('fileAdded');
      // 文件选择后的回调
      this.$bus.$on('fileAdded', () => {
        console.log('文件已选择')
      });
    },
  }
</script>

<style lang="scss">
  .demo-image__preview{
    width: 100%;
    margin-top: 5px;
  }
  .file-title{

  }
</style>
