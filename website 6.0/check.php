<!--此页面用于处理用户登录-->
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
    } 
	catch (Exception $e) {
        echo $e->message;
        exit;
    }
    if (! $result) {
        return false;
    }
    return $result;
}

# 该函数用于验证用户登录
function login () {
    # 连接数据库
    $handle = db_connect();
    if (!$handle) {
        die('Connect to the database faild!!!');
    }
	mysqli_set_charset($handle,"utf8");

    # 过滤字符防止sql注入,只允许数字，字母和 - 出现
    if ( preg_match('/[^a-zA-Z0-9-]/', $_POST['username']) or preg_match('/[^a-zA-Z0-9-]/', $_POST['password'])){
        echo "<script>alert('用户名不存在或密码错误！');location.href='login.php';</script>";
        die();
    }
    $username=substr($_POST['username'], 0, 20);     # 限制最大长度为20
    $password=substr($_POST['password'], 0, 20);     # 限制最大长度为20

    # 查询用户，用户名不区分大小写,密码区分大小写
    $sql = "SELECT * FROM user WHERE username='$username' and BINARY password='$password'";
    $result = mysqli_query($handle, $sql);
    if($result && mysqli_num_rows($result)>0){
        $res = mysqli_fetch_array($result);

        if( $res['used_time'] == NULL and $res['end_time'] >= date('Y-m-d H:i:s') ){
            mysqli_query($handle, "UPDATE user SET used_time= DATE_ADD(CURRENT_TIMESTAMP, INTERVAL " . $res['use_day'] . " DAY) WHERE user_id=".$res['user_id']);
			$sql = "SELECT * FROM user WHERE username='$username' and BINARY password='$password'";
			$result = mysqli_query($handle, $sql);
			$res = mysqli_fetch_array($result);
        }elseif($res['used_time'] == NULL and $res['end_time'] <= date('Y-m-d H:i:s')){
            echo "<script>alert('账号已过激活有效期无法激活,请联系管理员！');location.href='login.php';</script>";
            die();
        }elseif ( $res['used_time'] <= date('Y-m-d H:i:s') ){
            echo "<script>alert('该账号已过期或被禁用，请联系管理员！');location.href='login.php';</script>";
            die();
        }
        # 判断账号是否被禁用,不为0则被禁用
        if ( $res['ban_id'] != 0 ){
            echo "<script>alert('该账号已过期或被禁用，请联系管理员！');location.href='login.php';</script>";
            die();
        }
        # 账号信息写入session
        $_SESSION['username'] = $username;
        $_SESSION['Channel'] = $res['Channel'];
		$_SESSION['Channel-all'] = $res['Channel-all'];
		$_SESSION['used_time'] = $res['used_time'];
		$_SESSION['end_time'] = $res['end_time'];
		$_SESSION['ban_id'] = $res['ban_id'];
		$_SESSION['nickname'] = $res['nickname'];
		# 如果没有昵称，则显示用户名
		if (empty($_SESSION['nickname'])){
			$_SESSION['nickname'] = $res['username'];
		;}
        $_SESSION['time'] = time(); # 获取当前时间戳，若干时间后强制重新登录
        echo "<script>location.href='index.php';</script>";
    }
    else {
        echo "<script>alert('用户名不存在或密码错误！');location.href='login.php';</script>";
        // echo $password;
    }
}


login();

// include_once('footer.php');
?>
