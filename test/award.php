<?php
include "./com/base.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>award</title>
</head>
<body>
  <?php 
    include "./include/header.php"; 
  ?>

  <?php
    if(empty($_GET)){
      echo "請選擇要對獎的項目<a href='invoice.php'>各期獎號</a>";
      exit();
    }
    $award_type=[
      1=>["特別獎",1],
      2=>["特獎",2],
      3=>["頭獎",3],
      4=>["二獎",3],
      5=>["三獎",3],
      6=>["四獎",3],
      7=>["五獎",3],
      8=>["六獎",3],
      9=>["增開六獎",4]
    ];

    echo "獎別：".$award_type[$_GET['aw']][0]."<br>";
    echo "年份：".$_GET['year']."<br>";
    echo "期別：".$_GET['period']."<br>";

    // 筆數
    $award_nums=nums("award_number",[
      "year"=>$_GET['year'],
      "period"=>$_GET['period'],
      "type"=>$award_type[$_GET['aw']][1],
    ]);

    // $award_number=find("award_number",[
    //   "year"=>$_GET['year'],
    //   "period"=>$_GET['period'],
    //   "type"=>$award_type[$_GET['aw']][1],
    // ]);

    echo "獎號數量：".$award_nums;

    if($award_nums>1){
      $award_numbers=all("award_number",[
        "year"=>$_GET['year'],
        "period"=>$_GET['period'],
        "type"=>$award_type[$_GET['aw']][1],
      ]);
    }else{
      $award_numbers=find("award_number",[
        "year"=>$_GET['year'],
        "period"=>$_GET['period'],
        "type"=>$award_type[$_GET['aw']][1],
      ]);
    }
    
    echo "<pre>"; print_r($award_numbers); echo "</pre>";

    //抓出符合當期的發票號碼
    $invoices=all("invoice",[
      "year"=>$_GET['year'],
      "period"=>$_GET['period']
    ]);

  ?>  
  <hr>
  <pre>
    <?= print_r($invoices);?>
</pre>
</body>
</html>