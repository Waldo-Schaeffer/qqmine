<!--minecraft-->
<?php

if (!session_id()) session_start();
header("Content-type: text/html; charset=utf-8");
$diamond_id = 0;
$gold_id = 0;
$emerald_id = 0;
$box_id = 0;

function db_connect(){
    try{
        $database_host = '127.0.0.1';         # mysql地址
        $database_user = 'root';              # mysql用户名
        $database_pass = 'QQspider2020';              # mysql用户密码
        $database_name = 'egame_gift';           # 数据库名，不存在会自动创建
        $result = mysqli_connect($database_host, $database_user, $database_pass, $database_name);
    } catch (Exception $e) {
        echo $e->message;
        exit;
    }
    if (! $result) {
        return false;
    }
    return $result;
}

function db_connect_midiex(){
    try{
        $database_host = '127.0.0.1';         # mysql地址
        $database_user = 'root';              # mysql用户名
        $database_pass = 'QQspider2020';              # mysql用户密码
        $database_name = 'covcode';           # 数据库名，不存在会自动创建
        $result = mysqli_connect($database_host, $database_user, $database_pass, $database_name);
    } catch (Exception $e) {
        echo $e->message;
        exit;
    }
    if (! $result) {
        return false;
    }
    return $result;
}

# 该函数用于从数据库获取数据并循环输出到表格中
function html_center () {
    # 连接数据库
    $handle = db_connect();
    if (!$handle) {
        echo 'Did connect to the database faild!!!';
    }
	mysqli_set_charset($handle,"utf8");
	$handle_midiex = db_connect_midiex();
    if (!$handle_midiex) {
        echo 'Did connect to the database faild!!!';
    }
	mysqli_set_charset($handle_midiex,"utf8");
	//拿钻石矿工总数据
    $get_id = mysqli_query($handle, 'select max(table_id) from sub_table');
    $table_name = 'qqegame_gift_' . mysqli_fetch_array($get_id)[0];
	$sql = 'SELECT max(`key_id`) FROM ' . $table_name;
    $query_result = mysqli_query($handle, $sql);
	$max_id = mysqli_fetch_array($query_result)[0];
	$GLOBALS['diamond_id'] = $max_id;
	//拿金币矿工总数据
    $get_id = mysqli_query($handle, 'select max(table_id) from sub_table_gold');
    $table_name = 'qqegame_gift_gold_' . mysqli_fetch_array($get_id)[0];
	$sql = 'SELECT max(`key_id`) FROM ' . $table_name;
    $query_result = mysqli_query($handle, $sql);
	$max_id = mysqli_fetch_array($query_result)[0];
	$GLOBALS['gold_id'] = $max_id;
	//拿财富值矿工总数据
    $get_id = mysqli_query($handle, 'select max(table_id) from sub_table_emerald');
    $table_name = 'qqegame_gift_emerald_' . mysqli_fetch_array($get_id)[0];
	$sql = 'SELECT max(`key_id`) FROM ' . $table_name;
    $query_result = mysqli_query($handle, $sql);
	$max_id = mysqli_fetch_array($query_result)[0];
	$GLOBALS['emerald_id'] = $max_id;
	//拿梦幻盒子总数据
    $get_id = mysqli_query($handle_midiex, 'select max(table_id) from sub_table_midiex');
    $table_name = 'midiex_' . mysqli_fetch_array($get_id)[0];
	$sql = 'SELECT max(`key_id`) FROM ' . $table_name;
    $query_result = mysqli_query($handle_midiex, $sql);
	$max_id = mysqli_fetch_array($query_result)[0];
	$GLOBALS['box_id'] = $max_id;
}

html_center();

include_once('footer-minecraft.php');
