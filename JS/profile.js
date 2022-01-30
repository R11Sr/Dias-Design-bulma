window.addEventListener('load',(e)=>{

    let table = document.getElementById('table');
    // loop through the each row of the displayed table 
    for(let i =1; i < table.rows.length; i++){
        // selects  the view button
        let VIEW_BUTTON = $(`#view_${table.rows[i].lastElementChild.childNodes[0].id.slice(5)}`); //slice is to remove 'view_'

        console.log(table.rows[i].lastElementChild.childNodes[0].id.slice(5));


        // add an event listener to allow the user to be able to download the invoice
        VIEW_BUTTON.on('click',e=>{
            let order_id = e.target.id.slice(5); // slice off the word 'view_'
            window.location.href = `Profile/display_invoice_user.php?order_id=${order_id}`;

        });
    }




});