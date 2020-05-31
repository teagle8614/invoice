<?php
  include "./com/base.php";
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>中獎獎號列表</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/award_list.css">
</head>
<body>
  <div class="container">
    
    <div class="header">中獎獎號列表</div>

    <div class="invoiceBox">
      <?php
        $award_type=["特別獎","特獎","頭獎","二獎","三獎","四獎","五獎","六獎","增開六獎"];
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
          
            // echo "<pre>"; print_r($rows); echo "<pre>";
            foreach($rows as $row){
              $list=find("award_list",$row['reward']);
              // echo "<pre>"; print_r($list); echo "<pre>";
              $p=$row['period'];
              $index=$row['reward']-1;
              echo "<tr>";
              echo "  <td>".$row['year']."</td>";
              echo "  <td>".(2*$p-1)."、".(2*$p)."月</td>";
              echo "  <td>".$row['code'].$row['number']."</td>";
              echo "  <td>".$row['expend']."</td>";
              echo "  <td>".$award_type[$index]."</td>";
              echo "  <td>".$list['bonus']."</td>";
              echo "</tr>";
              $countBouns=$countBouns+$list['bonus'];
            }
        ?>
      </table>
      <?php
         echo "<p class='total'>共".$countNum."筆，".$countBouns."元</p>";
         }else{
          echo "<p class='tip'>這次沒有中獎!請再接再厲!</p>";
        }
      ?>
      
      <div class="btnBar">
        <a class="btn2" href="award.php">回對獎頁</a>
      </div>
    </div>
  </div>
</body>
</html>