function diagonalDifference($arr) {
    $primeD=0;
    $seconD=0;
    for($i=0; $i<sizeof($arr);$i++){
        for($j=0; $j<sizeof($arr);$j++){
            if($i==$j){
                $primeD+=$arr[$i][$j];
            }
            if($i+$j==sizeof($arr)-1){
                $seconD+=$arr[$i][$j];
            }
        }
    }
    return abs($primeD-$seconD);
}
