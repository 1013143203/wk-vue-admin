import request from '@/utils/request'

export function wechat(data) {
  return request({
    url: 'weixin/wechat',
    method: 'post',
    data
  })
}
