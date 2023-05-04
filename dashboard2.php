<?php
include 'session_chk.php';
include 'conn.php';

if (!isSessionActive()) {
    header("location: login.html");
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
                    <li data-rel="3" class="sidebar-list-item"><a href="#"><span>Sales</span></a></li>
                    <li data-rel="4" class="sidebar-list-item"><a href="#"><span>Clients</span></a></li>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <li class="sidebar-list-item"><a href="logout.php">Logout</a></li>
            </nav>

        </div>
        <section class="products-area-wrappers" id="printable-section">
            <article>
                <div class=" app-content">
                    <div class="app-content-header">
                        <h1 class="app-content-headerText">Dashboard</h1>
                        <button class="app-content-headerButton" onclick="printSection()"
                            style="transform: translateX(130vh);">Print</button>
                    </div>
                    <?php
                    // Retrieve the products data from the database
                    $sql = "SELECT id, title, sales, stock, price FROM products";
                    $result = mysqli_query($conn, $sql);
                    // Create arrays to store the data
                    $ids = array();
                    $titles = array();
                    $sales = array();
                    $stocks = array();
                    $prices = array();
                    // Loop through the results and add the data to the arrays
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ids[] = $row['id'];
                        $titles[] = $row['title'];
                        $sales[] = (int) $row['sales'];
                        $stocks[] = (int) $row['stock'];
                        $prices[] = (int) $row['price'];
                    }
                    // Create the chart data array
                    $chart_data = array();
                    $chart_data[] = array('Product', 'Sales', 'Stock', 'Price');
                    for ($i = 0; $i < count($ids); $i++) {
                        $chart_data[] = array($titles[$i], $sales[$i], $stocks[$i], $prices[$i]);
                    }
                    // Convert the chart data to JSON format
                    $chart_data_json = json_encode($chart_data);
                    ?>
                    <!DOCTYPE html>
                    <html>

                    <head>
                        <title>Product Sales and Stock Chart</title>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable(<?php echo $chart_data_json; ?>);
                                var options = {
                                    title: 'Product Sales and Stock Levels',
                                    hAxis: { title: 'Product', titleTextStyle: { color: '#333' } },
                                    vAxis: { minValue: 0 },
                                    seriesType: 'bars',
                                    series: { 2: { type: 'line' } }
                                };
                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                        </script>
                        <script>
                            function printSection() {
                                var chartData = <?php echo json_encode($chart_data_json); ?>;
                                var sectionToPrint = document.getElementById("printable-section");
                                var chartDiv = document.createElement("div");
                                chartDiv.innerHTML = "<h2>Sales and Stock Levels</h2>" + chartData;
                                sectionToPrint.appendChild(chartDiv);
                                var newWin = window.open('', 'Print-Window');
                                newWin.document.write('<html><body>' + sectionToPrint.innerHTML + '</body></html>');
                                newWin.document.close();
                                newWin.focus();
                                newWin.print();
                                newWin.close();
                                // Remove the chartDiv from the section after printing
                                sectionToPrint.removeChild(chartDiv);
                            }
                        </script>
                    </head>

                    <body>
                        <div id="chart_div" style="width: 90%; height: 500px;"></div>
                    </body>

                    </html>

            </article>
        </section>

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
                <h4>Section 3</h4>
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