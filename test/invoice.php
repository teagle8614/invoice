<?php
include "./com/base.php";
$period=ceil(date("n")/2);

$monthStr=[
  '1' => "1、2月",
  '2' => "3、4月",
  '3' => "5、6月",
  '4' => "7、8月",
  '5' => "9、10月",
  '6' => "11、12月"
];

if(isset($_GET['period'])){
  $period=$_GET['period'];
}
$year=date("Y");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>各期獎號</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/invoice.css">
</head>
<body>
  <?php 
    include "./include/header.php"; 
  ?>

<h1>發票列表</h1>

  <ul class="nav">
    <li><a href="invoice.php?period=1" style="background:<?=($period==1)?'lightgreen':'white';?>">1(1,2)</a></li>
    <li><a href="invoice.php?period=2" style="background:<?=($period==2)?'lightgreen':'white';?>">2(3,4)</a></li>
    <li><a href="invoice.php?period=3" style="background:<?=($period==3)?'lightgreen':'white';?>">3(5,6)</a></li>
    <li><a href="invoice.php?period=4" style="background:<?=($period==4)?'lightgreen':'white';?>">4(7,8)</a></li>
    <li><a href="invoice.php?period=5" style="background:<?=($period==5)?'lightgreen':'white';?>">5(9,10)</a></li>
    <li><a href="invoice.php?period=6" style="background:<?=($period==6)?'lightgreen':'white';?>">6(11,12)</a></li>
  </ul>

  <a href="add_invoice.php"><button>新增獎號</button></a>
  <hr>

  <?php
  // 將每個獎項分開取出，特別獎與特獎只會有一筆，使用find;()頭獎與六獎可能有多筆，使用all()
  $num1=find('award_number',['period'=>$period,'year'=>2020,'type'=>1]);
  $num2=find('award_number',['period'=>$period,'year'=>2020,'type'=>2]);
  $num3=all('award_number',['period'=>$period,'year'=>2020,'type'=>3]);
  $num4=all('award_number',['period'=>$period,'year'=>2020,'type'=>4]);
  ?>
  <!-- <hr>
  <pre><?=print_r($num1)?></pre>
  <pre><?=print_r($num2)?></pre>
  <pre><?=print_r($num3)?></pre>
  <pre><?=print_r($num4)?></pre> -->


  <table class="invoice-table">
    <tr>
      <td>年月份</td>
      <td><?=$year;?>年<?=$monthStr[$period]?></td>
    </tr>
    <tr>
      <td>特別獎</td>
      <td>
        <?php
        if(!empty($num1['number'])){
          echo $num1['number'];
        }
        ?>
      </td>
      <td>
        <a href="award.php?aw=1&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
    <tr>
      <td>特獎</td>
      <td>
        <?php
        if(!empty($num2['number'])){
          echo $num2['number'];
        }
        ?>
      </td>
      <td>
        <a href="award.php?aw=2&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
    <tr>
      <td>頭獎</td>
      <td>
        <?php
          foreach($num3 as $num){
            echo $num['number']."<br>";
          }
        ?>
      </td>
      <td>
        <a href="award.php?aw=3&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
    <tr>
      <td>二獎</td>
      <td></td>
      <td>
        <a href="award.php?aw=4&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
    <tr>
      <td>三獎</td>
      <td></td>
      <td>
        <a href="award.php?aw=5&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
    <tr>
      <td>四獎</td>
      <td></td>
      <td>
        <a href="award.php?aw=6&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
    <tr>
      <td>五獎</td>
      <td></td>
      <td>
        <a href="award.php?aw=7&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
    <tr>
      <td>六獎</td>
      <td></td>
      <td>
        <a href="award.php?aw=8&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
    <tr>
      <td>增開六獎</td>
      <td>
      <?php
          foreach($num4 as $num){
            echo $num['number']."<br>";
          }
        ?>
      </td>
      <td>
        <a href="award.php?aw=9&year=<?=$year;?>&period=<?=$period;?>">對獎</a>
      </td>
    </tr>
  </table>
</body>
</html>