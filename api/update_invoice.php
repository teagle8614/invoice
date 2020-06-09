<!-- 修改發票 -->
<?php
  include "../com/base.php";
  $id=$_POST['id'];
  $period=$_POST['period'];
  $year=$_POST['year'];
  $code=$_POST['code'];
  $number=$_POST['number'];
  $expend=$_POST['expend'];
  $y=$_POST['y'];
  $p=$_POST['p'];

  // echo "period=".$period."<br>";
  // echo "year=".$year."<br>";
  // echo "code=".$code."<br>";
  // echo "number=".$number."<br>";
  // echo "expend=".$expend."<br>";
  
  $table="invoice";
  $data=[
    "id" => $id,
    "period" => $period,
    "year" => $year,
    "code" => strtoupper($code),
    "number" => $number,
    "expend" => $expend 
  ];
  $res=save($table,$data);

  


  // $sql="update `invoice` set `period`='".$_POST['period']."', `year`='".$_POST['year']."', `code`='".strtoupper($_POST['code'])."', `number`='".$_POST['number']."', `expend`='".$_POST['expend']."' where `id`='".$_POST['id']."'";
  // $res=$pdo->exec($sql);

  if($res>0){
    // echo "修改成功";
    to("../list.php?edit=true&y=$y&p=$p");
  }else{
    // echo "修改失敗";
    to("../list.php?edit=false&y=$y&p=$p");
  }

?>