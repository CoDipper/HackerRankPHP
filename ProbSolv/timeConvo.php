
//the function returns the value of 00-23H:MM:SS if the input string faces the conditions of HH:MM:SSPM or HH:MM:SSAM
//the meaning is to format the value from 01-12H to 00-23H
<?php
function timeConversion($s) {
    $exploded= explode(":",$s);
    if(strrpos($exploded[2],"P")!=0){
		if(!strcmp($exploded[0], "12")){
        	$time=mktime($exploded[0], $exploded[1], str_replace("PM","",$exploded[2]), 0, 0, 0);
        }else{
        	$time=mktime($exploded[0]+12, $exploded[1], str_replace("PM","",$exploded[2]), 0, 0, 0);
        }
        return date("H:i:s", $time);

    }else{
    	if(!strcmp($exploded[0], "12"))$exploded[0]="00";
        $time=mktime($exploded[0], $exploded[1], str_replace("AM","",$exploded[2]), 0, 0, 0);
        return date("H:i:s", $time);
    }
}
echo timeConversion("12:45:54PM");
?>

//simpler alternative
<?php
function timeConversion($s) {
    return date("H:i:s", strtotime($s));
}
echo timeConversion("01:23:20PM");
?>
