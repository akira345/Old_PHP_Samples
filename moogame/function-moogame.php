<?php
//Moo�Q�[���v���O�����֐�Ver2.0
//Copyright(C) 2003 Akira345
//�����F�����i�Q���ȏ�X���ȉ��j�A�v���C���[�����͂������l
//�I�I���ӁI�I
//�Ԓl�͕K��list�Ŏ󂯂邱�ƁB���̊֐��͕Ԓl�Ƃ��ĕ����̒l��Ԃ��܂��B
//�G���[�������́A�G���[�R�[�h�ȊO�̕Ԓl�͑S��0��Ԃ��܂��B�Ăяo���̍ۂ̓G���[�R�[�h�̃`�F�b�N��K���s���ĉ������B
//�Ԓl�F�����t���O�i�P�F�����A�O�F�s�����j�A�q�b�g���A�u���[���A�G���[�R�[�h
//�G���[�R�[�h
//�O�F����A�P�F���͂��ꂽ���l�̌����ƋK��̌�������v���Ȃ������l���s���A�Q�F�������s���A�S�F�����G���[
//�g�p�@�F
//list($flag,$hit,$blow,$errorcode)=moogame(,3,$input_value);
function moogame($set_value,$input_value)
{

//�����p�����[�^�[�ݒ�
$errorcode=0;
$hit=0;
$blow=0;
$winner=0;
	//////////�p�����[�^�[�`�F�b�N��//////////
	$keta=strlen($set_value);//�����̌������`�F�b�N
	if ($keta=="" or $keta<2 or $keta>9)//�������s����������
	{
	$errorcode=2;//�G���[�R�[�h��ݒ�
	return array(0,0,0,$errorcode);//�Ԓl��ݒ�i���͂��̒i�K�Ŋ֐��͏I������Bexit���߂͂���Ȃ������肷��E�E�E�j
	exit;//�����I��
	}

	//���͒l�`�F�b�N
	if (strlen($input_value)!=$keta)//���͂��ꂽ�l�̌������K��̌����ƈ���Ă�����
	{
	$errorcode=1;//�G���[�R�[�h��ݒ�
	return array(0,0,0,$errorcode);//�Ԓl��ݒ�i���͂��̒i�K�Ŋ֐��͏I������Bexit���߂͂���Ȃ������肷��E�E�E�j
	exit;//�����I��
	}
	//////////�p�����[�^�[�`�F�b�N��//////////

	//////////���������蕔//////////
	if ($set_value==$input_value)//�����̐��Ɠ��͂��ꂽ�������������
	{
	$winner=1;//�����t���O��������
	}
	else
	{
	$winner=0;//�s�����t���O��������
	}
	//////////���������蕔//////////

	//////////�q�b�g�ƃu���[�̌v�Z��//////////
	for ($i=0;$i<$keta;++$i)		//���͌����񃋁[�v����
	{
		for ($j=0;$j<$keta;++$j)	//���������񃋁[�v����
		{
		$chk=substr($input_value,$i,1);	//���͐�����$i���ڂ����o��
		$chk1=substr($set_value,$j,1);	//���𐔂���$j���ڂ����o��
			if ($chk==$chk1)	//�����A���o�������������������
			{
				if ($i==$j)	//�����A���o�����ʒu�i���j�������Ȃ��
				{
				$hit=$hit+1;	//�q�b�g�̐��ɂP����
				}
				else
				{
				$blow=$blow+1;	//�u���[�̐��ɂP����
				}

			}
		}
	}
	//////////�q�b�g�ƃu���[�̌v�Z��//////////

	//////////�Ԓl�̐ݒ�//////////
	$errorcode=0;//����I���R�[�h��ݒ�
	return array($winner,$hit,$blow,$errorcode);//�Ԓl��ݒ�
	//////////�Ԓl�̐ݒ�//////////

//////////�֐��I��//////////
//The End Of Function
}

