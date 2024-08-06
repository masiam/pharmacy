<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="view.css">
    <style>
        body {
            font-size: 30px;
            padding: 50px;
        }

        .imagecontain {
            position: sticky;
            color: black;
            font-size: 25px;
            margin-top: 0px;
        }

        @media print {
            #printPageButton {
                display: none;
            }
        }

        #printPageButton {
            font-size: 25px;
            background-color: crimson;
            color: white;
            padding: 16px;
            margin-left: 300px;
            width: 20%;
            border: none;
            cursor: pointer;
            opacity: 1;
        }

        img.image {
            height: 1000px;
            width: 900px;
        }

        .align {
            position: absolute;
            top: 60%;
            left: 35%;
            transform: translate(-50%, -50%);
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="imagecontain">
        <img src="Beige%20Black%20Clean%20&%20Minimal%20Business%20Notepad%20(1).png" class="image">

        <div class="align">
     
        <?php
        include "config.php";

        if (isset($_GET['sale_id'])) {
            // Get Sale ID from GET request img src="Beige Black Clean-1.png" class="image">
            $sale_id = $_GET['sale_id'];
            $sale_id = mysqli_real_escape_string($conn, $sale_id);

            // Fetch Sale Data from Database
            $query = "
                SELECT 
                    s.sale_id, 
                    s.s_date, 
                    s.s_time, 
                    s.total_amt, 
                    s.e_id, 
                    s.c_id, 
                    c.c_fname AS patient_name, 
                    c.c_lname AS patient_lastname, 
                    c.c_sex AS gender, 
                    c.c_age AS age
                FROM 
                    sales s
                JOIN 
                    customer c ON s.c_id = c.c_id
                WHERE 
                    s.sale_id = '$sale_id'
            ";

            $result = mysqli_query($conn, $query);

            // Check if Query is Successful
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            // Fetch Sale Items Data from Database
            $query_items = "
                SELECT 
                    si.med_id, 
                    si.sale_qty AS med_qty,
                    m.med_name AS medicine_name 
                FROM 
                    sales_items si
                JOIN 
                    meds m ON si.med_id = m.med_id
                WHERE 
                    si.sale_id = '$sale_id'
            ";

            $result_items = mysqli_query($conn, $query_items);

            // Check if Query is Successful
            if (!$result_items) {
                die("Query failed: " . mysqli_error($conn));
            }

            // Display Sale Data
            if ($row = mysqli_fetch_array($result)) {
                echo "Date: " . $row['s_date'] . "<br />";
                echo "Time: " . $row['s_time'] . "<br />";
                echo "Employee ID: " . $row['e_id'] . "<br />";
                echo "<br />";
                echo "Patient ID: " . $row['c_id'] . "<br />";
                echo "Patient Name: " . $row['patient_name'] . " " . $row['patient_lastname'] . "<br />";
                echo "Gender: " . $row['gender'] . "<br />";
                echo "Age: " . $row['age'] . "<br />";
                echo "<br />";
            }

            // Display Sale Items Data
            echo "Medicines: <br />";
            while ($row_item = mysqli_fetch_array($result_items)) {
                echo "- " . $row_item['medicine_name'] . " (Quantity: " . $row_item['med_qty'] . ")<br />";
            }
            echo "<br />";
            echo "Total Amount: &#8377;" . $row['total_amt'] . "<br />";
            echo "<br />";

            // Close Connection
            mysqli_close($conn);
        } else {
            echo "Sale ID not provided.";
            exit;
        }
        ?>
        </div>
    </div>

    <button id="printPageButton" onClick="window.print();">Print</button>
</body>
</html>
