<p center>
    &copy;jsly
</p>
<script language="JavaScript">
function myrefresh()
{
   window.location.reload();
}
setTimeout('myrefresh()',40000); //指定40000毫秒刷新一次，1秒等于1000毫秒
//setInterval('acg.innerHTML=new Date().toLocaleTimeString("chinese",{hour12:false})',1000);
//以下两个函数从服务器获取时间并以js动态显示在网页中
function get_obj(time){  
	return document.getElementById(time);  
}  
var ts=<?php echo (round(microtime(true)*1000)) ?>  
function getTime(){  
	var t=new Date(ts);  
	with(t){  
	var _time=(getHours()<10 ? "0" :"") + getHours() + ":" + (getMinutes()<10 ? "0" :"") + getMinutes() + ":" +  (getSeconds()<10 ? "0" :"") + getSeconds();
        }  
	get_obj("time").innerHTML=_time;  
	setTimeout("getTime()",1000);  
	ts+=1000;  
}  
getTime(); 
//前端控制台广告位
console.log("%c\n        ███████╗ ██████╗  █████╗ ███╗   ███╗███████╗\n        ██╔════╝██╔════╝ ██╔══██╗████╗ ████║██╔════╝\n        █████╗  ██║  ███╗███████║██╔████╔██║█████╗  \n        ██╔══╝  ██║   ██║██╔══██║██║╚██╔╝██║██╔══╝  \n        ███████╗╚██████╔╝██║  ██║██║ ╚═╝ ██║███████╗\n        ╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═╝     ╚═╝╚══════╝\n        ","color:#E6B035","\n        企鹅电竞(egame.qq.com) 招聘前端工程师 https://www.lagou.com/jobs/3745500.html");
</script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.1.1.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>