<?php
# 该函数用于统一发布广告和北京时间，输出html代码，位置在表头之上

function advertisement () {
    echo "
			<div class='row'>
				<div class='col-sm-7 col-lg-7 col-xs-7 col-md-7'>
					<p style='font-size:24px;color:red'>
						龙龙微信: YunLong525626<br>
						秀秀微信: liangxinxiu521<br>
					</p>
					<p style='font-size:36px;color:#FF00FF'>
						高价收礼物头条卡<br>
						语音厅就去全企鹅最帅的男神
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

#该函数用于统一根据礼物显示不同颜色
function color_switch ($gift_name_switch, $default) {
	switch ($gift_name_switch) {
		case "夺宝战机":
			return "#a0b8f8";
		case "独角兽（30天）":
			return "#00c675";
		case "头条卡":
			return "#6fc675";
		case "私奔到月球":
			return "#fad8e8";
		case "皇家招财猫":
			return "#243ed6";
		case "皇家钞票枪":
			return "#dfb11e";
		case "神碎片":
			return "#243edd";	
		case "超级火箭":
			return "#ffff00";
		case "暗夜狸猫（30天）":
			return "#00403e";	
		case "皇家同花顺":
			return "#ff0000";	
		case "盛宴黑桃A":
			return "#444444";	
		case "梦幻摩天轮":
			return "#a0b8f8";	
		case "BUFF梦幻摩天轮":
			return "#a0b8f8";	
		default:
			return $default;	
	}
}

#该函数用于统一根据礼物显示不同的字体颜色
function color_font ($gift_name_switch) {
	switch ($gift_name_switch) {
		case "盛宴黑桃A":
			return "#ffffff";	
		default:
			return "#000000";	
	}
}

?>
<html http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>企鹅挖矿大数据定制版-全企鹅最帅的男神</title>

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
<!--5.0版本增加了专门查看臻品（独角兽、狸猫、神碎片）的页面。添加了针对指定直播间采集迷迭香数据、挖矿数据的页面，可以定制售卖。统一了广告位的数据，今后广告位可以统一修改。彻底修复PK引发的崩盘问题-->
<!--5.1版本增加了新的礼物盛宴黑桃A，统一了不同页面的礼物颜色-->
<!--5.1版本后，区分出定制版专门维护-->
<!--5.1.2版本新增了针对不同的礼物显示不同的字体颜色-->
<body>

