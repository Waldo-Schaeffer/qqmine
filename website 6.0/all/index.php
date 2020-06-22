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
        <h2>企鹅大数据（500条数据查阅）</h2>
        <br>
    </div>
	<div  class="col-md-12 col-lg-12 col-xl-6">
      <div class="card">
        <div class="card-body">
		<p style="font-size:18px;color:red" align="left">
		迷迭香数据私人订制、广告位、等商务合作联系微信: YunLong525626。
		欢迎各大公会前来洽谈。<br>账号一人一号外借被封不负责。<br>
		软件账号进群联系群主领取，一键加QQ群：<a href='https://jq.qq.com/?_wv=1027&k=55uF80w' target='_blank'>936266825</a><br>
		<font color="#0000FF">使用浏览器登录可以使用浏览器自带的保存密码功能保存密码</font><br>
		<font color="#000000" size="3">想要账号的在龙龙这儿出礼物获得：出货量达到3000元赠送普通账号，出货量达到1万给VIP账号，出货量达到2万以上给SVIP账号。<br>
		迷迭香数据接受私人订制联系龙龙<br>
		矿工盘、金卡盘不需要登录就能查看。普通账号可以查看臻品盘（可以计算别人填坑了多少）、头条卡盘（方便你找人收头条）。
		</font></p>
        </div>
      </div>
    </div>
    <div  class="col-md-12 col-lg-12 col-xl-6">
      <div class="card">
        <div class="card-body"><p align="left">
		<font color="#000000" size="3">
		VIP账号还能额外查看月球盘和神碎片盘。SVIP账号还能额外查看高级礼物盘（19999钻以上的礼物）、超级礼物盘（49999钻以上的礼物）
		</font></p>
        <img src='../ad.jpg' width=318 height=120 /><br />
		<p style='font-size:18px;color:red'>
            <?php
            if(!isset($_SESSION['username'])){
            echo '<div class="col-4 offset-8">
                欢迎您，请先<a href="login.php">登录</a>
                <br>
                <br>
            </div>';
            }else{
            echo '<div class="col-6 offset-6">
                欢迎您，' . $_SESSION['nickname'] . '。<a href="login.php?logout=yes">注销</a>
                <br>
                <br>
            </div>';
            }
            ?>
        </div>
      </div>
    </div>
	
    <div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body"><!-- style="background-image:url('../image/开心矿工.png');" -->
            <a href="mine.php">
              <img src="../image/qqmine.jpg" alt="Paris" width="180" height="160">
			  <!--br />矿工专场-->
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="5000.php">
              <img src="../image/5000.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="headline.php">
              <img src="../image/headline.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="MoonScoop.php">
              <img src="../image/moon.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<!--line 2-->
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="god.php">
              <img src="../image/god.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="luckydog.php">
              <img src="../image/luckydog.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="richking.php">
              <img src="../image/richking.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="box.php">
              <img src="../image/box.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="../long/box-seeall">
              <img src="../image/long.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="http://47.74.56.225/goldcard">
              <img src="../image/goldcard.jpg" alt="Paris" width="160" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="#">
              <img src="../image/jjqd.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="../">
              <img src="../image/back.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<!--div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="#">
              <img src="../image/jjqd.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div-->
    <!--div class="col-6">
      <div class="card"style="background-color: #7ED991;">
        <div class="card-body">
            <h5 class="card-title">金卡大数据</h5>
            <a href="#" class="btn btn-primary" >Go somewhere</a>
        </div>
      </div>
    </div-->

  </div>
</div>


<?php

//include_once('footer.php');
?>
