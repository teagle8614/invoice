<!-- 對獎頁 -->
<?php
  include "./com/base.php";
  
  $aw=$_GET['aw'];
  $awardNum1=[];
  $awardNum2=[];

  for($i=9;$i>=1;$i--){
    if($i<=3){
      func_award($i);
    }
    // else{
    //   func_award($i);
    // }
    // func_award($i);
    // echo "awardNum1<br>";
    // echo "<pre>"; print_r($awardNum1); echo "<pre>";
    // echo "awardNum2<br>";
    // echo "<pre>"; print_r($awardNum2); echo "<pre>";
  }


  // if($aw==0){
  //   // 全部
  //   for($i=1;$i<=9;$i++){
  //     func_award($i);
  //   }
  // }else{
  //   // 分別對獎
  //   func_award($aw);
  // }




  

  
  

  function func_award($aw){
    global $awardNum1;
    global $awardNum2;

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
    // $award_type=[
    //   // 獎別,第幾獎,需對獎的碼數
    //   1=>["特別獎",1,8],
    //   2=>["特獎",2,8],
    //   3=>["增開六獎",4,3],
    //   4=>["頭獎",3,8],
    //   5=>["二獎",3,7],
    //   6=>["三獎",3,6],
    //   7=>["四獎",3,5],
    //   8=>["五獎",3,4],
    //   9=>["六獎",3,3]
    // ];

    $award_type=[
      // 獎別,第幾獎,需對獎的碼數
      1=>["特別獎",1,8],
      2=>["特獎",2,8],
      3=>["頭獎",3,8],
      4=>["二獎",3,7],
      5=>["三獎",3,6],
      6=>["四獎",3,5],
      7=>["五獎",3,4],
      8=>["六獎",3,3],
      9=>["增開六獎",4,3]
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
    $invoices=all("invoice",[
      "year"=>$_GET['year'],
      "period"=>$_GET['period']
    ]);





    if($aw<=3){
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
          }
          else{
            $target_num=$tn;
          }

          if(mb_substr($ins['number'],$start,$len) == $target_num){
            echo "<span style='color: red;font-size:20px;'>".$ins['number']."中獎了</span><br>";
            // $awardNum1=[[$aw,$ins['number']]];
            $awardNum1[]=[$aw,$ins['number']];
          }
          else{
            // echo $ins['number']."沒中獎<br>";
          }
        }
      }
    }
    else{
      foreach($invoices as $ins){
        foreach($t_num as $tn){

          $len=$award_type[$aw][2];
          $start=8-$len;
          $target_num=mb_substr($tn,$start,$len);
          

          if(mb_substr($ins['number'],$start,$len) == $target_num){
            echo "<span style='color: red;font-size:20px;'>".$ins['number']."中獎了</span><br>";
            $awardNum2[]=[$aw,$ins['number']];
          }
          else{
            // echo $ins['number']."沒中獎<br>";
            if($aw!=9){
              echo "<br>其他獎<br>";
              $awardNum2[]=[$aw,$ins['number']];
            }else{
              echo "<br>六獎<br>";
            }

          }
        }
      }
    }

    echo "<br>======================================<br>";

  }






  
  
  


  


  


  

?>