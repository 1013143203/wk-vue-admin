import request from '@/utils/request'

export function load(name) {
  return request({
    url: 'weixin/load/'+name,
    method: 'get',
  })
}
export function wechat(data) {
  return request({
    url: 'weixin/wechat',
    method: 'post',
    data
  })
}
export function wxapp(data) {
  return request({
    url: 'weixin/wxapp',
    method: 'post',
    data
  })
}
export function pay(data) {
  return request({
    url: 'weixin/pay',
    method: 'post',
    data
  })
}
