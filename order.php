<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Get product details from database
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Calculate total price
    $total_price = $row["price"] * $quantity;

    // Insert purchase record into database
    $sql = "INSERT INTO purchases (product_id, quantity, total_price) VALUES ('$product_id', '$quantity', '$total_price')";
    if ($conn->query($sql) === TRUE) {
        echo "Purchase successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<div class="responsive-container">
    <div class="grid">
        <div class="grid-column">
            <?php
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <a class="product" href="#">
                <div class="product-image">
                    <img src="<?php echo $row['image']; ?>" />
                </div>
                <div class="product-content">
                    <div class="product-info">
                        <h2 class="product-title">
                            <?php echo $row['title']; ?>
                        </h2>
                        <p class="product-price">
                            <?php echo $row['price']; ?>
                        </p>
                    </div>
                    <button class="product-action"><i class="material-icons-outlined">favorite_border</i></button>
                </div>
            </a>

            <form method="post">
                <label for="product_id">Product:</label>
                <select id="product_id" name="product_id">
                    <?php
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row["id"] . "'>" . $row["title"] . " (₱" . $row["price"] . ")</option>";
                    }
                    ?>
                </select><br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" max="100" value="1"
                    onchange="calculateTotalPrice()"><br>
                <label for="total_price">Total Price:</label>
                <?php
                if ($row != null && isset($row['price'])) {
                    echo '<input type="text" id="total_price" name="total_price" value="₱' . $row['price'] . '"><br>';
                } else {
                    echo '<input type="text" id="total_price" name="total_price" value="Price not available"><br>';
                }
                ?>
                <input type="submit" name="submit" value="Buy">

            </form>

        </div>
    </div>
</div>

<script>
    function calculateTotalPrice() {
        var price = <?php echo $row['price']; ?>;
        var quantity = document.getElementById("quantity").value;
        var totalPrice = price * quantity;
        document.getElementById("total_price").value = "₱" + totalPrice;
    }
</script>