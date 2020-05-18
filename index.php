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
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
  
  
  <div class="container">

    <?php 
      $pageheader="統一發票管理系統";
      $navPage="1";
      include "./include/header.php"; 
    ?>

    <div class="invoiceBox">
      <h3>輸入發票資訊</h3>
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
            <td>獎號</td>
            <td>
              <div class="divNumber">
                <input type="text" name="code" placeholder="英文2碼" maxlength="2" required>
                <input type="number" name="number" placeholder="數字8碼" maxlength="8" required>
              </div>
            </td>
          </tr>
          <tr>
            <td>花費</td>
            <td><input type="number" name="expend" required></td>
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