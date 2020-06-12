<?php
# 该函数用于统一发布广告和北京时间，输出html代码，位置在表头之上

function advertisement () {
    echo "
			<div class='row'>
				<div class='col-sm-7 col-lg-7 col-xs-7 col-md-7'>
					<img src='../ad.jpg' width=318 height=130 /><br />
					<p style='font-size:18px;color:red'>
					广告位招租、公会商务合作联系：<br>
					QQ： 1356565637
					微信: YunLong525626<br>
					金卡盘进群领取，QQ群：<a href='https://jq.qq.com/?_wv=1027&k=55uF80w' target='_blank'>936266825</a><br>
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

#该函数用于统一根据礼物显示不同的背景颜色
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
			return "#000000";	
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

    <title>企鹅挖矿大数据定制版-可心户外帅帅主持</title>

    <style type="text/css">
    
    </style>
</head>
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
<body>

