

<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root" . "/Dias-Design-bulma/root_credentials.php");

    //this displays the invoice for a selected order 

    $order_id_str = $_GET['order_id'];
    $order_id = (int)$order_id_str;
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($order_id)){
        $invoice_sql = "SELECT `file_name`,`content` FROM Invoices WHERE OrderID = :id;";

        // pulls the file from the db and prepares it for the browser
        $stmt = $conn->prepare($invoice_sql);
        $stmt->bindValue(':id', $order_id, PDO::PARAM_INT);
        $stmt->bindColumn(1, $file_name);
        $stmt->bindColumn(2, $content, PDO::PARAM_LOB);
        if ($stmt->execute() === FALSE) {
            echo 'Could not display Invoice';
        } else {
            $stmt->fetch(PDO::FETCH_BOUND);
            header("Content-type: application/pdf");  
            header('Content-disposition: inline; filename="'.$file_name.'.pdf"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            echo $content;
        }
    } else {
        header('location: profile.php'); //this redirects user to profile.php 
    }







?>