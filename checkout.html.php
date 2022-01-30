

<!-- This is the checkout page -->


<?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/Dias-Design-bulma/root_credentials.php");
?>


<?php
    function get_prod($prod_id){
        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/Dias-Design-bulma/root_credentials.php");

        $sql = "SELECT * FROM `Products` WHERE `ProductID`= :pID;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam("pID",$prod_id,PDO::PARAM_INT);
            $stmt->execute();
            $prod_info = $stmt->fetchAll();
            return $prod_info[0];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script src="./JS/main.js"></script>
    <title>Cart</title>
</head>
<body>
    <?php include 'head.php'?>
 
    <div class="title is-1">
        Shopping Cart
    </div>

    <!-- fetches the items in the user shopping cart if the user is signed in -->
    <?php if(isset($_SESSION['uid'])):?>
        <?php
            $sql = "SELECT * FROM `shopping_cart` WHERE `u_id`= :USERID;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam("USERID",$_SESSION['uid'],PDO::PARAM_INT);
            $stmt->execute();
            $u_items = $stmt->fetchAll();
            
        ?>

        <table class="table is-hoverable ">
            <thead>
                <tr>
                    <th>IMG</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th class="is-narrow">Quantity</th>
                    <th></th>
                    <th>Total</th>
                </tr>    
            </thead>

            <!-- Populated the table rows with each item from the cart -->
            <tbody class="table-body">
                <?php  
                foreach($u_items as $item):
                   $prod_data =  get_prod($item['prod_id']);
                ?>
                <tr class= "row">
                    <td>
                        <img src="https://bulma.io/images/placeholders/128x128.png" alt="" srcset="">
                    </td>
                    <td>
                        <p><strong><?=$prod_data['Title']?></strong></p>
                        <br>
                        <p><?=$prod_data['Description']?></p>
                    </td>
                    <td>
                        $ <?=$prod_data['Price']?>
                    </td>
                    <td class="is-narrow ">
                        <input type="number" value ="<?=$item['quantity']?>" min="1" class="quantity">
                        <input type="text" value="<?=$prod_data['ProductID']?>" class="is-hidden">
                    </td>
                    <td>
                        <div class="container">
                            <form action="" class= 'remove-form'>
                            <span class="icon is-small">
                            <i class="fa fa-trash"></i>
                            </span>
                                <input type="text" value="<?=$prod_data['ProductID']?>" name="pID" class="is-hidden">
                                <input type="text" value="<?=$_SESSION['uid']?>" name="uID" class="is-hidden">

                                <!-- This remove buttons is activated using AJAX, toremove a specified element -->
                                <button class="button is-small is-danger remove-item" type='submit'>
                                         Remove
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>
                        <!-- Prints the total for eack item -->
                       $ <?= $prod_data['Price'] * $item['quantity'];?>.00
                    </td>
                </tr>
                <?php endforeach;?>
        
            </tbody>
            <tfoot>

            </tfoot>

        </table>
        <div class="container">
            <div class="is-pulled-right">
                <form action="Products/checkout.php" method="POST">
                <input type="text" value="<?=$_SESSION['uid']?>" name="uID" class="is-hidden">
                    <button class="button is-success order-button"> Place Order </button>
                </form>
            </div>
        </div>
    <?php else:?>
        <div class="container">
            <p class="title is-1">
                Please sign in to see items in your cart.
            </p>
        </div>
    <?php endif;?>
</body>
</html>

