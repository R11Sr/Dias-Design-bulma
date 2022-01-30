<!-- script to update the product -->

<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include("$root" . "/Dias-Design-bulma/root_credentials.php");
?>




<?php


$product_id = $_POST['product_ID']; // coming from a hidden field not needing user input
$product_name = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
$description = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
$type = filter_var($_POST['type'],FILTER_SANITIZE_STRING);
$price = filter_var($_POST['price'],FILTER_VALIDATE_FLOAT);
$size = filter_var($_POST['size'],FILTER_SANITIZE_STRING);
$colour = filter_var($_POST['colour'],FILTER_SANITIZE_STRING);

?>


<!-- if data is validated submir request -->
<?php
    if(!isset($product_name) || !isset($description) || !isset($type) || !isset($price) || !isset($size) || !isset($colour)) 
        {
            echo "<H2> A required field is missing from the product update</H2>";
        }
    else 
        {
            $sql = "UPDATE Products SET Title ='$product_name', Description = '$description',
                    Type = '$type', Price = '$price', size = '$size', colour = '$colour'
                    WHERE ProductID = $product_id;";

            if($conn ->query($sql) == TRUE)
            {
                echo "<script>alert('Record Successfully updated!');</script>";
                echo "<script> window.location.href = '../del_or_edit_product.php'</script>";


            }

            else {
                echo "<script>alert('An Error has occured, Item not Updated!');</script>";
                echo "<script> window.location.href = '../del_or_edit_product.php'</script>";
            }

        }

?>

