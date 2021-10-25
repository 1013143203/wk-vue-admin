import request from '@/utils/request'

export function index(params) {
  return request({
    url: 'role/index',
    method: 'get',
    params: params
  })
}

export function status(status,id){
  return request({
    url: 'role/status/'+id+'/'+status,
    method: 'put',
  })
}
export function edit(id) {
  return request({
    url: 'role/edit/'+id,
    method: 'get',
  })
}
export function update(data) {
  return request({
    url: 'role/update/'+data.id,
    method: 'put',
    data
  })
}
export function create(data) {
  return request({
    url: 'role/create',
    method: 'post',
    data
  })
}
export function del(id) {
  return request({
    url: 'role/delete/'+id,
    method: 'delete',
  })
}
