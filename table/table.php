<html>
<TITLE>
表ジェネレーターVer6.3forPHP4NewVer対応版
</TITLE>
<body bgcolor=#253656>

<!--表ジェネレーターVer6.3forPHP4NewVer対応版-->
<!--Ccopyright(C)2002 Akira345-->

<!--プログラムスタート！-->
<?php

//PHP4NewVer対応プログラム
$tr=$_POST['tr'];//フォームからきた縦の分割数
$td=$_POST['td'];//フォームからきた横の分割数
$waku=$_POST['waku'];//フォームからきた枠の太さ
$moji=$_POST['moji'];//フォームからきた中に入れる文字
$submit=$_POST['submit'];//ボタン
//以上終わり

//ヘッダー

//HTML出力
print ("

<TABLE BORDER=0>
<TR>
	<td><form method=POST action=table.php>\n
<h3>縦の分割数は？</h3>\n
<input type=text name=tr value=$tr>＊\n</td>
	<td><h3>横の分割数は？</h3>\n
<input type=text name=td value=$td>\n</td>
	<td><h3>枠の太さは？</h3>\n
<input type=text name=waku value=$waku>\n
</td>
	<td><h3>中に入れる文字は？</h3>
<input type=text name=moji value=$moji>\n
</td>
</tr>

</table>

<input type=submit name=submit value=\"OK\">\n
</form>\n
<br>\n<br>\n

");

//ヘッダー終わり

//デバック命令
//$tr=25;
//$td=12;

//メインルーチン


//すべてのフォームが入力されているかチェック

if ($submit !="" && $tr !="" && $td !="" && $waku !="")
{

print ("<TABLE BORDER=$waku>\n");//TABLEタグ出力

//もし、中に入れる文字が入力されていなければフラグを立てる
if ($moji==""){
	$flag=1;
		}

	for ($i=0;$i<$tr;$i++)//縦分割ループ
	{
	print ("<TR>\n");
	
		for ($j=0;$j<$td;$j++)//横分割ループ
		{
	
	//もし、フラグがたっていれば、配列表示モードにする
	
		if ($flag !=""){$moji=$i.",".$j;}
	
//下のTABはHTMLに出力したときソースを見易くするために入れただけです．
	
		print ("	<TD>$moji</TD>\n");
	
		}
	
	print ("</TR>\n");
	}

print ("</TABLE>\n");//TABLEタグ終了
}

?>
</body>
</html>
