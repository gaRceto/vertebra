<?php
@session_start();
$gen0 = rand(1,6);
$gen1 = rand(0,9);
$gen2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZzyxwvutsrqponmlkjihgfedcba";
$gen3 = "zyxwvutsrqponmlkjihgfedcbaABCDEFGHIJKLMNOPQRSTUVWXYZ";
$gen4 = "ABCDEFGHNOPQRSTUVWXYZabcdefghijklmstuvwxyzijklmnopqr";
for ($x=0; $x < 8; $x++) {
  $gen2[$x] = substr($gen2, mt_rand(0, strlen($gen2)-1), 1);
  $gen3[$x] = substr($gen3, mt_rand(0, strlen($gen3)-1), 1);
  $gen4[$x] = substr($gen4, mt_rand(0, strlen($gen4)-1), 1);
  $gen5[$x] = substr($gen3, mt_rand(0, strlen($gen3)-1), 1);
  $gen6[$x] = substr($gen2, mt_rand(0, strlen($gen2)-1), 1);
}
switch ($gen0){
  case '1';
    $_SESSION['willi'] = $gen1 .$gen2[0] .$gen3[0] .$gen4[0] .$gen5[0] .$gen6[0];
  break;
  case '2';
    $_SESSION['willi'] = $gen2[0] .$gen1 .$gen3[0] .$gen4[0] .$gen5[0] .$gen6[0];
  break;
  case '3';
    $_SESSION['willi'] = $gen3[0] .$gen2[0] .$gen1 .$gen4[0] .$gen5[0] .$gen6[0];
  break; 
  case '4';
    $_SESSION['willi'] = $gen4[0] .$gen3[0] .$gen2[0] .$gen1 .$gen5[0] .$gen6[0];
  break;
  case '5';
    $_SESSION['willi'] = $gen5[0] .$gen4[0] .$gen3[0] .$gen2[0] .$gen1 .$gen6[0];
  break;
  case '6';
    $_SESSION['willi'] = $gen6[0] .$gen5[0] .$gen4[0] .$gen3[0] .$gen2[0] .$gen1;
  break;
}
// echo $_SESSION['willi'];
?>