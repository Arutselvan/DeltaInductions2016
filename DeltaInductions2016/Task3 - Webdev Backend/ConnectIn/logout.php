<?php
session_start();
session_destroy();
header('Location: signinpage.php');
exit;
?>