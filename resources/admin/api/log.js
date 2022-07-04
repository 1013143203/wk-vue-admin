import request from '@/utils/request'

export function userAction(params) {
  return request({
    url: 'log/userAction',
    method: 'get',
    params:params
  })
}
