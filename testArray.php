<?php

$a[]=[10,20,30];
echo "<pre>"; print_r($a); echo "<pre>";
echo "<hr>";
$b=[10,20,30];
echo "<pre>"; print_r($b); echo "<pre>";
echo "<hr>";
$c[]=10;
$c[]=20;
$c[]=30;
echo "<pre>"; print_r($c); echo "<pre>";
echo "<hr>";
$d=[
  1=>10,
  2=>20,
  3=>30,
  "1"=>10,
  "2"=>20,
  "3"=>30,
  "4"=>40
];
echo "<pre>"; print_r($d); echo "<pre>";
echo "<hr>";
$e=[[20,30],[30,40]];
echo "<pre>"; print_r($e); echo "<pre>";
echo "<hr>";
$f[]=[1=>10];
$f[]=[2=>20];
$f[]=[3=>30];
echo "<pre>"; print_r($f); echo "<pre>";
echo "<hr>";
$g=[3=>30];
$g=[2=>20];
$g=[1=>10];
echo "<pre>"; print_r($g); echo "<pre>";
echo "<hr>";
$h[]=[1,10];
$h[]=[2,20];
$h[]=[3,30];
echo "<pre>"; print_r($h); echo "<pre>";
echo "<hr>";
$j[]=[
  "a" => "111",
  "b" => "222"
];
$j[]=[
  "a" => "333",
  "b" => "444"
];
echo "j:<br>";
echo "<pre>"; print_r($j); echo "<pre>";
echo "<hr>";

if(in_array("111",$j)){
  echo "找到<br>";
} else{
  echo "沒找到<br>";
}
echo "<hr>";
// foreach($j as $x){
//   echo $x["b"]."<br>";
//   if(in_array("111",$x)){
//     echo "找到<br>";
//   } else{
//     echo "沒找到<br>";
//   }
// }

$i=$h;
echo "i:<br>";
echo "<pre>"; print_r($i); echo "<pre>";
echo "<hr>";

echo "<br>-------------------<br>";
$a =  array('aaa1','bbb','ddd','aaa','ppp');
$b =  array('aaa','rrr','ddd','aaa','bbb','aaa1','qqq','www');

$c =  array_diff( $a,  $b);
print_r( $c);
echo $c[4]."<br>";
foreach($c as $n){
  echo "c1:".$n."<br>";
}
$c =  array_diff( $b,  $a);
print_r( $c);
foreach($c as $n){
  echo "c1:".$n."<br>";
}
echo "<hr>";



$k1=[
  ["a" => "aaa","b" => "111"],
  ["a" => "bbb","b" => "222"],
  ["a" => "ccc","b" => "333"]
];
$k2=[
  ["a" => "aaa","b" => "111"],
  ["a" => "bbb1","b" => "222"],
  ["a" => "ccc1","b" => "3333"]
];
echo "k:<br>";
echo "<pre>"; print_r($k1); echo "<pre>";
echo "<pre>"; print_r($k2); echo "<pre>";
// $k =  array_diff($k1, $k2);
foreach($k1 as $kkk1){
  foreach($k2 as $kkk2){
    // echo "kkk1<br>";
    // echo "<pre>"; print_r($kkk1); echo "<pre>";
    // echo "kkk2<br>";
    // echo "<pre>"; print_r($kkk2); echo "<pre>";
    $k =  array_diff($kkk1, $kkk2);
    echo "<pre>"; print_r($k); echo "<pre>";
    echo "<br>-------------------<br>";
  }
}
echo "<pre>"; print_r($k); echo "<pre>";
?>