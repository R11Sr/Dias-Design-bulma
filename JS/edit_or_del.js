window.addEventListener('load',e=>{
    // selects the table to modify product
    let table = document.getElementById('table');

    if (table){

        for(let i =1; i < table.rows.length; i++){
            // selects  the delete and edit button for each row
            let DELETE_BUTTON = $(`#delete${ table.rows[i].cells[5].innerHTML}`);
            let EDIT_BUTTON = $(`#edit${ table.rows[i].cells[5].innerHTML}`);

            // add the event listener to the button
            DELETE_BUTTON.on("click",e=>{
                let cnfm = confirm("Are you sure you want to delete this Item?");
                if(cnfm == true){
    
                    let productID = e.target.id.slice(6); // Slices of the word 'delete from the ID eg. 'delete12' becomes'12'.'

                    // create a JSON with product data
                    let request = {prod_id: productID};
    
                    // send the JSON as a AJAX request
                    $.ajax({
                        type: "POST",
                        url: "Menu Manager/menu_manager_remove.php",
                        data: request,
                        dataType: "html"
                    }).done(response =>{
                        // should show a pop up of the response on the screen, this doesn't work XD
                        tempAlert(`${response}`,2000); 
                    }).fail(()=>{
                        tempAlert("Failed to Delete Product",2000);
    
                    })
                    e.preventDefault();
                }
               
            });
            
            // add the event listener to the button
            EDIT_BUTTON.on("click",e=>{
      
                productID = e.target.id.slice(4);// Slices of the word 'edit from the ID'
                let request = {prod_id: productID};
                window.location.href = `menu_manager_update_page.php?prod_id=${productID}`;
    
            })
    
        }
    }


    function tempAlert(msg,duration)
{
 var el = document.createElement("div");
 el.setAttribute("style","position:absolute;top:40%;left:20%;background-color:white;");
 el.innerHTML = msg;
 setTimeout(function(){
  el.parentNode.removeChild(el);
 },duration);
 document.body.appendChild(el);
 location.reload();
}



});