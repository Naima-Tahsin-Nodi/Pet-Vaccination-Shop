<?php
class cartbird extends Model {
    session_start();
    $database_name = "PetVet";
    $con = mysqli_connect("localhost","root","",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart_bird"])){
            $item_array_id = array_column($_SESSION["cart_bird"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart_bird"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart_bird"][$count] = $item_array;
                echo '<script>window.location="Cart_bird.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart_bird")</script>';
                echo '<script>window.location="Cart_bird.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart_bird"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart_bird"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart_bird"][$keys]);
                    echo '<script>alert("Product has been Removed...!")</script>';
                    echo '<script>window.location="Cart_bird.php"</script>';
                }
            }
        }
    }
$query = "SELECT * FROM product_bird ORDER BY id ASC ";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {

    if(!empty($_SESSION["cart_bird"])){
        $total = 0;
        foreach ($_SESSION["cart_bird"] as $key => $value) {
            ?>
            <tr>
                <td><?php echo $value["item_name"]; ?></td>
                <td><?php echo $value["item_quantity"]; ?></td>
                <td>$ <?php echo $value["product_price"]; ?></td>
                <td>
                    $ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                <td><a href="Cart_bird.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                            class="text-danger">Remove Item</span></a></td>

            </tr>
            <?php
            $total = $total + ($value["item_quantity"] * $value["product_price"]);
        }
            ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <th align="right">$ <?php echo number_format($total, 2); ?></th>
                <td></td>
            </tr>
    }