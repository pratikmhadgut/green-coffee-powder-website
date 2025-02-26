<?php

$db_name = 'mysql:host=localhost;dbname=green_cofee';
$db_user = 'root';
$db_password = '';

$conn = new PDO($db_name,$db_user,$db_password);
if($conn){
    
}
function unique_id(){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strLen($chars);
    $randomString = '';
    for ($i=0; $i < 50 ; $i++){
        $randomString.=$chars[mt_rand(0, $charLength -1)];
    }
    return $randomString;
}
?>