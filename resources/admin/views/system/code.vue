<template>
  <div class="app-container">
    <el-form :model="formData" :rules="rules" ref="form" label-width="100px" class="demo-formData">
      <el-form-item label="模块名称" prop="name" placeholder="请输入模块名称">
        <el-input v-model="formData.name" @input="input"></el-input>
      </el-form-item>
      <el-form-item label="方法" prop="action">
        <el-select multiple v-model="formData.action" placeholder="请选择方法">
          <el-option
            v-for="(item ,index) in actions"
            :key="index"
            :label="item.name"
            :value="item.value"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="目录安装" prop="dirs">
        <el-checkbox-group v-model="formData.dirs">
          <el-checkbox
            v-for="(item ,index) in dirs" :key="index"
           :label="item.value"
           :value="item.value"
            name="dirs"
          >
          </el-checkbox>
        </el-checkbox-group>
      </el-form-item>
      <el-form-item>
        <el-button v-auth="'code:update'" type="primary" @click="submitForm">立即创建</el-button>
        <el-button @click="resetForm">重置</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
  import {general} from '@/api/code'
    export default {
      data() {
        return {
          formData:{
            name:'',
            dirs: [],
          },
          rules: {
            name: [
              { required: true, message: '请输入活动名称', trigger: 'change' },
              { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'change' }
            ],
          },
          actions:[
            {
              value:'index',
              name:'列表',
            },
            {
              value:'create',
              name:'新增',
            },
            {
              value:'edit',
              name:'详情',
            },
            {
              value:'update',
              name:'修改',
            },
            {
              value:'delete',
              name:'删除',
            }
          ],
          dirs:[
            {
              value:'Controller',
            },
            {
              value:'Service',
            },
            {
              value:'Model',
            },
            {
              value:'Request',
            }
          ]
        }
      },
      methods: {
        submitForm() {
          this.$refs.form.validate((valid) => {
            if (valid) {
              general(this.formData)
                .then((response) => {
                  console.log(response);
                })
                .catch((error) => {
                  console.log(error);
                });
            } else {
              console.log('error submit!!');
              return false;
            }
          });
        },
        resetForm() {
          this.$refs.form.resetFields();
        },
        input(value){
        }
      }
    }
</script>

<style scoped>
  .el-select {
    width: 100%
  }
</style>
