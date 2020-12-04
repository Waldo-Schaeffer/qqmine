<!--此页面用于处理用户登录-->
<?php

session_start();
#echo $_SESSION['Channel'];
header("Content-type: text/html; charset=utf-8");
#date_default_timezone_set('PRC'); 
include_once('header.php');
?>
<div class="container" style="text-align:center">
  <div class="row">
    <div class="col-12">
        <br>
        <h2>企鹅大数据</h2>
        <br>
    </div>

    <div  class="col-md-12 col-lg-12 col-xl-6">
      <div class="card">
        <div class="card-body">
		<p style="font-size:17px;color:red" align="left">
		迷迭香数据私人订制、广告位、等商务合作联系微信: YunLong525626。
		欢迎各大公会前来洽谈。<br>账号一人一号外借被封不负责。<br>
		软件账号请联系群管注册，点击群号一键加QQ群：<a href='https://jq.qq.com/?_wv=1027&k=55uF80w' target='_blank'>936266825</a><br>
		<font color="#0000FF">使用浏览器登录可以使用浏览器自带的保存密码功能保存密码</font><br>
		<!--font color="#000000" size="3">想要账号的在龙龙这儿出礼物获得：出货量达到3000元赠送普通账号，出货量达到1万给VIP账号，出货量达到2万以上给SVIP账号。<br>
		迷迭香数据接受私人订制联系龙龙<br>
		矿工盘、金卡盘不需要登录就能查看。普通账号可以查看臻品盘（可以计算别人填坑了多少）、头条卡盘（方便你找人收头条）。
		</font-->
		<?php
		if(!((!isset($_SESSION['username'])) or ($_SESSION['Channel-all'] <= 1024))){
		include_once('minecraft.php');
		echo "<font color='#000000' size='3'>
		<table><th>压力测试进度：</th>
		<tr><td width=200>钻石矿工：$diamond_id/20000</td><td width=200>金币矿工：$gold_id/20000</td></tr>
		<tr><td width=200>财富矿工：$emerald_id/20000</td><td width=200>梦幻盒子：$box_id/40000</td></tr>
		</table>
		</font>";
		}
		?>
		</p>
        </div>
      </div>
    </div>
    <div  class="col-md-12 col-lg-12 col-xl-6">
      <div class="card">
        <div class="card-body">
		<!--div class="box">
			<img id="pic" src='./ad1.jpg' width=318 height=120 />
		</div>
		<script>
			var pic=document.getElementById("pic");
			var n=1;
			function picLunH(){
				n++;
				if(n==2)
				{
					n=0;
				}
				pic.src="./ad"+n+".jpg"
				
			}
			setInterval(picLunH,200);
		</script-->
		<img id="pic" src='./ad.jpg' width=318 height=120 />
		<p style='font-size:18px;color:blank'>
            <?php
            if(!isset($_SESSION['username'])){
            echo '
                欢迎您，请先<a href="login.php">登录</a>
            ';
            }else{
            echo '
                欢迎您，' . $_SESSION['nickname'] . '。<br />您的有效期至' . $_SESSION['used_time'] . '。<br /><a href="login.php?logout=yes">退出登录</a>
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
              <img src="./image/gift2.jpg" alt="钻石矿工专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="MoonScoop.php">
              <img src="./image/moon.jpg" alt="月球专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="richking.php">
              <img src="./image/richking.jpg" alt="超级礼物专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<?php
	if(!((!isset($_SESSION['username'])) or ($_SESSION['Channel'] <= 0))){
    echo "
	<div class='col-md-6 col-xl-3'>
      <div class='card'>
        <div class='card-body'>
            <a target='_blank' href='./giftcount'>
              <img src='./image/giftcount.jpg' alt='每日礼物统计' width='180' height='160'>
            </a>
        </div>
      </div>
    </div>
	";
	}
	?>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./5000">
              <img src="./image/5000.jpg" alt="钻石矿工臻品专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./gold">
              <img src="./image/gold.jpg" alt="金币矿工专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<?php
	if(!((!isset($_SESSION['username'])) or ($_SESSION['Channel'] <= 0))){
    echo "
	<div class='col-md-6 col-xl-3'>
      <div class='card'>
        <div class='card-body'>
            <a target='_blank' href='./gold2'>
              <img src='./image/gold2.jpg' alt='金币矿工高级专场' width='180' height='160'>
            </a>
        </div>
      </div>
    </div>
	";
	}
	?>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="./emerald">
              <img src="./image/emerald.jpg" alt="财富值矿工专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<?php
	if(!((!isset($_SESSION['username'])) or ($_SESSION['Channel'] <= 0))){
    echo "
	<div class='col-md-6 col-xl-3'>
      <div class='card'>
        <div class='card-body'>
            <a target='_blank' href='./emerald2'>
              <img src='./image/emerald2.jpg' alt='财富值矿工高级专场' width='180' height='160'>
            </a>
        </div>
      </div>
    </div>
	<div class='col-md-6 col-xl-3'>
      <div class='card'>
        <div class='card-body'>
            <a target='_blank' href='./emerald3'>
              <img src='./image/emerald3.jpg' alt='财富值矿工超级专场' width='180' height='160'>
            </a>
        </div>
      </div>
    </div>
	";
	}
	?>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="midiex.php">
              <img src="./image/box.jpg" alt="梦幻盒子专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a target='_blank' href="http://47.74.56.225/goldcard">
              <img src="./image/goldcard.jpg" alt="金卡传说" width="160" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="./magic">
              <img src="./image/magic.jpg" alt="魔力包专场" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="#">
              <img src="./image/jjqd.jpg" alt="敬请期待" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<div  class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-body">
            <a href="#">
              <img src="./image/jjqd.jpg" alt="敬请期待" width="180" height="160">
            </a>
        </div>
      </div>
    </div>
	<?php
	if((!isset($_SESSION['username'])) or ($_SESSION['Channel-all'] <= 0)){
    echo "
	<div  class='col-md-6 col-xl-3'>
      <div class='card'>
        <div class='card-body'>
            <a target='_blank' href='#'>
              <img src='./image/jjqd.jpg' alt='敬请期待' width='180' height='160'>
            </a>
        </div>
      </div>
    </div>";
	}else{
	echo "
	<div  class='col-md-6 col-xl-3'>
      <div class='card'>
        <div class='card-body'>
            <a target='_blank' href='./admin'>
              <img src='./image/all.jpg' alt='数据查阅' width='180' height='160'>
            </a>
        </div>
      </div>
    </div>";
	}
	?>
  </div>
</div>

<p center>
    &copy;jsly
</p>
<?php

//include_once('footer.php');
?>
