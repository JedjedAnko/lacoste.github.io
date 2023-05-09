<?php
include 'conn.php';
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status='$status' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Status updated successfully.')</script>";
    } else {
        echo "<script>alert('Error updating status: " . mysqli_error($conn) . "')</script>";
    }
}

?>

<div class="wrapper">
    <section id="orders">
        <div class="products-area-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                        <th>Username</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT orders.id, orders.product_id, products.title, orders.quantity, orders.created_at, orders.updated_at, orders.total_cost, orders.status, cuser.Username FROM orders JOIN cuser ON orders.user_id=cuser.id JOIN products ON orders.product_id=products.id";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["title"] . "</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td>" . $row["total_cost"] . "</td>";
                            echo "<td>";
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
                            echo "<select name='status' onchange='this.form.submit()'>";
                            echo "<option value='pending'" . ($row["status"] == "pending" ? " selected" : "") . ">Pending</option>";
                            echo "<option value='approved'" . ($row["status"] == "approved" ? " selected" : "") . ">Approved</option>";
                            echo "<option value='declined'" . ($row["status"] == "declined" ? " selected" : "") . ">Declined</option>";
                            echo "</select>";
                            echo "<input type='submit' name='submit' value='Update' />";
                            echo "</form>";
                            echo "</td>";
                            echo "<td>" . $row["Username"] . "</td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "<td>" . $row["updated_at"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No orders found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
    function toggleSection(id) {
        var section = document.getElementById(id);
        var sections = document.getElementsByTagName("section");

        for (var i = 0; i < sections.length; i++) {
            sections[i].style.display = "none";
        }

        section.style.display = "block";
    }
</script>
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