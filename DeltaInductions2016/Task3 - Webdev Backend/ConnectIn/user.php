<!DOCTYPE html>
<html>
  <head>
    <link href='user.css' rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet' type='text/css'>
    <title>HOME | ConnectIn
    </title>
  </head>
  <body>
    <?php
session_start();
$myusername = "";
$servername = "localhost";$username = "root";
$password = "";
$database = "deltabook";
echo $password;
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
if($_SERVER["REQUEST_METHOD"] == "POST") {
$myusername = mysqli_real_escape_string($conn,$_POST['usrname']);
$mypassword = md5(mysqli_real_escape_string($conn,$_POST['pwd']));
$sql = "SELECT * FROM userdetails WHERE username = '$myusername' and password = '$mypassword'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
if($count==1){
$_SESSION['logstatus'] = true;
$_SESSION['usrname']   = $myusername; 
}
}
if(isset($_SESSION['logstatus']) && $_SESSION['logstatus'] == true){
$usrnme = $_SESSION['usrname'];
$sqluser = "SELECT * FROM userdetails WHERE username = '$usrnme'";
$resultuser = mysqli_query($conn,$sqluser);
$row = mysqli_fetch_array($resultuser,MYSQLI_ASSOC);
$propic = $row['propic'];
}
else
{
$_SESSION['errMsg'] = "Invalid username or password";
header('Location: signinpage.php');
}
?>
    <div id="titleblock">
      <a href="user.php">ConnectIn
      </a>
      <a id="button3" href="user.php">
        <?php echo $usrnme ?>
      </a>
      <a id="button1" href="logout.php">Logout
      </a>
      <a id="button2" href="edit.php">Edit
      </a>
    </div>
    <div id="details">
      <div align:center>
        <img id="propic" src="<?php echo $propic?>" alt="Profile Picture" height="300" width="300">
      </div>
      <br>
      <br>
      <span>First Name : 
        <?php echo $row['firstName']; ?>
      </span>
      <br>
      <br>
      <span>Last Name : 
        <?php echo $row['lastName']; ?>
      </span>
      <br>
      <br>
      <span>Username : 
        <?php echo $row['username']; ?>
      </span>
      <br>
      <br>
      <span>E-mail : 
        <?php echo $row['email']; ?>
      </span>
      <br>
      <br>
      <span>Phone number : 
        <?php echo $row['phone']; ?>
      </span>
    </div>
  </body>
</html>
