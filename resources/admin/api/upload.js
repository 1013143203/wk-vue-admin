import request from '@/utils/request'

export function upload(data) {
  return request({
    url: 'files/md5',
    method: 'post',
    data
  })
}
export function merge(data,md5) {
  return request({
    url: 'files/merge',
    method: 'post',
    data
  })
}
export function index(params) {
  return request({
    url: 'files/index',
    method: 'get',
    params:params
  })
}
