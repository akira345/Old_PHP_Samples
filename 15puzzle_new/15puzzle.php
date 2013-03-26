<?php
session_start();//セッション管理を使うための宣誓。
//これはファイルの先頭に必ず記述しなければならない。（<HTML>よりも上。）
?>

<html>
<head>
<title>
１５ゲームプログラムVer1.00
</title>
</head>
<body>

<?php
//１５ゲームプログラムVer1.00
//Copyright(C)2002,2003 Akira345,NAGOMI

//プログラム中のコメントで飛ばしてあるPrint命令はデバック用です。動作には関係ありません。
//（Print命令が多いところは苦労したところです（笑））
//プログラム中の(*?)はほぼ同じ処理です。

//環境設定ファイル読み込み
require("./15puzzle.ini");

//外部ユーザー関数読み込み
require("./myfunc.inc");

//乱数初期化
srand(make_seed());

//エラーチェック
if ($waku<=1 or $waku>10)//枠の一辺が1以下か10以上だったら
{
print ("枠の指定が不正です");
}else{

//メインスクリプトスタート

//定数準備
$waku=floor($waku);		//値の切り捨て（無いと思うけど少数対策です）
$souwaku=$waku*$waku;		//総枠数計算


//PHP4NewVer対応処理ー開始ー（外部からくる変数一覧）

//フォームからの入力系
$button=$_POST['button'];	//ボタンの種類(１：スタート、２：ギブアップ)
$mode_Form=$_POST['mode'];	//難易度設定変数

//URLからの入力系

//セッションから
$sw=$_SESSION['sw'];		//モード設定変数
$r=$_SESSION['r'];		//空白画像の座標
$move=$_SESSION['move'];	//動かせる座標
$mode=$_SESSION['mode'];	//難易度表示用変数
$outdata=$_SESSION['outdata'];	//現在の全座標

//URLから
$link=$_GET['link'];		//動かした座標

//PHP4NewVer対応処理ー終了ー

//セッションIDを＄IDに代入
$ID=session_id();

//ボタンチェック
if ($button==1)//スタートボタンが押されたら
{
$sw=1;//ランダム表示モードに
}
elseif ($button==2)//ギブアップボタンが押されたら
{
$sw=0;//完成形表示モードに
}
if ($sw=="")//モードが設定されていなければ（ゲーム起動直後など）
//モードとボタンは関係なかった・・・（＾＾）ゞ
{
$sw=0;//完成形表示モードにする
}

//配列に値を代入

if ($sw==0)//完成形表示モードなら(*1)
{

$kousi=explode(",",INIT($souwaku));//配列初期化ルーチンを呼び出す

}
elseif ($sw==1)//ランダム表示モードなら－開始－
{
//改良ランダム表示モードVre6.0
//Copyright(C)Akira345

//難易度設定読み込み

if ($mode_Form==1)//やさしい
{
$shfull=3;//この数字＊$souwaku数回ルーチンが回る。以下同様
}
elseif ($mode_Form==2)//普通
{
$shfull=6;
}
elseif ("$mode_Form==3")//難しい;
{
$shfull=10;
}

$mode=$mode_Form;//難易度表示のため変数$modeへ難易度設定の値を代入

//ルーチンの説明
//まず、完成形表示モードで座標を設定し、
//その後ランダム表示ルーチンで空白画像を動かす。

$r=$souwaku;//空白画像の座標を代入

//完成形表示モードで座標を設定(*1)

$kousi=explode(",",INIT($souwaku));//配列初期化ルーチンを呼び出す。

//変数とフラグの初期化
$j=0;
$g=0;

//ランダム表示ルーチン
//このルーチンの説明
//１、動かせる座標を調べる
//２、動かせる座標から動かす座標をランダムに１つ選ぶ
//３、選んだ座標を動かす
//１～３をレベルに指定された回数繰り返す
//繰り返したら、それが元に戻っていないか（完成形になっていないか）確認
//もし、戻っていたら、もう一回１～３を繰り返し、チェックする。

while($g==0)//改良ランダム表示ルーチン－開始－
{
$j=$j+1;//カウンター変数を上げる


//動かせる座標特定ルーチン－開始－

//NAGOMI氏作成改良ルーチン(*4)
//Programd By NAGOMI

//Akira345によるつたない解説
//動かせる画像の個数は最大４個。
//（真ん中が空白画像だった場合、動かせるのは上下左右）
//なのでまずは全部の計算上の動かせる場所を調べる。

$kouho[1]=$r-1;//候補１（左）
$kouho[2]=$r+1;//候補２（右）
$kouho[3]=$r+$waku;//候補３（下）
$kouho[4]=$r-$waku;//候補４（上）


//計算上の場所から実際動かせるものを絞り込む。
//計算上の場所で実際動かせないものは０（ゼロ）が入る

$tmp=$r%$waku;//判定式（実際の動かせる座標との関連を調べて作成しました（＾＾））

if ($kouho[4]<0)
{
$kouho[4]=0;
}

if ($kouho[3]>$souwaku)
{
$kouho[3]=0;
}

if ($tmp==0)
{
$kouho[2]=0;
}

if ($tmp==1)
{
$kouho[1]=0;
}

//print ("$r,$kouho[1],$kouho[2],$kouho[3],$kouho[4],\\,");

//動かせる座標特定ルーチン－終わり－

//print ("B$r");

//動かす座標特定ルーチン－開始－
$f=0;//フラグを初期化

while($f==0)//ルーチン開始
{
$tmp=rand(1,4);//動かせる４つの座標から動かす１つをランダムに選ぶ（１～４）

if ($kouho[$tmp]!=0)//選んだ座標が実際動かせるかチェック
	{
	//print ("A$kouho[$tmp]");
	$f=1;//動かせたらフラグを上げルーチンを抜ける
	}

}
//動かす座標特定ルーチン－終わり－

//座標を動かす－開始－(*2)

//説明は要らないと思うけどやっていることは単なる２変数の入れ替えです
//動かす前の空白画像の座標と動かす数字の座標を入れ替えています

$swap=$kousi[$kouho[$tmp]];
$kousi[$kouho[$tmp]]=$kousi[$r];
$kousi[$r]=$swap;

$r=$kouho[$tmp];//当然入れ替えたら動かす数字があった座標は空白画像の座標になるので代入。

//座標を動かす－終了－

//print $souwaku*$shfull;

//指定レベル分回ったか？－開始－
if ($j>=$souwaku*$shfull)
{
	//print ("END");

$err=chk_completion(implode(",",$kousi),$souwaku);//完成か？（元に戻っていないか？）(*3)

	//ループを抜ける条件判定－開始－
	if ($err==1)//未完成なら
	{
	$g=1;//ループを抜ける
	}
	else//完成形なら
	{
	$g=0;//もう一回ループを回る
	}
	//ループを抜ける条件判定－終了－

}
//指定レベル分回ったか？－終了－

}
//改良ランダム表示ルーチン－終了－

}
//ランダム表示モードなら－終了－

if ($sw==3)//ゲーム中なら－開始－
{
//print $outdata;
$kousi=explode(",",$outdata);//結合配列展開
//print ("out$outdata");

$chk_move=explode(",",$move);//結合配列展開
//print ("move$move");
//print ("MOVECHK$chk_move[3]");
if ($link!="" and $link!=0)//動かした座標が空と０（ゼロ）でなければ
//URLをいじられた時の対策－開始－
{
	for ($i=0;$i<=3;++$i)
	{
		if ($chk_move[$i]==$link)
		//動かせる座標と動かした座標が一致すれば
		
		{
		//座標を入れ替える(*2)
		//print ("LINK$link");
		$swap=$kousi[$link];
		$kousi[$link]=$kousi[$r];
		$kousi[$r]=$swap;
		$r=$link;
		}
		
	}

}
//URLをいじられた時の対策－終了－

}
//ゲーム中なら－終了－


//ここからのルーチンはモードに関係なく実行されます。（$sw=0,1,3）

$err=chk_completion(implode(",",$kousi),$souwaku);//完成か？(*3)

//状態表示

//難易度表示

if ($mode==1)
{
print("－やさしい－");
}
elseif ($mode==2)
{
print("－普通－");
}
elseif($mode==3)
{
print ("－難しい－");
}

//状態表示
if ($err==1)//未完成なら
{
print ("未完成\n");
$sw=3;//ゲームモード開始（$sw=1のとき）又は続行
}else//完成形なら
{
print ("完成\n");

$sw=0;//完成形モードへ移行（ゲーム終了）
$link="";//動かした座標初期化
}

//NULLチェック
if ($sw==3)//ゲーム中なら
{

//リンク条件判定チェックルーチン－開始－


//動かせる座標特定ルーチン－開始－

//NAGOMI氏作成改良ルーチン(*4)
//Programd By NAGOMI

//Akira345によるつたない解説
//動かせる画像の個数は最大４個。
//（真ん中が空白画像だった場合、動かせるのは上下左右）
//なのでまずは全部の計算上の動かせる場所を調べる。

$kouho[1]=$r-1;//候補１（左）
$kouho[2]=$r+1;//候補２（右）
$kouho[3]=$r+$waku;//候補３（下）
$kouho[4]=$r-$waku;//候補４（上）


//計算上の場所から実際動かせるものを絞り込む。
//計算上の場所で実際動かせないものは０（ゼロ）が入る

$tmp=$r%$waku;

if ($kouho[4]<0)
{
$kouho[4]=0;
}

if ($kouho[3]>$souwaku)
{
$kouho[3]=0;
}

if ($tmp==0)
{
$kouho[2]=0;
}

if ($tmp==1)
{
$kouho[1]=0;
}

//print ("$r,$kouho[1],$kouho[2],$kouho[3],$kouho[4],\\,");


}
//リンク条件判定チェックルーチン－終了－

//１５ゲーム画面表示ルーチン－開始－

//表ジェネレーターのソースを一部流用・・・

if ($view==1)			//見本表示モードなら
{				//タグを出力する
print ("<TABLE BORDER=0>\n");
print ("<TR>\n");
print ("<TD>\n");
}

//ゲーム表示ルーチン開始

$k=0;//カウンター変数初期化


print ("<TABLE BORDER=1>\n");//TABLEタグ出力


	for ($i=0;$i<$waku;$i++)//縦分割ループ
	{
	print ("<TR>\n");
	
		for ($j=0;$j<$waku;$j++)//横分割ループ
		{
$k=$k+1;//総ループ数をカウント（画像の座標になります）
	
//下のTABはHTMLに出力したときソースを見易くするために入れただけです．
	
		print ("	<TD>");

//リンク条件判定（全画像の座標を調査）ー開始ー
//１回ループが回るごとにリンクが張れる条件を満たしているか判定
$f=0;//フラグを初期化
$L=0;//カウンタ変数を初期化

while($f==0)
{
	$L=$L+1;//カウンタを上げる
	//print ("$kouho[$L]");
	if ($k==$kouho[$L])//もしリンクを張る条件を満たしていたら（その画像が動かせる画像だったら）
	{
	//動かす座標＆セッションIDをURLで送信＆セッション変数を飛ばす
	//本によれば、セッション変数を飛ばすにはリンクをPHPで出力してはいけないそうだが・・・
	$out="<a href=\"".$phpname."?PHPSESSID=$ID&link=$k\">
	<img src=$dir$kousi[$k].$ex></a>";//リンクを張る
	//左のＴＡＢはＨＴＭＬソースを見易くするために入れただけです
	$f=1;//条件判定ルーチンを抜ける
	}
	else
	{
	$out="<img src=$dir$kousi[$k].$ex>";//画像のみ表示
	//ちなみに、上のようなやり方は邪道。正式には下のようにする。
	//$out="<img src=".$dir.$kousi[$k].".".$ex.">";//画像のみ表示
		
		if ($L>4)//全ての条件を試したら（動かせる画像の数は最大４個。だから１つの画像に対し４回ループをまわす。）
		{
		$f=1;//条件判定ルーチンを抜ける
		}
	}

}//リンク条件判定ルーチンー終了ー

print ("$out"."</TD>\n");//画像＆リンクを出力	


	
		}
	
	print ("</TR>\n");
	}

print ("</TABLE>\n");//TABLEタグ終了

//ゲーム表示ルーチン終了

if ($view==1)		//見本表示モードなら
{			//タグを出力する＆見本を表示する
print ("</td>\n");
print ("<td>\n\n</td>\n");
print ("<td>\n");

//見本表示ルーチン（中身は上のゲーム表示ルーチンとほぼ一緒です。）
$k=0;//変数を初期化

//完成形を表示モードする(*1)

$kousi_view=explode(",",INIT($souwaku));//配列初期化ルーチンを呼び出す

print ("<TABLE BORDER=1>\n");//見本表示用TABLEタグを出力

for ($i=0;$i<$waku;$i++)//縦分割ループ
{
print ("<TR>\n");
	for ($j=0;$j<$waku;$j++)//横分割ループ
	{
	$k=$k+1;//総ループ数をカウント（画像の座標になります）
	print ("	<TD>");
	$out="<img src=".$dir.$kousi_view[$k].".".$ex.">";//画像のみ表示
	print ("$out"."</TD>\n");

	}

print ("</TR>");
}

print ("</TABLE>");//見本表示用TABLEタグを閉じる

//見本表示ルーチン終了

print ("</TD>\n</TR>\n</TABLE>\n");
}

//１５ゲーム画面表示ルーチン－終了－

//セッション変数登録－開始－

if ($sw!=0)//ゲームが始まっていたら
{
$move=implode(",",$kouho);//動かせる座標を結合
}

$outdata=implode(",",$kousi);//配列結合

//print $outdata;
//session_register("sw","outdata","r","mode","move");//セッション変数に登録（モード切り替え、結合配列、空白画像座標、レベル、動かせる座標）
$_SESSION['sw']=$sw;
$_SESSION['outdata']=$outdata;
$_SESSION['r']=$r;
$_SESSION['mode']=$mode;
$_SESSION['move']=$move;
//セッション変数登録－終了－

//フォーム表示ルーチン－開始－
if ($sw=="0")//完成形表示モードなら（又はゲームをクリアしたら）
{
//レベル入力フォームとスタートボタンを表示
print ("
<FORM method=\"POST\" action=\"$phpname\">
<input type=\"radio\" name=\"mode\" value=\"1\">やさしい
<input type=\"radio\" name=\"mode\" value=\"2\" checked>普通
<input type=\"radio\" name=\"mode\" value=\"3\">難しい
<br>
<input type=\"hidden\" name=\"button\" value=\"1\">
<INPUT type=\"submit\" name=\"submit\" value=\"スタート\">
</FORM>

");
}
else//でなければ
{
//ギブアップボタン表示
print("
<FORM method=\"POST\" action=\"$phpname\">
<input type=\"hidden\" name=\"button\" value=\"2\">
<INPUT type=\"submit\" name=\"submit\" value=\"ギブアップ\">
</FORM>
");
}
//フォーム表示ルーチン－終了－

}//メインスクリプト終了
?>
</body>
</html>