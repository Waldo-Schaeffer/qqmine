<!--此页面用于查看开心矿工爆出的礼物-->
<?php
function user_sql ($data) {
	if (empty($data)){
		$master = '1=1';
	}else{
		$master = 'gift_master  <=> "' . $_GET['name'] . '"';
	}
	
	return $master;
}

?>