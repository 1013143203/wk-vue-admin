import request from '@/utils/request'

export function index(params) {
  return request({
    url: 'crontab/index',
    method: 'get',
    params: params
  })
}

export function status(status,id){
  return request({
    url: 'crontab/status/'+id+'/'+status,
    method: 'put',
  })
}
export function edit(id) {
  return request({
    url: 'crontab/edit/'+id,
    method: 'get',
  })
}
export function update(data) {
  return request({
    url: 'crontab/update/'+data.id,
    method: 'put',
    data
  })
}
export function create(data) {
  return request({
    url: 'crontab/create',
    method: 'post',
    data
  })
}
export function del(id) {
  return request({
    url: 'crontab/delete/'+id,
    method: 'delete',
  })
}
