<!-- 建立假資料 -->
<?php
  include "./com/base.php";

  // 增加的筆數
  $num=5;
  // 字母的陣列
  // 將範圍縮小會比較好中獎，所以不將全部字母打入
  $char=["A","B","C","E","G","H","M","P","S","T","X","Y","Z"];
  for($i=0;$i<$num;$i++){
    // 亂數產生字母，重複兩次拼成兩個字母
    $code=$char[rand(0,12)].$char[rand(0,12)];

    // 利用亂數產生資料
    $data=[
      'period' => rand(1,6),
      'year' => rand(2019,2020),
      'code' => $code,
      'number' => rand(10000000,77777777), // 將範圍縮小比較好中獎
      'expend' => rand(10,2000)
    ];
    echo "已新增".$data["code"] . $data['number']."<br>";

    save("invoice",$data);
  }

?>