<html>
<head>
<title>SMC INPUT PAGE</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<link rel="stylesheet" href="css/acerola.css" type="text/css">
<body>

<div id="band">


	<!-- title -->	
	<div id="vocal">
		<span class=main>SMC INPUT PAGE</span><br>
		The page show 
<?php
echo $type;
?>
		.<br>
		変更したい登録データがあれば，その登録データの左側にあるチェックボタンをクリックし，印をつけた状態で，okを押して下さい．
	</div>
	<div id="melody">
		<br>
		&ensp; <span class=sub>REFERENCE</span><br>


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

function process($link, $type, $id) {
		/*
		echo
		echo $_POST["success"];
		//regist.phpからデータ登録が成功した場合
		if ( $_POST['success'] == null){
		echo "<br>
		----- データが登録されました -----
		<br>";
		}
		 */

	$value_title_line = "<th class=value>VALUE</th>";
	//変数ごと変数に格納できないのでやめました
	//$value_res_line		= "<th class=value>".$item[$a]."</th>";
	$start_th = "<th>";
	$end_th = "</th>";
	// 初期値はgoodsのカラム数(日付は抜く)
	$label_num = 5;
	if ( $type == "user" ){
		$value_title_line = NULL;
		//	$value_res_line 	= NULL;
		// userのカラム数(日付は抜く)
		$label_num = 4;
	}

	// form start
	echo "<form action=\"http://localhost/smc/update.php\" method=\"post\">";

	//mysqlにqueryをなげる
	$sql = "SELECT * FROM ".$type." WHERE id = ".$id;
	$res = mysql_query($sql, $link);
	echo "<br>
		<table>
		<tr>
		<th>recode</th>
		<th>=</th>
		<th>".mysql_num_rows($res)."
		</tr>
		</table>
		";
	echo "<table border=0 bgcolor=\"#000000\" cellspacing=0 cellpadding=0>
		<tr>
		<td>
		<table border=0 cellspacing=1 cellpadding=3>
		<tr class=red>
		<th class=id>ID</th>
		<th class=barcode>BARCODE</th>
		<th class=goods>NAME</th>
		".$value_title_line."
		<th class=datetime>DATETIME</th>
		</tr>
		";
	if ( $label_num == 4 ){
		while($item = mysql_fetch_array($res)) {
			$a = 0;
			echo "<tr class=red>";
			echo $start_th.$item[$a].$end_th;
			$id = $item[$a++];
			echo $start_th."<input type=text name=barcode value=\"".$item[$a++]."\"".$end_th;
			echo $start_th."<input type=text name=name value=\"".$item[$a++]."\"".$end_th;
			echo $start_th.$item[$a].$end_th;
			$registed_date = $item[$a];
		}
	}
	else{
		while ($item = mysql_fetch_array($res)) {
			$a = 0;
			echo "<tr class=red>";
			echo $start_th.$item[$a].$end_th;
			$id = $item[$a++];
			echo $start_th."<input type=text name=barcode value=\"".$item[$a++]."\">".$end_th;
			echo $start_th."<input type=text name=name value=\"".$item[$a++]."\">".$end_th;
			echo $start_th."<input type=text name=value value=\"".$item[$a++]."\">".$end_th;
			echo $start_th.$item[$a].$end_th;
			$registed_date = $item[$a];
		}
	}

	echo "</tr>";

	echo "			</table
		</td>
		</tr>
		</table>";

	// form end
	echo 
		"<div id=button>
		<button>update</button> &ensp;
	<input type=hidden name=type value=\"".$type."\"/>
		<input type=hidden name=id value=\"".$id."\"/>
		<input type=hidden name=registed_date value=\"".$registed_date."\"/>
		</form>
		<button onClick=\"history.go(-1)\">back</button>
		</div>";
}

function connect() {

	//parameter
	$url    = "localhost";
	$user   = "root";
	$passwd = "07s49power";
	$db 	= "smc";

	$link = mysql_connect($url, $user, $passwd) or die("failed");
	mysql_select_db($db, $link) or die("Not found such a database");
	$sql = "SET CHARACTER SET UTF8";
	mysql_query($sql, $link) or die("Can't set character-set to UTF8");
	return $link;
}

//main program
$id 	= $_POST['id'];
$type = $_POST['type']	;
$flag = connect();

if ( $flag != false ){
	process($flag, $type, $id);
}

?>


			</div>

			<div id="keyboard">
				<br>
				<span class=sub>Note</span>
			</div>

			<div id="drum" align=right>
				<br><br>
				現在ページ作成中 ver.1.2 &emsp;<br>
			</div>

		</div>




		</body>
		</html>

