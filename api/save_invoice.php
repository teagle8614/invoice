<!-- 新增發票 -->
<?php
  include "../com/base.php";

  $year= $_POST['year'];
  $period= $_POST['period'];

  // 改為function寫法
  $data=[
    'period' => $period,
    'year' => $year,
    'code' => strtoupper($_POST['code']),
    'number' => $_POST['number'],
    'expend' => $_POST['expend']
  ];

  $res=save("invoice",$data);

  if($res>0){
    // 新增成功
    to("../index.php?status=true&y=$year&p=$period"); 
  }else{
    // 新增失敗
    to("../index.php?status=false&y=$year&p=$period"); 
  }


?>
