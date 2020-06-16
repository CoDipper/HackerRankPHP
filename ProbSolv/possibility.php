//the function takes an array of negative and possitive numbers as like: 
// inPUT array:     -30, 2, -5, -3, 8, 0, 25, 0;
// counts the possitive, negative and the zeros in different variables
// so it can calculate the possibility of extracting each of them in a single try

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
