<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>Lacoste | Edit Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #35483c;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .panel {
            transform: translate(-15vh, -5%);
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
            transform: translate(5vh, -5vh);
            margin: 0.25rem;
            z-index: 100;
            position: absolute;
        }

        .ts-main-content {
            transform: translateY(-10vh);
        }
    </style>

</head>

<body>

    <button class="app-content-headerButton" onclick="redirectToPage()">Go Back</button>
    <div class="ts-main-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Manage Shoes</h2>
                        <!-- Zero Configuration Table -->
                        <div class="panel">
                            <div class="panel-heading">Shoe Details</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Sales</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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

                                            // Delete record if ID is set in the URL
                                            if (isset($_GET["id"])) {
                                                $id = $_GET["id"];
                                                $sql = "DELETE FROM products WHERE id = $id";
                                                if ($conn->query($sql) === TRUE) {
                                                    // Record was successfully deleted
                                                } else {
                                                    echo "Error deleting record: " . $conn->error;
                                                }
                                            }

                                            $sql = "SELECT * FROM products";
                                            $result = mysqli_query($conn, $sql);

                                            // Check if any rows were returned
                                            if (mysqli_num_rows($result) > 0) {
                                                // Output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row["id"] . '</td>';
                                                    echo '<td>' . $row["title"] . '</td>';
                                                    echo '<td>' . $row["sales"] . '</td>';
                                                    echo '<td>' . $row["stock"] . '</td>';
                                                    echo '<td>₱' . $row["price"] . '</td>';
                                                    echo '<td>';
                                                    echo '<button type="button" onclick="window.location.href=\'edit1.php?id=' . $row["id"] . '\'"><i class="fa fa-edit"></i></button>';
                                                    echo '&nbsp;&nbsp;';
                                                    echo '<button type="button" onclick="if(confirm(\'Do you want to delete that particular product?\')) window.location.href=\'?id=' . $row["id"] . '\';"><i class="fa fa-close"></i></button>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                            } else {
                                                echo '<tr><td colspan="6">0 results</td></tr>';
                                            }

                                            // Close database connection
                                            mysqli_close($conn);
                                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/chartData.js"></script>
<script src="js/main.js"></script>
<script>
    function redirectToPage() {
        window.location.href = "dashboard2.php";
    }
</script>

</html>