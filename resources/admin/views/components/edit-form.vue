<template>
  <el-dialog
    top="1%"
    :visible.sync="dialogVisible"
    @close="(formData= {}), close()"
    :width="dialogWidth"
  >
    <div class="el-dialog-div">
      <el-form :model="formData" ref="ruleForm" label-width="80px">
      <div v-for="(col, prop) in cols">
        <el-form-item :label="col.label" :prop="prop" :rules="col.rules">
          <input
            type="hidden"
            v-model="formData[prop]"
            v-if="col.type === 'hidden'"
          />
          <!-- inupt输入框 -->
          <el-input
            v-if="col.type === 'input'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            :placeholder="col.placeholder"
          ></el-input>
          <!-- 上传图片 -->
          <upload
            v-if="col.type === 'upload'"
            v-model="formData[prop]"
            :type="col.fileType"
            @current = "(res) => col.current(res)"
          ></upload>
          <!-- inupt密码框 -->
          <el-input
            v-if="col.type === 'password'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            show-password
            autocomplete="off"
          ></el-input>
          <!-- inupt数字框 -->
          <el-input-number
            v-if="col.type === 'number'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            :min="col.min"
            :max="col.max"
            onKeypress="return (/[\d\.]/.test(String.fromCharCode(event.keyCode)))"
          ></el-input-number>
          <!-- textarea输入框 -->
          <el-input
            type="textarea"
            v-if="col.type == 'textarea'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            :placeholder="col.placeholder"
          ></el-input>
          <!-- 上传图片 -->
          <region
            v-if="col.type == 'region'"
            v-model="formData[prop]"
            @current = "(res) => col.current(res)"
          ></region>
          <!-- select选择器 -->
          <el-select
            v-if="col.type == 'select'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            :placeholder="col.placeholder"
            :multiple='col.multiple'
            :remote-method="(query) => col.remoteMethod(query)"
            :remote="col.remote?col.remote:false"
            :reserve-keyword="col.reserveKeyword?col.reserveKeyword:false"
            :filterable="col.filterable?col.filterable:false"
            @change="$forceUpdate()"
          >
            <el-option
              :label="option.label"
              :value="option.value"
              v-for="option in col.options"
              :key="option.value"
            >
            </el-option>
          </el-select>
          <!-- 时分秒选择器 -->
          <el-time-picker
            value-format="HH:mm:ss"
            v-if="col.type == 'timePicker'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            :placeholder="col.placeholder"
            :picker-options="col.options"
          >
          </el-time-picker>
          <!-- 时分秒选择器，开始和结束时间 -->
          <el-time-picker
            value-format="HH:mm:ss"
            is-range
            v-if="col.type == 'timePickerIsRange'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            range-separator="至"
            start-placeholder="开始时间"
            end-placeholder="结束时间"
            placeholder="选择时间范围"
          ></el-time-picker>
          <!-- 年月日选择器 -->
          <el-date-picker
            value-format="yyyy-MM-dd HH:mm:ss"
            v-if="col.type == 'datePicker'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            :placeholder="col.placeholder"
          >
          </el-date-picker>
          <!-- 年月日选择器，开始和介绍年月日 -->
          <el-date-picker
            value-format="yyyy-MM-dd HH:mm:ss"
            type="daterange"
            v-if="col.type == 'datePickerIsRange'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
            :placeholder="col.placeholder"
            range-separator="至"
            start-placeholder="开始日期"
            end-placeholder="结束日期"
          ></el-date-picker>
          <!-- switch开关 -->
          <el-switch
            v-if="col.type == 'switch'"
            :disabled="col.disabled ? col.disabled : false"
            :active-value="col.active"
            :inactive-value="col.inactive"
            v-model="formData[prop]"
          >
          </el-switch>
          <!-- radio单选框 -->
          <el-radio-group
            v-if="col.type == 'radio'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
          >
            <el-radio
              :label="options.value"
              v-for="options in col.options"
              :key="options.value"
            >{{options.label}}
            </el-radio>
          </el-radio-group>
          <!-- checkbox复选框 -->
          <el-checkbox-group
            v-if="col.type == 'checkbox'"
            :disabled="col.disabled ? col.disabled : false"
            v-model="formData[prop]"
          >
            <el-checkbox
              :label="options.label"
              :key="options.value"
              v-for="options in col.options"
            >
            </el-checkbox>
          </el-checkbox-group>
          <el-tree
            v-if="col.type == 'tree'"
            :data="col.data"
            show-checkbox
            default-expand-all
            node-key="id"
            :ref="prop"
            @check-change="(data, check) => checkChange(data, check, prop)"
            @check="(data, check) => handleCheck(data, check, prop)"
            check-strictly
            highlight-current
            :default-checked-keys="formData[prop]"
            >
          </el-tree>

          <e-icon-picker v-model="formData[prop]" v-if="col.type == 'icon'" />

          <vue-json-editor
            v-if="col.type == 'json-editor'"
            v-model="formData[prop]"
            :mode="'code'"
            lang="zh"
          >
          </vue-json-editor>
          <div v-if="col.desc" class="desc">{{col.desc}}</div>
        </el-form-item>
      </div>
      <el-form-item>
        <el-button type="primary" @click="submitForm">确定</el-button>
        <el-button @click="(formData= {}), close()">取消</el-button>
      </el-form-item>
    </el-form>
    </div>

  </el-dialog>
