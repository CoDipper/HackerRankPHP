//the function takes two arrays in which there is information about points for every round between two people- a and b;
//then compares the points in every round so it can count the rounds won for each one of them

function compareTriplets($a, $b) {
    $arr= array(0,0);
    foreach(array_combine($a, $b) as $a=>$b){
        if($a<$b){
            $arr[1]++;
        }elseif($a>$b){
            $arr[0]++;
        }else{
            continue;
        }
    }
    return $arr;
}
