

$(document).ready(function(){
    // add the 'X' for the notification bar
    let close_notification = $(".delete");
    close_notification.on('click',()=>{
        let notification = $(".notification");
        notification = notification[0];
        notification.classList.add("is-hidden");
    })
    
    // when add to cart is clicked passed product to be processed 
    $("form.remove-form").submit(function( event ) {
        console.log( $( this ).serializeArray() );
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: "Products/manage-cart.php",
            data:$( this ).serializeArray(), // the form data
            dataType: "html"

        }).done(response=>{
            // add notification to confirm action
            $('.notification').text("Item Removed from cart");
            $('.notification').removeClass('is-hidden');
            let bttn = "<button class=\"delete\"> </button>"
            $('.notification').append(bttn);
            $(".delete").on('click',()=>{
                let notification = $(".notification");
                notification = notification[0];
                notification.classList.add("is-hidden");
            })
            
            $(".table-body").empty();
            $(".table-body").append(response);


            // refresh the item counter
            // $("#counter").text(response);

        }).fail(()=>{
            $('.notification').text("Unfortunately the item has not been removed from your cart.");
            $('.notification').removeClass('is-hidden');
            let bttn = "<button class=\"delete\"> </button>"
            $('.notification').append(bttn);
            $(".delete").on('click',()=>{
                let notification = $(".notification");
                notification = notification[0];
                notification.classList.add("is-hidden");          
                })

        });

    })



});
