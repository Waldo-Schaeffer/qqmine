<?php

include_once('power.php');
if (!session_id()) session_start();
header("Content-type: text/html; charset=utf-8");
#date_default_timezone_set('PRC'); 
include_once('header.php');

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

# 该函数用于屏蔽指定礼物
function block_gift ($data) {
    if ($data == '梦幻迷迭香')
        return true;
    if ($data == '梦幻摩天轮')
        return true;
	if ($data == 'BUFF梦幻迷迭香')
        return true;
    if ($data == 'BUFF梦幻摩天轮')
        return true;
	if ($data == '梦幻热气球')
        return true;
    if ($data == 'BUFF梦幻热气球')
        return true;
	if ($data == '星际战舰')
        return true;
    if ($data == 'BUFF星际战舰')
        return true;
    # 把要屏蔽的礼物用if筛选掉
    return false;
}

# 输出表头
function html_header () {
	echo"    <div class='container'>
                <div class='row'>
                  <div class='panel panel-default col-sm-12 col-lg-12 col-xs-12 col-md-12'>
                    <!--div class='panel-heading'>企鹅挖矿大数据4.6</div-->
					<div class='panel-heading'></div>
                    ";
    # =========  广告位 ==========
    advertisement();
    echo            "
                    <div class='panel-body table-responsive'>
					欢迎您，" . $_SESSION['nickname'] . "。您的有效期至" . $_SESSION['used_time'] . "。<a href='index.php'>返回主页</a><br />
					每日爆出的礼物统计，数据仅供参考，具体以实际情况为准。（没有办法统计小礼物的情况）
                      <table class='table table-bordered table-hover'>
                        <thead>
                        <tr>
                          <th>日期</th>
                          <th>礼物名称</th>
						  <th>单价</th>
                          <th>数量</th>
                          <th>价值</th>
                        </tr>
                        </thead>
                        <tbody>
    ";
}

# 该函数用于输出表格尾部
function html_footer () {
    echo "         </tbody>
                  </table>
                 </div>
              </div>
            </div>
          </div>";
}

# 该函数用于从数据库获取数据并循环输出到表格中
function html_center () {
    # 连接数据库
    $handle = db_connect();
    if (!$handle) {
        echo 'Did connect to the database faild!!!';
    }
	mysqli_set_charset($handle,"utf8");


for ($x=0; $x<=10; $x++) {
    $get_id = mysqli_query($handle, 'select max(table_id) from sub_table');
    $table_name = 'qqegame_gift_' . mysqli_fetch_array($get_id)[0];
    # echo $table_name;
    $sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%独角兽%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
    if (!$query_result) {
        printf("Error: %s\n", mysqli_error($handle));
        exit();
    }
	$dujiaoshou = mysqli_fetch_array($query_result)[0];
        echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>独角兽（30天）</td>
							<td>50000钻石</td>
							<td>" . $dujiaoshou . "</td>
							<td>&nbsp;&nbsp;" . $dujiaoshou * 50000 . "钻石</td>
						</tr>
              ";
	$zonge = $dujiaoshou * 50000;
	
	$name = '夺宝战机';
	$gift_value = -5000;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	$name = '私奔到月球';
	$gift_value = -20000;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	$name = '头条卡';
	$gift_value = -3000;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	$name = '皇家招财猫';
	$gift_value = -66666;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	
	$name = '皇家钞票枪';
	$gift_value = -56666;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	$name = '皇家同花顺';
	$gift_value = -88888;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	
	$name = '风铃禾梦';
	$gift_value = -131400;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	
	$name = '甜心宝蓓';
	$gift_value = -77770;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	
	$name = '无间道';
	$gift_value = -99990;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	
	
	$name = '合体';
	$gift_value = -66660;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	
	$name = '梦游仙境';
	$gift_value = -77770;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	
	
	$name = '盛宴黑桃A';
	$gift_value = -88888;
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (name like "%' . $name . '%") and  date(`date`) = date_add(date(now()), interval -' . $x . ' day) ';
    $query_result = mysqli_query($handle, $sql);
	$gift_num = mysqli_fetch_array($query_result)[0];
	
	
	echo "
                <tr bgcolor='#FFD980'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>" . $name . "</td>
							<td>" . $gift_value . "钻石</td>
							<td>" . $gift_num . "</td>
							<td>" . $gift_num * $gift_value . "钻石</td>
						</tr>
              ";
	$zonge = $zonge + ($gift_num * $gift_value);
	
	//echo $zonge
	echo "
                <tr bgcolor='#00FF00'>
							<td>" . date("Y-m-d",strtotime('-' . $x . ' days')) . "</td>
							<td>合计</td>
							<td>无</td>
							<td>无</td>
							<td>" . $zonge . "钻石</td>
						</tr>
              ";
	
}
}

html_header();
html_center();
html_footer();

include_once('footer-gift.php');
