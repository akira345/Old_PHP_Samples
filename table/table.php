<html>
<TITLE>
�\�W�F�l���[�^�[Ver6.3forPHP4NewVer�Ή���
</TITLE>
<body bgcolor=#253656>

<!--�\�W�F�l���[�^�[Ver6.3forPHP4NewVer�Ή���-->
<!--Ccopyright(C)2002 Akira345-->

<!--�v���O�����X�^�[�g�I-->
<?php

//PHP4NewVer�Ή��v���O����
$tr=$_POST['tr'];//�t�H�[�����炫���c�̕�����
$td=$_POST['td'];//�t�H�[�����炫�����̕�����
$waku=$_POST['waku'];//�t�H�[�����炫���g�̑���
$moji=$_POST['moji'];//�t�H�[�����炫�����ɓ���镶��
$submit=$_POST['submit'];//�{�^��
//�ȏ�I���

//�w�b�_�[

//HTML�o��
print ("

<TABLE BORDER=0>
<TR>
	<td><form method=POST action=table.php>\n
<h3>�c�̕������́H</h3>\n
<input type=text name=tr value=$tr>��\n</td>
	<td><h3>���̕������́H</h3>\n
<input type=text name=td value=$td>\n</td>
	<td><h3>�g�̑����́H</h3>\n
<input type=text name=waku value=$waku>\n
</td>
	<td><h3>���ɓ���镶���́H</h3>
<input type=text name=moji value=$moji>\n
</td>
</tr>

</table>

<input type=submit name=submit value=\"OK\">\n
</form>\n
<br>\n<br>\n

");

//�w�b�_�[�I���

//�f�o�b�N����
//$tr=25;
//$td=12;

//���C�����[�`��


//���ׂẴt�H�[�������͂���Ă��邩�`�F�b�N

if ($submit !="" && $tr !="" && $td !="" && $waku !="")
{

print ("<TABLE BORDER=$waku>\n");//TABLE�^�O�o��

//�����A���ɓ���镶�������͂���Ă��Ȃ���΃t���O�𗧂Ă�
if ($moji==""){
	$flag=1;
		}

	for ($i=0;$i<$tr;$i++)//�c�������[�v
	{
	print ("<TR>\n");
	
		for ($j=0;$j<$td;$j++)//���������[�v
		{
	
	//�����A�t���O�������Ă���΁A�z��\�����[�h�ɂ���
	
		if ($flag !=""){$moji=$i.",".$j;}
	
//����TAB��HTML�ɏo�͂����Ƃ��\�[�X�����Ղ����邽�߂ɓ��ꂽ�����ł��D
	
		print ("	<TD>$moji</TD>\n");
	
		}
	
	print ("</TR>\n");
	}

print ("</TABLE>\n");//TABLE�^�O�I��
}

?>
</body>
</html>
