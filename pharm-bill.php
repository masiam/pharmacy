<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="table1.css">
<title>Sales Invoice</title>
</head>

<body>

<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> Medical Store Management System </h2>
			<p style="margin-top:-20px;color:white;line-height:1;font-size:12px;text-align:center">Developed by, Aditya Raj, 2024</p>
			<a href="pharmmainpage.php">Dashboard</a>
			
			<a href="pharm-inventory.php">View Inventory</a>
			<a href="pharm-pos1.php">Add New Sale</a>
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="pharm-customer.php">Add New Customer</a>
				<a href="pharm-customer-view.php">View Customers</a>
			</div>
			<a href="pharm-bill.php">bill Details</a>

	</div>

<div class="topnav">
    <a href="logout.php">Logout</a>
</div>

<center>
<div class="head">
    <h2>SALES INVOICE DETAILS</h2>
</div>
</center>

<table align="right" id="table1" style="margin-right:100px;">
    <tr>
        <th>Sale ID</th>
        <th>Customer ID</th>
        <th>Date and Time</th>
        <th>Sale Amount</th>
        <th>Employee ID</th>
        <th>View</th>
    </tr>

    <?php
    include "config.php";

    $sql = "SELECT sale_id, c_id, s_date, s_time, total_amt, e_id FROM sales";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["sale_id"]. "</td>";
            echo "<td>" . $row["c_id"] . "</td>";
            echo "<td>" . $row["s_date"]."&nbsp;&nbsp;".$row["s_time"]."</td>";
            echo "<td>" . $row["total_amt"]. "</td>";
            echo "<td>" . $row["e_id"]. "</td>";
            echo "<td><a href='viewbill.php?sale_id=" . $row["sale_id"] . "'>View</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } 
    $conn->close();
    ?>

<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>

</body>
</html>
