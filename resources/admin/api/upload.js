import request from '@/utils/request'

export function chunk(data) {
  return request({
    url: 'file/chunk',
    method: 'post',
    data
  })
}
export function merge(data) {
  return request({
    url: 'file/merge',
    method: 'post',
    data
  })
}
