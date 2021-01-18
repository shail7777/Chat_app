<?php
 include_once('connection.php');
 
 $temp = $_GET['n'];
 $arr = explode(",", $temp);
 $n = $arr[0];
 $m = $arr[1];
 

 if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
   } 
     
 $sql = "UPDATE `Chat` SET `Text`='$m' WHERE Name = '$n'"; 
 
 if (mysqli_query($conn, $sql)) {
   echo 'Done';
   } 
 else{ 
   echo 'cant update'; 
   }
 ?>