<!-- 刪除該期全部獎號 -->
<?php
  include "../com/base.php";
  $id=$_POST['id'];
  $y=$_POST['y'];
  $p=$_POST['p'];

  $table="award_number";
  $data=[
    'year' =>$y,
    'period' => $p
  ];
  $res=del($table,$data);

  if($res>0){
    // echo "刪除成功";
    to("../query.php?del=true&y=$y&p=$p");
  }else{
    // echo "刪除失敗";
    to("../query.php?del=false&y=$y&p=$p");
  }
?>