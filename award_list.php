<?php
  include "./com/base.php";

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
        $countNum=count($rows);
        $countBouns=0;
        if(!empty($rows)){
      ?>
      <table>
        <tr>
          <td>年份</td>
          <td>期別</td>
          <td>獎號</td>
          <td>花費</td>
          <td>獎項</td>
          <td>獎金</td>
        </tr>
        <?php
            // $countReward=1;
            // $countTmp1=0;
            // $countTmp2=0;
            // $arrayTest1=[];
            // $arrayTest2=[];



            // echo "<pre>"; print_r($rows); echo "<pre>";
            foreach($rows as $row){
              // 獎項列表
              $list=find("award_list",$row['reward']);

              // echo "<pre>"; print_r($list); echo "<pre>";
              $p=$row['period'];
              echo "<tr>";
              echo "  <td>".$row['year']."</td>";
              echo "  <td>".(2*$p-1)."、".(2*$p)."月</td>";
              echo "  <td>".$row['code'].$row['number']."</td>";
              echo "  <td>".$row['expend']."</td>";
              echo "  <td>".$list['award']."</td>";
              echo "  <td>".$list['bonus']."</td>";
              echo "</tr>";
              $countBouns=$countBouns+$list['bonus'];




              // 改用num()計算?

              // echo "row['reward']:".$row['reward']."<br>";

              // if($row['reward']==$countReward){
              //   echo "-----------row['reward']:".$row['reward']."<br>";
              //   echo "-----------countReward:".$countReward."<br>";
              //   $countTmp1=$countTmp1+1;
              //   $countTmp2=$countTmp2+$list['bonus'];
              //   echo "-----------countTmp1:".$countTmp1."<br>";
              //   echo "-----------countTmp2:".$countTmp2."<br>";
              // }else{
              //   echo "===========row['reward']:".$row['reward']."<br>";
              //   echo "===========countReward:".$countReward."<br>";
              //   $arrayTest1[]=$countTmp1;
              //   echo "張數:<br>";
              //   echo "<pre>"; print_r($arrayTest1); echo "<pre>";
              //   $arrayTest2[]=$countTmp2;
              //   echo "小計:<br>";
              //   echo "<pre>"; print_r($arrayTest2); echo "<pre>";

              //   $countTmp1=0;
              //   $countTmp2=0;
              //   $countReward=$countReward+1;
              //   $countTmp1=$countTmp1+1;
              //   $countTmp2=$countTmp2+$list['bonus'];
              // }

            }
        ?>
      </table>
      <?php
         echo "<p class='total'>共".$countNum."張，".$countBouns."元</p>";
         $fireworkDisplay="block";
         }else{
          echo "<p class='tip'>此期沒有中獎!請再接再厲!</p>";
          $fireworkDisplay="none";
        }
      ?>
      <style>
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