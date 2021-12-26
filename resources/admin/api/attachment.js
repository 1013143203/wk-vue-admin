import request from '@/utils/request'

export function load() {
  return request({
    url: 'attachment/load',
    method: 'get',
  })
}
export function update(data) {
  return request({
    url: 'attachment/update',
    method: 'put',
    data
  })
}
