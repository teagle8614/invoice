<!-- 對獎頁 -->
<?php
  include "./com/base.php";
  
  $aw=$_GET['aw'];
  $arrayPrev=[]; //前一個獎項的中獎號碼
  $arrayNext=[]; //當前獎項的中獎號碼
  $array=[];
 
  /**
   * 將頭獎~六獎分開處理
   * 得到六獎才可能得到五獎、四獎、三獎...
   * 只將前一次中獎的號碼拿去與後面的獎項做比對
   * 就可以不用將所有的號碼都重新比對一次
   */

  for($i=8;$i>=3;$i--){
    func_award($i);
  }
  

  
  

  function func_award($aw){
    echo "AAAAA:".$aw."<br>";
    global $arrayPrev; //多
    global $arrayNext; //少
    global $array;
    $awardNum1=[];
    echo "arrayPrevaaaa<br>";
    echo "<pre>"; print_r($arrayPrev); echo "<pre>";
    echo "arrayNextaaa<br>";
    echo "<pre>"; print_r($arrayNext); echo "<pre>";
    echo "arrayaaa<br>";
    echo "<pre>"; print_r($array); echo "<pre>";
    echo "<hr>";
    // 將當前獎項的中獎號碼改為前一個獎項的中獎號碼
    $arrayPrev=$arrayNext;
    // 將當前獎項的中獎號碼陣列清空
    $arrayNext=[];
    echo "arrayPrevaaaa<br>";
    echo "<pre>"; print_r($arrayPrev); echo "<pre>";
    echo "arrayNextaaa<br>";
    echo "<pre>"; print_r($arrayNext); echo "<pre>";
    echo "arrayaaa<br>";
    echo "<pre>"; print_r($array); echo "<pre>";

    // $award_type=[
    //   // 獎別,第幾獎,需對獎的碼數
    //   1=>["特別獎",1,8],
    //   2=>["特獎",2,8],
    //   3=>["頭獎",3,8],
    //   4=>["二獎",3,7],
    //   5=>["三獎",3,6],
    //   6=>["四獎",3,5],
    //   7=>["五獎",3,4],
    //   8=>["六獎",3,3],
    //   9=>["增開六獎",4,3]
    // ];
    $award_type=[
      // 獎別,第幾獎,需對獎的碼數
      3=>["頭獎",3,8],
      4=>["二獎",3,7],
      5=>["三獎",3,6],
      6=>["四獎",3,5],
      7=>["五獎",3,4],
      8=>["六獎",3,3]
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
    $invoices=all("invoice",[
      "year"=>$_GET['year'],
      "period"=>$_GET['period']
    ]);

    // echo "<br>-----------------------------------------------------------------<br>";
    // echo "invoices<br>";
    // echo "<pre>"; print_r($invoices); echo "<pre>";
    // echo "<br>-----------------------------------------------------------------<br>";
    // $temp="";
    foreach($invoices as $ins){
      foreach($t_num as $tn){

        $len=$award_type[$aw][2];
        $start=8-$len;
        $target_num=mb_substr($tn,$start,$len);
        

        if(mb_substr($ins['number'],$start,$len) == $target_num){
          echo "<span style='color: red;font-size:20px;'>".$ins['number']."中獎了</span><br>";

          // 將中獎的元素存入$arrayNext內
          $arrayNext[]=$ins['number'];
        }

      }
    }


    // 將兩個陣列做比對，$temp會為arrayPrev裡多的元素，也就等同於前一次的獎別
    $temp=array_diff($arrayPrev,$arrayNext);

    // 舊(prev) 比 新(next) ->多的加入array
    // 新的變舊的 prev=next
    // 將新的清空 next=[]
    // 新的變為新的陣列 再與舊的相比


    // 將$temp的元素存入$array中，並將獎別一同存入
    foreach($temp as $t){
      echo "t:".$t."<br>";
      $array[]=[
        "type" => $aw+1,
        "number" => $t
      ];
    }


    echo "arrayPrev<br>";
    echo "<pre>"; print_r($arrayPrev); echo "<pre>";
    echo "arrayNext<br>";
    echo "<pre>"; print_r($arrayNext); echo "<pre>";
    echo "array<br>";
    echo "<pre>"; print_r($array); echo "<pre>";
    echo "<br>======================================<br>";

  }

  

?>