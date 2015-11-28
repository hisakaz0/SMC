<?php

//************************
//	listen from client ...
//************************
{
	$port = 12345;
	$addr = '192.168.7.83';
	$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_bind($sock, $addr, $port);
	socket_listen($sock);

	$sock = socket_accept($sock);


	$buf = socket_read($sock, 1024);
	list($user, $goods) = split('[/]', $buf);

	$res = buy($user, $goods);
	
	echo "res : ".$res."\n";
	socket_write($sock, $res, 1024);

	sleep(5);
	socket_close($sock);

}
function buy($user, $goods){
	// parameter setting
	$url    = "localhost";
	$admin  = "root";
	$passwd = "07s49power";
	$db     = "smc";

	date_default_timezone_set('Asia/Tokyo');
	$date = date('Y-m-d G:i:s');

	//preparation
	$link = mysql_connect($url, $admin, $passwd) or die("failed\n");
	mysql_select_db($db, $link) or die("Not found such a database\n");
	$sql = "SET CHARACTER SET UTF8";
	mysql_query($sql, $link) or die("Can't set character-set to UTF8\n");

	// userのbarcodeをnameに変換するう 
	$sql = "SELECT name FROM user WHERE barcode = \"".$user."\"";
	$res = mysql_query($sql, $link);
	// 初期化しないと該当データがない場合
	// Empty setで返ってくるので，$userの値が更新されない
	// なので，バーコードデータのままpaymentに登録される
	$user = null;
	while ($item = mysql_fetch_array($res)) {
		$user = $item[0];
	}
	echo "sql : ".$sql."\n";
	echo "user : ".$user."\n";
	// goodsのbarcodeをnameに変換するう
  // 一緒に価格も取得する 	
	$sql = "SELECT name, value FROM goods WHERE barcode = \"".$goods."\"";
	$res = mysql_query($sql, $link);
	// Empty Set対策(userの部分に同じ)
	$goods = null;
	$value = null;
	while ($item = mysql_fetch_array($res)) {
		$goods = $item[0];
		$value = $item[1];
	}
	echo "goods : ".$goods."\n";
	//データがあるかどうか確認!!!
	if ( $user == null ){
		return -1;
	}elseif( $goods == null ){
		return -1;
	}
	else{
		$sql = "INSERT INTO  payment value ( null, '".$goods."', ".$value." , '".$user."', cast( '".$date."' as datetime))";
		echo "sql : ".$sql."\n";
		// 購入失敗
		if( mysql_query($sql, $link) == false ){
			return -1;
		}
		// 購入成功
		else {
			return 0;
		}
	}
}

?>

