<!-- 刪除發票 -->
<?php
  include "../com/base.php";
  $id=$_POST['id'];
  $y=$_POST['y'];
  $p=$_POST['p'];

  $table="invoice";
  $res=del($table,$id);

  if($res>0){
    // 刪除成功
    to("../list.php?del=true&y=$y&p=$p");
  }else{
    // 刪除失敗
    to("../list.php?del=false&y=$y&p=$p");
  }
?>