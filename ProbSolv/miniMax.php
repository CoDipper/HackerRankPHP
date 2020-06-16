function miniMaxSum($arr) {

    $sum= array_sum($arr);

    $max=$sum-$arr[0];
    $min=$sum-$arr[0];

    foreach($arr as $x){
        if($min>$sum-$x){
            $min=$sum-$x;
        }elseif($max<$sum-$x){
            $max=$sum-$x;
        }
    }
    
    echo $min." ".$max;
}
