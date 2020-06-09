<!-- 重置資料庫 -->
<?php
include "../com/base.php";

// 清空發票資料表
$sql="TRUNCATE TABLE invoice";
$pdo->exec($sql);

// 將備份的發票資料表取出後存入原資料表
$invoice_rows=all("invoice_bak");
foreach($invoice_rows as $row){
  $data=[
    'code' => $row['code'],
    'number' => $row['number'],
    'period' => $row['period'],
    'expend' =>$row['expend'],
    'year' => $row['year']
  ];
  save("invoice",$data);
}

// -----------------------------------------

// 清空獎號資料表
$sql="TRUNCATE TABLE award_number";
$pdo->exec($sql);

 // 將備份的獎號資料表取出後存入原資料表
$an_rows=all("award_number_bak");
foreach($an_rows as $row){
  $data=[
    'year' => $row['year'],
    'period' => $row['period'],
    'number' => $row['number'],
    'type' =>$row['type']
  ];
  save("award_number",$data);
}

to("../index.php?reset=true");

?>