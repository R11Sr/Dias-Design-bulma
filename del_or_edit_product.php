<!-- Page to update an individual product details -->

  
  
  <?php include('head.php');
      $root = $_SERVER['DOCUMENT_ROOT'];
      include("$root" . "/Dias-Design-bulma/root_credentials.php");
  ?>
  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JS/edit_or_del.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css"> 

    <title>Update Product</title>
</head>
<body>


    <!-- Fetchs all the products from the db -->
    <?php
        $all_products = $conn ->query("SELECT DISTINCT * FROM Products;");
        $product_list = $all_products ->fetchAll(PDO::FETCH_ASSOC);    
    ?>

<style>
    header {
    background-color: #790EAA;
    padding: 20px;
    text-align: center;
    font-size: 20px;
    color: white;
}
</style>
    <header> 
        <h1> Product Management </h1>
        <h2> (Deletion or Edition of product content) </h2>
    </header>

   <a href="product_Creation_temp.html.php" class="button is-large is-large mt-3">Add Product</a>
    <table class= "table" id="table">
        <tr>

            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Remove Option</th>
            <th>Edit Option</th>

        </tr>
        <!-- populate table with each fetched product -->

        <?php foreach($product_list as $product):?>
            <tr>
                <td><?=$product['Title']?></td>
                <td><?=$product['Description']?></td>
                <td><?=$product['Price']?></td>
                <!-- uses JS to add an event listener to to each button to activate the 'edit' or 'delete' functionality -->
                <td><button class="button" id= "delete<?=$product['ProductID']?>" >Delete</button></td> 
                <td><button class="button" id= "edit<?=$product['ProductID']?>" >Edit</button></td>
                <!-- hidden field with the product id -->
                <td style ="display: none"><?=$product['ProductID']?></td> 
            </tr>

        <?php endforeach;?>

    </table>

</body>
</html>