<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="style.css">
    <style>
        button {
            background-color: darkgrey;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 8px;
        }

        button:hover {
            opacity: 0.8;
        }

        .button_container {
            padding: 16px;
            width: 30%;
            margin: auto;
        }
        .table_container {
            margin: 20px auto auto auto;
            font-size: 18pt;
            width: 60%;
            text-align: center;
        }
    </style>
</head>
<body>
<img src="../assets/cartoonShoeLogo.png" alt="ShoeHub Logo" class="logo1">
    <img src="../assets/cartoonShoeLogo.png" alt="ShoeHub Logo" class="logo2">
    <h1>My Account</h1>
    <div class="navbar">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="loginform.html" class="active">Account</a></li>
            <li><a href="employeelogin.html">Employee</a></li>
        </ul>
    </div>
    <?php
    //Connect to db
    $db = new mysqli("localhost","root","","shoestore");
    if ($db->connect_errno) 
    {
        echo "Failed to connect to the DB server";
        die('Goodbye');
    }

    //Make sure we got data 
    if (!$_POST) {
        die ("<p>No information provided."); 
    }
    
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $orders = $db->query("SELECT * FROM orders NATURAL JOIN places_order NATURAL JOIN customers WHERE customers.cusername = '$uname' AND customers.password = '$pword'");
    $customer = $db->query("SELECT * FROM customers WHERE customers.cusername = '$uname' AND customers.password = '$pword'");
    if (mysqli_num_rows($customer) == 0) {
        die ("<h2>Customer does not exist.</h2><div class='button_container'><a href='loginform.html'><button>Back to Login</button></a></div>");
    }
    $firstrow = $customer->fetch_assoc();
    echo "<h2>Welcome back, ". $firstrow['fname'] ."!</h2>";
    echo "<h2>Past Orders:</h2>";
    // Echo order information to HTML
    echo "<div class='table_container'><table style='width:100%'>
            <tr>
                <th>Order Date</th>
                <th>Order Time</th>
                <th>Total Cost</th>
                <th style='border-right: none;'>Shoes (Quantity)</th>
            </tr>";

    while($row = $orders->fetch_assoc()) 
    {
        if(count($row) == 0) 
        {
            die ("<p style='text-align:center'>No orders.</p>");
        }
        echo "<tr>";
        echo "<td>". $row['odate'] ."</td>";
        echo "<td>". $row['otime'] ."</td>";
        echo "<td>$". $row['totalcost'] ."</td>";
        $shoes = $db->query("SELECT * FROM shoes NATURAL JOIN order_of WHERE order_of.oid = ". $row['oid'] ."");
        while($row2 = $shoes->fetch_assoc()) 
        {
            echo "<td>". $row2['name'] . " (" . $row2['qty']  .")</td></tr>";
            echo "<tr><td style='border:none;'></td><td style='border:none;'></td><td style='border:none;'></td>";
        }
        echo "</tr>";
    } 
    echo "</table></div>";
    ?>
    <div class="button_container">
        <a href="index.html"><button>Logout</button></a>
    </div>
</body>
</html>