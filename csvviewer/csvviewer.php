<html>
<head>
<title>
�f�[�^�ꗗ
</title>
<body>
<?php
//�ėp�b�r�u�t�@�C���\���v���O�����u�����P�D�O
//Copyright(C)Akira345

$fd = fopen ("./sample.csv", "r");//�b�r�u�f�[�^�t�@�C���I�[�v��
$koumoku=5;//���ڐ�
$data[0]="No,�w���ԍ�,�Ȋw���_,���w���_,�������_";//���ږ��w��i�e���ږ��̊Ԃɂ̓T���v���̂悤��","�ŋ�؂邱�ƁI�I�j

$i=0;//�J�E���^�[�ϐ�������

while (!feof ($fd)) 
{

//�t�@�C���̏I�[�ɂ���܂�
$i=$i+1;//�J�E���g�i�P����͂��߂邱�ƁB�z��0�͍��ږ������邩��B�j
$data[$i]= $i.",".fgets($fd, 8192);//�t�@�C���̓��e��ǂݍ��݁A�ŏ��̍��ڂƂ��ăJ�E���g����t�������Ĕz��ɕۑ��B

}

fclose ($fd);//�t�@�C�������

print ("<TABLE BORDER=1>\n");//TABLE�^�O�o��

for ($j=0;$j<$i;++$j)//�t�@�C���̏I�[���R�[�h���܂�
{
	print ("<TR>\n");//TR�^�O�o��
	$tmp=explode(",",$data[$j]);//","����؂蕶���Ƃ��ăf�[�^��$temp�ɑ��
	
		for ($k=0;$k<$koumoku;++$k)//���ڐ������ɕ\��
		{
		print ("<TD>$tmp[$k]</TD>");
		}
	print ("</TR>\n");//TR�^�O�o��
}

print ("</TABLE>\n");//TABLE�^�O�I��

?>
</body>
</html>

