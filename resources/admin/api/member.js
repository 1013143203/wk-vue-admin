import request from '@/utils/request'

export function index(params) {
  return request({
    url: 'member/index',
    method: 'get',
    params: params
  })
}

export function status(status,id) {
  return request({
    url: 'member/status/'+id+'/'+status,
    method: 'put',
  })
}
export function edit(id) {
  return request({
    url: 'member/edit/'+id,
    method: 'get',
  })
}
export function update(data) {
  return request({
    url: 'member/update/'+data.id,
    method: 'put',
    data
  })
}
export function create(data) {
  return request({
    url: 'member/create',
    method: 'post',
    data
  })
}
