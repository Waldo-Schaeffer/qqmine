<?php
# 该函数用于统一发布广告和北京时间，输出html代码，位置在表头之上

function advertisement () {
    echo "
			<div class='row'>
				<div class='col-sm-7 col-lg-7 col-xs-7 col-md-7'>
					<!--div class='box'>
						<img id='pic' src='./ad1.jpg' width=318 height=120 />
					</div>
					<script>
						var pic=document.getElementById('pic');
						var n=1;
						function picLunH(){
							n++;
							if(n==2)
							{
								n=0;
							}
							pic.src='./ad'+n+'.jpg'
							
						}
						setInterval(picLunH,200);
					</script-->
					<img id='pic' src='./ad.jpg' width=318 height=120 />
					<p style='font-size:18px;color:red'>
					广告位招租、公会商务合作联系：<br>
					QQ：1356565637
					微信: YunLong525626<br>
					点击群号一键加QQ群：<a href='https://jq.qq.com/?_wv=1027&k=55uF80w' target='_blank'>936266825</a><br>
					<a href='https://cdn.egame.qq.com/pgg_act/314134/' target='_blank'>手机QQ开心矿工链接1</a><br /><br />
					<a href='https://cdn.egame.qq.com/pgg_act/314133/' target='_blank'>手机QQ开心矿工链接2</a><br />
					哪个能用用哪个
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

function color_switch ($gift_name_switch, $default) {
	switch ($gift_name_switch) {
		case "夺宝战机":
			return "#a0b8f8";
		case "超级666":
			return "#a0b8f8";
		case "高级挖矿券":
			return "#00c675";
		case "独角兽（30天）":
			return "#00c675";
		case "Q币":
			return "#00c675";
		case "头条卡":
			return "#6fc675";
		case "私奔到月球":
			return "#fad8e8";
		case "2星衰神卡":
			return "#fad8e8";
		case "甜心宝蓓":
			return "#d008e8";
		case "1星衰神卡":
			return "#d008e8";
		case "无间道":
			return "#000000";
		case "皇家招财猫":
			return "#006030";
		case "皇家钞票枪":
			return "#dfb11e";
		case "改名卡":
			return "#dfb11e";
		case "黄金大炮":
			return "#dfb11e";
		case "神碎片":
			return "#243edd";
		case "超级火箭":
			return "#ffff00";
		case "黄金战机":
			return "#ffff00";
		case "财富值":
			return "#ff0000";
		case "普通挖矿券":
			return "#ff0000";
		case "炫金弹幕卡（3天）":
			return "#ff0090";
		case "炫金弹幕卡（7天）":
			return "#ff0090";
		case "金币":
			return "#000000";
		case "超级鹅蛋":
			return "#000000";
		case "守护主播":
			return "#a0b8f8";
		case "暗夜狸猫（30天）":
			return "#00403e";
		case "暗夜狸猫碎片":
			return "#00403e";
		case "3星衰神卡":
			return "#00403e";
		case "财神卡":
			return "#fa1ee8";
		case "风铃禾梦":
			return "#fa1ee8";
		case "梦幻热气球":
			return "#8a1e78";
		case "BUFF梦幻热气球":
			return "#fa1ee8";
		case "盛宴黑桃A":
			return "#000000";	
		case "梦幻摩天轮":
			return "#a0b8f8";	
		case "BUFF梦幻摩天轮":
			return "#0088f8";
		case "梦幻迷迭香":
			return "#FFD980";
		case "BUFF梦幻迷迭香":
			return "#8F6900";
		case "星际战舰":
			return "#00ff00";	
		case "BUFF星际战舰":
			return "#008f00";
		case "1星福神卡":
			return "#00ff00";
		case "合体":
			return "#0000ff";
		default:
			return $default;
			#return "#FFD980";
	}
}

#该函数用于统一根据礼物显示不同的字体颜色
function color_font ($gift_name_switch) {
	switch ($gift_name_switch) {
		case "盛宴黑桃A":
			return "#ffffff";	
		case "皇家招财猫":
			return "#cdd932";
		case "风铃禾梦":
			return "#000000";
		case "神碎片":
			return "#FFFFFF";
		case "无间道":
			return "#FFFFFF";
		case "金币":
			return "#ffffff";
		case "超级鹅蛋":
			return "#ffffff";
		case "合体":
			return "#FFFF00";
		default:
			return "#000000";	
	}
}
?>
<html http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>企鹅挖矿大数据6.2.2</title>

    <style type="text/css">
    
    </style>
</head>
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
<body>

