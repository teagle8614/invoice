<!-- 存入獎號 -->
<?php

include "./com/base.php"; 
echo "<pre>"; print_r($_POST); echo "</pre>";

/**
 * 年份     -> year
 * 期數     -> period
 * 特別獎   -> num1
 * 特獎     -> num2
 * 頭獎     -> num3 可能多筆
 * 增開六獎 -> num4 可能多筆，且只有三碼
 */

$table="award_number";

// 儲存特別獎
$year=$_POST['year'];  
$period=$_POST['period'];

$num1=$_POST['num1'];
$data=[
  "year" => $year,
  "period" => $period,
  "number" => $num1,
  "type" => 1 
];
save($table,$data);

// 特獎
$num2=$_POST['num2'];
$data=[
  "year" => $year,
  "period" => $period,
  "number" => $num2,
  "type" => 2 
];
save($table,$data);

// 頭獎(因為有多筆)
$num3=$_POST['num3'];
foreach($num3 as  $n){
  $data=[
    "year" => $year,
    "period" => $period,
    "number" => $n,
    "type" => 3
  ];
  save($table,$data);
}

// 六獎(因為有多筆)
$num4=$_POST['num4'];
foreach($num4 as  $n){
  $data=[
    "year" => $year,
    "period" => $period,
    "number" => $n,
    "type" => 4
  ];
  save($table,$data);
}

// 導回對獎頁
// to("invoice.php");

?>