import { asyncRoutes, constantRoutes } from '@/router'
import { fetchMenuList } from '@/api/user'
import Layout from '@/layout'
import { Message } from "element-ui";

/**
 * Use meta.role to determine if the current user has permission
 * @param authorization
 * @param route
 */
function hasAuthorization(authorization, route) {
  if (route.meta && route.meta.auth) {
    return authorization.some(auth => {
      return route.meta.auth.some(routeAuth => {
        return routeAuth === auth
      })
    })
  } else {
    return true
  }
}


/**
 * 后台查询的菜单数据拼装成路由格式的数据
 * @param data
 */
export function generaMenu(data) {
  data.forEach(item => {
    item.component = loadComponent(item.component)
    if (item.children) {
      item.children = generaMenu(item.children)
    }
  })
  return data
}
export function loadComponent(component) {
  if (component === '#' ){
    return Layout;
  }else if(component === '##' ){
    return loadView('components/nested');
  }else{
    return loadView(component);
  }
}

/**
 * 静态路由懒加载
 * @param view  格式必须为 xxx/xxx 开头不要加斜杠
 * @returns
 */
 export const loadView = (view) => {
  return (resolve) => require([`@/views/${view}.vue`], resolve)
}

/**
 * Filter asynchronous routing tables by recursion
 * @param routes asyncRoutes
 * @param auths
 */
export function filterAsyncRoutes(routes, auths) {
  const res = []

  routes.forEach(route => {
    const tmp = { ...route }
    if (hasAuthorization(auths, tmp)) {
      if (tmp.children) {
        tmp.children = filterAsyncRoutes(tmp.children, auths)
      }
      res.push(tmp)
    }
  })

  return res
}

const state = {
  routes: [],
  addRoutes: []
}

const mutations = {
  SET_ROUTES: (state, routes) => {
    state.addRoutes = routes
    state.routes = constantRoutes.concat(routes)
  }
}

const actions = {
  generateRoutes({ commit }, auths) {
    return new Promise(resolve => {
      const loadMenuData = []
      // 先查询后台并返回左侧菜单数据并把数据添加到路由
      fetchMenuList(state.token).then(response => {
        const { data } = response
        if (response.code !== 200) {
          Message({
            message: response.msg || 'Error',
            type: 'error',
            duration: 5 * 1000
          })
        } else {
          Object.assign(loadMenuData, data?data:[])
          let accessedRoutes , getMenu = generaMenu(loadMenuData)
          accessedRoutes = filterAsyncRoutes(getMenu, auths)
          accessedRoutes.push({
            path:'*',
            redirect:'/404',
          })
          commit('SET_ROUTES', accessedRoutes)
          resolve(accessedRoutes)
        }
      }).catch(error => {
        console.log(error)
      })
    })
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
