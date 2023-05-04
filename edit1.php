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

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $sales = $_POST["sales"];
    $stock = $_POST["stock"];
    $price = $_POST["price"];
    $sql = "UPDATE products SET title='$title', sales='$sales', stock='$stock', price='$price' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        setTimeout(function() {
            alert('Product Updated Successfully');
            window.location.href = 'dashboard2.php';
        }, 100);
    </script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>
<?php
$id = $row["id"];
$confirmationMessage = "Do you want to delete that particular product?";
$deleteUrl = "editdel.php?id=$id";
$buttonHtml = '<button type="button" onclick="if(confirm(\'' . $confirmationMessage . '\')) {window.location.href=\'' . $deleteUrl . '\';}"><i class="fa fa-trash"></i></button>';


?>

<button class="app-content-headerButton" onclick="redirectToPage()">Go Back</button>
<center>
    <div class="card">
        <div class="card-header">
            <div class="text-header">Edit Shoe</div>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <?php echo $buttonHtml; ?>
                    <label for="username">ID:</label>
                    <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Name:</label>
                    <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Sales:</label>
                    <input type="text" id="sales" name="sales" value="<?php echo $row['sales']; ?>">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Stock:</label>
                    <input type="text" id="stock" name="stock" value="<?php echo $row['stock']; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Price:</label>
                    <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>">
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </form>

        </div>
    </div>
</center>


<?php
mysqli_close($conn);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap-social.css">
<style>
    .card {
        width: 350px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 10px;
    }

    .card-header {
        background-color: #35483c;
        padding: 16px;
        text-align: center;
    }

    .card-header .text-header {
        margin: 0;
        font-size: 18px;
        color: rgb(255, 255, 255);
    }

    .card-body {
        padding: 16px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        color: #333;
        font-weight: bold;
        margin-bottom: 1px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn {
        padding: 12px 24px;
        margin-left: 13px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #35483c;
        color: #fff;
        text-transform: uppercase;
        transition: background-color 0.2s ease-in-out;
        cursor: pointer
    }

    .btn:hover {
        background-color: #ccc;
        color: #333;
    }

    center {
        transform: translateY(5vh);
    }

    .app-content-headerButton {
        background-color: #35483c;
        color: #fff;
        font-size: 14px;
        line-height: 24px;
        border: none;
        border-radius: 4px;
        height: 32px;
        padding: 0 16px;
        transition: 0.2s;
        cursor: pointer;
        transform: translate(5vh);
        margin: 0.25rem;
    }
</style>
<script>
    function redirectToPage() {
        window.location.href = "dashboard2.php";
    }
</script>