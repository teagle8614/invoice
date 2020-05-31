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

// $num1=find('award_number',['period'=>$p,'year'=>$y,'type'=>1]);
// $num2=find('award_number',['period'=>$p,'year'=>$y,'type'=>2]);
// $num3=all('award_number',['period'=>$p,'year'=>$y,'type'=>3]);
// $num4=all('award_number',['period'=>$p,'year'=>$y,'type'=>4]);

$type=[
  1 => "特別獎",
  2 => "特獎",
  3 => "頭獎",
  4 => "加開四獎"
];

function func_award($num){
  global $y;
  global $p;
  switch($num){
    case 1:
      // 特別獎
      $rows=all('award_number',['period'=>$p,'year'=>$y,'type'=>1]);
      break;
    case 2:
      // 特獎
      $rows=all('award_number',['period'=>$p,'year'=>$y,'type'=>2]);
      break;
    case 3:
      // 頭獎
      $rows=all('award_number',['period'=>$p,'year'=>$y,'type'=>3]);
      break;
    case 4:
      // 加開四獎
      $rows=all('award_number',['period'=>$p,'year'=>$y,'type'=>4]);
  }
  
  return $rows;
}


// 編輯狀態
$id="";
$cssDisplay="inline-block";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $cssDisplay="none";
}
// 全部刪除
$status="";
if(isset($_GET['status'])){
  $status=$_GET['status'];
}

// 讀取表格資料
// if($p==0){
//   // 搜尋該年度全部資料
//   $rows=all("award_number",['year'=>$y]);
// }else{
//   // 搜尋該年度當期資料
//   $rows=all("award_number",['year'=>$y,"period"=>$p]);
// }

?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/query.css">
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
     $pageheader="查詢獎號";
     $navPage="5";
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
              echo "<option value='query.php?y=$i&p=$p' ".$selected.">".$i."</option>";
            }
          ?>
        </select>
        <ul>
          <li><a class="<?=($p==1)?'active':'';?>" href="query.php?y=<?=$y;?>&p=1">1,2月</a></li>
          <li><a class="<?=($p==2)?'active':'';?>" href="query.php?y=<?=$y;?>&p=2">3,4月</a></li>
          <li><a class="<?=($p==3)?'active':'';?>" href="query.php?y=<?=$y;?>&p=3">5,6月</a></li>
          <li><a class="<?=($p==4)?'active':'';?>" href="query.php?y=<?=$y;?>&p=4">7,8月</a></li>
          <li><a class="<?=($p==5)?'active':'';?>" href="query.php?y=<?=$y;?>&p=5">9,10月</a></li>
          <li><a class="<?=($p==6)?'active':'';?>" href="query.php?y=<?=$y;?>&p=6">11,12月</a></li>
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
        </div>


        <form action="update_award.php" method="post">
          <table>
            <tr>
              <td>年份</td>
              <td>期別</td>
              <td>獎項</td>
              <td>獎號</td>
              <td></td>
            </tr>
            <?php
              for($x=1;$x<=4;$x++){
                $rows=func_award($x);
                // echo "<pre>"; print_r($rows); echo "</pre>";
                // echo "----------<br>";
                

                foreach($rows as $row){
                  if($row['id']==$id){
                    // 編輯
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
                    echo "  <td>".$type[$x]."</td>";
                    echo "  <td>";
                    echo "    <input type='number' name='number' placeholder='數字8碼' maxlength='8' value='".$row['number']."' required>";
                    echo "    <input type='hidden' name='id' value='".$row['id']."'>";
                    echo "    <input type='hidden' name='y' value='$y'>";
                    echo "    <input type='hidden' name='p' value='$p'>";
                    echo "  </td>";
                    echo "  <td>";
                    echo "    <input class='btn btnSave' type='submit' value='儲存'>";
                    echo "    <a class='btn btnCancel' href='query.php?y=$y&p=$p'>取消</a>";
                    echo "  </td>";
                    echo "</tr>";
                  }
                  else{
                    // 顯示
                    echo "<tr class='item".$row['id']."'>";
                    echo "  <td>".$row['year'] ."</td>";
                    echo "  <td>".($row['period']*2-1).",".($row['period']*2)."月</td>";
                    echo "  <td>".$type[$x]."</td>";
                    echo "  <td>".$row['number'] ."</td>";
                    echo "  <td>";
                    echo "    <a class='btn btnEdit' href='query.php?y=$y&p=$p&id=".$row['id']."'>編輯</a>";
                    echo "  </td>";
                    echo "</tr>";

                  }
                }
              } 
            ?>
          </table>
          <?php
            $table="award_number";
            $data=[
              'year' => $y,
              'period' => $p
            ];
            $count=nums($table,$data);

            // 沒有獎號則不顯示刪除按鈕
            if($count>0){
              echo "<div class='btnBar'>";
              echo "  <a class='btn2 btnDelAll' href='query.php?y=$y&p=$p&status=del'>全部刪除</a>";
              echo "</div>";
            }else{
              echo "<p class='tip'>尚無資料!</p>";
            }
          ?>
        </form>
            

        <?php
          // 刪除的提示視窗
          if($status=="del"){
            echo "<div class='overlay'></div>";
            echo "<div class='checkBox'>";
            echo "  <form action='del_query.php' method='post'>";
            echo "    <p>確認刪除該期的全部獎號?</p>";
            echo "    <input type='hidden' name='y' value='$y'>";
            echo "    <input type='hidden' name='p' value='$p'>";
            echo "    <input class='btn2 btnOK' type='submit' value='是'>";
            echo "    <a class='btn2 btnClose' href='query.php?y=$y&p=$p'>否</a>";
            echo "  </form>";
            echo "</div>";
          }
        ?>

      </div>

    </div>
  </div>
</body>
</html>