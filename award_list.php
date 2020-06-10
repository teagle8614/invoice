<?php
  include "com/base.php";

  $y=$_GET['y'];
  $p=$_GET['p'];
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>中獎獎號列表</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/award_list.css">
  <link rel="stylesheet" href="./css/firework.css">
  <!-- 
    Pure CSS Fireworks  
    Author: Eddie Lin
    source: https://codepen.io/yshlin/details/ylDEk
   -->
</head>
<body>
  <!-- 煙火特效 -->
  <div class="pyro">
    <div class="before"></div>
    <div class="after"></div>
  </div>

  <div class="container">
    
    <div class="header">中獎獎號列表</div>
    <div class="invoiceBox">
    <?php
      $rows=all("reward_record",""," order by `reward` ASC");
      if(!empty($rows)){
        // 有中獎
    ?>
        <table class="awardTable">
          <tr>
            <td>年份</td>
            <td>期別</td>
            <td>獎號</td>
            <td>花費</td>
            <td>獎項</td>
            <td>獎金</td>
          </tr>
          <?php
              // 小計: 獎項、數量、金額
              $arrayAward=["","","","","","","","","",""]; 
              $arrayNum=[0,0,0,0,0,0,0,0,0,0];
              $arrayBouns=[0,0,0,0,0,0,0,0,0,0];
              // 總數量、總金額
              $countNum=0;
              $countBouns=0;
              foreach($rows as $row){
                // 獎項列表
                $list=find("award_list",$row['reward']);

                $p=$row['period'];
                echo "<tr>";
                echo "  <td>".$row['year']."</td>";
                echo "  <td>".(2*$p-1)."、".(2*$p)."月</td>";
                echo "  <td>".$row['code'].$row['number']."</td>";
                echo "  <td>".$row['expend']."</td>";
                echo "  <td>".$list['award']."</td>";
                echo "  <td>".$list['bonus']."</td>";
                echo "</tr>";

                $index=$row['reward']-1;
                $arrayAward[$index]=$list['award'];
                $arrayNum[$index]=$arrayNum[$index]+1;
                $arrayBouns[$index]=$arrayBouns[$index]+$list['bonus'];
              }
          ?>
        </table>

      <?php
          for($z=0;$z<=8;$z++){
            if($arrayNum[$z]!=0){
              echo "<p class='subtotal'>".$arrayAward[$z]."，".$arrayNum[$z]."張，小計".$arrayBouns[$z]."元</p>";
              $countNum=$countNum+$arrayNum[$z];
              $countBouns=$countBouns+$arrayBouns[$z];
            }
          }
          echo "<p class='total'>合計".$countNum."張，".$countBouns."元</p>";
          $fireworkDisplay="block";

        }else{
          // 沒中獎
          echo "<p class='tip'>此期沒有中獎!請再接再厲!</p>";
          $fireworkDisplay="none";
        }
      ?>
      <style>
        /* 控制煙火顯示與否 */
        .pyro{
          display: <?=$fireworkDisplay;?>;
        }
      </style>
      
      <div class="btnBar">
        <a class="btn2" href="award.php?y=<?=$y?>&p=<?=$p?>">回對獎頁</a>
      </div>
    </div>
  </div>
</body>
</html>