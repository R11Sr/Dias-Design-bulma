<!-- delete the session an sends to home page -->
<?php
session_start();
session_destroy();
header("Location: /Dias-Design-bulma/index.php");        

?>