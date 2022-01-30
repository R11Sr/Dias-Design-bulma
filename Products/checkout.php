<!-- REMOVE DEBUGGING MODE -->

<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL| E_STRICT);
?>

<?php
    // remove item from shopping cart where order for item has been placed
    function del_frm_crt($uid){
        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/Dias-Design-bulma/root_credentials.php");

        $sql_del = "DELETE FROM `shopping_cart` WHERE `u_id`=:USERID;";
        $stmt = $conn->prepare($sql_del);
        $stmt->bindParam("USERID",$uid,PDO::PARAM_INT);
        $stmt->execute();
    }

?>


<?php
    session_start();
    if(!isset($_SESSION['uid'])){
        echo "Please Login to continue!";
   }
    else{   

        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/Dias-Design-bulma/root_credentials.php");

        $userID = filter_var($_POST['uID'],FILTER_SANITIZE_NUMBER_INT);

        $sql = "SELECT * FROM `shopping_cart` WHERE `u_id`=$userID;";
        $sql_i = "INSERT INTO Orders(UserID,ProductID,quantity,total_cost,status)VALUES(:USERID,:PRODID,:QUAN,:TOTAL,'Pending');";

        $_= $conn->query($sql);
        $cart_items = $_->fetchAll(PDO::FETCH_ASSOC);
        
        $order_stat =[];

        //loop through each item in the cart
        foreach($cart_items  as $item){
            var_dump($item);
            $prod_id = $item['prod_id'];
            $quantity = $item['quantity'];

            $pq = "SELECT Price FROM Products WHERE ProductID = $prod_id;";
            $prcestmt= $conn->query($pq);
            $price = $prcestmt->fetchAll(PDO::FETCH_ASSOC);

            $total = floatval($price[0]["Price"] * $quantity);

            //creating the order
            $stmt = $conn->prepare($sql_i);
            $stmt->bindParam("USERID",$userID,PDO::PARAM_INT);
            $stmt->bindParam("PRODID",$prod_id,PDO::PARAM_INT);
            $stmt->bindParam("QUAN",$quantity,PDO::PARAM_INT);
            $stmt->bindParam("TOTAL",$total);
            

            if($stmt->execute() == TRUE){
                array_push($order_stat, TRUE);
            }
            else{
                array_push($order_stat, FALSE);
            }


        }


        // some items were not able to be processed
        if(in_array(FALSE, $order_stat, $strict = false)){
            echo "Most of Your Order Has Been Placed. Please review from your Profile";
            del_frm_crt($userID);
        }else{
            echo "Your Order Has Been Placed!";            
            del_frm_crt($userID);
        } 
    }       

?>

