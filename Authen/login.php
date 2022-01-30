<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>

<?php 
        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/Dias-Design-bulma/root_credentials.php");
?>

<?php

session_start();

//get values from the login.html file
$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
$pass =  filter_var($_POST['password'],FILTER_SANITIZE_STRING);

//prevent sql injects
$email = trim($email);
$pass = trim($pass);

//query info in database
$sql = "SELECT * FROM Users WHERE email = '$email';";                    
$q = $conn ->query($sql);
//$result = mysql_fetch_array($sql);
$result = $q ->fetchAll(PDO::FETCH_ASSOC);

$password_hashed = $result[0]["password"];

// use to compare entered password  to the one stored
if(password_verify($pass,$password_hashed)) {
  
  //creates standard user session
  $_SESSION['uid'] = $result[0]["UserID"];

  //create admin session  to allow admin privilages to user. 
  if ($email == 'admin@dias.com'){
  $_SESSION['adminID'] = $result[0]["UserID"];

  }
  // redir to home page if authenticated
  echo "<script> location.href = '../index.php'</script>";

} else {
  // if failed notifies  the user and redir to login page
  echo "<script>alert('Login Failed');</script>";
  echo "<script> location.href = '../login.html'</script>";

}

?>