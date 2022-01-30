



<!-- Fetchs all the products in the db -->
<?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/Dias-Design-bulma/root_credentials.php");
        $all_products = $conn ->query("SELECT DISTINCT * FROM Products;");
        $product_list = $all_products ->fetchAll(PDO::FETCH_ASSOC);  

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
         
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="JS/main.js"></script>
        <script src="JS/add-to-cart.js"></script>

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
            crossorigin="anonymous"
        />


        <title>Products</title>
    </head>

    <body>


<?php include('head.php');?>


        <div class="columns is-multiline">

            <!-- loops through the product list and populates an 'article' element with each 'product' -->
        <?php foreach($product_list as $product):?>
            <div class="column is-6-tablet is-4-desktop is-3-widescreen">
                <article class="box">
                    <div class="media">
                        <aside class="media-left">
                            <figure class="">
                                <img class = "image is-128x128" src="images/prod<?=$product['ProductID']?>.jpg">
                            </figure>
                        </aside>

                        <div class="media-content">
                            <p class="title is-5 is-marginless">
                               <?=$product['Title']?>
                            </p>
                            <br>
                            <p>
                               <?=$product['Description']?>                               

                            </p>
                            <p class="subtitle is-marginless">
                            $ <?=$product['Price']?>
                            </p>
                            <p>
                               
                                <form action="">
                                    <input type="text" value ='<?=$product['ProductID']?>' class='is-hidden' name="productID">
                                    <input type="text" value='<?=$_SESSION['uid']?>'  class='is-hidden' name='uid'>
                                    <button class="button is-small add-to-cart" type='submit'>
                                         Add to Cart
                                    </button>
                                </form>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach;?>

        </div>

    </body>
</html>
