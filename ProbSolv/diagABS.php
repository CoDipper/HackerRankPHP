//the function takes the primary diagonal and the secondary diagonal of a matrix
//then returns the difference between them as like : return abs($primeD-$seconD);
//where $primeD is primary diag and $seconD is secondary diagonal

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
