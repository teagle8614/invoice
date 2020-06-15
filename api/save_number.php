<!-- 新增獎號 -->
<?php
  include "../com/base.php";
  // echo "<pre>"; print_r($_POST); echo "</pre>";
  /**
   * 年份     -> year
   * 期數     -> period
   * 特別獎   -> num1
   * 特獎     -> num2
   * 頭獎     -> num3 可能多筆
   * 增開六獎 -> num4 可能多筆，且只有三碼
   */

  $table="award_number";
  $year=$_POST['year'];
  $period=$_POST['period'];
  $data=[
    'year' => $year,
    'period' => $period
  ];


  $count=nums($table,$data);
  if($count>0){
    // 已有資料
    to("../invoice.php?check=true&y=$year&p=$period"); 
  }else{
    // 尚未有資料
 

    // 儲存特別獎
    $num1=$_POST['num1'];
    $data=[
      "year"   => $year,
      "period" => $period,
      "number" => $num1,
      "type"   => 1
    ];
    $res1=save($table,$data);

    // 儲存特獎
    $num2=$_POST['num2'];
    $data=[
      "year"   => $year,
      "period" => $period,
      "number" => $num2,
      "type"   => 2
    ];
    $res2=save($table,$data);

    // 儲存頭獎
    $num3=$_POST['num3'];
    foreach($num3 as $n){
      $data=[
        "year"   => $year,
        "period" => $period,
        "number" => $n,
        "type"   => 3
      ];
      // number為空值時不存入
      if($n!=""){
        $res3=save($table,$data);
      }
    }
    
    // 儲存增開六碼
    $num4=$_POST['num4'];
    foreach($num4 as $n){
      $data=[
        "year"   => $year,
        "period" => $period,
        "number" => $n,
        "type"   => 4
      ];
      // number為空值時不存入
      if($n!=""){
        $res4=save($table,$data);
      }
    }

    // 導回對獎頁
    if($res1>0 && $res2>0 && $res3>0 && $res4>0){
      // 新增成功
      to("../invoice.php?status=true&y=$year&p=$period"); 
    }else{
      // 新增失敗
      to("../invoice.php?status=false"); 
    }
  }
  
?>