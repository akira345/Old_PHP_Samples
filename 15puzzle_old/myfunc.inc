<?php
//�����������F�o�g�o�h�L�������g��蔲��

//��܂��Ȑ����F
//�}�C�N���^�C�����擾���A�������ɃV�[�h���쐬���A���������������Ă���E�E�E�݂���

// �}�C�N���ŃV�[�h��ݒ肷��
 function make_seed() {
     list($usec, $sec) = explode(' ', microtime());
     return (float) $sec + ((float) $usec * 100000);
 }
//�I���
?>