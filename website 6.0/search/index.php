<!--此页面用于处理用户登录-->
<?php

session_start();
#echo $_SESSION['Channel'];
header("Content-type: text/html; charset=utf-8");
#date_default_timezone_set('PRC'); 
if(!isset($_SESSION['username'])){
        echo "<script>alert('请先登录！如果没有账号，请联系管理员获取！');location.href='../login.php';</script>";
}
if($_SESSION['Channel-all'] <= 0){
        echo "<script>alert('您没有权限查看此页！请联系管理员！');location.href='../index.php';</script>";
}
include_once('header.php');
?>
<div class="container" style="text-align:center">
  <div class="row">
    <div class="col-12">
        <br>
        <h2>企鹅梦幻盒子大数据（搜索版）</h2>
        <br>
    </div>

    <div  class="col-md-12 col-lg-12 col-xl-6">
      <div class="card">
        <div class="card-body">
		<p style="font-size:17px;color:red" align="left">
		迷迭香数据私人订制、广告位、等商务合作联系微信: YunLong525626。
		欢迎各大公会前来洽谈。<br>账号一人一号外借被封不负责。<br>
		软件账号进群联系群主领取，点击群号一键加QQ群：<a href='https://jq.qq.com/?_wv=1027&k=55uF80w' target='_blank'>936266825</a><br>
		<font color="#0000FF">使用浏览器登录可以使用浏览器自带的保存密码功能保存密码</font><br>
		<font color="#000000" size="3">此页面用于搜索单个直播间和全平台的盒子数据</font>
		<?php
		if($_SESSION['nickname'] == '一只小独狼'){
			echo '<font color="#000000" size="3">flag{Welcome_to_CTFD}</font>';
		}
		?>
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
                欢迎您，请先<a href="../login.php">登录</a>
            ';
            }else{
            echo '
                欢迎您，' . $_SESSION['nickname'] . '。<br />您的有效期至' . $_SESSION['used_time'] . '。<a href="../login.php?logout=yes">退出登录</a>
            ';
            }
            ?>
        </div>
      </div>
    </div>
    <div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./midiex?name=">
              <img src="../image/midiex1.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./midiexcount?name=">
              <img src="../image/midiexcount.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./midiexcount2?name=">
              <img src="../image/midiexcount2.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./midiexcount3?name=">
              <img src="../image/midiexcount3.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<!--line 2-->
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./midiexcount4?name=">
              <img src="../image/midiexcount4.jpg" alt="Paris" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./midiex-seeall?name=">
              <img src="../image/midiex-seeall.jpg" alt="Paris" width="180" height="160">
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
	<div  class='col-md-6 col-xl-3'>
      <div class='card'>
        <div class='card-body'>
            <a target='_blank' href='../admin'>
              <img src='../image/all.jpg' alt='Paris' width='180' height='160'>
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
            <a href="#">
              <img src="../image/jjqd.jpg" alt="Paris" width="180" height="160">
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
