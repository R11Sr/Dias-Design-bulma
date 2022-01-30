

<?php 
        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/Dias-Design-bulma/root_credentials.php");
?>

<!-- collects all the data that has been submitted. -->
<?php
  $fname = filter_var($_GET['fname'],FILTER_SANITIZE_STRING);
  $lname = filter_var($_GET['lname'],FILTER_SANITIZE_STRING);
  $email = filter_var($_GET['email'],FILTER_SANITIZE_STRING);
  $pass =  filter_var($_GET['password'],FILTER_SANITIZE_STRING);


$email = trim($email);
$pass = trim($pass);
 $pass_hashed = password_hash($pass, PASSWORD_DEFAULT); // creates a salt of the password
$sql = "INSERT INTO Users(Fname,Lname, email, password)VALUES('$fname','$lname','$email','$pass_hashed');";

// created an entry in the db, redir and  display the proper error msg
if($conn ->query($sql) == TRUE){
  echo"<script>alert('Successfully Registered!');</script>";
  echo "<script> location.href = '../login.html'</script>";
} 
else {
  echo"<script>alert('There was an issue while registering. Please try again.');</script>";
  echo "<script> location.href = '../registration.php'</script>";

}   
 
?>