<template>
  <el-dialog
    :visible.sync="dialogFormVisible"
    @close="(dialogFormVisible = false,$refs.form.resetFields())"
    :width="dialogWidth"
  >
    <el-form ref="form" :model="formData" :rules="rules" label-width="80px">
      <el-form-item prop="sType" label="任务类型">
        <el-select v-model="formData.sType" placeholder="任务类型"  @change="sTypeChange" autocomplete="off">
          <el-option
            v-for="item in sTypes"
            :key="item.id"
            :checked="item.id == formData.sType"
            :label="item.name"
            :value="item.id"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="任务名称" prop="name">
        <el-input v-model="formData.name" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item label="任务周期">
        <el-col :span="5">
          <el-form-item prop="tType">
            <el-select v-model="formData.tType" @change="tTypeChange" autocomplete="off">
              <el-option
                v-for="item in tTypes"
                :key="item.id"
                :checked="item.id == formData.tType"
                :label="item.name"
                :value="item.id"
              />
            </el-select>
          </el-form-item>
        </el-col>
        <div v-if="week__">
          <el-col :span="1">⠀</el-col>
          <el-col :span="5">
            <el-form-item prop="week">
              <el-select v-model="formData.week" autocomplete="off">
                <el-option
                  v-for="item in 7"
                  :key="item"
                  :checked="item == formData.week"
                  :label="'周' + weekfun(item)"
                  :value="item"
                />
              </el-select>
            </el-form-item>
          </el-col>
        </div>
        <div v-if="day__">
          <el-col :span="1">⠀</el-col>
          <el-col :span="5">
            <el-form-item prop="day">
              <el-input v-model="formData.day" type="number" autocomplete="off">
                <template slot="append">日</template>
              </el-input>
            </el-form-item>
          </el-col>
        </div>
        <div v-if="hour__">
          <el-col :span="1">⠀</el-col>
          <el-col :span="5">
            <el-form-item prop="hour">
              <el-input v-model="formData.hour" type="number" autocomplete="off">
                <template slot="append">时</template>
              </el-input>
            </el-form-item>
          </el-col>
        </div>
        <div v-if="minute__">
          <el-col :span="1">⠀</el-col>
          <el-col :span="5">
            <el-form-item prop="minute">
              <el-input v-model="formData.minute" type="number" autocomplete="off">
                <template slot="append">分</template>
              </el-input>
            </el-form-item>
          </el-col>
        </div>
      </el-form-item>
      <el-form-item v-if="shell__" label="脚本内容" prop="sBody">
        <el-input type="textarea" v-model="formData.sBody" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item v-if="url__" label="URL地址" prop="sBody">
        <el-input v-model="formData.sBody" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item prop="status" label="状态">
        <el-switch
          :active-value="switch_active.active"
          :inactive-value="switch_active.inactive"
          v-model="formData.status"
        >
        </el-switch>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="submitForm">确定</el-button>
        <el-button @click="(dialogFormVisible = false,$refs.form.resetFields())">取消</el-button>
      </el-form-item>

    </el-form>
  </el-dialog>
</template>

<script>
  import {update, create} from "@/api/crontab";

  export default {
    inject: ['reload'],
    name: "edit",
    props: {
      data: {
        type: Object,
        default: () => {},
      },
    },
    watch:{
      data:{
        handler(val, oldVal){
          this.$nextTick(() => {
            this.formData=val
          })
          this.dialogFormVisible = true;
        },
        deep:true //true 深度监听
      }
    },
    data() {
      return {
        dialogWidth: '',
        dialogFormVisible: false,
        type: 1,
        switch_active: {
          active: 1,
          inactive: 2,
        },
        formData: {
          sType: 1,
          tType: 1,
        },
        rules: {
          name: [
            {required: true, message: "请输入任务名称", trigger: 'blur'},
          ],
          sType: [
            {required: true, message: "请选择任务类型", trigger: 'blur'},
          ],
          sBody: [
            {required: true, message: "请输入任务内容", trigger: 'blur'},
          ],
          day: [
            {required: true, message: "请输入日", trigger: 'blur'},
          ],
        },
        week__:false,
        day__:false,
        hour__:false,
        minute__:false,
        shell__:false,
        url__:false,
        tTypes: [
          {
            id:1,
            name:'N天'
          },
          {
            id:2,
            name:'N小时'
          },
          {
            id:3,
            name:'N分钟'
          },
          {
            id:4,
            name:'每周'
          },
          {
            id:5,
            name:'每月'
          },
        ],
        sTypes:[
          {
            id:1,
            name:'Shell脚本'
          },
          {
            id:2,
            name:'访问URL'
          }
        ]
      }
    },
    mounted() {
      const that = this
      window.onresize = () => {
        return (() => {
          this.setDialogWidth()
        })()
      }
    },
    methods: {
      weekfun(num){
        const arr = ['一', '二', '三', '四', '五', '六', '日'];
        return arr[--num]
      },
      setDialogWidth() {
        var val = document.body.clientWidth
        const def = 1000 // 默认宽度
        if (val < def) {
          this.dialogWidth = '100%'
        } else {
          this.dialogWidth = def + 'px'
        }
      },
      add(obj = {}) {
        if (obj.id) {
          this.formData = obj
          this.tTypeChange(obj.tType)
        }else{
          this.day__ = true
          this.hour__ = true
          this.minute__ = true
          this.shell__ = true
        }
        this.dialogFormVisible = true
      },
      submitForm() {
        this.$refs.form.validate((valid) => {
          if (valid) {
            const l = this.formData.id ? update(this.formData) : create(this.formData);
            l.then((response) => {
              console.log(response)
              this.$message({
                type: 'info',
                message: response.msg
              });
              this.reload('global');
            }).catch((error) => {
              console.log(error);
            });
          }
        });
      },
      sTypeChange(e) {
        if (e == 1){
          this.shell__ = true
          this.url__ = false
        }else{
          this.url__ = true
          this.shell__ = false
        }
      },
      tTypeChange(e) {
        if (e == 1){
          this.day__ = true
          this.hour__ = true
          this.minute__ = true
          this.week__ = false
          delete this.formData.week
        }else if (e == 2){
          this.hour__ = true
          this.minute__ = true
          this.day__ = false
          this.week__ = false
          delete this.formData.day
          delete this.formData.week
        }else if (e == 3){
          this.minute__ = true
          this.hour__ = false
          this.day__ = false
          this.week__ = false
          delete this.formData.day
          delete this.formData.week
          delete this.formData.hour
        }else if (e == 4){
          this.week__ = true
          this.minute__ = true
          this.hour__ = true
          this.day__ = false
          delete this.formData.day
        }else if (e == 5){
          this.week__ = false
          this.minute__ = true
          this.hour__ = true
          this.day__ = true
          delete this.formData.week
        }
      },
    }
  }
</script>

<style scoped>
  .el-select {
    width: 100%
  }

  /deep/ input::-webkit-outer-spin-button,
  /deep/ input::-webkit-inner-spin-button {
    -webkit-appearance: none !important;
  }

  /deep/ input[type='number'] {
    -moz-appearance: textfield !important;
  }
</style>
