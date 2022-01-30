
<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL| E_STRICT);
?>


<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include("$root" . "/Dias-Design-bulma/root_credentials.php");
session_start();

// return the total items in the card
function cart_items(){
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root" . "/Dias-Design-bulma/root_credentials.php");

    $sql = "SELECT quantity FROM `shopping_cart` WHERE `u_id` = :ID;";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':ID',$_SESSION['uid']);
    $stmt->execute();
    $result =$stmt->fetchAll();
    $all_quan = $result;
    $total =0;
    if(count($all_quan) > 0){
        foreach($all_quan as $item){
            $int_val = (int)$item['quantity']; 
            $total+= $int_val;
        }
    }
    
    echo $total;

}


?>




<?php

    if(!isset($_SESSION['uid'])){
        echo "Please Login to continue!";
    }
    else{
        // if the user has been validated add the product to that shopping cart db with the user id
        if(isset($_GET['productID']) && isset($_GET['uid'])){
            $pID = filter_var($_GET['productID'],FILTER_VALIDATE_INT);
            $uID = filter_var($_GET['uid'],FILTER_VALIDATE_INT);
            
            $sql = "SELECT * FROM `shopping_cart` WHERE u_id =$uID AND `prod_id` =$pID";
            $sql_quan = "SELECT `quantity` FROM `shopping_cart` WHERE `u_id` =$uID AND `prod_id`=$pID;";
            $sql_i = "INSERT INTO `shopping_cart` SET `u_id` = :USERID, `prod_id`=:PRODID,`quantity`=:QUAN;";
            $sql_u = "UPDATE `shopping_cart` SET `quantity` = :QUAN WHERE `prod_id`=:PRODID AND `u_id`=:USERID;";

            $_= $conn->query($sql);
            $cart_item = $_->fetchAll(PDO::FETCH_ASSOC); 
            if (count($cart_item) == 0){
                // insert the item in the cart
                $stmt = $conn->prepare($sql_i);
                $quantity =1;
                $stmt->bindParam("USERID",$uID,PDO::PARAM_INT);
                $stmt->bindParam("PRODID",$pID,PDO::PARAM_INT);
                $stmt->bindParam("QUAN",$quantity,PDO::PARAM_INT);
                $stmt->execute();
                echo cart_items();
                
            }
            else{
                // select quantity of a product and increment it in the cart db
                $quan_quer = $conn->query($sql_quan);
                $result = $quan_quer->fetchAll(PDO::FETCH_ASSOC); 
                $quantity = $result[0]['quantity']; 
                $quantity +=1;

                $stmt = $conn->prepare($sql_u);
                $stmt->bindParam("USERID",$uID,PDO::PARAM_INT);
                $stmt->bindParam("PRODID",$pID,PDO::PARAM_INT);
                $stmt->bindParam("QUAN",$quantity,PDO::PARAM_INT);
                $stmt->execute();
                echo cart_items();



            }

    
    
        }else{
            echo cart_items();
        }
    }
?>
