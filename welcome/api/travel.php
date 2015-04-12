<?php
/*
  Script outputs data in json format suitable for 'source' option in X-editable
*/
sleep(1);   
$groups = array(
  array('value' => 5, 'text' => 'เดินทางด้วยตนเอง'),
  array('value' => 1, 'text' => 'อนุสาวรีย์ชัยสมรภูมิ'),
  array('value' => 2, 'text' => 'สถานีขนส่งหมอชิตใหม่ (หมอชิต 2)'),
  array('value' => 3, 'text' => 'สถานีรถไฟหัวลำโพง'),
  array('value' => 4, 'text' => 'สถานีขนส่งเอกมัย')
);
echo json_encode($groups);  