function plusMinus($arr) {
    $newArr= array(0.000000,0.000000,0.000000);
    $possCount=0;
    $negaCount=0;
    $zeroCount=0;

    $sizeCount= sizeof($arr);
    foreach($arr as $x){
        if($x>0){
            $possCount++;
        }elseif($x<0){
            $negaCount++;
        }elseif($x==0){
            $zeroCount++;
        }
    }
    echo $possCount/$sizeCount. "\n";
    echo $negaCount/$sizeCount. "\n";
    echo $zeroCount/$sizeCount. "\n";
}
