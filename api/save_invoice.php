<?php
  include "../com/base.php";

  // 盡量將$_POST[' ']的值抓出來，判定是否符合資料庫的規範，在存入資料庫內
  // htmlspecialchars(): 可以將符號、特殊字元轉為其他格式
  //...等

  // $str= strtoupper($_POST['code']);
  // echo "period=".$_POST['period']."<br>";
  // echo "year=".$_POST['year']."<br>";
  // echo "code=".$_POST['code']."<br>";
  // echo "number=".$_POST['number']."<br>";
  // echo "expend=".$_POST['expend']."<br>";


  // $sql= "insert into `invoice` (`period`,`year`,`code`,`number`,`expend`) 
  //        values('".$_POST['period']."','".$_POST['year']."','".strtoupper($_POST['code'])."','".$_POST['number']."','".$_POST['expend']."')";

  // echo $sql;
  // $res=$pdo->exec($sql);

  // if($res>0){
  //   echo "新增成功<br>";
  //   echo "<a href='index.php'>繼續輸入</a><br>";
  //   echo "<a href='list.php'>發票列表</a>";
  // }else{
  //   echo "新增失敗";
  // }

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
    echo "新增成功<br>";
    to("../index.php?status=true&y=$year&p=$period"); 
    // echo "<a href='index.php'>繼續輸入</a><br>";
    // echo "<a href='list.php'>發票列表</a>";
  }else{
    echo "新增失敗<br>";
    to("../index.php?status=false&y=$year&p=$period"); 
  }


?>
