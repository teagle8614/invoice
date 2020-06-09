<?php
// 年份
$y=date("Y");
// 期別
$p=ceil(date("n")/2);


$cssScroll="auto";
if(isset($_GET['status'])){
  // css
  $tipDisplay="block";
  $boxDisplay="none";
}
if(isset($_GET['reset'])){
  // css
  if($_GET['reset']=="true"){
    $tipDisplay="block";
    $boxDisplay="none";
  }
  if($_GET['reset']=="ask"){
    $cssScroll="hidden";
  }

}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/index.css">
  <style>
    /* 重置視窗出現時則不可滾動 */
    body{
      overflow-y: <?=$cssScroll;?>;
    }

    .tipBox{
      display: <?=$tipDisplay;?>;
    }
    .invoiceBox{
      display: <?=$boxDisplay;?>;
    }
  </style>
</head>
<body>
  
  <div class="container">
    <?php 
      $pageheader="統一發票管理系統";
      $navPage="1";
      include "include/header.php"; 
    ?>

    <div div class="tipBox">
      <?php
        // 確認是否資料已存在
        if(isset($_GET['status'])){
          $y=$_GET['y'];
          $p=$_GET['p'];

          if($_GET['status']=="true"){
            echo "<h3 class='tip'>資料新增成功!</h3>";
            
          }else{
            echo "<h3 class='tip'>資料新增失敗!</h3>";
          }
          echo "<a class='btn2 btnGO' href='list.php?y=$y&p=$p'>發票列表</a>";
          echo "<a class='btn2' href='index.php'>繼續輸入</a>";
        }

        if(isset($_GET['reset']) && $_GET['reset']=="true"){
          echo "<h3 class='tip'>資料已重置完畢!</h3>";
          echo "<a class='btn2' href='index.php'>確定</a>";
        }


      ?>
    </div>


    <div class="invoiceBox">
      <h3>輸入發票資訊</h3>
      <form action="api/save_invoice.php" method="post">
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
            <td>獎號</td>
            <td>
              <div class="divNumber">
                <input type="text" name="code" placeholder="英文2碼" maxlength="2" required>
                <input type="number" name="number" placeholder="數字8碼" onkeyup="strlen(this,8);" required>
              </div>
            </td>
          </tr>
          <tr>
            <td>花費</td>
            <td><input type="number" name="expend" required></td>
          </tr>
        </table>
        <div class="btnBar">
          <input class="btn2" type="submit" value="儲存">
        </div>
      </form>

      <?php
          // 重置資料
          if(isset($_GET['reset']) && $_GET['reset']=="ask"){
            echo "<div class='overlay'></div>";
            echo "<div class='checkBox'>";
            echo "  <p>是否確定要重置?</p>";
            echo "  <p>重置後所有資料都會恢復成開發完成時的狀態</p>";
            echo "  <a class='btn2 btnOK' href='api/reset_db.php'>是</a>";
            echo "  <a class='btn2 btnClose' href='index.php'>否</a>";
            echo "</div>";
          }
        ?>
    </div>
  </div>



  <div class="resetBox">
    <div class="boxBtnDiv">
      <div class="boxBtn"></div>
    </div>
    <p>資料都被弄亂了嗎?</p>
    <p>點擊按鈕，就可以施展魔法將所有資料都重置為開發完成時的狀態唷ヽ(✿ﾟ▽ﾟ)ノ</p>
    <a href="index.php?reset=ask" class="btn2">施展魔法</a>
  </div>

  <script src="plugins/jquery-3.5.1.min.js"></script>
  <script src="js/js.js"></script>
</body>
</html>