<p center>
    &copy;jsly
</p>
<script language="JavaScript">

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

</script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.1.1.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>