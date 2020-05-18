<?php
$id=$_GET['id'];
include "./com/base.php";
$sql="select * from `invoice` where `id`='$id'";
$item=$pdo->query($sql)->fetch();



?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
  
  
  <div class="container">

    <?php 
      $pageheader="統一發票管理系統";
      include "./include/header.php"; 
    ?>

    <div class="invoiceBox">
      <h3>test編輯</h3>
      <form action="update_invoice.php" method="post">
        <table>
          <tr>
            <td>期別</td>
            <td>
              <select name="period">
                <?php
                  for($i=1;$i<=6;$i++){
                    if($item['period']==$i){
                      echo "<option value='".$i."' selected>".(2*$i-1)."、".(2*$i)."月</option>";
                    }
                    else{
                      echo "<option value='".$i."'>".(2*$i-1)."、".(2*$i)."月</option>";
                    }
                  }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>年份</td>
            <td>
              <select name="year">
              <?php
                  // 改為資料庫所含資料的最小年份?
                  $yToday = date("Y");
                  $y1=$yToday-5;
                  for($i=$y1;$i<=$yToday;$i++){
                    if($item['year']==$i){
                      echo "<option value='".$i."' selected>".$i."</option>";
                    }
                    else{
                      echo "<option value='".$i."'>".$i."</option>";
                    }
                  }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>獎號</td>
            <td>
              <div class="divNumber">
                <input type="text" name="code" placeholder="英文碼" maxlength="2" value="<?=$item['code'];?>">
                <input type="number" name="number" placeholder="數字" maxlength="8" value="<?=$item['number'];?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>花費</td>
            <td><input type="number" name="expend" value="<?=$item['expend'];?>"></td>
          </tr>
        </table>
        <input type="hidden" name="id" value="<?=$id;?>">
        <div class="btnBar">
          <input type="submit" value="儲存">
        </div>
      </form>
    </div>

  </div>
</body>
</html>