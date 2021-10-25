import { MessageBox, Message } from 'element-ui'
import Vue from "vue";

export function confirm(item1,fn) {
  Vue.prototype.$confirm(item1, '提示', {
    confirmButtonText: '确定',
    cancelButtonText: '取消',
    type: 'warning'
  }).then(() => {
    fn()
  }).catch(() => {
    Vue.prototype.$message({
      type: 'info',
      message: '已取消'
    });
  });
}
