<template>
  <el-dialog
    :visible.sync="dialogFormVisible"
    @close="(dialogFormVisible = false)"
    :width="dialogWidth"
  >
    <el-form ref="form" :model="formData" :rules="rules" label-width="80px">
      <el-form-item label="名称" prop="name">
        <el-input v-model="formData.name" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item prop="pid" label="上级">
        <el-select v-model="formData.pid" placeholder="请选择父级" autocomplete="off">
          <el-option
            v-for="item in category"
            :key="item.id"
            :checked="item.id == formData.pid"
            :label="item.name"
            :value="item.id"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="icon" v-if="type!=3">
        <e-icon-picker v-model="formData.icon"/>
      </el-form-item>
      <el-form-item prop="type" label="类型">
        <el-select v-model="formData.type" placeholder="请选择类型" autocomplete="off" @change="node_typeChange">
          <el-option
            v-for="item in menus_types"
            :key="item.id"
            :checked="item.id == formData.type"
            :label="item.name"
            :value="item.id"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="连接" prop="path" v-if="type!=3">
        <el-input v-model="formData.path" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item label="权限标识" prop="permission">
        <el-input v-model="formData.permission" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item label="组件" prop="component" v-if="type!=3">
        <el-input v-model="formData.component" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item label="重定向" prop="redirect" v-if="type!=3">
        <el-input v-model="formData.redirect" autocomplete="off"></el-input>
      </el-form-item>
      <el-form-item label="权限节点" v-if="type==2 ">
        <el-transfer :props="{
      key: 'id',
      label: 'name'
    }" v-model="formData.node_fun" :data="menus_nodes" :titles="['全部节点', '已赋予节点']"
                     @change="nodesChange"></el-transfer>
      </el-form-item>
      <el-form-item prop="is_public" label="公共菜单">
        <el-switch
          :active-value="switch_active.active"
          :inactive-value="switch_active.inactive"
          v-model="formData.is_public"
        >
        </el-switch>
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
        <el-button @click="(dialogFormVisible = false)">取消</el-button>
      </el-form-item>

    </el-form>
  </el-dialog>
</template>

<script>
  import {update, create} from "@/api/menu";
  export default {
    inject:['reload'],
    name: "edit",
    props: {
      menus_nodes:{
        type: Array,
        default: () => [],
      },
      menus_types:{
        type: Array,
        default: () => [],
      },
      category:{
        type: Array,
        default: () => [],
      },
      data:{
        type: Object,
        default: () => {},
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
        deep:true //true 深度监听
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
          type: "",
          permission: '',
          status: 2,
          is_public: 2,
          node_fun: [],
          path: '',
          redirect:'',
          component:''
        },
        rules: {
          name: [
            {required: true, message: "请输入菜单名称", trigger: 'blur'},
            {
              min: 1,
              max: 15,
              message: "长度在 1 到 15 个字符",
              trigger: 'blur',
            },
          ],
          permission: [
            {required: true, message: "请填写权限标识"},
          ],
          pid: [
            {required: true, message: "请选择上级菜单"},
          ],
          type: [
            {required: true, message: "请选择类型"},
          ],
          path: [
            {required: true, message: "请输入连接", trigger: 'blur'},
            {
              min: 1,
              max: 30,
              message: "长度在 1 到 30 个字符",
              trigger: 'blur',
            },
          ],
          component: [
            {required: true, message: "请输入组件", trigger: 'blur'},
            {
              min: 1,
              max: 30,
              message: "长度在 1 到 30 个字符",
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
      submitForm() {
        this.$refs.form.validate((valid) => {
          if (valid) {
            const l = this.formData.id?update(this.formData) : create(this.formData);
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
      node_typeChange(e) {
        this.type = e
      },
      nodesChange(selecedOption) {
        this.formData.node_fun = selecedOption
      }
    }
  }
</script>

<style scoped>
  .el-select {
    width: 100%
  }
</style>
