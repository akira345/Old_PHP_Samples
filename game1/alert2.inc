<?php
function alert($message)
{
//アラートにメッセージを代入しＪＡＶＡスクリプトを出力して表示する
//Copyright(C)2002 Akira345
//使用条件：呼びだす前に<html><body>が記述されていること。（ＪＡＶＡスクリプトを用いているため）
//Arranged By Rinsyo
//メッセージが何も入っていなければ何もしない
if($message<>""){
print("
<SCRIPT LANGUAGE=\"JavaScript\">
<!--
alert(\"$message\");
//-->
</SCRIPT>
");
}
}
?>