<?php
 include_once('connection.php');

 $n = $_GET['n'];

 if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
   } 
      
 $sql = "SELECT `Text` FROM `Chat` WHERE `Name`='$n'";
 $result =  mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 $data = $row['Text'];
 
 echo $data;
 /*if (mysqli_query($conn, $sql)) {
   echo "Worked";
   } 
 else{ 
   echo 'Error in the name'; 
   }*/
 ?>