<HTML>
<HEAD>
<TITLE>�~�j�Q�[�����̂P</TITLE>
</HEAD>
<BODY bgcolor=#B0E0ED>

<!--�~�j�Q�[�����̂P-->
<!--Ccopyright(C)2002 Akira345-->

<!--�v���O�����X�^�[�g>
<!--alert.inc���Ăяo���ہAHTML�̃R�����g������ƃ_�C�A���O���\������Ȃ��݂����ł��B-->
<?php
//�O�����[�U�[�֐��C���N���[�h
require("alert.inc");

//PHP4NewVer�Ή�����
$sw=$_POST['sw'];//�������{�^���̐���
$ten=$_POST['ten'];//���_
$ng=$_POST['ng'];//���s������
//�ȏ�I���

//�����������F�o�g�o�h�L�������g��蔲��

//��܂��Ȑ����F�}�C�N���^�C�����擾���A�������ɃV�[�h���쐬���A���������������Ă���E�E�E�݂���

// �}�C�N���ŃV�[�h��ݒ肷��
 function make_seed() {
     list($usec, $sec) = explode(' ', microtime());
     return (float) $sec + ((float) $usec * 100000);
 }
 srand(make_seed());
//�I���

$q = rand(1,3);//�P�`�R�܂ł̗�������

//�f�o�b�N�p���߂��̂P
//$q=2;
//print ($q);

//�����A�{�^���������ꂽ��
if ($sw !="")
{

//�f�o�b�N�p���߂��̂Q
//print ($q);
//print ($sw);

//�����A�����̒l�Ɖ����ꂽ�{�^���̒l��������������
	if ($sw==$q)
	{
	$ten=$ten+10;//�_����ǉ�
	}else//�łȂ����
	{
	$ng=$ng+1;//���s�񐔂𑝂₷
	}

}else//�����{�^����������Ă��Ȃ����
{

//�ϐ�������
$ten=0;
$ng=0;

}

if ($ng==3){//�����A���s�񐔂��K��񐔂𒴂�����

$msg="Game Over!!";//���b�Z�[�W���`
alert($msg);//�G���[�_�C�A���O��\��

//�I���{�^����\��
print ("
<form method=\"POST\" action=\"game1.php\">
<input type=\"submit\" value=\"�I��\" style=\"font-size : 300%;\">
<input type=\"hidden\" name=\"sw\" value=\"\"><!--�{�^������������>
</form>
");

}else//���s�񐔂��K��񐔂𒴂��Ă��Ȃ����
{

//�����{�^����\��

print ("
<FORM method=\"POST\" action=\"game1.php\">
<INPUT type=\"submit\" name=\"sw\" value=\"1\" style=\"font-size : 300%;\">
<INPUT type=\"submit\" name=\"sw\" value=\"2\" style=\"font-size : 300%;\">
<INPUT type=\"submit\" name=\"sw\" value=\"3\" style=\"font-size : 300%;\">
<!--�_���Ǝ��s�񐔂��B���t�H�[���ő��M-->
<input type=\"hidden\" name=\"ten\" value=$ten>
<input type=\"hidden\" name=\"ng\" value=$ng>
</form>
");

}
//�X�R�A���\��
print ("
<form>
<h3>�O��̐����F</h3>
<INPUT type=\"text\" value=$q readonly>
<br>
<h3>�X�R�A�F</h3>
<INPUT type=\"text\" value=$ten readonly>
<br>
<h3>���s�񐔁F</h3>
<INPUT type=\text\" value=$ng readonly>
</form>
");

//�I��

?>
</BODY>
</HTML>

