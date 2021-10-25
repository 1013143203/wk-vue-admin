import request from '@/utils/request'

export function index(params) {
  return request({
    url: 'address/index',
    method: 'get',
    params: params
  })
}
