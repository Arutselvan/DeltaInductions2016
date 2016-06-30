<!DOCTYPE html>
<html>
  <head>
    <title>ConnectIn
    </title>
    <link href='index.css' rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <?php
session_start();
if(isset($_SESSION['logstatus']) && $_SESSION['logstatus'] == true){
header('Location: user.php');
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "deltabook";
$connErr = "";
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
$connErr="Unable to connect to server";
} 
$connErr="Connected Successfully";
$flag=0;
$fname=$lname=$uname=$email=$passwrd=$phoneno="";
$fnameErr = $lnameErr = $dobErr = $usernameErr = $emailErr= $passErr = $phnoErr = $imgErr= "" ;
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
//validates phone number for its length of 10 digits
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
//validates the email for correct format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format"; 
$flag=1;
}
}
if (empty($_POST["uname"])) {
$usernameErr = "Username is required";
$flag=1;
} else {
$uname = test($_POST["uname"]);
$sqluname = "SELECT * FROM userdetails WHERE username = '$uname'";
$resultuname = mysqli_query($conn,$sqluname);
$checkuname = mysqli_num_rows($resultuname);
if($checkuname>0){
$usernameErr = "Username already in use";
$flag=1;
}
}
if($emailErr==""){
$email = test($_POST["email"]);
$sqlemail = "SELECT * FROM userdetails WHERE email = '$email'";
$resultemail = mysqli_query($conn,$sqlemail);
$checkemail = mysqli_num_rows($resultemail);
if($checkemail>0){
$emailErr = "E-mail already registered";   
$flag=1;
}
}
if(isset($_FILES['image'])){
$imgname = $_FILES['image']['name'];
$imgsize =$_FILES['image']['size'];
$imgtmp =$_FILES['image']['tmp_name'];
$imgtype=$_FILES['image']['type'];
$ext = pathinfo($imgname, PATHINFO_EXTENSION);
$extensions= array("jpeg","jpg","png");
if(in_array($ext,$extensions)=== false){
$imgErr="Extension not allowed, please choose a JPEG or PNG file or Check if the file size exceeds 2MB";
$flag=1;
}
}
else{
$flag=1;
}
if($flag!=1){
$fname = test($_POST["fname"]);
$lname = test($_POST["lname"]);
$uname = test($_POST["uname"]);
$email = test($_POST["email"]);
$passwrd = md5(test($_POST["pass"]));
$phoneno = test($_POST["phno"]);
move_uploaded_file($imgtmp,"propics/".$uname.".".$ext);
$sql = "INSERT INTO userdetails (firstName, lastName, email, username,phone, password,propic)
VALUES ('$fname','$lname','$email','$uname','$phoneno','$passwrd','propics/$uname.$ext')";
if ($conn->query($sql) === TRUE) {
$_SESSION['errMsg'] = "Registered Sucessfully";
header('Location: signinpage.php');
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
}
}
?>
    <div id="titleblock">
      <a href="index.php" >ConnectIn
      </a> 
      <a style="float:right;font-size:20px;background-color:blue;padding:10px;color:white;margin-right:10px;" href="signinpage.php">Log In
      </a>
    </div>
    <div id="formblock">
      <br>
      <br>
      <span id="signup" style="background-color:white;border: 1px solid crimson;padding:10px; width:60%;color:crimson;margin-top:2%;">Sign Up here
      </span>
      <br>
      <br>
      <br>
      <form method="POST" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        First Name
        <br>
        <span class="error">
          <?php echo $fnameErr;?>
        </span>
        <br>
        <input type="text" required value="<?php echo $fname ?>" placeholder="First Name" name="fname" class="input">
        <br>
        <br>
        Last Name
        <br>
        <span class="error">
          <?php echo $lnameErr;?>
        </span>
        <br>
        <input type="text" required value="<?php echo $lname ?>" placeholder="Last Name" name="lname" class="input">
        <br>
        <br>
        Username
        <br>
        <span class="error">
          <?php echo $usernameErr;?>
        </span>
        <br>
        <input type="text" required value="<?php echo $uname ?>" placeholder="User Name" name="uname" class="input">
        <br>
        <br>
        E-mail
        <br>
        <span class="error">
          <?php echo $emailErr;?>
        </span>
        <br>
        <input type="email" required value="<?php echo $email ?>" placeholder="E-mail" name="email" class="input">
        <br>
        <br>
        Password
        <br>
        <span class="error">
          <?php echo $passErr;?>
        </span>
        <br>
        <input type="password" required placeholder="Password" name="pass" class="input">
        <br>
        <br>
        Phone Number
        <br>
        <span class="error">
          <?php echo $phnoErr;?>
        </span>
        <br>
        <input type="number" required value="<?php echo $phoneno ?>" placeholder="Phone Number" name="phno" class="input">
        <br>
        <br>
        Profile picture
        <br>
        <br>
        <span class="error">
          <?php echo $imgErr;?>
        </span>
        <br>
        <input type="file" required name="image" class="input">
        <br>
        <br>
        <button style="font-size: 30px;background-color: crimson;color: white;padding: 10px;border: none;" type="submit" name="submit">Sign Up
        </button>
      </form>
    </div>
  </body>
</html>
