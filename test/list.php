<?php
include "com/base.php";

$period=1;
if(isset($_GET['period'])){
  $period=$_GET['period'];
}

// $sql="select * from invoice where `period`='$period'";
// $rows=$pdo->query($sql)->fetchAll();
$rows=all('invoice',['period'=>$period]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/list.css">
</head>
<body>

  <?php 
    include "./include/header.php"; 
  ?>

<h1>發票列表</h1>

<ul class="nav">
  <li><a href="list.php?period=1" style="background:<?=($period==1)?'lightgreen':'white';?>">1(1,2)</a></li>
  <li><a href="list.php?period=2" style="background:<?=($period==2)?'lightgreen':'white';?>">2(3,4)</a></li>
  <li><a href="list.php?period=3" style="background:<?=($period==3)?'lightgreen':'white';?>">3(5,6)</a></li>
  <li><a href="list.php?period=4" style="background:<?=($period==4)?'lightgreen':'white';?>">4(7,8)</a></li>
  <li><a href="list.php?period=5" style="background:<?=($period==5)?'lightgreen':'white';?>">5(9,10)</a></li>
  <li><a href="list.php?period=6" style="background:<?=($period==6)?'lightgreen':'white';?>">6(11,12)</a></li>
</ul>
  
  <table>
    <tr>
      <td>編號</td>
      <td>標記</td>
      <td>號碼</td>
      <td>花費</td>
    </tr>
    <?php
      foreach($rows as $row){
        echo "<tr>";
        echo "  <td>".$row['id'] ."</td>";
        echo "  <td>".$row['period'] ."</td>";
        echo "  <td>".$row['code'].$row['number']."</td>";
        echo "  <td>".$row['expend'] ."</td>";
        echo "</tr>";
      }
    ?>
    
  </table>
</body>
</html>