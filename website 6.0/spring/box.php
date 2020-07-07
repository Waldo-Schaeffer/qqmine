<?php

session_start();
header("Content-type: text/html; charset=utf-8");
#date_default_timezone_set('PRC'); 
include_once('header.php');

function db_connect(){
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

# 该函数用于屏蔽指定礼物
function block_gift ($data) {
    if ($data == '梦幻迷迭香')
        return false;
    if ($data == '梦幻摩天轮')
        return false;
	if ($data == 'BUFF梦幻迷迭香')
        return false;
    if ($data == 'BUFF梦幻摩天轮')
        return false;
	if ($data == '梦幻热气球')
        return false;
    if ($data == 'BUFF梦幻热气球')
        return false;
	if ($data == '星际战舰')
        return false;
    if ($data == 'BUFF星际战舰')
        return false;
    # 把要屏蔽的礼物用if筛选掉
    return true;
}

# 输出表头
function html_header () {
	/*
	# 连接数据库
    $handle = db_connect();
    if (!$handle) {
        echo 'Did connect to the database faild!!!';
    }
	mysqli_set_charset($handle,"utf8");
	
	$gift_master = 'gift_master <=> "春哥法力无边" or gift_master <=> "晞秋Ball" or gift_master <=> "TR情谊-春哥" or gift_master <=> "TR情谊-残夜酱" or gift_master <=> "春哥的意大利炮" or gift_master <=> "春哥的法拉利" or gift_master <=> "春哥的布加迪威龙" or gift_master <=> "企鹅电竞沃哥" or gift_master <=> "TR情谊-殷水春"';
	#print($gift_master);
    $get_id = mysqli_query($handle, 'select max(table_id) from sub_table');
    $table_name = 'data_' . mysqli_fetch_array($get_id)[0];
    # echo $table_name;
    $sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻迷迭香%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 1) ) ';
    $query_result = mysqli_query($handle, $sql);
    if (!$query_result) {
        printf("Error: %s\n", mysqli_error($handle));
        exit();
    }
	$one_1 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻迷迭香%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 3) ) ';
    $query_result = mysqli_query($handle, $sql);
	$one_3 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻迷迭香%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 6) ) ';
    $query_result = mysqli_query($handle, $sql);
	$one_6 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻迷迭香%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(curdate()) ) ';
    $query_result = mysqli_query($handle, $sql);
	$one_day = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻摩天轮%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 1) ) ';
    $query_result = mysqli_query($handle, $sql);
	$two_1 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻摩天轮%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 3) ) ';
    $query_result = mysqli_query($handle, $sql);
	$two_3 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻摩天轮%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 6) ) ';
    $query_result = mysqli_query($handle, $sql);
	$two_6 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻摩天轮%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(curdate()) ) ';
    $query_result = mysqli_query($handle, $sql);
	$two_day = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻热气球%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 1) ) ';
    $query_result = mysqli_query($handle, $sql);
	$three_1 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻热气球%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 3) ) ';
    $query_result = mysqli_query($handle, $sql);
	$three_3 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻热气球%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 6) ) ';
    $query_result = mysqli_query($handle, $sql);
	$three_6 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻热气球%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(curdate()) ) ';
    $query_result = mysqli_query($handle, $sql);
	$three_day = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%星际战舰%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 1) ) ';
    $query_result = mysqli_query($handle, $sql);
	$four_1 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%星际战舰%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 3) ) ';
    $query_result = mysqli_query($handle, $sql);
	$four_3 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%星际战舰%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 6) ) ';
    $query_result = mysqli_query($handle, $sql);
	$four_6 = mysqli_fetch_array($query_result)[0];
	
	$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%星际战舰%") and ( ' . $gift_master  . ' ) and `gift_time` / 1000 >= (unix_timestamp(curdate()) ) ';
    $query_result = mysqli_query($handle, $sql);
	$four_day = mysqli_fetch_array($query_result)[0];
	*/
    echo"    <div class='container'>
                <div class='row'>
                  <div class='panel panel-default col-sm-12 col-lg-12 col-xs-12 col-md-12'>
                    <!--div class='panel-heading'>企鹅挖矿大数据4.6</div-->
					<div class='panel-heading'></div>
                    ";
    # =========  广告位 ==========
	#SELECT count(*) FROM `data_2` where (gift_name like "%梦幻迷迭香%") and (gift_master  <=> "户外丶大宝哥" or gift_master  <=> "Sog丶龙龙.") and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 48) ) 
	#$sql = 'SELECT count(*) FROM ' . $table_name .' where (gift_name like "%梦幻迷迭香%") and (gift_master  <=> "户外丶大宝哥" or gift_master  <=> "Sog丶龙龙.") and `gift_time` / 1000 >= (unix_timestamp(now()) - (3600 * 48) ) ';
    advertisement();
    echo            "
                    <div class='panel-body table-responsive' >
                      <table class='table table-bordered table-hover'>
                        <thead>
                        <tr>
                          <th>时间</th>
                          <th>昵称</th>
                          <th>礼物</th>
                          <th>数量</th>
                          <th>直播间</th>
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

    $get_id = mysqli_query($handle, 'select max(table_id) from sub_table');
    $table_name = 'data_' . mysqli_fetch_array($get_id)[0];
    # echo $table_name;
	
	$gift_master = 'gift_master <=> "春哥法力无边" or gift_master <=> "晞秋Ball" or gift_master <=> "TR情谊-春哥" or gift_master <=> "TR情谊-残夜酱" or gift_master <=> "春哥的意大利炮" or gift_master <=> "春哥的法拉利" or gift_master <=> "春哥的布加迪威龙" or gift_master <=> "企鹅电竞沃哥" or gift_master <=> "TR情谊-殷水春"';
	
    $sql = 'select gift_time,gift_author,gift_name,gift_number,gift_color,gift_master from ' . $table_name .' where (gift_name <=> "梦幻迷迭香"  or gift_name <=> "梦幻摩天轮"  or gift_name <=> "BUFF梦幻迷迭香"  or gift_name <=> "BUFF梦幻摩天轮" or gift_name <=> "梦幻热气球" or gift_name <=> "BUFF梦幻热气球" or gift_name <=> "星际战舰" or gift_name <=> "BUFF星际战舰") and ( ' . $gift_master . ' ) order by gift_time desc limit 0,55';
    $query_result = mysqli_query($handle, $sql);
    if (!$query_result) {
        printf("Error: %s\n", mysqli_error($handle));
        exit();
    }

    # 循环输出表格内容
    $number = 0;
    # flag控制输出条数，不从数据库限制是因为有礼物黑名单
    $flag = 50;
    while ($data = mysqli_fetch_array($query_result)) {
        if ( block_gift($data[2]) )
            continue;
        $number++;
        if ($number > $flag)
            break;
		if ($data[5] == '与')				# 无直播间时正则抓到的直播间名为 与 ，此时替换为 [主页活动页面]
			$data[5] = '[主页活动页面]';
        echo "
                <tr bgcolor='" . color_switch($data[2],$data[4]) . "'>
                  <td>" . date('Y-m-d H:i:s', substr($data[0], 0,10)+8*60*60) . "</td>
                  <td>$data[1]</td>
                  <td>$data[2]</td>
                  <td>$data[3]</td>
                  <td>$data[5]</td>
                </tr>
              ";
    }
}

html_header();
html_center();
html_footer();

include_once('footer.php');
