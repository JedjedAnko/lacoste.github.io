<?php
include 'session_chk.php';
include 'conn.php';

if (!isSessionActive()) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>Lacoste | Dashboard Products</title>
</head>
<style>
    .app-content-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 4px;
    }

    .app-content-headerButton {
        background-color: var(--action-color);
        color: #fff;
        font-size: 14px;
        line-height: 24px;
        border: none;
        border-radius: 4px;
        height: 32px;
        padding: 0 16px;
        transition: 0.2s;
        cursor: pointer;
        transform: translateX(110vh);
        margin: 0.25rem;
    }

    .products-area-wrappers {
        overflow: hidden;
    }
</style>

<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <div class="app-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="app-icon">
                    <img src="https://lacoste.com.ph/media/logo/default/default-logo-desktop_1_1.svg">
                </div>
            </div>

            <nav>
                <ul class="sidebar-list">
                    <li data-rel="1" class="sidebar-list-item active"><a href="#"><span>Dasboard</span></a></li>
                    <li data-rel="2" class="sidebar-list-item"><a href="#"><span>Products</span></a></li>
                    <li data-rel="3" class="sidebar-list-item"><a href="#"><span>Order Details</span></a></li>
                    <li data-rel="4" class="sidebar-list-item"><a href="#"><span>Clients</span></a></li>
                    <li class="sidebar-list-item"><a href="logout.php">Logout</a></li>
            </nav>

        </div>
        <section class="products-area-wrappers" id="printable-section">
            <article>
                <div class=" app-content">
                    <div class="app-content-header">
                        <h1 class="app-content-headerText">Dashboard</h1>
                    </div>

                    <div id="container" style="width: 80%; height: 500px;"></div>
                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "product";
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT id, title, sales, stock FROM products";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $sales = array();
                            $stock = array();
                            $product = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sales[] = (int) $row['sales'];
                                $stock[] = (int) $row['stock'];
                                $product[] = $row['title'];
                            }
                        } else {
                            echo "No results found.";
                        }
                        ?>
                        Highcharts.chart('container', {
                            chart: {
                                type: 'bar',
                                height: 350
                            },
                            title: {
                                text: 'Sales and Stock by Product'
                            },
                            xAxis: {
                                categories: <?php echo json_encode($product); ?>,
                                title: {
                                    text: 'Product'
                                }
                            },
                            yAxis: [{
                                min: 0,
                                title: {
                                    text: 'Sales',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            }, {
                                title: {
                                    text: 'Stock',
                                    align: 'high'
                                },
                                opposite: true
                            }],
                            series: [{
                                name: 'Sales',
                                data: <?php echo json_encode($sales); ?>
                            }, {
                                name: 'Stock',
                                data: <?php echo json_encode($stock); ?>,
                                yAxis: 1
                            }],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 80 // Set the maximum width at which the chart will resize
                                    },
                                    chartOptions: {
                                        chart: {
                                            height: 250 // Set the new height of the chart
                                        }
                                    }
                                }]
                            }
                        });
                    </script>
                </div>
            </article>
        </section>
        <style>
            @media print {
                body * {
                    visibility: hidden;
                }

                #printable-section,
                #printable-section * {
                    visibility: visible;
                }

                #printable-section {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }
        </style>


        <section class="products-area-wrappers"">
            <article>
                <div class=" app-content">
            <div class="app-content-header">
                <h1 class="app-content-headerText">Products</h1>
                <button class="app-content-headerButton" onclick="redirectToPage()"
                    style="transform: translateX(125vh);">Add Product</button>

                <!-- <button class="app-content-headerButton" onclick="printSection()">Print</button> -->
            </div>
            <div class="products-area-wrapper gridView">
                <div class="products-header">
                    <div class="product-cell image">
                        Items
                    </div>
                    <div class="product-cell sales">Sales<button class="sort-button">
                    </div>
                    <div class="product-cell stock">Stock<button class="sort-button">
                    </div>
                    <div class="product-cell price">Price<button class="sort-button">
                    </div>
                </div>
                <?php
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);

                // Check if any rows were returned
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<div class="products-row">';
                        echo '<div class="product-cell image">';
                        echo '<a href="edit1.php?id=' . $row["id"] . '"><img src="uploads/' . $row["image"] . '"></a>';
                        echo '<span>' . $row["title"] . '</span>';
                        echo '</div>';
                        echo '<div class="product-cell sales"><span class="cell-label">Sales:</span>' . $row["sales"] . '</div>';
                        echo '<div class="product-cell stock"><span class="cell-label">Stock:</span>' . $row["stock"] . '</div>';
                        echo '<div class="product-cell price"><span class="cell-label">Price:</span>₱' . $row["price"] . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                ?>
                </article>
        </section>

        <section class="products-area-wrappers">
            <article>
                <div class=" app-content">
                    <div class="app-content-header">
                        <h1 class="app-content-headerText">Order Details</h1>
                    </div>
                    <?php
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all data from orders table
$sql = "SELECT * FROM orders";

