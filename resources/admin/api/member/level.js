import request from '@/utils/request'

export function index(params) {
  return request({
    url: 'member/level/index',
    method: 'get',
    params: params
  })
}

export function status(status,id) {
  return request({
    url: 'member/level/status/'+id+'/'+status,
    method: 'put',
  })
}
export function edit(id) {
  return request({
    url: 'member/level/edit/'+id,
    method: 'get',
  })
}
export function update(data) {
  return request({
    url: 'member/level/update/'+data.id,
    method: 'put',
    data
  })
}
export function create(data) {
  return request({
    url: 'member/level/create',
    method: 'post',
    data
  })
}
export function del(id) {
  return request({
    url: 'member/level/delete/'+id,
    method: 'delete',
  })
}
