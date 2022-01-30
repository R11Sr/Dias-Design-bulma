window.addEventListener('load',(e)=>{


    // the 'add to cart' button is a form element that uses AJAX to submit it.
    $("form").submit(function( event ) {
        console.log( $( this ).serializeArray() );
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: "Products/cart-service.php",
            data:$(this).serializeArray(),
            dataType: "html"

        }).done(response=>{
            // Affirm action in notification bar
            $('.notification').text("<H1>Item added to cart</H1>");
            $('.notification').removeClass('is-hidden'); //shows  the notification bar
            let bttn = "<button class=\"delete\"> </button>" // create the 'X' for the notification bar
            $('.notification').append(bttn); //add the 'X' to the notification bar
            // add the listener to remove the notification bar
            $(".delete").on('click',()=>{
                let notification = $(".notification");
                notification = notification[0];
                notification.classList.add("is-hidden");
            })
            
            // refresh the item counter
            $("#counter").text(response);

        }).fail(()=>{
            // if the action fails display appropriate message
            $('.notification').text("unfortunately the item has not been added to your cart");
            $('.notification').removeClass('is-hidden');
            let bttn = "<button class=\"delete\"> </button>"
            $('.notification').append(bttn);
            $(".delete").on('click',()=>{
                let notification = $(".notification");
                notification = notification[0];
                notification.classList.add("is-hidden");          
                })

        });
    });



});
