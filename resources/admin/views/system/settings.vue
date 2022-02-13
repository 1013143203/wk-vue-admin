<template>
  <div class="app-container">
    <el-card class="show">
      <wk-table
        :table="table"
      ></wk-table>
    </el-card>
    <wk-edit-form
      ref="form"
      @submit="submit"
      :cols="form.cols"
      :data="form.data"
      @close="close"
    ></wk-edit-form>
  </div>
</template>

<script>
  import { index ,create ,update ,edit ,del} from "@/api/settings";
  import { validateObjectJSON } from "@/utils/validate.js";
  import { confirm } from "@/utils/message-box.js";

  const validatorJSON=(rule, value, callback)=>{
    if (validateObjectJSON(value)){
      callback()
    }else{
      return callback(new Error('请输入JSON字符串'))
    }
  }
  export default {
    name: "settings",
    inject:['reload'],
    data() {
      return {
        table: {
          cols: [
            {label:'变量名称', prop: "name" , width:100},
            {label:'变量值', prop: "value" },
            {
              label:'操作',
              type: "btn",
              btn:[
                {
                  label:'编辑',
                  icon:"el-icon-edit",
                  auth:'settings:edit',
                  click:(index , item)=>{
                    edit(item.id).then((response) => {
                      const { data } = response;
                      this.form.cols.name.disabled = true
                      this.form.data = data
                    })
                      .catch((error) => {
                        console.log(error);
                      });
                  }
                },
                {label: "删除" ,icon:"el-icon-delete" , auth:'settings:delete',
                  click:(index , item)=>{
                    var that = this
                    let fn = () => {
                      del(item.id).then((response) => {
                        this.$message({
                          type: 'info',
                          message: response.msg
                        });
                        that.table.lst.splice(index, 1)
                        that.table.total = that.table.total-1
                      }).catch((error) => {
                        console.log(error);
                      })
                    }
                    confirm("是否永久删除该数据？", fn);
                  }
                }
              ], width:150
            },
          ],
          btn:[
            {
              label:'添加',
              auth:'settings:create',
              type:'primary',
              icon:'el-icon-plus',
              click:()=>{
                this.form.data={}
                this.form.data.value={}
              }
            },
          ],
          lst: [],
          total: 0,
        },
        form: {
          cols: {
            name:{
              type: "input",
              label: "配置名称", //字段
              placeholder: "请填写配置名称", //提示内容,
              rules: [
                { required: true, message: "请输入配置名称", trigger: "blur" },
                {
                  min: 1,
                  max: 10,
                  message: "长度在 1 到 10 个字符",
                  trigger: 'blur',
                },
              ],
            },
            value:{
              type: "json-editor",
              label: "配置内容", //字段
              rules: [
                { required: true, message: "请输入JSON数据", trigger: "blur" },
                { validator: validatorJSON, trigger: 'change'},
              ],
            },
            description:{
              type: "input",
              label: "配置描述", //字段
              placeholder: "请填写配置描述", //提示内容,
              rules: [
                {
                  min: 1,
                  max: 50,
                  message: "长度在 1 到 50 个字符",
                  trigger: 'blur',
                },
              ],
            },
          },
          data: {
            name: "",
            value: {},
            description: '',
          },
        }
      }
    },
    created() {
      this.index();
    },
    methods: {
      close(){
        this.$refs.form.formData.value = {}
      },
      index() {
        index()
          .then((response) => {
            const { data } = response;
            this.table.lst = data;
          })
          .catch((error) => {
            console.log(error);
          });
      },
      submit(form) {
        const l = form.id ? update(form) : create(form);
        l.then((response) => {
          this.$message({
            type: 'success',
            message: response.msg
          });
          this.reload();
        }).catch((error) => {
          console.log(error);
        });
      },
    }
  }
</script>

<style scoped>
  .row {
    padding: 10px 0;
  }
</style>
