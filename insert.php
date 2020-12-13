<?php
 include_once('connection.php');
 
 $fname = $_GET['getfname'];
 
 if (!$conn) {die("Connection failed: " . mysqli_connect_error());} 
 
 $sql = "SELECT `Text` FROM `Chat` WHERE `Name`=$fname";
 //$result =  mysqli_query($conn, $sql);
 
 if(mysqli_query($conn, $sql)){
   $data = mysqli_query($conn, $sql);
   print $data;
  }
  else{
    print "Problem in SQL Statement";
    }
 
 ?>