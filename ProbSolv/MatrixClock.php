<!DOCTYPE html>
<html>
<body>

<?php
//$arr[$row][$col]
$arr = array (
  array("48", "51", "54", "57", "60", "03"),
  array("45", "23", "24", "13", "14", "06"),
  array("42", "22", "60", "15", "15", "09"),
  array("39", "21", "45", "30", "16", "12"),
  array("36", "20", "19", "18", "17", "15"),
  array("33", "30", "27", "24", "21", "18")
);
function outSteps($arr){
	for ($row = 0; $row < count($arr); $row++) {
		for ($col = 0; $col < count($arr[0]); $col++) {
			echo "|".$arr[$row][$col]. "|";
		}
	echo "<br>";
	}
	echo "<br>";
}    
function LayerOneType_byArrays($arr){
	for ($row = 0; $row < count($arr); $row++) {
		for ($col = 0; $col < count($arr[0]); $col++) {
			if($row==0 or $col==count($arr[0])-1){ 
				$arr[$row][$col]=77;
			}elseif($col==0 or $row==count($arr)-1){
				$arr[$row][$col]=99;
			}else{
				continue;
			}
			outSteps($arr);
		}
	}
}
function LayerOneType_Clock($arr){
	$temp=0;
	$i= 0;
	$j= 0; 
    echo "I= ".$i. " J= ". $j. "<br>";
    
	$row= count($arr)-1;
    echo "rows: ".$row. "<br>";
	$col= count($arr[0])-1;
    echo "cols: ".$col. "<br>";
    if($j!=$col){
    	//echo true;
    }else{
    	//echo false;
    }
	while($j!=$col){
    	$temp=$arr[$i][$j];
        $arr[$i][$j]=$arr[$i][$j+1];
        $arr[$i][$j+1]=$temp;
        
    	echo "I= ".$i. " J= ". $j. "<br>";
    	//$arr[$i][$j]=99;
        $j++;
	}
    while($j==$col and $i!=$row){
    	$temp=$arr[$i][$j];
        $arr[$i][$j]=$arr[$i+1][$j];
        $arr[$i+1][$j]=$temp;
    
    	echo "I= ".$i. " J= ". $j. "<br>";
    	//$arr[$i][$j]=99;
        $i++;
    }
    while($j>0){
    	$temp=$arr[$i][$j];
        $arr[$i][$j]=$arr[$i][$j-1];
        $arr[$i][$j-1]=$temp;
        
        echo "I= ".$i. " J= ". $j. "<br>";
        //$arr[$i][$j]=99;
        $j--;
    }
    while($i>0){
    	if($i!=1){
        	$temp=$arr[$i][$j];
        	$arr[$i][$j]=$arr[$i-1][$j];
        	$arr[$i-1][$j]=$temp;
        }
        echo "I= ".$i. " J= ". $j. "<br>";
        //$arr[$i][$j]=99;
        $i--;
    }
    echo "I= ".$i. " J= ". $j. "<br>";
    outSteps($arr);
}
LayerOneType_Clock($arr);
?>

</body>
</html>
