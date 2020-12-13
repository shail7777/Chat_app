<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chat</title>
    <link rel="stylesheet" href="style.css" media="all" />
    
</head>

<body>
     <h1>Chat</h1>
	 
	 <div class="row">
	 <div class="column" style="background-color:skyblue;">
   
   <form action="" method="post">
	 <p><b>Name:</b> <input type="text" autocomplete="off" name="fname" id="f"></p>			
   <p><b>Password:</b> <input type="password" autocomplete="off" name="pass" id="password"></p>
   <textarea name="send" autocomplete="off" id="send" placeholder="Enter Message"></textarea>
   <input type="submit" id="submit" value="Submit"><br>
   <p id = "updated"></p>
   </form>
   
	 </div>
	 <br>
	 <div class="column" style="background-color:lightgreen;">
   
	 <form action="" method="get">
	 <p><b>Name:</b> <input type="text" autocomplete="off" name="getfname" id="getfirst">     <input type="submit" id="insert" value="Listen"><br>		
   <textarea id="chat"></textarea>
   </form>
   
	 </div>
	 </div>
    
<script>
function Validation(){
    
  if(!document.getElementById('f').value){
    alert('Name is empty');
    return false;
  }

  if(!document.getElementById('password').value){
    alert('Password is empty');
    return false;
  }

  if(!document.getElementById('send').value){
    alert('Text area is empty');
    return false;
  }
    
return true;
}

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


function Verification(){
var fn = document.getElementById('f').value;
var ps = document.getElementById('password').value;


for(var i = 0; i < fname.length; i++){
	if(fname[i] == fn && pass[i] == ps){
		return true;
	}
  return false;
  }
}

document.getElementById("insert").onclick = function() {insert()};
function insert(){
  var getfname = document.getElementById("getfirst").value;
   var req = new XMLHttpRequest();
   req.onreadystatechange = function(){
     if (req.readyState == 4 && status == 200) {
       var response = req.responseText;
       if (response){
         document.getElementById("chat").innerHTML = response.data;
        } 
      }
      else {
        alert('NULL');
        //document.getElementById("chat").innerHTML = NULL;
      }
    }
    req.open('GET','insert.php?fname=' + getfname, true);
    req.send(null);  
}
     
document.getElementById("submit").onclick = function() {upd()};
function upd(){
  if(Validation()){
    if(Verification()){
      var first = document.getElementById("f").value;
      var text = document.getElementById("send").value;
      var req = new XMLHttpRequest();
      //req.onreadystatechange = function(){
      if(req.onreadystatechange){
        if (req.readyState == 4 && status == 200) {
          document.getElementById('updated').innerHTML = 'Done';
        }
        else {
          alert('There was a problem with the request.');
        }
           
        req.open('POST','update.php',true);
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        req.send('fname=' + encodeURIComponent(first), 'text=' + encodeURIComponent(text));  
      }
      else{ alert('NOt ready'); } 
    }
    else{
      alert("Inncorect inforamtion");
      }
  }
}
     
    
</script>

</body>
</html>