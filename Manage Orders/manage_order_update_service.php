<!-- Updates the order status -->

<?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/Dias-Design-bulma/root_credentials.php");
?>




<?php
$order_id = $_POST['order_ID']; // coming from a hidden field not needing user input
$order_status = filter_var($_POST['status'],FILTER_SANITIZE_STRING);
?>


<?php
    if(!isset($order_id) || !isset($order_status)) //checks to see if value is set 
        {
            echo "<H2> A required field is missing to update the product</H2>";
        }
    else 
        {
            $sql = "UPDATE Orders SET status ='$order_status' WHERE OrderID = $order_id;"; //updates the order status 

            // exe the update request
            if($conn ->query($sql) == TRUE)
            {
                echo "<script>alert('Record Successfully updated!');</script>";
                echo "<script> window.location.href = '../manage_order_page.php'</script>";




            }

            else {
                echo "<h3>An Error has occured, Order Status not updated<h3>";
            }

        }

?>

