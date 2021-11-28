import request from '@/utils/request'

export function index(code,type) {
  return request({
    url: `region/lists/${code}/${type}`,
    method: 'get',
  })
}
export function loadProvince(params) {
  return request({
    url: 'region/loadProvince',
    method: 'get',
    params: params
  })
}
