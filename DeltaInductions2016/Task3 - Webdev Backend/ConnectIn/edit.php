<!DOCTYPE html>
<html>
  <head>
    <link href='edit.css' rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet' type='text/css'>
    <title>Edit Details
    </title>
  </head>
  <body>
    <?php
session_start();
$flag=0;
$myusername = "";
$servername = "localhost";$username = "root";
$password = "";
$database = "deltabook";
$fname=$lname=$uname=$email=$passwrd=$phoneno="";
$fnameErr = $lnameErr = $dobErr = $usernameErr = $emailErr= $passErr = $phnoErr = $imgErr= "" ;
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
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
function test($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["phno"])) {
$phnoErr = "Phone Number is required";
$flag=1;  
} else {
$phoneno = test($_POST["phno"]);
if (strlen((string)$phoneno)!=10) {
$phnoErr = "Only 10 digit numbers are allowed"; 
$flag=1;
}
}
if (empty($_POST["fname"])) {
$fnameErr = "First Name is required";
$flag=1;  
} else {
$fname = test($_POST["fname"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
$fnameErr = "Only letters and white space allowed"; 
$flag=1;
}
}
if (empty($_POST["lname"])) {
$lnameErr = "Last Name is required";
$flag=1;  
} else {
$lname = test($_POST["lname"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
$lnameErr = "Only letters and white space allowed"; 
$flag=1;
}
}
if (empty($_POST["email"])) {
$emailErr = "Email is required";
$flag=1;
} else {
$email = test($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format"; 
$flag=1;
}
}
if($emailErr==""){
$email = test($_POST["email"]);
if($email != $row['email'] )
{
$email = test($_POST["email"]);
$sqlemail = "SELECT * FROM userdetails WHERE email = '$email'";
$resultemail = mysqli_query($conn,$sqlemail);
$checkemail = mysqli_num_rows($resultemail);
if($checkemail>0){
$emailErr = "E-mail already registered";   
$flag=1;
}
}
}
if($flag==0){
$fname = test($_POST["fname"]);
$lname = test($_POST["lname"]);
$email = test($_POST["email"]);
$phoneno = test($_POST["phno"]);
$sqlfname = "UPDATE userdetails SET firstName ='$fname' WHERE username='$usrnme'";
$sqllname = "UPDATE userdetails SET lastName ='$lname' WHERE username='$usrnme'";
$sqlemail = "UPDATE userdetails SET email ='$email' WHERE username='$usrnme'";
$sqlphoneno = "UPDATE userdetails SET phone ='$phoneno' WHERE username='$usrnme'";
if ( $conn->query($sqlfname) === TRUE && $conn->query($sqllname) === TRUE && $conn->query($sqlemail) === TRUE && $conn->query($sqlphoneno) === TRUE) {
echo "New record created successfully";
header('Location: user.php');
}  
}
}
?>
  </body>
  <div id="titleblock">
    <a href="user.php">ConnectIn
    </a>
    <a id="button1" href="logout.php">Logout
    </a>
    <a id="button2" href="edit.php">Edit
    </a>
  </div>
  <div id="formblock">
    <span style="font-weight:bold;font-size:30px;">Username : 
      <?php echo $row['username']; ?>
    </span>
    <br>
    <br>
    <div align:center>
      <img id="propic" src="<?php echo $propic?>" alt="Profile Picture" height="200" width="200">
    </div>
    <br>
    <br>
    <form method="POST" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
      First Name
      <br>
      <span class="error">
        <?php echo $fnameErr;?>
      </span>
      <br>
      <input type="text" required value="<?php echo $row['firstName'] ?>" placeholder="First Name" name="fname" class="input">
      <br>
      <br>
      Last Name
      <br>
      <span class="error">
        <?php echo $lnameErr;?>
      </span>
      <br>
      <input type="text" required value="<?php echo $row['lastName'] ?>" placeholder="Last Name" name="lname" class="input">
      <br>
      <br>
      E-mail
      <br>
      <span class="error">
        <?php echo $emailErr;?>
      </span>
      <br>
      <input type="email" required value="<?php echo $row['email']; ?>" placeholder="E-mail" name="email" class="input">
      <br>
      <br>
      Phone Number
      <br>
      <span class="error">
        <?php echo $phnoErr;?>
      </span>
      <br>
      <input type="text" required value="<?php echo $row['phone']; ?>" placeholder="Phone Number" name="phno" class="input">
      <br>
      <br>
      <button style="font-size: 30px;background-color: crimson;color: white;padding: 10px;border: none;" type="submit" name="submit">Update
      </button>
    </form>
  </div>
</html>
