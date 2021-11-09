import request from '@/utils/request'

export function upload(data) {
  return request({
    url: 'file/md5',
    method: 'post',
    data
  })
}
export function merge(data) {
  return request({
    url: 'file/merge',
    method: 'post',
    headers:{'Content-Type':'multipart/form-data'},
    data
  })
}
