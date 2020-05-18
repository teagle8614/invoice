<?php
// 年份
$y=date("Y");
// 期別
$p=ceil(date("n")/2);
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/invoice.css">
</head>
<body>
  <div div class="container">
    <?php 
      $pageheader="輸入獎號頁";
      $navPage="4";
      include "./include/header.php"; 
    ?>

    <!-- 
      開獎時間
      1、2月    3/25  13:30
      3、4月    5/25  13:30
      5、6月    7/25  13:30
      7、8月    9/25  13:30
      9、10月   11/25 13:30
      11、12月  1/25  13:30
     -->

    <div class="invoiceBox">
      <h3>輸入中獎號碼資訊</h3>
      <form action="save_invoice.php" method="post">
        <table>
          <tr>
            <td>年份</td>
            <td>
              <select name="year" onchange="location=this.value;">
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
            <td>獎項</td>
            <td>
              <select name="item">
                <option value="1">特別獎</option>
                <option value="2">特獎</option>
                <option value="3">頭獎</option>
                <option value="4">增開六獎</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>獎號</td>
            <td>
              <input type="number" name="number" maxlength="8" required>
            </td>
          </tr>
        </table>
        <div class="btnBar">
          <input type="submit" value="儲存">
        </div>
      </form>
    </div>
  </div>
</body>
</html>