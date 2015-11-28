<html lang=ja>
<head>
<title>
	SMC WEB PAGE
</title>

<!--setting-->
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<link rel="stylesheet" href="css/miku.css" type="text/css">
</head>
<!--body-->
<body>
	<div id="band">
		<!-- title -->	
		<div id="vocal" class="black">
			<br>
			&ensp;
			<span class=main>
			在庫管理システムサイト	
			</span>
			<div><br>
				下に示されている手続きを選んでください．<br>
				照会･登録の場合は，チェックマークを付けてデータを入力してください．<br>
				確認ができたらokを押してください．
			</div>
		</div>
		<div id="string">
			<!-- reference -->
			<div id="reference" class="subfloat black"> 
				<span class=sub>&ensp;購入履歴照会ブロック</span><br>
				<form action="http://localhost/smc/reference.php" method="post">
					<table border=0 frame=void rules=none>
						<tr align=center>
							<th>-- データの型 --</th>
							<th>-- データの値 --</th>
						</tr>
						<tr align=left>
							<th><input type="radio" name="reference_type" value=barcode checked>バーコード</th>
							<th><input size="13" type="text" value="" name="reference_data"><br></th>
						</tr>
						<tr align=left>
							<th><input type="radio" name="reference_type" value=name>名称(名前)</th>
							<th><br></th>
						</tr>
					</table>
					&ensp;
					<button>&thinsp; ok &thinsp;</button><br>
				</form>
			</div>

			<!-- regits -->
		<div id=regist class="subfloat white">
				<span class=sub>&ensp;商品･ユーザ登録ブロック</span>
				<form action="http://localhost/smc/regist.php" method="post">
					<table border=0 frame=void rules=none>
						<tr align=left>
							<th><input type="radio" name="regist_type" value=0 checked>商品</th>
						</tr>
						<tr align=center>
							<th>-- 名称 --</th>
							<th>-- バーコード --</th>
							<th>-- 価格 --</th>
						</tr>
						<tr align=left>
							<th><input size=14 type=text value="" name="regist_goods_name"></th>
							<th><input size=14 type=text value="" name="regist_goods_barcode"></th>
							<th><input size=14 type=text value="" name="regist_goods_value"></th>
						</tr>
						<tr align=left>
							<th><input type="radio" name="regist_type" value=1>ユーザ</th>
						</tr>
						<tr align=center>
							<th>-- 名前 --</th>
							<th>-- バーコード --</th>
						</tr>
						<tr align=left>
							<th><input size=14 type=text value="" name="regist_user_name"></th>
							<th><input size=14 type=text value="" name="regist_user_barcode"></th>
						</tr>			
					</table>
					&ensp;
					<button>&thinsp; ok &thinsp;</button>
				</form>
					バーコードがない場合
					<a href="http://www5d.biglobe.ne.jp/~bar/page3/barmain.html" Target="_blank">ここ</a>
					で作成してください．<br>
					バーコードの種類は &ensp; CODE39 &ensp;を使ってください．	
			</div>

			<!--goods-->
			<div id="check" class="subfloat white">
				<span class=sub>&ensp; 登録データ確認ブロック	</span><br> 
				<form action="http://localhost/smc/check.php" method="post">
					<table border=0 frame=void rules=none>
						<tr align=center>
							<th>-- タイプ--</th>
							<th><br></th>
						</tr>
						<tr>
							<th><input type=radio name=check_type value=goods checked>商品</th>
							<th><input type=radio name=check_type value=user>ユーザ</th>
								  <input type=hidden name=success value=2 />
						</tr>
					</table>
					&ensp;
					<button>&thinsp; ok &thinsp;</button>
				</form>
					商品･ユーザ登録ブロックで<br>登録データの確認を行うためのブロックです．<br>
			</div>

			<!--user-->
			<div id="hisa" class="subfloat black">
			present by cantabile_hisa
			</div>
		</div>

		<!--note-->
		<div id="keyboard" class=black>
			<span class=sub>&ensp;Note</span>
		</div>

		<!--record-->
		<div id="drum" class="black" align=right>
			<br>
			現在ページ作成中 ver.1.2 &emsp;<br>
		</div>
	</div>
</body>
</html>

