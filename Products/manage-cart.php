<!-- REMOVE DEBUGGING MODE -->


<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL| E_STRICT);
?>

<?php 
    session_start();    
?>


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



<?php if (!isset($_SESSION['uid'])):?>
        <?php echo "Please login to continue!";?>
    <?php else:?>
        <?php var_dump($_GET['pID'],$_GET['uID'])?>
        <?php if(isset($_GET['pID']) && isset($_GET['uID'])):?>
            <?php 
                $uID = $_GET['uID'];
                $pID = $_GET['pID'];
                 $sql = "DELETE from `shopping_cart` WHERE `prod_id`=:PRODID AND `u_id`=:USERID;";
                $sql_get = "SELECT * FROM `shopping_cart` WHERE `u_id`= :USERID;";
                
                //remove selected Items from cart
                $stmt = $conn->prepare($sql);
                $stmt->bindParam("USERID",$uID,PDO::PARAM_INT);
                $stmt->bindParam("PRODID",$pID,PDO::PARAM_INT);
                $stmt->execute();

                //refresh the items in the cart
                $stmt = $conn->prepare($sql_get);
                $stmt->bindParam("USERID",$uID,PDO::PARAM_INT);
                $stmt->execute();
                
                $u_items= $stmt->fetchAll();
                var_dump($u_items) ;
            ?>

            <!-- display each item in cart as a row in table -->

            <?php foreach($u_items as $item):?>
                <?php $prod_data =  get_prod($item['prod_id']); ?>
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
                            <form action="" class='remove-form'>
                               <span class="icon is-small">
                               <i class="fa fa-trash"></i>
                               </span>
                                <input type="text" value="<?=$prod_data['ProductID']?>" name="pID" class="is-hidden">
                                <input type="text" value="<?=$_SESSION['uid']?>" name="uID" class="is-hidden">

                                <!-- functionaity of remove bttn added by selecting 'remove-item'class in the main.js file -->
                                <button  type="submit" class="button is-small is-danger remove-item">
                                Remove
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>
                       $ <?= $prod_data['Price'] * $item['quantity'];?>.00
                    </td>
                </tr>
            <?php endforeach;?>
        <?php else:?>
            <?php echo "An Error has occured please contact your administrator"?>
        <?php endif;?>
<?php endif;?>
