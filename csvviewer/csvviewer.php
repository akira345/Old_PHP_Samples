<html>
<head>
<title>
データ一覧
</title>
<body>
<?php
//汎用ＣＳＶファイル表示プログラムＶｅｒ１．０
//Copyright(C)Akira345

$fd = fopen ("./sample.csv", "r");//ＣＳＶデータファイルオープン
$koumoku=5;//項目数
$data[0]="No,学生番号,科学得点,数学得点,物理得点";//項目名指定（各項目名の間にはサンプルのように","で区切ること！！）

$i=0;//カウンター変数初期化

while (!feof ($fd)) 
{

//ファイルの終端にくるまで
$i=$i+1;//カウント（１からはじめること。配列0は項目名が入るから。）
$data[$i]= $i.",".fgets($fd, 8192);//ファイルの内容を読み込み、最初の項目としてカウント数を付け加えて配列に保存。

}

fclose ($fd);//ファイルを閉じる

print ("<TABLE BORDER=1>\n");//TABLEタグ出力

for ($j=0;$j<$i;++$j)//ファイルの終端レコード数まで
{
	print ("<TR>\n");//TRタグ出力
	$tmp=explode(",",$data[$j]);//","を区切り文字としてデータを$tempに代入
	
		for ($k=0;$k<$koumoku;++$k)//項目数分横に表示
		{
		print ("<TD>$tmp[$k]</TD>");
		}
	print ("</TR>\n");//TRタグ出力
}

print ("</TABLE>\n");//TABLEタグ終了

?>
</body>
</html>

