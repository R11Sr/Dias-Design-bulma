<!-- Remove selected Item from the db -->


<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root" . "/Dias-Design-bulma/root_credentials.php");
?>

<?php
    $ProductID = filter_var($_POST['prod_id'], FILTER_SANITIZE_NUMBER_INT);

    if(isset($ProductID)){
        $sql = "DELETE FROM Products WHERE ProductID = $ProductID;";

        if($conn ->query($sql) == TRUE)
            {
                echo "<script>alert('Record Successfully Removed!');</script>";
                echo "<script> window.location.href = '../del_or_edit_product.php'</script>";

            }

            else {
                echo "<script>alert('An Error has occured, Item not Deleted');</script>";
                echo "<script> window.location.href = '../del_or_edit_product.php'</script>";
                
            }

    }
    else{
        echo "<script>alert('No Product Selected to remove');</script>";
        echo "<script> window.location.href = '../del_or_edit_product.php'</script>";
                

    }





?>

