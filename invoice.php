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
      include "include/header.php"; 
    ?>

    <div class="tipBox">
       <?php
        if(isset($_GET['check']) && $_GET['check']=="true"){
          $y=$_GET['y'];
          $p=$_GET['p'];

          echo "<h3 class='tip'>該期獎號已存在！</h3>";
          echo "<p class='tip'>請善用修改或是刪除的功能</p>";
          echo "<p class='tip'>若輸入的個數有誤，請全部刪除後再重新輸入</p>";
          echo "<a class='btn2 btnGO' href='query.php?y=$y&p=$p'>前往獎號列表</a>";
          echo "<a class='btn2' href='invoice.php'>重新輸入</a>";
        }

        // 確認是否資料已存在
        if(isset($_GET['status'])){
          if($_GET['status']=="true"){
            echo "<h3 class='tip'>資料新增成功!</h3>";
          }else{
            echo "<h3 class='tip'>資料部分有誤!</h3>";
          }
          echo "<a class='btn2 btnGO' href='query.php?y=$y&p=$p'>前往獎號列表</a>";
          echo "<a class='btn2' href='invoice.php'>繼續輸入</a>";
        }
       ?>
      
    </div>


    <div class="invoiceBox"> 
      <h3>輸入中獎號碼資訊</h3>
      <form action="api/save_number.php" method="post">
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
              <input type="number" name="num1" placeholder="數字8碼" onkeyup="strlen(this,8);" required>
            </td>
          </tr>
          <tr>
            <td>特獎</td>
            <td>
              <input type="number" name="num2" placeholder="數字8碼" onkeyup="strlen(this,8);" required>
            </td>
          </tr>
          <tr>
            <td>頭獎</td>
            <td>
              <input type="number" name="num3[]" placeholder="數字8碼" onkeyup="strlen(this,8);" required>
              <input type="number" name="num3[]" placeholder="數字8碼" onkeyup="strlen(this,8);">
              <input type="number" name="num3[]" placeholder="數字8碼" onkeyup="strlen(this,8);">
              <input type="number" name="num3[]" placeholder="數字8碼" onkeyup="strlen(this,8);">
            </td>
          </tr>
          <tr>
            <td>增開六獎</td>
            <td>
              <input type="number" name="num4[]" placeholder="數字3碼" onkeyup="strlen(this,3);" required>
              <input type="number" name="num4[]" placeholder="數字3碼" onkeyup="strlen(this,3);">
              <input type="number" name="num4[]" placeholder="數字3碼" onkeyup="strlen(this,3);">
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

  <script src="plugins/jquery-3.5.1.min.js"></script>
  <script src="js/js.js"></script>
</body>
</html>