//�����_���������[�`��Ver2.0
//Copyright(C) 2003 Akira345
//�����F�������錅���i�Q�ȏ�X�ȉ��j
//�I�I���ӁI�I
//�Ԓl�͕K��list�Ŏ󂯂邱�ƁB���̊֐��͕Ԓl�Ƃ��ĕ����̒l��Ԃ��܂��B
//�G���[�������́A�G���[�R�[�h�ȊO�̕Ԓl�͑S��0��Ԃ��܂��B�Ăяo���̍ۂ̓G���[�R�[�h�̃`�F�b�N��K���s���ĉ������B
//�Ԓl�F�w�肳�ꂽ�����̏d�����Ȃ�����A�G���[�R�[�h
//�G���[�R�[�h
//�O�F����I���A�P�F�������s���A�Q�F�����G���[
//�g�p�@�F
//list($set_value,$errorcede)=value_generate($keta)
//
function value_generate($keta)
{
$errorcode=0;
	//////////�����`�F�b�N//////////
	if ($keta<2 or $keta>9)//�������Q�ȉ����X�ȏ�Ȃ�
	{
	$errorcode=1;//�G���[�R�[�h��ݒ�
	return array(0,$errorcode);//�Ԓl��ݒ�
	exit;//�����I��
	}
	//////////�����`�F�b�N//////////

	//////////����������//////////
	/***********************************************
	//�����������F�o�g�o�h�L�������g��蔲��

	//��܂��Ȑ����F
	//�}�C�N���^�C�����擾���A�������ɃV�[�h���쐬���A���������������Ă���E�E�E�݂���

	//�����F����
	//�Ԃ�l�F?
	***********************************************/
	// �}�C�N���ŃV�[�h��ݒ肷��
	 function make_seed() {
	     list($usec, $sec) = explode(' ', microtime());
	     return (float) $sec + ((float) $usec * 100000);
	 }
	srand(make_seed());//�V�[�h���痐��������
	//////////����������//////////

	//////////�����_���������[�`��//////////
	$keta=$keta+1;//���[�v�̏I�������̊֌W����P�l�𑝂₷
	$tmp[1]=rand(1,9);//�P���ڂ̂P�ȏ�X�ȉ��̐����̗����𔭐�
	$i=2;//���̌������w��
	$c=0;//���S���u�̃J�E���^�[��������
	while ($i<$keta)//�����񃋁[�v
	{

	////�������[�v�h�~�p���S���u////
	$c=$c+1;//�g���b�v�p�J�E���^�[�ϐ��𑝂₷
		if ($c>100)
		{
		$errorcode=9;//�G���[�R�[�h��ݒ�
		return array(0,$errorcode);//�Ԓl��ݒ�
		exit;//�����I��
		}
	////�������[�v�h�~�p���S���u////

	$tmp[$i]=rand(1,9);//�Q���ڈȍ~��ݒ�
	////�ݒ肵�����ɏd�����Ȃ����`�F�b�N////
			///�I�������ݒ�///
			$end_value=$i-1;
		for ($j=1;$j<$i;++$j)
		{
			if ($tmp[$j]==$tmp[$i])//�����A�d������������
			{
			break;//�d���`�F�b�N���[�`���𔲂���
			}
			else
			{
				if ($j==$end_value)//�S���`�F�b�N������
				{
				$i=$i+1;//����������₷
				}
			}
		}
	////�ݒ肵�����ɏd�����Ȃ����`�F�b�N////

	}
	//////////�����_���������[�`��//////////

	//////////�z��𐔗�ɕϊ�//////////
	for ($i=1;$i<$keta;++$i)//�����񃋁[�v
	{
	$out_value=$out_value.$tmp[$i];//�z��̕��������Ɍ������Ă���
	}
	//////////�z��𐔗�ɕϊ�//////////

	//////////�Ԓl��ݒ�//////////
	$errorcode=0;//����I����ݒ�
	return array($out_value,$errorcode);//�Ԓl��ݒ�
	//////////�Ԓl��ݒ�//////////

//The End Of Function
}