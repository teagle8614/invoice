<?php
include "./com/base.php";


// 年份、期別搜尋
$y=date("Y");
if(isset($_GET['y'])){
  $y=$_GET['y'];
}
// 月份/2 為期數
$p=ceil(date("n")/2);
if(isset($_GET['p'])){
  $p=$_GET['p'];
}

// 讀取表格資料
if($p==0){
  // 搜尋該年度全部資料
  
  // $sql="select * from `invoice` where `year`='$y' order by `period`,`id` ASC";
  // $sqlCount="select count(*) from `invoice` where `year`='$y'";
  $rows=all("invoice",['year'=>$y]," order by `period`,`id` ASC");
  $dbCount=nums("invoice",['year'=>$y]);
}else{
  // 搜尋該年度當期資料
  // $sql="select * from `invoice` where `year`='$y' && `period`='$p' order by `period`,`id` ASC";
  // $sqlCount="select count(*) from `invoice` where `year`='$y' && `period`='$p'";
  $rows=all("invoice",['year'=>$y,"period"=>$p]," order by `period`,`id` ASC");
  $dbCount=nums("invoice",['year'=>$y,"period"=>$p]);
}
// echo $sql;
// $rows=$pdo->query($sql)->fetchAll();
// $dbCount=$pdo->query($sqlCount)->fetch();
// echo $dbCount[0];

// 編輯狀態
$id="";
$cssDisplay="inline-block";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $cssDisplay="none";

  $sql2="select * from `invoice` where `id`='$id'";
  echo $sql2."<br>";
  $item=$pdo->query($sql2)->fetch();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/list.css">
  <style>
    /* 當有項目在編輯時，將其他編輯按鈕隱藏 */
    a.btnEdit{
      display: <?=$cssDisplay;?>;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php 
      $pageheader="發票列表";
      $navPage="2";
      include "./include/header.php"; 
    ?>

    <div class="invoiceBox">

      <div class="sideNav">
        <select name="year" onchange="location=this.value;">
          <?php
            $yToday = date("Y");
            $y1=$yToday-4;
            for($i=$y1;$i<=$yToday;$i++){
              $selected=($y==$i)?'selected':'';
              echo "<option value='list.php?y=$i&p=$p' ".$selected.">".$i."</option>";
            }
          ?>
        </select>
        <ul>
          <li><a class="<?=($p==0)?'active':'';?>" href="list.php?y=<?=$y;?>&p=0">全部</a></li>
          <li><a class="<?=($p==1)?'active':'';?>" href="list.php?y=<?=$y;?>&p=1">1,2月</a></li>
          <li><a class="<?=($p==2)?'active':'';?>" href="list.php?y=<?=$y;?>&p=2">3,4月</a></li>
          <li><a class="<?=($p==3)?'active':'';?>" href="list.php?y=<?=$y;?>&p=3">5,6月</a></li>
          <li><a class="<?=($p==4)?'active':'';?>" href="list.php?y=<?=$y;?>&p=4">7,8月</a></li>
          <li><a class="<?=($p==5)?'active':'';?>" href="list.php?y=<?=$y;?>&p=5">9,10月</a></li>
          <li><a class="<?=($p==6)?'active':'';?>" href="list.php?y=<?=$y;?>&p=6">11,12月</a></li>
        </ul>
      </div>

      <div class="listBox">
        <div class="topBar">
          <?php
            if($p==0){
              echo "<h3>".$y."年- All</h3>";
            }else{
              echo "<h3>".$y."年-".($p*2-1).",".($p*2)."月</h3>";
            }
          ?>
          
          <p>共有<?php echo $dbCount;?>筆</p>
        </div>

        <form action="update_invoice.php" method="post">
          <table>
            <tr>
              <td>年份</td>
              <td>期別</td>
              <td>獎號</td>
              <td>花費</td>
              <td></td>
            </tr>
            <?php
              foreach($rows as $row){
                if($row['id']==$id){

                  echo "<tr class='item".$row['id']." itemEdit'>";
                  echo "  <td>";
                  echo "    <select name='year'>";
                              for($i=$y1;$i<=$yToday;$i++){
                                $selected=($y==$i)?'selected':'';
                                echo "<option value='$i' ".$selected.">".$i."</option>";
                              }
                  echo "    </select>";
                  echo "  </td>";
                  echo "  <td>";
                  echo "    <select name='period'>";
                              for($i=1;$i<=6;$i++){
                                $selected=($p==$i)?'selected':'';
                                echo "<option value='$i' ".$selected.">".(2*$i-1)."、".(2*$i)."月</option>";
                              }
                  echo "    </select>";
                  echo "  </td>";
                  echo "  <td>";
                  echo "    <div class='divNumber'>";
                  echo "      <input type='text' name='code' placeholder='英文2碼' maxlength='2' value='".$item['code']."' required>";
                  echo "      <input type='number' name='number' placeholder='數字8碼' maxlength='8' value='".$item['number']."' required>";
                  echo "    </div>";
                  echo "  </td>";
                  echo "  <td>";
                  echo "    <input type='number' name='expend' value='".$item['expend']."' required>";
                  echo "    <input type='hidden' name='id' value='".$item['id']."'>";
                  echo "    <input type='hidden' name='y' value='$y'>";
                  echo "    <input type='hidden' name='p' value='$p'>";
                  echo "  </td>";
                  echo "  <td>";
                  echo "    <input class='btn btnSave' type='submit' value='儲存'>";
                  echo "    <a class='btn btnCancel' href='list.php?y=$y&p=$p'>取消</a>";
                  echo "  </td>";
                  echo "</tr>";

                }else{
                  echo "<tr class='item".$row['id']."'>";
                  echo "  <td>".$row['year'] ."</td>";
                  echo "  <td>".($row['period']*2-1).",".($row['period']*2)."月</td>";
                  echo "  <td>".$row['code'].$row['number']."</td>";
                  echo "  <td>".$row['expend'] ."</td>";
                  echo "  <td>";
                  // echo "    <a class='btn' href='edit_test.php?id=".$row['id']."'>編輯</a>";
                  echo "    <a class='btn btnEdit' href='list.php?y=$y&p=$p&id=".$row['id']."'>編輯</a>";
                  echo "  </td>";
                  echo "</tr>";
                }
              }
            ?>
          </table>
        </form>

        <div class="pageNav">
          <ul>
            <li><a href="#"><</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a class="active" href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">></a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</body>
</html>