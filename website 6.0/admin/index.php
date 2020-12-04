<!--此页面用于处理用户登录-->
<?php

session_start();
header("Content-type: text/html; charset=utf-8");
#date_default_timezone_set('PRC'); 
include_once('header.php');
if(!isset($_SESSION['username'])){
        echo "<script>alert('请先登录！如果没有账号，请联系管理员获取！');location.href='../login.php';</script>";
}
if($_SESSION['Channel-all'] <= 0){
        echo "<script>alert('您没有权限查看此页！请联系管理员！');location.href='../index.php';</script>";
}
?>
<div class="container" style="text-align:center">
  <div class="row">
    <div class="col-12">
        <br>
        <h2>企鹅大数据（数据查阅）</h2>
        <br>
    </div>
	<div  class="col-md-12 col-lg-12 col-xl-6">
      <div class="card">
        <div class="card-body">
		<p style="font-size:18px;color:red" align="left">
		迷迭香数据私人订制、广告位、等商务合作联系微信: YunLong525626。
		欢迎各大公会前来洽谈。<br>账号一人一号外借被封不负责。<br>
		软件账号进群联系群主领取，一键加QQ群：<a href='https://jq.qq.com/?_wv=1027&k=55uF80w' target='_blank'>936266825</a><br>
		数据查阅是用来查看500-1000条静态数据的，不是实时刷新的，请留意！<br>
		<font color="#0000FF">使用浏览器登录可以使用浏览器自带的保存密码功能保存密码</font>
		</p>
        </div>
      </div>
    </div>
    <div  class="col-md-12 col-lg-12 col-xl-6">
      <div class="card">
        <div class="card-body">
		<!--p align="left">
		<font color="#000000" size="3">
		&nbsp;
		</font>
		</p-->
        <img src='../ad.jpg' width=318 height=120 /><br />
		<p style='font-size:18px;color:blank'>
            <?php
            if(!isset($_SESSION['username'])){
            echo '
                欢迎您，请先<a href="login.php">登录</a>
                <br>
                <br>
            ';
            }else{
            echo '
                欢迎您，' . $_SESSION['nickname'] . '。您的有效期至' . $_SESSION['used_time'] . '。<a href="../login.php?logout=yes">退出登录</a>
                <br>
                <br>
            ';
            }
            ?>
        </div>
      </div>
    </div>
    <div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./gift">
              <img src="../image/gift2.jpg" alt="钻石矿工专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./5000">
              <img src="../image/5000.jpg" alt="钻石矿工臻品专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./gold">
              <img src="../image/gold.jpg" alt="金币矿工专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./gold2">
              <img src="../image/gold2.jpg" alt="金币矿工高级专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./emerald">
              <img src="../image/emerald.jpg" alt="财富值矿工专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./emerald2">
              <img src="../image/emerald2.jpg" alt="财富值矿工高级专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./emerald3">
              <img src="../image/emerald3.jpg" alt="财富值矿工超级专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="MoonScoop.php">
              <img src="../image/moon.jpg" alt="月球专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="richking.php">
              <img src="../image/richking.jpg" alt="超级礼物专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./midiex">
              <img src="../image/box.jpg" alt="梦幻盒子专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="http://47.74.56.225/goldcard/">
              <img src="../image/goldcard.jpg" alt="金卡传说" width="160" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="./magic">
              <img src="../image/magic.jpg" alt="魔力包专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<!--div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="#">
              <img src="../image/jjqd.jpg" alt="敬请期待" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="#">
              <img src="../image/jjqd.jpg" alt="敬请期待" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="#">
              <img src="../image/jjqd.jpg" alt="敬请期待" width="180" height="160">
            </a>
        </div>
      </div>
    </div-->
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="../search">
              <img src="../image/midiex2.jpg" alt="梦幻盒子数据查阅" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="../">
              <img src="../image/back.jpg" alt="返回首页" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	
  </div>
</div>

<p center>
    &copy;jsly
</p>
<?php

//include_once('footer.php');
?>
