import request from '@/utils/request'

export function upload(data) {
  return request({
    url: 'file/md5',
    method: 'post',
    data
  })
}
export function merge(data,md5) {
  return request({
    url: 'file/merge',
    method: 'post',
    data
  })
}
export function index(params) {
  return request({
    url: 'file/index',
    method: 'get',
    params:params
  })
}
