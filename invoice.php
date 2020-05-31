<?php
// 年份
$y=date("Y");
// 期別
$p=ceil(date("n")/2);

if(isset($_GET['status']) || isset($_GET['check'])){
  // css
  $tipDisplay="block";
  $boxDisplay="none";
}

?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/invoice.css">

  <style>
    .tipBox{
      display: <?=$tipDisplay;?>;
    }
    .invoiceBox{
      display: <?=$boxDisplay;?>;
    }
  </style>
</head>
<body>
  <div div class="container">
    <?php 
      $pageheader="新增獎號";
      $navPage="4";
      include "./include/header.php"; 
    ?>

    <div class="tipBox">
       <?php
        if(isset($_GET['check']) && $_GET['check']=="true"){
          $y=$_GET['y'];
          $p=$_GET['p'];

          echo "<h3 class='tip'>該期獎號已存在！</h3>";
          echo "<p class='tip'>請善用修改或是刪除的功能</p>";
          echo "<a class='btn2 btnGO' href='query.php?y=$y&p=$p'>前往查詢獎號頁</a>";
          echo "<a class='btn2' href='invoice.php'>重新輸入</a>";
        }

        // 確認是否資料已存在
        if(isset($_GET['status'])){
          if($_GET['status']=="true"){
            echo "<h3 class='tip'>資料新增成功!</h3>";
          }else{
            echo "<h3 class='tip'>資料部分有誤!</h3>";
          }
          echo "<a class='btn2' href='invoice.php'>繼續輸入</a>";
        }
       ?>
      
    </div>


    <div class="invoiceBox"> 
      <h3>輸入中獎號碼資訊</h3>
      <form action="save_number.php" method="post">
        <table>
          <tr>
            <td>年份</td>
            <td>
              <select name="year">
                <?php
                  $yToday = date("Y");
                  $y1=$yToday-4;
                  for($i=$y1;$i<=$yToday;$i++){
                    $selected=($y==$i)?'selected':'';
                    echo "<option value='$i' ".$selected.">".$i."</option>";
                  }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>期別</td>
            <td>
              <select name="period">
                <?php
                  for($i=1;$i<=6;$i++){
                    $selected=($p==$i)?'selected':'';
                    echo "<option value='$i' ".$selected.">".(2*$i-1)."、".(2*$i)."月</option>";
                  }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>特別獎</td>
            <td>
              <input type="number" name="num1" maxlength="8" required>
            </td>
          </tr>
          <tr>
            <td>特獎</td>
            <td>
              <input type="number" name="num2" maxlength="8" required>
            </td>
          </tr>
          <tr>
            <td>頭獎</td>
            <td>
              <input type="number" name="num3[]" maxlength="8" required>
              <input type="number" name="num3[]" maxlength="8">
              <input type="number" name="num3[]" maxlength="8">
              <input type="number" name="num3[]" maxlength="8">
            </td>
          </tr>
          <tr>
            <td>增開六獎</td>
            <td>
              <input type="number" name="num4[]" maxlength="3" required>
              <input type="number" name="num4[]" maxlength="3">
              <input type="number" name="num4[]" maxlength="3">
            </td>
          </tr>
        </table>
        <div class="btnBar">
          <input class="btn2" type="submit" value="儲存">
          <input class="btn2" type="reset" value="重置">
        </div>
      </form>
    </div>
  </div>
</body>
</html>