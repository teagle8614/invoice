<!-- 修改獎號 -->
<?php
  include "../com/base.php";
  $id=$_POST['id'];
  $year=$_POST['year'];
  $period=$_POST['period'];
  $number=$_POST['number'];
  $y=$_POST['y'];
  $p=$_POST['p'];

  // echo "period=".$period."<br>";
  // echo "year=".$year."<br>";
  // echo "number=".$number."<br>";


  $table="award_number";
  $data=[
    "id" => $id,
    "period" => $period,
    "year" => $year,
    "number" => $number
  ];
  $res=save($table,$data);



  // $sql="update `invoice` set `period`='".$_POST['period']."', `year`='".$_POST['year']."', `code`='".strtoupper($_POST['code'])."', `number`='".$_POST['number']."', `expend`='".$_POST['expend']."' where `id`='".$_POST['id']."'";
  // $res=$pdo->exec($sql);

  // $id
  // $rows=find($table,$id);

  if($res>0){
    // echo "修改成功";
    to("../query.php?edit=true&y=$y&p=$p");
  }else{
    // echo "修改失敗";
    to("../query.php?edit=false&y=$y&p=$p");
  }

?>