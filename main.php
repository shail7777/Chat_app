<!DOCTYPE html>
<html>
<body>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<h2>Chat Application</h2>
<!--form to update the text of the user-->
<form action="" method="post">
Name: <input type="text" id="name" name= "n" autocomplete="off"></br>
Password: <input type="password" id="password" autocomplete="off"></br>
<textarea name="m" id="message1" rows="10" cols="30"></textarea></br>
<button type="button" class="button" onclick="send()">Send</button></br>
<p id="text"></p>
</form>

</br>
</br>
</br>

<!--form to receive the text of the person names-->
<form action="" method="post">
Name: <input type="text" id="receiver" name= "n" autocomplete="off"></br>
<textarea id="message" rows="10" cols="30"></textarea></br>
<button type="button" class="button" onclick="receive()">Listen</button></br>
</form>

<!-- The overlay -->
<div id="overlay" class="overlay">

<!-- Button to close the overlay navigation -->
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

<!-- Overlay content -->
<div class="overlay-content">
  <a id="display" href="#">Done</a>
</div>
</div>

<script>

<?php 
include_once('connection.php');
$query = "SELECT * FROM `Chat`";
$result = mysqli_query($conn, $query);
?>

var fname = [];
var pass = [];

<?php
while($rows = mysqli_fetch_assoc($result)){
	$db_first[] = $rows['Name'];
	$db_pass[] = $rows['Password'];
}
?>

var fname = <?php echo json_encode($db_first); ?>
<?php echo "\n"; ?>
var pass = <?php echo json_encode($db_pass); ?>
<?php echo "\n"; ?>


/* Open when someone clicks on the span element */
function openNav() {
  document.getElementById("overlay").style.width = "100%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("overlay").style.width = "0%";
}


function Verification(){
var fn = document.getElementById('name').value;
var ps = document.getElementById('password').value;


for(var i = 0; i < fname.length; i++){
	if(fname[i] == fn && pass[i] == ps){
		return true;
	}
  return false;
  }
}

/*send function is used to send a sql query to the database
and update the record of what user enters.*/
function send() {
  var name = document.getElementById("name").value;          //get the name
  var message = document.getElementById("message1").value;    //get the message which we have to send
  var pass = document.getElementById('password').value;
  //Checking if the fields are filled or not
  if(name.length == 0 || message.length == 0 || pass.length == 0){
    document.getElementById("display").innerHTML = "Please fill out name, password and message";
    openNav();
    return;
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
      document.getElementById("display").innerHTML = this.responseText;
      openNav();
      console.log(this.responseText);
    }
  };
  if(Verification()){
    xhttp.open("GET", "send.php?n=" + name+","+message , true);
    xhttp.send();
  }
  else{
    document.getElementById("display").innerHTML = "Wrong combination";
    openNav();
    return;
  }
}

/*Receive function makes a sql query and find the message of the name 
that user has typed in*/
function receive() {
  var name = document.getElementById("receiver").value;          //get the name
  //Checking if the fields are filled or not
  if(name.length == 0){
    document.getElementById("display").innerHTML = "Please fill the name";
    openNav();
    return;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("message").innerHTML = this.responseText;
    console.log(this.responseText);
    }
  /*else{
    document.getElementById("display").innerHTML = "Error";
    openNav();
    console.log("Error in the SQL statement");
    }*/
  };
  xhttp.open("GET", "receive.php?n=" + name , true);
  xhttp.send();
}
</script>

</body>
</html>