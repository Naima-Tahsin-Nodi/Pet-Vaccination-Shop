<?php
class payment extends Model {
    session_start();
    $database_name = "PetVet";
    $con = mysqli_connect("localhost","root","",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["payment"])){
            $item_array_id = array_column($_SESSION["payment"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["payment"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["payment"][$count] = $item_array;
                echo '<script>window.location="payment.php"</script>';
            }else{
                echo '<script>alert("Payment Successfull...!")</script>';
                echo '<script>window.location="payment.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                
            );
            $_SESSION["payment"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "success"){
            foreach ($_SESSION["payment"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["payment"][$keys]);
                    echo '<script>alert("Payment Successfull...!")</script>';
                    echo '<script>window.location="payment.php"</script>';
                }
            }
        }
}