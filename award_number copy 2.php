<!-- 對獎頁 -->
<?php
  ob_start();
  include "./com/base.php";
  
  $aw=$_GET['aw'];

  $award=[]; //存放所有獎號
  $arrayPrev=[]; //前一個獎項的中獎號碼
  $arrayNext=[]; //當前獎項的中獎號碼
  $arrayAward=[]; //存放頭獎~六獎的獎號


  for($i=1;$i<=4;$i++){
    if($i<=3){
      func_award($i);
    }else{
      /**
       * 將頭獎~六獎分開處理
       * 得到六獎才可能得到五獎、四獎、三獎...
       * 只將前一次中獎的號碼拿去與後面的獎項做比對
       * 就可以不用將所有的號碼都重新比對一次
       */
      for($j=9;$j>=4;$j--){
        func_award($j);
      }
    }
  }

  // 將所有的獎號併入$award中
  if(!empty($arrayAward)){
    foreach($arrayAward as $a){
      $award[]=[
        "type" => $a['type'],
        "number" => $a['number']
      ];
    }
  }

  echo "<br>----------------------------------------------<br>";
  echo "award<br>";
  echo "<pre>"; print_r($award); echo "<pre>";
  echo "<br>----------------------------------------------<br>";
  
  
  $serialized_array = serialize($award);
  to("award_list.php?y=".$_GET['year']."&p=".$_GET['period']."&list=$serialized_array");





  

  function func_award($aw){
    global $award;
    global $arrayPrev;
    global $arrayNext;
    global $arrayAward;

    /**
     * 前一個獎號陣列(arrayPrev) 比 現在的獎號陣列(arrayNext) -> 多的加入arrayAward
     * 將現在的改為前一個陣列 prev=next
     * 將現在的清空 next=[]
     * 新的變為現在的獎號陣列 再與前一個獎號陣列相比
     */
    // 將當前獎項的中獎號碼改為前一個獎項的中獎號碼
    $arrayPrev=$arrayNext;
    // 將當前獎項的中獎號碼陣列清空
    $arrayNext=[];


    $award_type=[
      // 獎別,第幾獎,需對獎的碼數
      1=>["特別獎",1,8],
      2=>["特獎",2,8],
      3=>["增開六獎",4,3],
      4=>["頭獎",3,8],
      5=>["二獎",3,7],
      6=>["三獎",3,6],
      7=>["四獎",3,5],
      8=>["五獎",3,4],
      9=>["六獎",3,3],
     
    ];

    echo "獎別：".$award_type[$aw][0]."<br>";
    echo "年份：".$_GET['year']."<br>";
    echo "期別：".$_GET['period']."<br>";
    echo "對獎的碼數：".$award_type[$aw][2]."<br>";

    // 獎號數量
    $award_nums=nums("award_number",[
      "year"=>$_GET['year'],
      "period"=>$_GET['period'],
      "type"=>$award_type[$aw][1],
    ]);
    echo "獎號數量：".$award_nums;
    echo "<br>-------------------------------<br>";
    

    echo "<h5>對獎獎號</h5>";
    $award_number=all("award_number",[
      "year"=>$_GET['year'],
      "period"=>$_GET['period'],
      "type"=>$award_type[$aw][1],
    ]);
    
    $t_num=[];
    foreach($award_number as $num){
      echo $num['number']."<br>";
      // 將獎號放入陣列
      $t_num[]=$num['number'];
    }


    echo "<h5>該期發票號碼</h5>";
    //抓出符合當期的發票號碼
    // 特殊獎、特獎、增開六獎、六獎
    if($aw<=3 || $aw==9){
      $invoices=all("invoice",[
        "year"=>$_GET['year'],
        "period"=>$_GET['period']
      ]);
    }else{
      // 頭獎~五獎 將前個中獎的獎號放入陣列中
      if(!empty($arrayPrev)){
        foreach($arrayPrev as $a){
          $invoices[]=[
            "number" => $a
          ];
        }
      }
    }


    // 比對兩個陣列的資料
    foreach($invoices as $ins){

      foreach($t_num as $tn){

        // 從後面算取幾位數
        $len=$award_type[$aw][2];
        // 起始值
        $start=8-$len;
        // 針對"增開六獎"特別處理substr的開始位置
        if($aw!=3){
          $target_num=mb_substr($tn,$start,$len);
          // echo "target=".$target_num.",tn=".$tn.",start=".$start.",len=".$len."<br>";
        }
        else{
          $target_num=$tn;
        }



        if(mb_substr($ins['number'],$start,$len) == $target_num){
          echo "<span style='color: red;font-size:20px;'>".$ins['number']."中獎了</span><br>";
          if($aw>=4){
            // 將中獎的元素存入$arrayNext內
            $arrayNext[]=$ins['number'];
          }else{
            // 將中獎的號碼與獎別一同存入$award
            $award[]=[
              "type" => $aw,
              "number" => $ins['number']
            ];
          }
        }else{
          // echo $target_num.",".$ins['number']."沒中獎<br>";
        }
      }
    }


    if($aw>=4){
      // 將兩個陣列做比對，$temp會為arrayPrev裡多的元素，也就等同於前一次的獎別
      $temp=array_diff($arrayPrev,$arrayNext);


      // 將$temp的元素存入$array中，並將獎別一同存入
      foreach($temp as $t){
        // echo "t:".$t."<br>";
        $arrayAward[]=[
          "type" => $aw+1,
          "number" => $t
        ];
      }

      // 若有頭獎時，則將頭獎的獎號也放入array中
      if($aw==4 && !empty($arrayNext)){
        foreach($arrayNext as $n){
          // echo "n:".$n."<br>";
          $arrayAward[]=[
            "type" => 4,
            "number" => $n
          ];
        }
      }
    }


    echo "award<br>";
    echo "<pre>"; print_r($award); echo "<pre>";
    echo "arrayPrev<br>";
    echo "<pre>"; print_r($arrayPrev); echo "<pre>";
    echo "arrayNext<br>";
    echo "<pre>"; print_r($arrayNext); echo "<pre>";
    echo "arrayAward<br>";
    echo "<pre>"; print_r($arrayAward); echo "<pre>";
    echo "<br>======================================<br>";
  }
  ob_end_flush();
?>

