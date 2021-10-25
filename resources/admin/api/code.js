import request from '@/utils/request'

export function general(data) {
  return request({
    url: 'general',
    method: 'post',
    data
  })
}
