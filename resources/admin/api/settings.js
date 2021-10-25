import request from '@/utils/request'

export function index(params) {
  return request({
    url: 'settings/index',
    method: 'get',
    params: params
  })
}
export function update(data) {
  return request({
    url: 'settings/update/'+data.id,
    method: 'put',
    data
  })
}
export function edit(id) {
  return request({
    url: 'settings/edit/'+id,
    method: 'get',
  })
}
export function create(data) {
  return request({
    url: 'settings/create',
    method: 'post',
    data
  })
}
export function del(id) {
  return request({
    url: 'settings/delete/'+id,
    method: 'delete',
  })
}
