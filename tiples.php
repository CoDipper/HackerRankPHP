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
