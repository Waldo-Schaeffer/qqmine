#!/usr/bin/python3
# encoding:utf-8
import requests
import re
import time
import ssl
import urllib3
import json
import pymysql
import datetime

conn = None
cursor = None
# db_connect 函数用于连接数据库，函数返回一个数据库操作名柄，连接信息在函数中定义
def db_connect():
    # conn为全局变量，用于在函数外关闭数据库连接
    global conn
    global cursor
    database_host = '127.0.0.1'         # mysql地址
    database_user = 'root'              # mysql用户名
    database_pass = 'QQspider2020'              # mysql用户密码
    database_name = 'egame_gift'           # 数据库名，不存在会自动创建

    # 连接数据库
    conn = pymysql.connect(database_host, database_user, database_pass, charset='utf8')
    # 使用cursor()方法获取操作游标
    cursor = conn.cursor()
    # 使用execute方法执行SQL语句
    cursor.execute("SELECT VERSION()")
    # 使用 fetchone() 方法获取一条数据
    db_data = cursor.fetchone()
    print ("Connect Database Success!! Database version : %s " % db_data)

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
            
    sql_data_table = """CREATE TABLE IF NOT EXISTS `qqegame_gift_1` (
            `key_id` INT NOT NULL AUTO_INCREMENT,
            `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
            `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
            `name` VARCHAR(255) NOT NULL,
            `num` VARCHAR(255) NOT NULL,
            `nick` VARCHAR(255) NOT NULL,
            `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `source` VARCHAR(800) NOT NULL,
            primary key(key_id)
            )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;"""
    cursor.execute(sql_sub_table)
    cursor.execute(sql_data_table)
    
    # 初始化 sub_table 表数据,表为空才插入
    sql_test = "select * from sub_table"
    sql_init_sub_table = "insert into sub_table(table_name) values('qqegame_gift_1');"
    cursor.execute(sql_test)
    if not cursor.fetchall():
        cursor.execute(sql_init_sub_table)
        conn.commit()
    return cursor

# 数据插入函数
def db_operation(qqegame_gift, temp_str):
    # time.sleep(200)
    # 先检测是否已断开mysql连接，断开则重连
    try:
        conn.ping()
    except:
        db_connect()
    # 获取最新的数据表名，保证表名后缀与table_id同步
    cursor.execute('select max(table_id) from sub_table;')
    table_id = cursor.fetchall()[0][0]     # sub_table表中的table_id
    table_name = 'qqegame_gift_' + str(table_id)

    # 插入数据前先查重
    cursor.execute("select date,source from "+table_name+" where date=(select max(date) from "+table_name+") ;" )
    check_fetchall = cursor.fetchall()
    # 首先判断数据是否是空的，防止第一次建立数据库时出错
    if check_fetchall: 
        temp_fetchall, temp_fetchall_2 = check_fetchall[0]
    else:
        temp_fetchall, temp_fetchall_2 = '1020-01-01 00:00:00', ''
    # print(str(temp_fetchall)+'|||||||||' + str(qqegame_gift[3]) )
    if str(qqegame_gift[3]) >= str(temp_fetchall) and qqegame_gift[4] != temp_fetchall_2 :
        sql_insert_data = "insert into " + table_name + "(name,num,nick,date,source) values('"+qqegame_gift[0]+"','"+str(qqegame_gift[1])+"','"+qqegame_gift[2]+"','"+str(qqegame_gift[3])+"',"+'''"'''+str(qqegame_gift[4])+'''"'''+");"
        # print(sql_insert_data)
        # exit();
        try:
            cursor.execute(sql_insert_data)
            # 默认开启事务，插入需要执行一次commit
            conn.commit()
            # 输出插入的数据
            # print(str(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time())))+ ' :' + temp_str)
            with open (log_name, 'a') as log_handle:
                log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据写入成功,'+str(temp_str)+'\n')
            # 插入数据之后，获取插入的Key_id,用以判断是否需要分表
            cursor.execute('select last_insert_id();')
            key_id = cursor.fetchall()[0][0]
        except Exception as e:
            print(e)
            with open (log_name, 'a') as log_handle:
                log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据写入失败,'+str(temp_str)+'\n')
            conn.rollback()
            
        # 如果表中数据达到4万，则创建分表
        if key_id > 40000 :
            sql_data_table = """CREATE TABLE IF NOT EXISTS `qqegame_gift_""" + str(table_id+1) + """` (
                    `key_id` INT NOT NULL AUTO_INCREMENT,
                    `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
                    `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
                    `name` VARCHAR(255) NOT NULL,
                    `num` VARCHAR(255) NOT NULL,
                    `nick` VARCHAR(255) NOT NULL,
                    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `source` VARCHAR(800) NOT NULL,
                    primary key(key_id)
                    )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;"""
            cursor.execute(sql_data_table)
            try:
                # 创建分表后需要将新表信息写入sub_table表中,这里要保证表名后缀与table_id同步
                cursor.execute("insert into sub_table(table_id, table_name) values(" + str(table_id+1) + ", 'qqegame_gift_" + str(table_id+1) + "');")
                conn.commit()
                cursor.execute("insert into qqegame_gift_" + str(table_id+1) + " ( `create_time`, `update_time`, `name`, `num`, `nick`, `date`, `source`) select `create_time`, `update_time`, `name`, `num`, `nick`, `date`, `source` from qqegame_gift_" + str(table_id) + " where key_id >= (40000 - 500 - 1) order by date")
                conn.commit()
            except Exception as e:
                print(e)
                with open (log_name, 'a') as log_handle:
                    log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',新表数据写入失败,'+'-\n')
                conn.rollback()
    else:
        pass
        #print('数据重复!')
