#!/usr/bin/env python3
# encoding:utf-8
import pymysql
# pip3 install -i https://pypi.douban.com/simple/ cryptography
# import cryptography     # 本脚本未使用该库，但连接mysql8以上需要，写在这里提醒一下

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
    sql_user_table = """CREATE TABLE IF NOT EXISTS `user` (
            `user_id` INT NOT NULL AUTO_INCREMENT,
            `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
            `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
            `end_time` TIMESTAMP NOT NULL DEFAULT DATE_ADD(CURRENT_TIMESTAMP,INTERVAL 14 DAY) comment '激活时间',
			`used_day` INT NOT NULL DEFAULT 14 comment '可以激活的天数',
			`used_time` TIMESTAMP NULL comment '有效期',
            `username` VARCHAR(255) NOT NULL comment '用户名',
            `password` VARCHAR(255) NOT NULL comment '密码',
            `phonenum` VARCHAR(255) NULL comment '手机号',
            `nickname` VARCHAR(255) NOT NULL DEFAULT '' comment '昵称',
            `note` VARCHAR(255) NOT NULL DEFAULT '' comment '备注',
            `Channel` INT NOT NULL comment '权限',
            `Channel-all` INT NOT NULL comment '查阅权限',
            `ban_id` INT NOT NULL comment '是否封禁',
            primary key(user_id)
            )ENGINE=InnoDB DEFAULT CHARSET=utf8;"""
    cursor.execute(sql_sub_table)
    cursor.execute(sql_data_table)
    cursor.execute(sql_user_table)
db_connect();
print ('数据库表已创建成功！')
print ('命令行中插入测试数据示例：')
print ('''insert into user(username,password,end_time,use_day,phonenum,nickname,note,Channel,`Channel-all`,ban_id) values('test','test','2020-07-31 23:59:59',14,'38380438','test','this is a test acount',2047,2047,0);''')
