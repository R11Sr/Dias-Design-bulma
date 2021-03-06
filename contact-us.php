
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dias Designs Contact Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css"> <!-- link for access to bulma api for page design-->
  <style>


    /* Header Style */
    header {
    background-color: #790EAA;
    padding: 30px;
    text-align: center;
    font-size: 35px;
    color: white;
    }

  </style>

  </head>
  
  
  <body>
  <?php include('head.php') ?>


    <!-- Contact Us Form Header -->
    <header> 
      <h1> CONTACT US </h1>
    </header>

    <!-- Contact Us Form -->
      <section class="section has-background-light">
        <div class="container">
          <div class="columns">
            <div class="column is-half">
              <img src="images/contactus.png" alt="Contact-Form-Photo">
            </div>

            <div class="column is-half">
              <form action="#" method="POST"> <!-- link to FormSubmit api that allows the admin to recieve emails from form-->
                
                <!-- Contact Us Form Header -->
                <h1 style="text-align:center">What's on your mind? </h1> 

                <!-- Contact Us Form Firstname Field -->
                <div class="field">
                  <label class="label">First Name</label>
                  <div class="control">
                    <input class="input" type="text" placeholder="First Name" name="fname" required>
                  </div>
                </div>

                <!-- Contact Us Form Lastname Field -->
                <div class="field">
                  <label class="label">Last Name</label>
                  <div class="control">
                    <input class="input" type="text" placeholder="Last Name" name="lname" required>
                  </div>
                </div>

                <!-- Contact Us Form Email Field -->
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control">
                    <input class="input" type="email" placeholder="Example: username@" name="email" required>
                  </div>
                </div>

                <!-- Contact Us Form Message Field -->
                <div class="field">
                  <label class="label">Message</label>
                  <div class="control">
                    <textarea class="textarea" placeholder="Write something.." name="msg" required></textarea>
                  </div>
                </div>

                <!-- Contact Us Form Submit Button -->
                <div class="field is-grouped">
                  <div class="control">
                    <button class="button is-link">Submit</button>
                  </div>
                </div>  

              </form>  
            </div>
          </div>
        </div>
      </section>

  </body>
</html>