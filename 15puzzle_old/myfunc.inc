<?php
//乱数初期化：ＰＨＰドキュメントより抜粋

//大まかな説明：
//マイクロタイムを取得し、それを基にシードを作成し、乱数を初期化している・・・みたい

// マイクロでシードを設定する
 function make_seed() {
     list($usec, $sec) = explode(' ', microtime());
     return (float) $sec + ((float) $usec * 100000);
 }
//終わり
?>