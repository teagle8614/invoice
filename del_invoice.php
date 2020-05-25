<!-- 刪除發票 -->
<?php
  include "./com/base.php";
  $id=$_POST['id'];
  $y=$_POST['y'];
  $p=$_POST['p'];

  $table="invoice";
  $res=del($table,$id);

  if($res>0){
    echo "刪除成功";
    header("location:list.php?y=$y&p=$p");
  }else{
    echo "刪除失敗";
  }
?>