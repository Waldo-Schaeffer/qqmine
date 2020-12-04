<?php
# 获取当前用户访问的页面，如果是获取当前程序流程所在文件名应当使用 basename(__FILE__)
$current_file = basename($_SERVER['SCRIPT_NAME']);
$power = 0;

# 使用下面这个表维护各个页面的权限
# Channal的二进制位为1则表示有权限，反之则无。$power表示第几位，默认为0，为0时无权限
switch($current_file){

    case "mine.php":
        $power = 1;
        break;
	case "gift.php":
        $power = 1;
        break;
    case "5000.php":
        $power = 2;
        break;
	case "headline.php":
        $power = 3;
        break;
	case "MoonScoop.php":
	    $power = 4;
        break;
	case "god.php":
	    $power = 5;
        break;
	case "gold2.php":
	    $power = 7;
        break;
	case "emerald2.php":
	    $power = 8;
        break;
	case "emerald3.php":
	    $power = 8;
        break;
	case "richking.php":
	    $power = 9;
        break;
	case "box.php":
	    $power = 10;
        break;
	case "midiex.php":
	    $power = 10;
        break;
	case "giftcount.php":
	    $power = 10;
        break;
	case "minecount.php":
	    $power = 19;
        break;
    default:
        $power = 30;
}
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>alert('请先登录！如果没有账号，请联系管理员获取！');location.href='login.php';</script>";
    die();
}

# 检测账号是否过期或被禁用，是则注销账号
if ( $_SESSION['ban_id'] != 0 or $_SESSION['used_time'] <= date('Y-m-d H:i:s') ){
    $_SESSION['username'] = null;
    $_SESSION['nickname'] = null;
    $_SESSION['Channel'] = null;
    $_SESSION['Channel-all'] = null;
    echo "<script>alert('当前账号已过期或被禁用，请联系管理员！');location.href='./login.php?logout=yes';</script>";
    die();
}

if((!isset($_SESSION['Channel']))or(! ($_SESSION['Channel'] % pow(2, $power) >= pow(2, $power-1)))){
    echo "<script>alert('您没有权限查看此页！请联系管理员！');location.href='index.php';</script>";
    die();
}

# 强制重新登录的时间间隔，单位：秒 ,12小时即43200秒
$timeout = 43200;
if((!isset($_SESSION['Channel']))or(time() - $_SESSION['time'] >= $timeout)){
    echo "<script>alert('登录会话已过期，请重新登录！');location.href='login.php?logout=yes';</script>";
    die();
}

