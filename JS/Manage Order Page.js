window.addEventListener('load',(e)=>{
    let table = document.getElementById('table');
    
    // for each Item row add stated functionality to each button

    for(let i =1; i < table.rows.length; i++){
        let UPDATE_BUTTON = $(`#${ table.rows[i].cells[7].innerHTML}`);
        let INVOICE_BUTTON = $(`#invoice_${table.rows[i].cells[7].innerHTML}`);
        let UPLOAD_BUTTON = $(`#upload_${table.rows[i].cells[7].innerHTML}`);
        let VIEW_BUTTON = $(`#view_${table.rows[i].cells[7].innerHTML}`);

        // console.log(table.rows[i].lastElementChild.childNodes);
        
        
        UPDATE_BUTTON.on('click',e=>{
            window.location.href = `manage_order_update_page.php?order_id=${e.target.id}`; // redirect to update page of that product

        });

        
        INVOICE_BUTTON.on('click', e=>{
            let order_id = e.target.id.slice(8); // Slices of the word 'delete from the ID'
            window.location.href = `Manage Orders/create_invoice_service.php?order_ID=${order_id}`;


        });

        UPLOAD_BUTTON.on('click',e=>{
            let order_id = e.target.id.slice(7); // slice off the word upload_
            window.location.href = `Manage Orders/file-upload.php?order_id=${order_id}`;

        });


        VIEW_BUTTON.on('click',e=>{
            let order_id = e.target.id.slice(5); // slice off the word 'view_'
            window.location.href = `Manage Orders/display_invoice_service.php?order_id=${order_id}`;

        });
    }





});