<?php
session_start();//�Z�b�V�����Ǘ��g�p�鐾
?>
<html>
<head>
<title>
MooGameForPHP4
</title>
</head>
<body>
<table border=1 width=760>
<tr><td width=350>
<P>Moo�Q�[��Ver2.5<BR>
Copyright�iC�jAkira345<BR>
<?php
require("./function-moogame.php");//�O���֐������[�h
///�����ݒ聕�ϐ�������///
$keta=3;//�����̌�����ݒ�
//$setvalue=123;//������ݒ�
$flag=0;//�������ǂ����̃t���O
$hit=0;//�q�b�g�̐�
$blow=0;//�u���[�̐�

///�����_���������[�`���Ăяo���Ɛ������ꂽ�����̐ݒ�///
if ($_SESSION['backup']=="" and $setvalue=="")//�����A�������o�b�N�A�b�v���󂾂�����
{
list($setvalue,$errorcode)=value_generate($keta);//�����_���ɐ���
$_SESSION['backup']=$setvalue;//�Z�b�V�����ɐ�����o�^
}
elseif ($_SESSION['backup']!="")//�Z�b�V�����ɐ����������Ă�����
{
$setvalue=$_SESSION['backup'];//�Z�b�V�����̐�����ϐ��ɑ��
}

///�I������///
if ($_POST['end']!="" or $flag!=0)//�I���{�^���������ꂽ������������
{
$_SESSION['backup']="";//�Z�b�V�������폜
$setvalue="";//�������폜
$_SESSION['count']="";//���s�񐔂��폜
}

///�f�n�I�{�^������///
if ($_POST['submit']!="" or $_POST['answer']!="")//�{�^���������ꂽ�����l���̓t�H�[�����N���b�N���ꂽ��
{
$input_value=$_POST['answer'];//�𓚂���
//�Q�[���v���O�������Ăяo��
list($flag,$hit,$blow,$errorcode)=moogame($setvalue,$input_value);

	if ($errorcode!=0 and $errorcode!=1)
	{
	print ("<font color=red>�G���[�������I�G���[�R�[�h��$errorcode</font>");
	}
}

///���̓G���[����///
if ($errorcode==1)//���͂��ꂽ���l�̌����ƋK��̌�������v���Ă��Ȃ����
{
print ("<font color=red>���͂��ꂽ�����̌������Ⴄ�������͂ł��I�I</font><br>");
}
else
{
print ("���l����͂��Ă�<BR>");
}

///���s�񐔃J�E���g���\��///
if ($setvalue!="" and $_SESSION['count']=="")//�������L�^����Ă��Ă����s�񐔂��J�E���g���ꂽ���Ȃ����
{
$_SESSION['count']=1;//���s�񐔂��Z�b�V�����ɓo�^
$count=1;//���s�񐔂�ݒ�
}
else
{
$count=$_SESSION['count'];//�Z�b�V�����ɓo�^����Ă��鎎�s�񐔂�ϐ��֑��
$count=$count+1;//�J�E���g���P���₷
$_SESSION['count']=$count;//�Z�b�V�����ɓo�^
}

print ("�������܂̎��s�񐔁�".$count."��ł��B<br>");//���s�񐔂�\��

?>

<BR>
</P>

<form method="POST" action=moogame.php>
<center>
<TABLE border="1">
    <TR>
      <TD><INPUT size="10" type="text" maxlength="9" name="answer"></TD>
      <TD><INPUT type="submit" name="submit" value="GO!"></TD>
    </TR>
    <TR>
      <TD>Hit��<br><?php print ("$hit"); ?></TD>
      <TD>Blow��<br><?php print ("$blow"); ?></TD>
    </TR>
    <TR>
      <TD colspan="2" valign="center">�������܂̌���<BR>
      <center><?php print("$keta"); ?>��</center></TD>
    </TR>
</TABLE>
</center>

<br>
<input type="submit" name="end" value="�I��"><br>
<?php
///���b�Z�[�W�\��///
print ("���Ȃ��̓��͂���������$input_value<br>������$setvalue");
if ($flag!=0)
{
print ("<h3>�����I</h3><br>\n");
}
else
{
print ("<h3>����΂낤�I</h3><br>\n");
}

?>
</form>
</td>
<td>
<!--���-->
<br>
�q�b�g���Ƃ́H�E�E�E�E�q�b�g���Ƃ́A�����̌��i�ʒu�j�Ɛ�����������\���܂��B<br>
�Ⴆ�΁A�������P�V�T�ł���A���Ȃ������ꂽ�l���X�V�P�������ꍇ�A�V���������ł����������ł��B<br>
�ł�����A�q�b�g���͂P�ƂȂ�܂��B<br>
�܂�A�����̏ꍇ�̓q�b�g���͂R�ɂȂ�Ƃ����킯�ł��ˁB�i�{���̃��[���ł͐������q�b�g���͌���Ȃ��炵���j
<br>
<br>
�u���[���Ƃ́H�E�E�E�E�u���[���Ƃ́A�����̌��i�ʒu�j��<b>�Ⴄ</b>���A����ȊO�̌��i�ʒu�j�ɂ��̐����������Ă��邻�̐����̌���\���܂��B<br>
�Ⴆ�΁A��قǂƓ����悤�ɐ������P�V�T�ł���A���Ȃ������ꂽ�l���X�V�P�������ꍇ�A�P�͌��i�ʒu�j���������܂��������Ɋ܂܂�Ă��܂��B<br>
�ł�����A�u���[���͂P�ƂȂ�܂��B<br>
����āA���̏ꍇ�͂P�q�b�g�P�u���[�ƂȂ�܂��B<br>
�ȉ��ɂ���������o���Ă����܂��̂ł悭������Ȃ��l�͒����I�ɗ������ĉ������B<br>
<br>
<br>
<table border=1>
<tr>
<td><center>����</center></td><td><center>���͒l</center></td><td><center>����</center></td>
</tr>
<tr>
<td><center>123</center></td><td><center>524</center></td><td><center>1H0B</center></td>
</tr>
<tr>
<td><center>123</center></td><td><center>341</center></td><td><center>0H2B</center></td>
</tr>
<tr>
<td><center>847</center></td><td><center>123</center></td><td><center>0H0B</center></td>
</tr>
<tr>
<td><center>834</center></td><td><center>263</center></td><td><center>0H1B</center></td>
</tr>
</table>
</td></tr>
</table>
</BODY>
</HTML>