# test =============



headers = {'content-type': 'charset=utf8'}
ssl._create_default_https_context = ssl._create_unverified_context
urllib3.disable_warnings()

# log_name 用于获取日期当作日志文件名
log_name = time.strftime(".\log\%Y-%m-%d", time.localtime()) + '-egame_gift-log.csv'
def main():
    global log_name
    while 1:
        # 连接并初始化数据库信息
        cursor = db_connect()
        flag = True
        #ctrl_time = int(str(time.time())[0:10]) - 179
        ctrl_data = ''
        time_totle = 0
        number_first = 1
        break_time = 0
        while 1:

            # flag 为布尔值，用以标记上次循环是否有插入数据，是则休眠三分钟
            #if flag :
            #    try:
            #        time.sleep(180 - (int(str(time.time())[0:10]) - int(ctrl_time)))
            #        time_totle += 180
            #    except:
            #        flag = False
            
            log_name = time.strftime(".\log\%Y-%m-%d", time.localtime()) + '-log.csv'
            nowTime = int(round(time.time() * 1000))
            #在今天抓取之前获取日期以防止出错
            jintian = str(datetime.date.today())
            if (break_time >= 2400) :
                exit()
            header = {
                'Connection': 'close'
            }
            cookies = {
                'pgg_appid':'101503919; pgg_openid=0D28F5E8F39A0FB1FDF386CD95B42834; pgg_access_token=ECF29045412B8C49D099D943EE27785B; pgg_type=1'
            }
            url = 'https://share.egame.qq.com/cgi-bin/pgg_async_fcgi?_=' + str(nowTime + 3000)
            if number_first == 1 :
                data = {
                    'param':'{"0":{"param":{"type":0,"anchor_id":0,"name":"","ts":' + str(nowTime / 1000) + ',"page_num":1,"page_size":50},"module":"pgg_loot_boxes_mt_svr","method":"get_loot_prize_detail"}}'
                }
                number_first = 0
            else:
                data = {
                    'param':'{"0":{"param":{"type":0,"anchor_id":0,"name":"","ts":' + str(nowTime / 1000) + ',"page_num":1,"page_size":50},"module":"pgg_loot_boxes_mt_svr","method":"get_loot_prize_detail"}}'
                }
                time.sleep(1)
                break_time += 1
            try:
                html = requests.post(url, data=data, headers=header, cookies=cookies, verify=False, timeout=8)
                # print(html.text)
            except:
                with open (log_name, 'a') as log_handle:
                    log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',爬取数据失败，请检查网络及目标网站是否正常,'+'-\n')
                time.sleep(2)
                time_totle += 10
                continue

            # 如果返回的数据不存在details节点，直接放弃
            try:
                msg = json.loads(html.text)['data']['0']['retBody']['data']['details']
            except:
                print ('数据错误：不存在data节点！！-1')
                flag = False
                with open (log_name, 'a') as log_handle:
                    log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据格式出错,'+html.text+'\n')
            # 根据msg判断数据是否为空
            if msg :
                #print(msg)
                # 先按时间排序，原本数据是倒序的
                try:
                    new_msg = sorted(msg,key=lambda x:(x['date']))
                    #print (new_msg)
                    
                except:
                    print ('数据错误：不存在date节点！！')
                
                for msg_list in new_msg :
                    qqegame_gift = []
                    # print(msg_list['name'])
                    # exit()
                    try:
                        # print(msg_list['date'])
                        temp_str = msg_list
                        qqegame_gift.append(msg_list['item']['name'])                  # 0 礼物名字
                        qqegame_gift.append(msg_list['item']['num'])                   # 1 数量
                        qqegame_gift.append(msg_list['user_info']['nick'])                  # 2 用户名
                        #时间格式变更
                        #print(str(msg_list['date']))
                        #print(str(datetime.date.today()))
                        #print(str(datetime.date.today()) + " " + str(msg_list['date']))
                        qqegame_gift.append( jintian + " " + str(msg_list['date']))                  # 3 日期/时间
                        qqegame_gift.append(str(msg_list))                     # 4 源数据
                    except:
                        if ctrl_data != temp_str:
                            # print('data format error - ' + time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time())) + ' :' + temp_str)
                            with open (log_name, 'a') as log_handle:
                                log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据格式错误,'+str(temp_str)+'\n')
                            ctrl_data = temp_str
                        else:
                            pass
                    #print (qqegame_gift)
                    if len(qqegame_gift) == 5:
                        db_operation(qqegame_gift, temp_str)
                        flag = True
                        #ctrl_time = msg_list['end_ts']
                    else:
                        print ('数据错误：数据不完整！！')
                        flag = False
                        with open (log_name, 'a') as log_handle:
                            log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据格式出错,'+html.text+'\n')

            else:
                with open (log_name, 'a') as log_handle:
                    log_handle.write(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))+',数据为空,'+html.text+'\n')
                print ('数据错误：不存在data节点！！-2')
                flag = False

            if not flag:
                time.sleep(5)
                time_totle += 5
            # 每隔大约10分钟输出一次脚本运行情况
            if time_totle >= 360:
                print(str(time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time())))+ ' :' + 'Script is Running!')
                time_totle = 0

        # 关闭数据库连接
        if conn:
            conn.close()
            print ('数据库连接已关闭！')
        else:
            print("没有活跃的数据库连接可关闭!")


if __name__ == '__main__':
    main()
