<html lang=ja>
<head>
<title>
	SMC REGIST PAGE
</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<link rel="stylesheet" href="css/orion.css" type="text/css">
</head>
<body>
<div id="band">


	<!-- title -->	
	<div id="vocal">
		<font color=white>
			<span class=main>SMC REGIST PAGE</span><br>
			The page is for registation.<br>
			You can regist user or goods data.
		</div>	

		<div id="melody">
			<br>
			&ensp; <span class=sub>REGIST</span><br>

<?php

// homeだとsmc databaseがないから
// dieで処理が終了するためそれ以降が読み取られない
// なので、学校ではこれをコメントを外す
// 
//--home ver.----------------------------------
//			/*  
//				--中身(刺身)--
//			*/
//			
//--labo ver.-----------------------------------
//		//	/*
//				--中身(ハラミ)--
//		//	*/

function process($link, $table, $gbarcode, $gname, $value, $ubarcode, $uname){

	$date = date('Y-m-d G:i:s');

	//goods
	if ( $table == 0 ){	
		$sql = "INSERT INTO goods
			VALUE ( null, \"".$gbarcode."\", \"".$gname."\", ".$value.", cast( '".$date."' as datetime ))";
		$table = "goods";
		$barcode = $gbarcode;
	}
	//user 
	else{		
		$sql = "INSERT INTO user  
			VALUE ( null, \"".$ubarcode."\", \"".$uname."\", cast( '".$date."' as datetime ))";
		$table = "user";
		$barcode = $ubarcode;
	}

	//query送信	
	if ( mysql_query($sql, $link ) == null)
		echo "The query is not collect.";
	else{
		echo"<h2>You request is collect. User data is registed.</h2>";
		// 登録したデータのidを取得する
		$sql = "SELECT * from ".$table." WHERE barcode = \"".$barcode."\"";
		$res = mysql_query($sql, $link);
		while (	$item = mysql_fetch_array($res)){
			$id = $item[0];
		}

		echo "
			<form action=\"http://localhost/smc/check.php\" method=post name=regist>
			<input type=hidden name=check_type value=".$table." />
			<input type=hidden name=id value=".$id." />
			<input type=hidden name=success value=0 />
			<button name=submit>ok</button>
			</form>
			";
	}
}	

function connect() {

	//parameter
	$url    = "localhost";
	$user   = "root";
	$passwd = "07s49power";
	$db 	  = "smc";

	//preparation
	$link = mysql_connect($url, $user, $passwd) or die("failed");
	mysql_select_db($db, $link) or die("Not found such a database");
	$sql = "SET CHARACTER SET UTF8";
	mysql_query($sql, $link) or die("Can't set character-set to UTF8");
	return $link;
}

function check($link, $goods_barcode, $user_barcode){

	//重複チェックフラグ
	$double = 0;

	// 入力されたbarcodeがgoods,userテーブルにあるかどうか確認する
	// ない場合 -> 正常
	// ある場合 -> 以上
	// user,goodsの順番で調べていく
	$sql = "SELECT barcode FROM user WHERE barcode = \"".$user_barcode."\"";
	$res = mysql_query($sql, $link);
	if ( mysql_fetch_array($res) != null ){
		$double = 1;
	}
	$sql = "SELECT barcode FROM goods WHERE barcode = \"".$goods_barcode."\"";
	$res = mysql_query($sql, $link);
	if ( mysql_fetch_array($res) != NULL ){
		$double = -1;
	}
	if ( $double == -1){
		echo "該当するデータはすでに登録済みです.";
	}

	return $double;

}

//入力確認
$table    			= $_POST["regist_type"];
$goods_name    	= $_POST["regist_goods_name"];
$goods_barcode 	= $_POST["regist_goods_barcode"];
$goods_value    = $_POST["regist_goods_value"];
$user_name    	= $_POST["regist_user_name"];
$user_barcode 	= $_POST["regist_user_barcode"];

$flag; // 不備があるかどうかのフラグ

if ( $table == 0){
	if ( ($goods_name or $goods_barcode or $goods_value) == null ){
		$flag = -1;
		echo "入力に不備があります.<br>";
		if ( $goods_name == null )
			echo "商品名を入力してください.<br>";
		if ( $goods_barcode == null )
			echo "商品バーコードを入れてください.<br>";
		if ( $goods_value == null )
			echo "商品価格を入れてください.<br>";
	}
}
else{
	if ( ($user_name or $user_barcode) == null ){
		$flag = -1;
		echo "入力に不備があります.<br>";
		if ( $user_name == null )
			echo "ユーザ名を入力してください.<br>";
		if ( $user_barcode == null )
			echo "ユーザバーコードを入力してください.<br>";
	}
}

//main program
//入力されたか?
if ( $flag != -1 ) {
	$link = connect();
	//接続できたか?
	if ( $link != false ){
		$double = check($link, $goods_barcode, $user_barcode);
		//バーコードの値は重複していないか?
		if ( $double != 1 ){
			process($link, $table, $goods_barcode, $goods_name, $goods_value, $user_barcode, $user_name);
		}
	}
}

?>

<script type="text/javascript">
document.regist.submit.click();
</script>
</div>

<div id=back>
	<form>
		<input type="button" value="back" onClick="location.href='http://localhost/smc/smc.php">
	</form>
</div>


<div id="keyboard">
	<br>
	<span class=sub>Note</span>
</div>

<div id="drum" align=right>
	<br><br>
	現在ページ作成中 ver.1.2 &emsp;<br>
</div>

	</font>
</div>


</body>
</html>

