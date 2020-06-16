// the function makes a staircase from a value input

function staircase($n) {
    for($i=$n; $i>0; $i--){

        for($j=$i; $j>1; $j--){
            echo " ";
        }

        for($z=0; $z<($n-$i+1); $z++){
            echo "#";
            
        }
        echo "\n";
    }
}
