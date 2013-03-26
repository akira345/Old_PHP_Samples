<HTML>
<HEAD>
<TITLE>ミニゲームその１</TITLE>
</HEAD>
<BODY bgcolor=#B0E0ED>

<!--ミニゲームその１-->
<!--Ccopyright(C)2002 Akira345-->

<!--プログラムスタート>
<!--alert.incを呼び出す際、HTMLのコメントがあるとダイアログが表示されないみたいです。-->
<?php
//外部ユーザー関数インクルード
require("alert.inc");

//PHP4NewVer対応処理
$sw=$_POST['sw'];//押したボタンの数字
$ten=$_POST['ten'];//得点
$ng=$_POST['ng'];//失敗した回数
//以上終わり

//乱数初期化：ＰＨＰドキュメントより抜粋

//大まかな説明：マイクロタイムを取得し、それを基にシードを作成し、乱数を初期化している・・・みたい

// マイクロでシードを設定する
 function make_seed() {
     list($usec, $sec) = explode(' ', microtime());
     return (float) $sec + ((float) $usec * 100000);
 }
 srand(make_seed());
//終わり

$q = rand(1,3);//１～３までの乱数を代入

//デバック用命令その１
//$q=2;
//print ($q);

//もし、ボタンが押されたら
if ($sw !="")
{

//デバック用命令その２
//print ($q);
//print ($sw);

//もし、乱数の値と押されたボタンの値が等しかったら
	if ($sw==$q)
	{
	$ten=$ten+10;//点数を追加
	}else//でなければ
	{
	$ng=$ng+1;//失敗回数を増やす
	}

}else//もしボタンが押されていなければ
{

//変数初期化
$ten=0;
$ng=0;

}

if ($ng==3){//もし、失敗回数が規定回数を超えたら

$msg="Game Over!!";//メッセージを定義
alert($msg);//エラーダイアログを表示

//終了ボタンを表示
print ("
<form method=\"POST\" action=\"game1.php\">
<input type=\"submit\" value=\"終了\" style=\"font-size : 300%;\">
<input type=\"hidden\" name=\"sw\" value=\"\"><!--ボタン情報を初期化>
</form>
");

}else//失敗回数が規定回数を超えていなければ
{

//数字ボタンを表示

print ("
<FORM method=\"POST\" action=\"game1.php\">
<INPUT type=\"submit\" name=\"sw\" value=\"1\" style=\"font-size : 300%;\">
<INPUT type=\"submit\" name=\"sw\" value=\"2\" style=\"font-size : 300%;\">
<INPUT type=\"submit\" name=\"sw\" value=\"3\" style=\"font-size : 300%;\">
<!--点数と失敗回数を隠しフォームで送信-->
<input type=\"hidden\" name=\"ten\" value=$ten>
<input type=\"hidden\" name=\"ng\" value=$ng>
</form>
");

}
//スコア等表示
print ("
<form>
<h3>前回の正解：</h3>
<INPUT type=\"text\" value=$q readonly>
<br>
<h3>スコア：</h3>
<INPUT type=\"text\" value=$ten readonly>
<br>
<h3>失敗回数：</h3>
<INPUT type=\text\" value=$ng readonly>
</form>
");

//終了

?>
</BODY>
</HTML>

