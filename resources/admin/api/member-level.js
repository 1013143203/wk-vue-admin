import request from '@/utils/request'

export function index(params) {
  return request({
    url: 'memberLevel/index',
    method: 'get',
    params: params
  })
}

export function status(status,id) {
  return request({
    url: 'memberLevel/status/'+id+'/'+status,
    method: 'put',
  })
}
export function edit(id) {
  return request({
    url: 'memberLevel/edit/'+id,
    method: 'get',
  })
}
export function update(data) {
  return request({
    url: 'memberLevel/update/'+data.id,
    method: 'put',
    data
  })
}
export function create(data) {
  return request({
    url: 'memberLevel/create',
    method: 'post',
    data
  })
}
export function del(id) {
  return request({
    url: 'memberLevel/delete/'+id,
    method: 'delete',
  })
}
