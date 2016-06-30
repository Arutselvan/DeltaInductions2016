<!DOCTYPE html>
<html>
  <head>
    <link href='signinpage.css' rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet' type='text/css'>
    <title>Login | ConnectIn
    </title>
  </head>
  <body>
    <?php 
      session_start();  
    ?>
    <div id="titleblock">
      <a href="index.php" >ConnectIn
      </a>    
    </div>
    <form id="formblock" method="POST" action="user.php">
      <div id="err">
        <?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?>
      </div>
      <?php unset($_SESSION['errMsg']); ?>
      <br>
      <br>
      Username
      <br>
      <br>
      <input type="text" name="usrname" class="input">
      <br>
      <br>
      Password
      <br>
      <br>
      <input type="password" name="pwd" class="input">
      <br>
      <br>
      <button style="font-size: 30px;background-color: crimson;color: white;padding: 10px;border: none;"  type="submit" name="submit">Sign in
      </button>
      <br><br><span>Not yet registered</span>
      <br>
      <br>
      <a id="button2" href="index.php">Sign Up
      </a>
    </form>
  </body>
</html>
