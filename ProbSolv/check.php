/*      implode()   Returns a string from the elements of an array
 *      explode()   Returns an array from the string inputt
 * Complete the timeConversion function below.
 */
function timeConversion($s) {
    $exploded= explode(":",$s);
    if(strcspn(exploded,"P")!=0){
        echo 
        date("H:i:s",mktime(exploded[0],exploded[2],str_replace("PM","",exploded[3]),
        0,0,0));
    }else{
        echo
        date("h:i:s",mktime(exploded[0],exploded[2],str_replace("AM","",exploded[3]),
        0,0,0));
    }
}
