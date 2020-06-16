//the function takes array and finds the minimum and the maximum sums of n-1 element
//then prints them in the console

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
