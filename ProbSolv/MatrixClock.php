<!DOCTYPE html>
<html>
<body>

<?php
//$arr[$row][$col]
$arr = array (
  array(80,81,82,83,84),
  array(10,11,12,13,14),
  array(20,21,22,23,24),
  array(30,31,32,33,34)
);
function outSteps($arr){
	for ($row = 0; $row < count($arr); $row++) {
		for ($col = 0; $col < count($arr[0]); $col++) {
			echo $arr[$row][$col]. " ";
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
	$i= 0, $j= 0; 
	$col= count($arr[0]);
	$row= count($arr);
	do{
		if(($i>=0 and $j==$col) or 
			($i==$row and $j==0) or
			($i==$row and $j==$col)){
				if($i==$row and $j==$col){
					j--;
				}elseif($i>$j){
					$i--;
				}else{
					$i++;
				}
		}else{
			j++;
		}
	}while($i==0 and $j==0);
}
?>

</body>
</html>
