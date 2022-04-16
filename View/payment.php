<?php
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
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment System</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        }
        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            margin: 4px 2px;
            cursor: pointer;
        }
        
    </style>
</head>
<body>

    <div class="container" style="width: 65%">
        <h2>Payment System</h2>
        <?php
            $query = "SELECT * FROM payment_system ORDER BY id ASC ";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <div class="col-md-3">

                        <form method="post" action="payment.php?action=add&id=<?php echo $row["id"]; ?>">

                            <div class="product">
                                <img src="<?php echo $row["image"]; ?>" class="img-responsive">
                                
                                
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success"
                                       value="Confirm Payment">
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
        ?>

        </div>
        <div class="text-center">
        <button class="button"><a href="index.html" class="button">Home</a></button>
        </div>
    </div>


</body>
</html>