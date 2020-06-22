#!/usr/bin/python3
# encoding:utf-8
import requests
import re
import time
import ssl
import urllib3
import json
import pymysql

# test =============

conn = None
cursor = None
# db_connect 函数用于连接数据库，函数返回一个数据库操作名柄，连接信息在函数中定义
def db_connect():
    # conn, cursor为全局变量，用于在函数外关闭数据库连接或使用数据库名柄
    global conn
    global cursor
    database_host = '127.0.0.1'         # mysql地址
    database_user = 'root'              # mysql用户名
    database_pass = 'QQspider2020'              # mysql用户密码
    database_name = 'covcode'           # 数据库名，不存在会自动创建

    # 连接数据库
    conn = pymysql.connect(database_host, database_user, database_pass, charset='utf8')
    # 使用cursor()方法获取操作游标
    cursor = conn.cursor()
    # 使用execute方法执行SQL语句
    cursor.execute("SELECT VERSION()")
    # 使用 fetchone() 方法获取一条数据
    db_data = cursor.fetchone()
    # print ("Connect Database Success!! Database version : %s " % db_data)

    # 数据库不存在则创建：
    cursor.execute("create database if not exists " + database_name + ";")
    cursor.execute("use " + database_name + ";")
    # 创建数据库表：
    sql_sub_table = """CREATE TABLE IF NOT EXISTS `sub_table` (
            `table_id` INT NOT NULL AUTO_INCREMENT,
            `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
            `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
            `table_name` VARCHAR(255) NOT NULL,
            primary key(table_id)
            )ENGINE=InnoDB DEFAULT CHARSET=utf8;"""
    sql_data_table = """CREATE TABLE IF NOT EXISTS `data_1` (
            `key_id` INT NOT NULL AUTO_INCREMENT,
            `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
            `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
            `gift_time` VARCHAR(255) NOT NULL,
            `gift_author` VARCHAR(255) NOT NULL,
            `gift_name` VARCHAR(255) NOT NULL,
            `gift_number` INT NOT NULL,
            `gift_color` VARCHAR(255) NOT NULL,
            `gift_master` VARCHAR(255) NOT NULL,
            primary key(key_id)
            )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;"""
    cursor.execute(sql_sub_table)
    cursor.execute(sql_data_table)

    # 初始化 sub_table 表数据,表为空才插入
    sql_test = "select * from sub_table"
    sql_init_sub_table = "insert into sub_table(table_name) values('data_1');"
    cursor.execute(sql_test)
    if not cursor.fetchall():
        cursor.execute(sql_init_sub_table)
        conn.commit()
    return cursor

# 数据插入函数，达到4万条数据自动分表
def db_operation(gift_data, temp_str):
    # time.sleep(200)
    # 先检测是否已断开mysql连接，断开则重连
    try:
        conn.ping()
    except:
        db_connect()
    # 获取最新的数据表名，保证表名后缀与table_id同步
    cursor.execute('select max(table_id) from sub_table;')
    table_id = cursor.fetchall()[0][0]     # sub_table表中的table_id
    table_name = 'data_' + str(table_id)

    # 插入数据前先查重
    cursor.execute("select max(gift_time) from "+table_name+";" )
    temp_fetchall = cursor.fetchall()[0][0]
    if not temp_fetchall or str(gift_data[0]) > temp_fetchall :     # 首先判断数据是否是空的，防止第一次建立数据库时出错
        # 准备插入数据
        # sql_insert_data = "insert into " + table_name + "(gift_time,gift_author,gift_name,gift_number,gift_color,gift_master) values('158753g0007325','猫熊最欧皇papapa','夺宝战机×1',1,'#FFEF9A','怼怼小哥-52001');"
        sql_insert_data = "insert into " + table_name + "(gift_time,gift_author,gift_name,gift_number,gift_color,gift_master) values('"+str(gift_data[0])+"','"+gift_data[1]+"','"+gift_data[2]+"',"+str(gift_data[3])+",'"+gift_data[4]+"','"+gift_data[5]+"');"
        try:
            cursor.execute(sql_insert_data)
            # 默认开启事务，插入需要执行一次commit
            conn.commit()
            # 输出插入的数据
            # print(str(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time())))+ ' :' + temp_str)
            with open (log_name, 'a') as log_handle:
                log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据写入成功,'+temp_str+'\n')
            # 插入数据之后，获取插入的Key_id,用以判断是否需要分表
            cursor.execute('select last_insert_id();')
            key_id = cursor.fetchall()[0][0]
        except Exception as e:
            print(e)
            with open (log_name, 'a') as log_handle:
                log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据写入失败,'+temp_str+'\n')
            conn.rollback()
        # 如果表中数据达到4万，则创建分表
        if key_id > 40000 :
            sql_data_table = """CREATE TABLE IF NOT EXISTS `data_""" + str(table_id+1) + """` (
                    `key_id` INT NOT NULL AUTO_INCREMENT,
                    `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
                    `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
                    `gift_time` VARCHAR(255) NOT NULL,
                    `gift_author` VARCHAR(255) NOT NULL,
                    `gift_name` VARCHAR(255) NOT NULL,
                    `gift_number` INT NOT NULL,
                    `gift_color` VARCHAR(255) NOT NULL,
                    `gift_master` VARCHAR(255) NOT NULL,
                    primary key(key_id)
                    )ENGINE=InnoDB DEFAULT CHARSET=utf8;"""
            cursor.execute(sql_data_table)
            #INSERT INTO `data_2`(`create_time`, `update_time`, `gift_time`, `gift_author`, `gift_name`, `gift_number`, `gift_color`, `gift_master`) select `create_time`, `update_time`, `gift_time`, `gift_author`, `gift_name`, `gift_number`, `gift_color`, `gift_master` from `data_1` where `key_id` >=45000
            #UPDATE `sub_table` SET `table_id`=2,`create_time`=now(),`update_time`=now(),`table_name`='data_2' 
            #INSERT INTO `sub_table`(`table_id`, `create_time`, `update_time`, `table_name`) VALUES (1,now(),now(),'data_1') 
            try:
                # 创建分表后需要将新表信息写入sub_table表中,这里要保证表名后缀与table_id同步
                cursor.execute("insert into sub_table(table_id, table_name) values(" + str(table_id+1) + ", 'data_" + str(table_id+1) + "');")
                conn.commit()
                cursor.execute("insert into data_" + str(table_id+1) + " ( `create_time`, `update_time`, `gift_time`, `gift_author`, `gift_name`, `gift_number`, `gift_color`, `gift_master`) select `create_time`, `update_time`, `gift_time`, `gift_author`, `gift_name`, `gift_number`, `gift_color`, `gift_master` from data_" + str(table_id) + " where key_id >= (40000 - 500 - 1) order by gift_time")
                conn.commit()
            except Exception as e:
                print(e)
                with open (log_name, 'a') as log_handle:
                    log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',新表数据写入失败,'+'-\n')
                conn.rollback()
    else:
        pass
        # print('数据重复!')
