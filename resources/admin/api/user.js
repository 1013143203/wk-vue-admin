import request from '@/utils/request'

export function login(data) {
  return request({
    url: 'login',
    method: 'post',
    data
  })
}

export function getInfo(token) {
  return request({
    url: 'auth/info',
    method: 'get',
    params: { token }
  })
}

export function logout() {
  return request({
    url: 'auth/logout',
    method: 'post'
  })
}

export function fetchMenuList() {
  return request({
    url: 'auth/fetchMenuList',
    method: 'post'
  })
}

export function index(params) {
  return request({
    url: 'user/index',
    method: 'get',
    params: params
  })
}

export function status(status,id) {
  return request({
    url: 'user/status/'+id+'/'+status,
    method: 'put',
  })
}
export function edit(id) {
  return request({
    url: 'user/edit/'+id,
    method: 'get',
  })
}
export function update(data) {
  return request({
    url: 'user/update/'+data.id,
    method: 'put',
    data
  })
}
export function create(data) {
  return request({
    url: 'user/create',
    method: 'post',
    data
  })
}
export function del(id) {
  return request({
    url: 'user/delete/'+id,
    method: 'delete',
  })
}
