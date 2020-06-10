<!-- 修改獎號 -->
<?php
  include "../com/base.php";
  $id=$_POST['id'];
  $year=$_POST['year'];
  $period=$_POST['period'];
  $number=$_POST['number'];
  $y=$_POST['y'];
  $p=$_POST['p'];


  $table="award_number";
  $data=[
    "id" => $id,
    "period" => $period,
    "year" => $year,
    "number" => $number
  ];
  $res=save($table,$data);


  if($res>0){
    // 修改成功
    to("../query.php?edit=true&y=$y&p=$p");
  }else{
    // 修改失敗
    to("../query.php?edit=false&y=$y&p=$p");
  }

?>