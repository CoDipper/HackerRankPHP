//the function returns the value of blown candles
//as it is said that John have blown only the tallest ones
//in other words- the most high values 

// example:
//  inPut array      3 2 4 2 3 4 4
//  outPut           3

// as there are 3 of hight 4 candles.

function birthdayCakeCandles($arr) {    
    rsort($arr);         
    $max=$arr[0];
    $count=0;
    foreach($arr as $x){
        if($max!=$x){
            break;
        }else{
            $count++;
        }
    }
    return $count;
}
