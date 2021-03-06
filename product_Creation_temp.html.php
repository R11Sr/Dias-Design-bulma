<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a product</title>
    
    <style>
      body {
          background-color: #d8befa;
          text-align: center;
          border: 10px solid #6b38ab;
          padding: 50px;
          margin: 100px;
      }
    </style>
</head>
<body>

    <header> 
        <h1> Product Creation </h1>
    </header>

    <!-- Product Creation Form -->
      <section>
        <div class="container">
          <div class="columns">
            <div class="column is-half">
              <form action="Menu Manager/menu_manger_add.php" method="GET">
                  <label for="title">Product Name</label><br>
                  <input type="text" id="title" name="title"><br></br>

                  <label for="description">Product Description</label><br>
                  <textarea name="description" id="description" rows="10" cols="30">
                    
                  </textarea><br></br>


                  <label for="type">Product Category</label>
                  <select name="type" id="type">
                    <option value="Accessories">Accessories</option>
                    <option value="Tops">Tops</option>
                    <option value="Bikini & Coverup">Bikini & Coverup</option>
                  </select><br></br>

                  <label for="price">Product Price</label>
                  <input type="text" id="price" name="price"><br></br>

                  <label for="size">Size</label>
                  <select name="size" id="size">
                    <option value="small">small</option>
                    <option value="medium">medium</option>
                    <option value="large">large</option>
                  </select><br></br>


                  <label for="colour">Colour</label>
                  <select name="colour" id="colour">
                    <option value="Red">Red</option>
                    <option value="Green">Green</option>
                    <option value="Blue">Blue</option>
                    <option value="Purple">Purple</option>
                    <option value="Orange">Orange</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Multi-coloured">Multi-coloured</option>
                  </select><br></br>

                <input type="submit" value="Submit">
            
              </form>
            </div>
          </div>
        </div>
      </section>

</body>
</html>