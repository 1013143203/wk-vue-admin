import request from '@/utils/request'

export function index(params) {
  return request({
    url: 'menu/index',
    method: 'get',
    params: params
  })
}

export function status(status,id) {
  return request({
    url: 'menu/status/'+id+'/'+status,
    method: 'put',
  })
}
export function edit(id) {
  return request({
    url: 'menu/edit/'+id,
    method: 'get',
  })
}
export function update(data) {
  return request({
    url: 'menu/update/'+data.id,
    method: 'put',
    data
  })
}
export function create(data) {
  return request({
    url: 'menu/create',
    method: 'post',
    data
  })
}
export function del(id) {
  return request({
    url: 'menu/delete/'+id,
    method: 'delete',
  })
}
export function loadEdit() {
  return request({
    url: 'menu/load/edit',
    get: 'get',
  })
}
