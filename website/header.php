<?php
# 该函数用于统一发布广告和北京时间，输出html代码，位置在表头之上

function advertisement () {
    echo "
			<div class='row'>
				<div class='col-sm-7 col-lg-7 col-xs-7 col-md-7'>
					<p style='font-size:18px;color:red'>
					龙龙微信: YunLong525626<br>
					秀秀微信: liangxinxiu521<br>
					广告位招租QQ: 1356565637</p>  
					<p style='font-size:32px;color:#FF00FF'>
					<b>64-66折</b>回收礼物头条等<br>		
					</p>
					<p style='font-size:18px;color:red'>
					欢迎各大公会前来合作<br>
					金卡盘进群领取<br>
					点击一键加群：<a href='https://jq.qq.com/?_wv=1027&k=55uF80w' target='_blank'>936266825</a><br>
					</p>
				</div>
				<div class='col-sm-5 col-lg-5 col-xs-5 col-md-5'>
					<p style='font-size:24px;color:#ff0000'><b>请不要使用IE10以下的浏览器访问</b><br></p>
					<div class='row'>
						<div class='col-sm-9 col-lg-9 col-xs-9 col-md-9' style='background-color:#f3f3f0'>
							<p style='font-size:24px;color:#878786'>北京时间</p>
							<p id=time style='font-size:48px;'></p>
						</div>
					</div>
				</div>				
			</div>
				
        ";
}

# 该函数用于针对无广告位的，输出html代码，位置在表头之上
function noadvertisement () {
    echo "
				<div class='col-sm-5 col-lg-5 col-xs-5 col-md-5'>
					<p style='font-size:24px;color:#ff0000'><b>请不要使用IE10以下的浏览器访问</b><br></p>
					<div class='row'>
						<div class='col-sm-9 col-lg-9 col-xs-9 col-md-9' style='background-color:#f3f3f0'>
							<p style='font-size:24px;color:#878786'>北京时间</p>
							<p id=time style='font-size:48px;'></p>
						</div>
					</div>
				</div>
			</div>
				
        ";
}
?>
<html http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>企鹅挖矿大数据4.9.6</title>

    <style type="text/css">
    
    </style>
</head>
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
<!--4.1版本功能初具雏形，所有功能均可使用-->
<!--4.2版本新增了防火墙，拦截SQL注入和非法访问-->
<!--4.3版本新增了广告位，过滤掉了迷迭香等礼物的显示，修复了时间显示为数字的问题-->
<!--4.4版本修改了广告位的字体大小，修复了DNS服务器宕机的时候CPU跑满的问题-->
<!--4.5版本针对不同的礼物添加了不同的颜色-->
<!--4.6版本添加了动态的北京时间，修复了在主页活动页面中奖，而不是直播间中奖时，礼物不显示的问题-->
<!--4.7版本解决了一次性中多个礼物的时候只显示1个的问题，添加了ico图标-->
<!--4.7.2版本解决了一些礼物颜色相近的问题-->
<!--4.8版本解决了显示的北京时间是本地时间而不是服务器时间的问题-->
<!--4.8.4版本暂时解决了某些骚主播PK时引发的大规模广播导致崩盘的问题-->
<!--4.8.6版本修复了数据重复的问题-->
<!--4.9版本回调了4.8.6版本显示黄金战机引发的崩盘-->
<!--4.9.2版本增加了专门查看梦幻盒子（迷迭香、摩天轮）的页面-->
<!--4.9.6版本增加了专门查看皇家系列、月球的页面-->
<body>

