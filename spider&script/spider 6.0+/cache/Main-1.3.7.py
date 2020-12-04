import requests
import re
import time
import ssl
import urllib3
import requests

headers = {'content-type': 'charset=utf8'}
ssl._create_default_https_context = ssl._create_unverified_context
urllib3.disable_warnings()

def main():
    # test = requests.get('https://egame.qq.com/245745870')
    # print(re.search('liveInfo:{videoInfo:{pid:"(.*?)"', test.text, re.S))
	#param={"0":{"module":"pgg_live_barrage_svr","method":"get_barrage","param":{"anchor_id":"10002","vid":"245745870_1586947490","other_uid":0,"last_tm":1586961091}}}
    nowTime = int(round(time.time() * 1000))
    header = {
        'Connection': 'close'
    }
	#pgg_appid=101503919; pgg_openid=0D28F5E8F39A0FB1FDF386CD95B42834; pgg_access_token=ECF29045412B8C49D099D943EE27785B; pgg_type=1
	#716116961
    cookies = {
        'pgg_appid':'101503919; pgg_openid=0D28F5E8F39A0FB1FDF386CD95B42834; pgg_access_token=ECF29045412B8C49D099D943EE27785B; pgg_type=1'
    }
    url = 'https://share.egame.qq.com/cgi-bin/pgg_async_fcgi?_=' + str(nowTime + 3000)
    #anchor_id = 245745870
    #vid = '245745870_1586947490'
	#param={"0":{"param":{"type":0,"anchor_id":0,"name":"","ts":1596658916,"page_num":1,"page_size":20},"module":"pgg_loot_boxes_mt_svr","method":"get_loot_prize_detail"}}
    data = {
        'param':'{"0":{"param":{"type":0,"anchor_id":0,"name":"","ts":' + str(nowTime / 1000) + ',"page_num":1,"page_size":20},"module":"pgg_loot_boxes_mt_svr","method":"get_loot_prize_detail"}}'
    }
    
    html = requests.post(url, headers=header, cookies=cookies, data=data, verify=False)
    html.encoding='utf-8'
    #print(url)
    #print(data)
    print(html.text)
    print('程序休息10秒')
    time.sleep(10)
    print('程序休息完毕，可以再次执行')


if __name__ == '__main__':
    main()
