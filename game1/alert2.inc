<?php
function alert($message)
{
//�A���[�g�Ƀ��b�Z�[�W�������i�`�u�`�X�N���v�g���o�͂��ĕ\������
//Copyright(C)2002 Akira345
//�g�p�����F�Ăт����O��<html><body>���L�q����Ă��邱�ƁB�i�i�`�u�`�X�N���v�g��p���Ă��邽�߁j
//Arranged By Rinsyo
//���b�Z�[�W�����������Ă��Ȃ���Ή������Ȃ�
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