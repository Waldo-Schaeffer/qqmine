<?php
session_start();
if (isset($_GET['logout']) && $_GET['logout'] == 'yes'){
    $_SESSION['username'] = null;
	#防止注销后显示名字和权限错乱
	$_SESSION['nickname'] = null;
	$_SESSION['Channel'] = null;
	$_SESSION['Channel-all'] = null;
    echo "<script>alert('您已注销登录！');location.href='./login.php';</script>";
    die();
}
if(isset($_SESSION['username'])){
    echo "<script>alert('您已经登录，请不要重复登录！');location.href='./index.php';</script>";
    die();
}
include_once('header.php');
?>

<div class="row" style="margin-top:30px; text-align:center;">
  <div class="col-md-4 offset-md-4" >
    <div class="well col-md-12 ">
        <h3>用户登录</h3>
        <form method="post" action="check.php">
            <div class="input-group input-group-md">
                <span class="input-group-addon" id="sizing-addon1"><i aria-hidden="true"></i></span>
                <input name="username" type="text" class="form-control" placeholder="用户名" aria-describedby="sizing-addon1">
            </div>
            <div class="input-group input-group-md">
                <span class="input-group-addon" id="sizing-addon1"><i></i></span>
                <input name="password" type="password" class="form-control" placeholder="密码" aria-describedby="sizing-addon1">
            </div>
            <div class="well well-sm">
                <br>
                <!--
                <input type="radio" name="kind" value="tea"> 老师
                <input type="radio" name="kind" value="stu"> 学生
                -->
            </div>
            <button name="submit" type="submit" class="btn btn-success btn-block">
                登录
            </button>
        </form>
    </div>
  </div>
</div>

<!--?php
include_once('footer.php');

?-->