// Execute the query
$result = $conn->query($sql);

// Check if there are any records in the table
if ($result->num_rows > 0) {
    // Output table header
    echo "<table>
        <tr>
            <th>ID</th>
            <th>Product ID</th>
            <th>Username</th>
            <th>Quantity</th>
            <th>Total Cost</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["product_id"] . "</td>
            <td>" . $row["user_id"] . "</td>
            <td>" . $row["quantity"] . "</td>
            <td>" . $row["total_cost"] . "</td>
            <td>";

        // Output status dropdown menu button
        echo "<form method='POST' action='update_status.php'>";
        echo "<input type='hidden' name='order_id' value='" . $row["id"] . "' />";
        echo "<select name='status'>
            <option value='Pending' " . ($row["STATUS"] == 'Pending' ? 'selected' : '') . ">Pending</option>
            <option value='Approved' " . ($row["STATUS"] == 'Approved' ? 'selected' : '') . ">Approved</option>
            <option value='Declined' " . ($row["STATUS"] == 'Declined' ? 'selected' : '') . ">Declined</option>
        </select>";
        echo "<button type='submit'>Update</button>";
        echo "</form>";

        echo "</td>
            <td>" . $row["created_at"] . "</td>
        </tr>";
    }

    // Output table footer
    echo "</table>";
} else {
    echo "No records found";
}
?>


            </article>
        </section>

        <section class="products-area-wrappers">
            <article>
                <div class="app-content">
                    <div class="app-content-header">
                        <h1 class="app-content-headerText">Clients</h1>
                        <button class="app-content-headerButton" onclick="redirectToPage2()"
                            style="transform: translateX(133vh);">Add Client</button>
                    </div>

                    <body>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // SQL query to select data from the table
                                $sql = "SELECT * FROM cuser";
                                $result = mysqli_query($conn, $sql);

                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row["id"] . '</td>';
                                    echo '<td>' . $row["Username"] . '</td>';
                                    echo '<td>' . $row["Password"] . '</td>';
                                    echo '<td>';
                                    echo '<button type="button" onclick="window.location.href=\'editclient.php?id=' . $row["id"] . '\'"><i class="fa fa-edit"></i></button>';
                                    echo '&nbsp;&nbsp;';
                                    echo '<button type="button" onclick="if(confirm(\'Do you want to delete that particular product?\')) window.location.href=\'?id=' . $row["id"] . '\';"><i class="fa fa-close"></i></button>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </body>

</html>
</h4>
</article>
</section>

</body>
<script>
    document.querySelector(".jsFilter").addEventListener("click", function () {
        document.querySelector(".filter-menu").classList.toggle("active");
    });

    document.querySelector(".grid").addEventListener("click", function () {
        document.querySelector(".list").classList.remove("active");
        document.querySelector(".grid").classList.add("active");
        document.querySelector(".products-area-wrapper").classList.add("gridView");
        document
            .querySelector(".products-area-wrapper")
            .classList.remove("tableView");
    });

    document.querySelector(".list").addEventListener("click", function () {
        document.querySelector(".list").classList.add("active");
        document.querySelector(".grid").classList.remove("active");
        document.querySelector(".products-area-wrapper").classList.remove("gridView");
        document.querySelector(".products-area-wrapper").classList.add("tableView");
    });

    var modeSwitch = document.querySelector('.mode-switch');
    modeSwitch.addEventListener('click', function () {
        document.documentElement.classList.toggle('light');
        modeSwitch.classList.toggle('active');
    });
</script>
<script>
    function redirectToPage() {
        window.location.href = "product.html";
    }
    // function redirectToPage1() {
    //     window.location.href = "edit.php";
    // }
    function redirectToPage2() {
        window.location.href = "addclient.html";
    }
</script>
<script>
    (function ($) {
        $('nav li').click(function () {
            $(this).addClass('sidebar-list-item active').siblings('li').removeClass('sidebar-list-item active');
            $('section:nth-of-type(' + $(this).data('rel') + ')').stop().fadeIn(400, 'linear').siblings('section').stop().fadeOut(400, 'linear');
        });
    })(jQuery);
</script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/chartData.js"></script>
<script src="js/main.js"></script>
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
    .wrapper {
        position: relative;
        width: 960px;
        padding: 10px;

    }

    section {
        position: absolute;
        display: none;
        top: 10px;
        right: 0;
        width: 1140px;
        min-height: 550px;
        transform: translate(-1vh, -1vh);
        overflow-y: scroll;
    }

    section:first-of-type {
        display: block;
    }

    nav {
        float: left;
        width: 200px;
    }


    .products-area-wrapper {
        width: 100%;
        max-height: 580px;
        padding: 0 4px;
        overflow-y: scroll;
    }

    a {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px 16px;
        color: var(--sidebar-link);
        text-decoration: none;
        font-size: 14px;
        line-height: 24px;
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
</style>

</html>