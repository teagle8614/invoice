<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");

// 因為安全性的關係，不建議將session_start()寫於此，盡量需要用時再寫即可
// session_start();


// 查詢單筆資料
function find($table,$arg){
  global $pdo;
  $sql="select * from `$table` ";

  if(is_array($arg)){
    $tmp=[];
    foreach($arg as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql." where ". implode(" && ", $tmp);
  }else{
    $sql=$sql." where `id`='$arg'";
  }

  // echo $sql."<br>";
  $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

  // 若出來的資料為空值，則為傳錯誤訊息
  if(empty($row)){
    return "無符合資料的內容";
  }
  return $row;
}

// 查詢全部資料
function all($table,...$arg){
  global $pdo;
  $sql="select * from $table ";

  if(isset($arg[0]) && is_array($arg[0])){
    // $tmp="";
    $tmp=[];
    // 將陣列組合成字串
    foreach($arg[0] as $key => $value){
      // 最後會多一個 && 導致錯誤
      // $tmp=$tmp."`".$key."`='".$value."'" . " && ";

      // sprintf() 函式可以將格式化的字符元素
      // 第一個 %s被$key取代，第二個 %s被$value取代
      // %後方加的值不同，會有不同格式 ex: %s:字串、%%:百分比、
      $tmp[]=sprintf("`%s`='%s'",$key,$value);

    }
    // implode() 可以將Array 的陣列元素組合成一個新的字串，也可用join()
    $sql=$sql." where ". implode(" && ", $tmp);
  }

  if(isset($arg[1])){
    $sql=$sql . $arg[1];
  }

  // echo $sql."<br><br>";
  return $pdo->query($sql)->fetchAll();
}

// 新增+修改
function save($table,$arg){
  global $pdo;

  if(isset($arg['id'])){
    // update
    foreach($arg as $key => $value){
      // 在修改資料時，當作where條件的資料，基本上不可以更動
      // 所以將id去除
      // echo "test:".$arg."-".$key."-".$value."<br>";
      echo "key=".$key." ,value=".$value."<br>";

      if($key!='id'){
        $tmp[]=sprintf("`%s`='%s'",$key,$value);
      }
    }
    $sql="update $table set " .implode(',',$tmp). " where `id`='".$arg['id']."' ";
  }else{

    // insert
    $sql="insert into $table (`".implode("`,`",array_keys($arg)). "`) values('".implode("','",$arg)."')";
  }

  echo $sql."<br>";
  return $pdo->exec($sql);
}

// 刪除資料
function del($table,$arg){
  global $pdo;
  $sql="delete from $table ";

  // 根據目前的資料庫需求(若結構不同需要修改)
  // (1)若$arg是陣列->組合條件字串
  // (2)若$arg不是陣列->為id
  // (1)其實可包含(2)，但只是將較常用的功能獨立出來寫
  if(is_array($arg)){
    $tmp=[];
    foreach($arg as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql." where ". implode(" && ", $tmp);
  }else{
    $sql=$sql." where `id`='$arg'";
  }

  // echo $sql."<br>";
  // 不需要回傳值，只會回傳成功或失敗，所以用exec()
  // exec():回傳影響到的行數，若失敗也會回傳0
  return $pdo->exec($sql);
}


// 計算筆數
function nums($table,...$arg){
  global $pdo;
  $sql="select count(*) from $table ";

  if(isset($arg[0]) && is_array($arg[0])){

    $tmp=[];
    foreach($arg[0] as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql." where ". implode(" && ", $tmp);
  }

  if(isset($arg[1])){
    $sql=$sql . $arg[1];
  }

  // echo $sql."<br>";

  // fetchColumn 出來會是一個數字，而不是陣列，所以可以直接印出
  // fetch為一維陣列$total[]
  // fetchAll為二維陣列$total[][]
  return $pdo->query($sql)->fetchColumn();
}

// 導出頁面
function to($url){
  header("location:".$url);
}

// 萬用查詢
function q($sql){
  global $pdo;
  return $pdo->query($sql)->fetchAll();
}


?>