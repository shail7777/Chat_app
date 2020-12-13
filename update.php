<?php
        include_once('connection.php');
        $fname = $_POST['fname'];
        $text = $_POST['text'];
        if (!$conn) {die("Connection failed: " . mysqli_connect_error());} 
        $sql = "UPDATE `Chat` SET `Text`='$text' WHERE Name = '$fname'"; 
        
        if (mysqli_query($conn, $sql)) {
        echo 'Done';
        } 
        else{ echo 'cant update'; }
?>