# test =============

headers = {'content-type': 'charset=utf8'}
ssl._create_default_https_context = ssl._create_unverified_context
urllib3.disable_warnings()

# log_name 用于日期每日当作日志文件名
log_name = time.strftime("%Y-%m-%d", time.localtime()) + '-log.csv'
def main():
    global log_name
    # 连接并初始化数据库信息
    cursor = db_connect()
    ctrl_data = ''
    time_totle = 0
    while 1:
        log_name = time.strftime("%Y-%m-%d", time.localtime()) + '-log.csv'
        # test = requests.get('https://egame.qq.com/245745870')
        # print(re.search('liveInfo:{videoInfo:{pid:"(.*?)"', test.text, re.S))
        #param={"0":{"module":"pgg_live_barrage_svr","method":"get_barrage","param":{"anchor_id":"10002","vid":"245745870_1586947490","other_uid":0,"last_tm":1586961091}}}
        nowTime = int(round(time.time() * 1000))
        header = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36',
            'Expect': '100-continue',
            'Connection': 'close'
        }
        url = 'https://wdanmaku.egame.qq.com/cgi-bin/pgg_barrage_async_fcgi?g_tk=&_=%d' % (nowTime + 3000)
        anchor_id = 245745870
        vid = '245745870_1586947490'
        data = {
            'param':'{"0": {"module": "pgg_live_barrage_svr", "method": "get_barrage", "param": {"anchor_id": "' + str(anchor_id) + '", "vid": "' + str(vid) + '", "other_uid": 0, "last_tm":' + str(nowTime) + '}}}'
        }
        
        try:
            html = requests.post(url, data=data, verify=False, timeout=8)
        except:
            with open (log_name, 'a') as log_handle:
                log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',连接超时，请检查网络或目标网站连通性,-\n')
            time.sleep(10)
            time_totle += 10
            continue
        # print(url)
        # print(data)
        # print('data row =====================++++++++++++++===================\n')
        # print(html.text)
        # print('data format =====================++++++++++++++===================\n')

        # 如果返回的数据不存在msg_list节点，直接放弃
        try:
            msg = json.loads(html.text)['data']['0']['retBody']['data']['msg_list']
        except:
            with open (log_name, 'a') as log_handle:
                log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',不存在msg_list节点,'+html.text+'\n')
            continue
            
        # 根据msg_list字段判断数据是否为空
        if msg :
            # print(msg)
            new_msg = sorted(msg,key=lambda x:(x['tm']))
            for msg_list in new_msg :
                gift_data = []
                try:
                    # print(msg)
                    temp_str = msg_list['content']# .encode('UTF-8')
                    # print temp_str
                    r = r'[在,参与] {0,1}(.*?)[ ,的]*直播间.*?出 (.*?)[ ]*[x,×]([0-9]+)'
                    re_data = re.findall(r,temp_str)
                    gift_data.append(msg_list['tm'])              # [0] time
                    gift_data.append(msg_list['ext']['0_t'])      # [1] author
                    gift_data.append(re_data[0][1])             # [2] name
                    gift_data.append(re_data[0][2])             # [3] number
                    gift_data.append(msg_list['ext']['0_c'])      # [4] color
                    if ' ' in re_data[0][0] :
                        gift_data.append(re_data[0][0].split('在 ')[1])
                    else:
                        gift_data.append(re_data[0][0])             # [5] master
                except:
                    if ctrl_data != temp_str:
                        # print('data format error - ' + time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time())) + ' :' + temp_str)
                        with open (log_name, 'a') as log_handle:
                            log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据格式错误,'+temp_str+'\n')
                        ctrl_data = temp_str
                    else:
                        pass
                if len(gift_data) == 6:
                    # gift_data = ['158753g0007325','猫熊最欧皇papapa','夺宝战机×1',1,'#FFEF9A','怼怼小哥-52001']
                    # 插入表数据,自动检测分表,传入的gift_data为爬虫抓取到的数据，是一个数组
                    db_operation(gift_data, temp_str)

        else:
            pass
            # print('nothing')
        time.sleep(2)
        time_totle += 3
        # 每隔大约6-8分钟输出脚本运行情况
        if time_totle >= 600:
            print(str(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time())))+ ' :' + 'Script is Running!')
            time_totle = 0

    # 关闭数据库连接
    if conn:
        conn.close()
    else:
        print("没有活跃的数据库连接可关闭!")


if __name__ == '__main__':
    main()
