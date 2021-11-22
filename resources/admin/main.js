import Vue from 'vue'

import Cookies from 'js-cookie'

import 'normalize.css/normalize.css' // a modern alternative to CSS resets

import Element from 'element-ui'
import './styles/element-variables.scss'

import '@/styles/index.scss' // global css

import App from './App'
import store from './store'
import router from './router'

import './icons' // icon
import './permission' // permission control
import './utils/error-log' // error log

import * as filters from './filters' // global filters

import WkTable from './views/components/table.vue';//列表
Vue.component('wk-table',WkTable)
import WkEditForm from './views/components/edit-form.vue';//详情
Vue.component('wk-edit-form',WkEditForm)
import Wksearch from './views/components/search.vue';//搜索
Vue.component('wk-search',Wksearch)
import WktableBtn from './views/components/table-btn.vue';//列表按钮
Vue.component('wk-table-btn',WktableBtn)
import Wkpagination from './views/components/pagination.vue';//列表按钮
Vue.component('wk-pagination',Wkpagination)

/**
 * If you don't want to use mock-server
 * you want to use MockJs for mock api
 * you can execute: mockXHR()
 *
 * Currently MockJs will be used in the production environment,
 * please remove it before going online ! ! !
 */
// if (process.env.NODE_ENV === 'production') {
//   const { mockXHR } = require('../mock')
//   mockXHR()
// }

const auth = value => {
  let auth
  if(value){
    if (typeof value === 'string') {
      return store.getters.hasAuthorization(value)
    } else {
      auth = value.some(item => {
        return store.getters.hasAuthorization(item)
      })
    }
  }else{
    return true
  }
}

// 注册 v-auth 指令
Vue.directive('auth', {
  inserted: (el, binding) => {
    if (!auth(binding.value)) {
      el.remove()
    }
  }
})

// 挂载 this.$auth() 方法
Vue.prototype.$auth = auth

import iconPicker from 'e-icon-picker';
import 'e-icon-picker/lib/index.css'; //基础样式
import 'font-awesome/css/font-awesome.min.css'; //font-awesome 图标库
import 'element-ui/lib/theme-chalk/icon.css'; //element-ui 图标库
Vue.use(iconPicker, { eIcon: true, ElementUI: true, FontAwesome: true, eIconSymbol: true });

Vue.use(Element, {
  size: Cookies.get('size') || 'medium', // set element-ui default size
})

// register global utility filters
Object.keys(filters).forEach(key => {
  Vue.filter(key, filters[key])
})

Vue.config.productionTip = false

Vue.prototype.$bus = new Vue();

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})
