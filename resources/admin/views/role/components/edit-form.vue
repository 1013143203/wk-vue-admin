<template>
  <el-dialog
    :visible.sync="dialogFormVisible"
    @close="(dialogFormVisible = false,$refs.form.resetFields())"
    :width="dialogWidth"
  >
    <el-form ref="form" :model="formData" :rules="rules" label-width="80px">
      <el-form-item label="角色" prop="name">
        <el-input v-model="formData.name" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item prop="permission" label="权限">
        <el-tree
          :data="permission"
          show-checkbox
          default-expand-all
          node-key="id"
          ref="permission"
          check-strictly
          @check="(data, check) => handleCheck(data, check, 'permission')"
          @check-change="(data, check) => handleCheckChange(data, check, 'permission')"
          highlight-current
          :default-checked-keys="formData.permission"
        >
        </el-tree>
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
        <el-button type="primary" @click="submit">确定</el-button>
        <el-button @click="(dialogFormVisible = false,$refs.form.resetFields())">取消</el-button>
      </el-form-item>

    </el-form>
  </el-dialog>
</template>

<script>
  import {update, create} from "@/api/role";
  export default {
    inject:['reload'],
    name: "edit",
    props: {
      data:{
        type: Object,
        default: () => {},
      },
      permission:{
        type: Array,
        default: function () {
          return [];
        },
      },
    },
    watch:{
      data:{
        handler(val, oldVal){
          this.$nextTick(() => {
            this.formData = val
            this.type = val.type
          })
          this.dialogFormVisible=true
        },
      }
    },
    data() {
      return {
        dialogWidth:'',
        dialogFormVisible: false,
        type: 1,
        switch_active: {
          active: 1,
          inactive: 2,
        },
        formData: {
          name: "",
          status: 2,
          permission: [],
        },
        rules: {
          name: [
            {required: true, message: "请填写角色名", trigger: 'blur'},
            {
              min: 1,
              max: 10,
              message: "长度在 3 到 10 个字符",
              trigger: 'blur',
            },
          ],
        },
      }
    },
    mounted() {
      const that=this
      window.onresize = () => {
        return (() => {
          this.setDialogWidth()
        })()
      }
    },
    methods: {
      setDialogWidth() {
        var val = document.body.clientWidth
        const def = 450 // 默认宽度
        if (val < def) {
          this.dialogWidth = '100%'
        } else {
          this.dialogWidth = def + 'px'
        }
      },
      submit() {
        const l = this.formData.id ? update(this.formData) : create(this.formData);
        l.then((response) => {
          this.$message({
            type: 'success',
            message: response.msg
          });
          this.reload('global');
        }).catch((error) => {
          console.log(error);
        });
      },
      selectChildren(data,ref) {
        data && data.children && data.children.map(item => {
          this.$refs[ref].setChecked(item.id, true);
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
        this.formData[ref] = this.$refs[ref].getCheckedKeys();

      },
      handleCheckChange(data, checked, ref) {
        // 节点所对应的对象、节点本身是否被选中、节点的子树中是否有被选中的节点
        //如果为取消
        if (checked === false) {
          //如果当前节点有子集
          if (data.children) {
            //循环子集将他们的选中取消
            data.children.map(item => {
              this.$refs[ref].setChecked(item.id, false);
            });
          }
        } else {
          //否则(为选中状态)
          //判断父节点id是否为空
          if (data.parentId !== 0) {
            //如果不为空则将其选中
            this.$refs[ref].setChecked(data.parentId, true);
          }
        }
      },
    }
  }
</script>

<style scoped>
  .el-select {
    width: 100%
  }
</style>