</template>

<script>
import vueJsonEditor from 'vue-json-editor'
import upload from './upload'
import region from './region'
export default {
  props: {
    cols: {
      type: Object,
      default: () => {},
    },
    data: {
      type: Object,
      default: () => {},
    },
  },
  components: {
    vueJsonEditor,
    upload,
    region
  },
  data() {
    return {
      formData:this.data,
      dialogVisible: false,
      dialogWidth:'65%',
    };
  },
  watch:{
    data:{
      handler(val, oldVal){
        this.$nextTick(() => {
          this.formData=val
        })
        this.dialogVisible = true;
      },
      // deep:true //true 深度监听
    }
  },
  created() {
    // console.log(this.cols);
    // console.log(this.formData);
  },
  mounted() {
    window.onresize = () => {
      return (() => {
        this.setDialogWidth()
      })()
    }
  },
  methods: {
    setDialogWidth() {
      var val = document.body.clientWidth
      const def = 700 // 默认宽度
      if (val < def) {
        this.dialogWidth = '100%'
      } else {
        this.dialogWidth = def + 'px'
      }
    },
    //提交时验证表单，直接在父级调用
    submitForm() {
      this.$refs.ruleForm.validate((valid) => {
        if (valid) {
          this.$emit("submit", this.formData);
        }
      });
    },
    close() {
      this.$refs.ruleForm.resetFields();
      this.dialogVisible = false
      this.$emit('close')
    },
    checkChange(data, check, ref) {
      let $data = this.$refs[ref][0]
      // 父节点操作
      if (data.pid) {
        if (check === true) {
          // 如果选中，设置父节点为选中
          $data.setChecked(data.pid, true);
        } else {
          // 如果取消选中，检查父节点是否该取消选中（可能仍有子节点为选中状态）
          var parentNode = $data.getNode(data.pid);

          var parentHasCheckedChild = false;
          for (
            var i = 0, parentChildLen = parentNode.childNodes.length;
            i < parentChildLen;
            i++
          ) {
            if (parentNode.childNodes[i].checked === true) {
              parentHasCheckedChild = true;
              break;
            }
          }
          if (!parentHasCheckedChild)
            $data.setChecked(data.pid, false);
        }
      }
      // 子节点操作，如果取消选中，取消子节点选中
      if (data.children != null && check === false) {
        for (var j = 0, len = data.children.length; j < len; j++) {
          var childNode = $data.getNode(data.children[j].id);
          if (childNode.checked === true) {
            $data.setChecked(childNode.data.id, false);
          }
        }
      }
    },
    selectChildren(data,ref) {
      data && data.children && data.children.map(item => {
        this.$refs[ref][0].setChecked(item.id, true);
        if (data.children) {
          this.selectChildren(item,ref)
        }
      });
    },
    handleCheck(data, { checkedKeys } , ref) {
      // 节点所对应的对象、节点本身是否被选中、节点的子树中是否有被选中的节点
      //如果为取消
      if (checkedKeys.includes(data.id)) {
        //如果当前节点有子集
        this.selectChildren(data,ref);
      }
      let $data = this.$refs[ref][0]
      this.formData[ref] = $data.getCheckedKeys().concat($data.getHalfCheckedKeys());
    },
  },
};
</script>
<style lang="scss" scoped>
  .el-dialog-div{
    max-height: 80vh;
    overflow: auto;
  }

  /*.el-select {*/
  /*  width: 100%*/
  /*}*/
  .jsoneditor-poweredBy{
    display: none;
  }
  /*.el-dialog {*/
  /*  position: absolute;*/
  /*  top: 50%;*/
  /*  left: 50%;*/
  /*  margin: 0 !important;*/
  /*  transform: translate(-50%, -50%);*/
  /*  max-height: calc(100% - 30px);*/
  /*  max-width: calc(100% - 30px);*/
  /*  display: flex;*/
  /*  flex-direction: column;*/
  /*}*/

  .el-dialog__body {
    overflow: auto;
  }
</style>
