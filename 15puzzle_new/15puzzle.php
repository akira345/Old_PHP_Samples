<?php
session_start();//�Z�b�V�����Ǘ����g�����߂̐鐾�B
//����̓t�@�C���̐擪�ɕK���L�q���Ȃ���΂Ȃ�Ȃ��B�i<HTML>������B�j
?>

<html>
<head>
<title>
�P�T�Q�[���v���O����Ver1.00
</title>
</head>
<body>

<?php
//�P�T�Q�[���v���O����Ver1.00
//Copyright(C)2002,2003 Akira345,NAGOMI

//�v���O�������̃R�����g�Ŕ�΂��Ă���Print���߂̓f�o�b�N�p�ł��B����ɂ͊֌W����܂���B
//�iPrint���߂������Ƃ���͋�J�����Ƃ���ł��i�΁j�j
//�v���O��������(*?)�͂قړ��������ł��B

//���ݒ�t�@�C���ǂݍ���
require("./15puzzle.ini");

//�O�����[�U�[�֐��ǂݍ���
require("./myfunc.inc");

//����������
srand(make_seed());

//�G���[�`�F�b�N
if ($waku<=1 or $waku>10)//�g�̈�ӂ�1�ȉ���10�ȏゾ������
{
print ("�g�̎w�肪�s���ł�");
}else{

//���C���X�N���v�g�X�^�[�g

//�萔����
$waku=floor($waku);		//�l�̐؂�̂āi�����Ǝv�����Ǐ����΍�ł��j
$souwaku=$waku*$waku;		//���g���v�Z


//PHP4NewVer�Ή������[�J�n�[�i�O�����炭��ϐ��ꗗ�j

//�t�H�[������̓��͌n
$button=$_POST['button'];	//�{�^���̎��(�P�F�X�^�[�g�A�Q�F�M�u�A�b�v)
$mode_Form=$_POST['mode'];	//��Փx�ݒ�ϐ�

//URL����̓��͌n

//�Z�b�V��������
$sw=$_SESSION['sw'];		//���[�h�ݒ�ϐ�
$r=$_SESSION['r'];		//�󔒉摜�̍��W
$move=$_SESSION['move'];	//����������W
$mode=$_SESSION['mode'];	//��Փx�\���p�ϐ�
$outdata=$_SESSION['outdata'];	//���݂̑S���W

//URL����
$link=$_GET['link'];		//�����������W

//PHP4NewVer�Ή������[�I���[

//�Z�b�V����ID����ID�ɑ��
$ID=session_id();

//�{�^���`�F�b�N
if ($button==1)//�X�^�[�g�{�^���������ꂽ��
{
$sw=1;//�����_���\�����[�h��
}
elseif ($button==2)//�M�u�A�b�v�{�^���������ꂽ��
{
$sw=0;//�����`�\�����[�h��
}
if ($sw=="")//���[�h���ݒ肳��Ă��Ȃ���΁i�Q�[���N������Ȃǁj
//���[�h�ƃ{�^���͊֌W�Ȃ������E�E�E�i�O�O�j�U
{
$sw=0;//�����`�\�����[�h�ɂ���
}

//�z��ɒl����

if ($sw==0)//�����`�\�����[�h�Ȃ�(*1)
{

$kousi=explode(",",INIT($souwaku));//�z�񏉊������[�`�����Ăяo��

}
elseif ($sw==1)//�����_���\�����[�h�Ȃ�|�J�n�|
{
//���ǃ����_���\�����[�hVre6.0
//Copyright(C)Akira345

//��Փx�ݒ�ǂݍ���

if ($mode_Form==1)//�₳����
{
$shfull=3;//���̐�����$souwaku���񃋁[�`�������B�ȉ����l
}
elseif ($mode_Form==2)//����
{
$shfull=6;
}
elseif ("$mode_Form==3")//���;
{
$shfull=10;
}

$mode=$mode_Form;//��Փx�\���̂��ߕϐ�$mode�֓�Փx�ݒ�̒l����

//���[�`���̐���
//�܂��A�����`�\�����[�h�ō��W��ݒ肵�A
//���̌ド���_���\�����[�`���ŋ󔒉摜�𓮂����B

$r=$souwaku;//�󔒉摜�̍��W����

//�����`�\�����[�h�ō��W��ݒ�(*1)

$kousi=explode(",",INIT($souwaku));//�z�񏉊������[�`�����Ăяo���B

//�ϐ��ƃt���O�̏�����
$j=0;
$g=0;

//�����_���\�����[�`��
//���̃��[�`���̐���
//�P�A����������W�𒲂ׂ�
//�Q�A����������W���瓮�������W�������_���ɂP�I��
//�R�A�I�񂾍��W�𓮂���
//�P�`�R�����x���Ɏw�肳�ꂽ�񐔌J��Ԃ�
//�J��Ԃ�����A���ꂪ���ɖ߂��Ă��Ȃ����i�����`�ɂȂ��Ă��Ȃ����j�m�F
//�����A�߂��Ă�����A�������P�`�R���J��Ԃ��A�`�F�b�N����B

while($g==0)//���ǃ����_���\�����[�`���|�J�n�|
{
$j=$j+1;//�J�E���^�[�ϐ����グ��


//����������W���胋�[�`���|�J�n�|

//NAGOMI���쐬���ǃ��[�`��(*4)
//Programd By NAGOMI

//Akira345�ɂ����Ȃ����
//��������摜�̌��͍ő�S�B
//�i�^�񒆂��󔒉摜�������ꍇ�A��������̂͏㉺���E�j
//�Ȃ̂ł܂��͑S���̌v�Z��̓�������ꏊ�𒲂ׂ�B

$kouho[1]=$r-1;//���P�i���j
$kouho[2]=$r+1;//���Q�i�E�j
$kouho[3]=$r+$waku;//���R�i���j
$kouho[4]=$r-$waku;//���S�i��j


//�v�Z��̏ꏊ������ۓ���������̂��i�荞�ށB
//�v�Z��̏ꏊ�Ŏ��ۓ������Ȃ����̂͂O�i�[���j������

$tmp=$r%$waku;//���莮�i���ۂ̓���������W�Ƃ̊֘A�𒲂ׂč쐬���܂����i�O�O�j�j

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

//����������W���胋�[�`���|�I���|

//print ("B$r");

//���������W���胋�[�`���|�J�n�|
$f=0;//�t���O��������

while($f==0)//���[�`���J�n
{
$tmp=rand(1,4);//��������S�̍��W���瓮�����P�������_���ɑI�ԁi�P�`�S�j

if ($kouho[$tmp]!=0)//�I�񂾍��W�����ۓ������邩�`�F�b�N
	{
	//print ("A$kouho[$tmp]");
	$f=1;//����������t���O���グ���[�`���𔲂���
	}

}
//���������W���胋�[�`���|�I���|

//���W�𓮂����|�J�n�|(*2)

//�����͗v��Ȃ��Ǝv�����ǂ���Ă��邱�Ƃ͒P�Ȃ�Q�ϐ��̓���ւ��ł�
//�������O�̋󔒉摜�̍��W�Ɠ����������̍��W�����ւ��Ă��܂�

$swap=$kousi[$kouho[$tmp]];
$kousi[$kouho[$tmp]]=$kousi[$r];
$kousi[$r]=$swap;

$r=$kouho[$tmp];//���R����ւ����瓮�������������������W�͋󔒉摜�̍��W�ɂȂ�̂ő���B

//���W�𓮂����|�I���|

//print $souwaku*$shfull;

//�w�背�x������������H�|�J�n�|
if ($j>=$souwaku*$shfull)
{
	//print ("END");

$err=chk_completion(implode(",",$kousi),$souwaku);//�������H�i���ɖ߂��Ă��Ȃ����H�j(*3)

	//���[�v�𔲂����������|�J�n�|
	if ($err==1)//�������Ȃ�
	{
	$g=1;//���[�v�𔲂���
	}
	else//�����`�Ȃ�
	{
	$g=0;//������񃋁[�v�����
	}
	//���[�v�𔲂����������|�I���|

}
//�w�背�x������������H�|�I���|

}
//���ǃ����_���\�����[�`���|�I���|

}
//�����_���\�����[�h�Ȃ�|�I���|

if ($sw==3)//�Q�[�����Ȃ�|�J�n�|
{
//print $outdata;
$kousi=explode(",",$outdata);//�����z��W�J
//print ("out$outdata");

$chk_move=explode(",",$move);//�����z��W�J
//print ("move$move");
//print ("MOVECHK$chk_move[3]");
if ($link!="" and $link!=0)//�����������W����ƂO�i�[���j�łȂ����
//URL��������ꂽ���̑΍�|�J�n�|
{
	for ($i=0;$i<=3;++$i)
	{
		if ($chk_move[$i]==$link)
		//����������W�Ɠ����������W����v�����
		
		{
		//���W�����ւ���(*2)
		//print ("LINK$link");
		$swap=$kousi[$link];
		$kousi[$link]=$kousi[$r];
		$kousi[$r]=$swap;
		$r=$link;
		}
		
	}

}
//URL��������ꂽ���̑΍�|�I���|

}
//�Q�[�����Ȃ�|�I���|


//��������̃��[�`���̓��[�h�Ɋ֌W�Ȃ����s����܂��B�i$sw=0,1,3�j

$err=chk_completion(implode(",",$kousi),$souwaku);//�������H(*3)

//��ԕ\��

//��Փx�\��

if ($mode==1)
{
print("�|�₳�����|");
}
elseif ($mode==2)
{
print("�|���ʁ|");
}
elseif($mode==3)
{
print ("�|����|");
}

//��ԕ\��
if ($err==1)//�������Ȃ�
{
print ("������\n");
$sw=3;//�Q�[�����[�h�J�n�i$sw=1�̂Ƃ��j���͑��s
}else//�����`�Ȃ�
{
print ("����\n");

$sw=0;//�����`���[�h�ֈڍs�i�Q�[���I���j
$link="";//�����������W������
}

//NULL�`�F�b�N
if ($sw==3)//�Q�[�����Ȃ�
{

//�����N��������`�F�b�N���[�`���|�J�n�|


//����������W���胋�[�`���|�J�n�|

//NAGOMI���쐬���ǃ��[�`��(*4)
//Programd By NAGOMI

//Akira345�ɂ����Ȃ����
//��������摜�̌��͍ő�S�B
//�i�^�񒆂��󔒉摜�������ꍇ�A��������̂͏㉺���E�j
//�Ȃ̂ł܂��͑S���̌v�Z��̓�������ꏊ�𒲂ׂ�B

$kouho[1]=$r-1;//���P�i���j
$kouho[2]=$r+1;//���Q�i�E�j
$kouho[3]=$r+$waku;//���R�i���j
$kouho[4]=$r-$waku;//���S�i��j


//�v�Z��̏ꏊ������ۓ���������̂��i�荞�ށB
//�v�Z��̏ꏊ�Ŏ��ۓ������Ȃ����̂͂O�i�[���j������

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
//�����N��������`�F�b�N���[�`���|�I���|

//�P�T�Q�[����ʕ\�����[�`���|�J�n�|

//�\�W�F�l���[�^�[�̃\�[�X���ꕔ���p�E�E�E

if ($view==1)			//���{�\�����[�h�Ȃ�
{				//�^�O���o�͂���
print ("<TABLE BORDER=0>\n");
print ("<TR>\n");
print ("<TD>\n");
}

//�Q�[���\�����[�`���J�n

$k=0;//�J�E���^�[�ϐ�������


print ("<TABLE BORDER=1>\n");//TABLE�^�O�o��


	for ($i=0;$i<$waku;$i++)//�c�������[�v
	{
	print ("<TR>\n");
	
		for ($j=0;$j<$waku;$j++)//���������[�v
		{
$k=$k+1;//�����[�v�����J�E���g�i�摜�̍��W�ɂȂ�܂��j
	
//����TAB��HTML�ɏo�͂����Ƃ��\�[�X�����Ղ����邽�߂ɓ��ꂽ�����ł��D
	
		print ("	<TD>");

//�����N��������i�S�摜�̍��W�𒲍��j�[�J�n�[
//�P�񃋁[�v����邲�ƂɃ����N�����������𖞂����Ă��邩����
$f=0;//�t���O��������
$L=0;//�J�E���^�ϐ���������

while($f==0)
{
	$L=$L+1;//�J�E���^���グ��
	//print ("$kouho[$L]");
	if ($k==$kouho[$L])//���������N�𒣂�����𖞂����Ă�����i���̉摜����������摜��������j
	{
	//���������W���Z�b�V����ID��URL�ő��M���Z�b�V�����ϐ����΂�
	//�{�ɂ��΁A�Z�b�V�����ϐ����΂��ɂ̓����N��PHP�ŏo�͂��Ă͂����Ȃ����������E�E�E
	$out="<a href=\"".$phpname."?PHPSESSID=$ID&link=$k\">
	<img src=$dir$kousi[$k].$ex></a>";//�����N�𒣂�
	//���̂s�`�a�͂g�s�l�k�\�[�X�����Ղ����邽�߂ɓ��ꂽ�����ł�
	$f=1;//�������胋�[�`���𔲂���
	}
	else
	{
	$out="<img src=$dir$kousi[$k].$ex>";//�摜�̂ݕ\��
	//���Ȃ݂ɁA��̂悤�Ȃ����͎ד��B�����ɂ͉��̂悤�ɂ���B
	//$out="<img src=".$dir.$kousi[$k].".".$ex.">";//�摜�̂ݕ\��
		
		if ($L>4)//�S�Ă̏�������������i��������摜�̐��͍ő�S�B������P�̉摜�ɑ΂��S�񃋁[�v���܂킷�B�j
		{
		$f=1;//�������胋�[�`���𔲂���
		}
	}

}//�����N�������胋�[�`���[�I���[

print ("$out"."</TD>\n");//�摜�������N���o��	


	
		}
	
	print ("</TR>\n");
	}

print ("</TABLE>\n");//TABLE�^�O�I��

//�Q�[���\�����[�`���I��

if ($view==1)		//���{�\�����[�h�Ȃ�
{			//�^�O���o�͂��違���{��\������
print ("</td>\n");
print ("<td>\n\n</td>\n");
print ("<td>\n");

//���{�\�����[�`���i���g�͏�̃Q�[���\�����[�`���Ƃقڈꏏ�ł��B�j
$k=0;//�ϐ���������

//�����`��\�����[�h����(*1)

$kousi_view=explode(",",INIT($souwaku));//�z�񏉊������[�`�����Ăяo��

print ("<TABLE BORDER=1>\n");//���{�\���pTABLE�^�O���o��

for ($i=0;$i<$waku;$i++)//�c�������[�v
{
print ("<TR>\n");
	for ($j=0;$j<$waku;$j++)//���������[�v
	{
	$k=$k+1;//�����[�v�����J�E���g�i�摜�̍��W�ɂȂ�܂��j
	print ("	<TD>");
	$out="<img src=".$dir.$kousi_view[$k].".".$ex.">";//�摜�̂ݕ\��
	print ("$out"."</TD>\n");

	}

print ("</TR>");
}

print ("</TABLE>");//���{�\���pTABLE�^�O�����

//���{�\�����[�`���I��

print ("</TD>\n</TR>\n</TABLE>\n");
}

//�P�T�Q�[����ʕ\�����[�`���|�I���|

//�Z�b�V�����ϐ��o�^�|�J�n�|

if ($sw!=0)//�Q�[�����n�܂��Ă�����
{
$move=implode(",",$kouho);//����������W������
}

$outdata=implode(",",$kousi);//�z�񌋍�

//print $outdata;
//session_register("sw","outdata","r","mode","move");//�Z�b�V�����ϐ��ɓo�^�i���[�h�؂�ւ��A�����z��A�󔒉摜���W�A���x���A����������W�j
$_SESSION['sw']=$sw;
$_SESSION['outdata']=$outdata;
$_SESSION['r']=$r;
$_SESSION['mode']=$mode;
$_SESSION['move']=$move;
//�Z�b�V�����ϐ��o�^�|�I���|

//�t�H�[���\�����[�`���|�J�n�|
if ($sw=="0")//�����`�\�����[�h�Ȃ�i���̓Q�[�����N���A������j
{
//���x�����̓t�H�[���ƃX�^�[�g�{�^����\��
print ("
<FORM method=\"POST\" action=\"$phpname\">
<input type=\"radio\" name=\"mode\" value=\"1\">�₳����
<input type=\"radio\" name=\"mode\" value=\"2\" checked>����
<input type=\"radio\" name=\"mode\" value=\"3\">���
<br>
<input type=\"hidden\" name=\"button\" value=\"1\">
<INPUT type=\"submit\" name=\"submit\" value=\"�X�^�[�g\">
</FORM>

");
}
else//�łȂ����
{
//�M�u�A�b�v�{�^���\��
print("
<FORM method=\"POST\" action=\"$phpname\">
<input type=\"hidden\" name=\"button\" value=\"2\">
<INPUT type=\"submit\" name=\"submit\" value=\"�M�u�A�b�v\">
</FORM>
");
}
//�t�H�[���\�����[�`���|�I���|

}//���C���X�N���v�g�I��
?>
</body>
</html>