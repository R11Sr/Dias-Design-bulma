<?php
    // This is used to enable the debugging mode. removed for production mode.
    // It is included in the header file so its everywhere. based on DRY

    ini_set('display_errors','On');
    error_reporting(E_ALL| E_STRICT);
?>

<!-- This consists of the navigation bar and the notification bar  -->

<?php
    session_start(); // starts  the user session to tracks that the user is logged in and the type of user recorded ie admin or regular    
  
    // if logged in returns the profile page else the login page
    function direct(){
        if(isset($_SESSION['uid'])){
             echo "profile.html.php";
        }
        else{
             echo "login.html";
        }
    }

    // if logged in prints the user email else the word "Login"
    function name_or_login(){
        require('root_credentials.php');

        if(isset($_SESSION['uid']))
        {
            $id = $_SESSION['uid'];
            $sql = "SELECT email FROM Users WHERE UserID = $id;";
            $fetched = $conn ->query($sql);
            $email = $fetched->fetchAll(PDO::FETCH_ASSOC);
            $user_email = $email[0]["email"];
            echo "$user_email";
       }
       else{
            echo "Login";
       }
    }

    // prints the items in the user shopping cart from the db
    function cart_items(){

        include('root_credentials.php');
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

    // If the user that has logged in is not the admin this hides the admin menu options
    function admin_check(){
        if(!isset($_SESSION['adminID']))
        {
            echo "is-hidden";
       }
        
    }

    // sets the option for the user to logout using the needed script
    function logout(){
      if(isset($_SESSION['uid']))
      {
        echo   "<a class=\"navbar-item\" href=\"Authen/logout.php\"> LOGOUT </a>";
      }
    }
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="JS/main.js"></script>



<!--Navigation Bar Menu -->
<nav class="navbar has-shadow">
  <!-- Dias Designs Logo -->
  <div class="navbar-logo">
    <a href="index.php" class="navbar-logo">
     <img src="images/Dias Designs Transparent Background.png" alt="Business logo" style="max-height: 100px" class = "py-2 px-2">
    </a>
  </div>
  <!-- Navigation Bar Menu -->
  <div id="navbar-menu" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item"  href="index.php">
        HOME
      </a>
      <a class="navbar-item" href="about.html.php">
        ABOUT US
      </a>
      
      <a class="navbar-item" href="Products.html.php">
        PRODUCTS
      </a>
      <!-- Testimonal page has CSS that conflicts with bulma, to refeactor -->

      <!-- <a class="navbar-item" href="testimonial.html.php">
        TESTIMONIALS
      </a> -->
      <a class="navbar-item" href="contact-us.php">
        CONTACT US
      </a>

      <!-- FAQ page has CSS that conflicts with bulma, to refeactor -->

      <!-- <a class="navbar-item" href="faq.html.php">
        FAQs
      </a> -->
      <a class="navbar-item  <?php admin_check();?>" href="manage_order_page.php " >
      ADMIN ORDERS
    </a>
      
      <a class="navbar-item  <?php admin_check();?>" href="del_or_edit_product.php " >
      ADMIN PRODUCTS
    </a>
    </div>

    <div class="navbar-end">
        <div class="navbar-item">
            <?php logout();?>
            <!-- <a class="navbar-item" href="Authen/logout.php">
            LOGOUT
            </a> -->
        </div>
        <div class="navbar-item" id="cart-container">
            <span class="icon is-large">
                <i class="fa fa-shopping-cart"></i>
            </span>

            <a  class="title is-4" id="counter" >

                <?php cart_items()?>
            </a>
            
        </div>
      <a href= <?php direct()?> class="navbar-item">
       <?php name_or_login();?>
      </a>

    </div>
  </div>

</nav>
     
<div class="notification is-primary">
  <button class="delete"></button>
  Lorem ipsum dolor sit amet, consectetur
  adipiscing elit lorem ipsum dolor. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur.
</div>
