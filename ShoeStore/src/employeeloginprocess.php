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
            <li><a href="loginform.html">Account</a></li>
            <li><a href="employeelogin.html" class="active">Employee</a></li>
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
    $eid = $_POST['eid'];
    $password = $_POST['password'];
    $emp = $db->query("SELECT * FROM employees WHERE employees.eid = '$eid' AND employees.password = '$password'");
    if (mysqli_num_rows($emp) == 0) {
        die ("<h2>Employee does not exist.</h2><div class='button_container'><a href='employeelogin.html'><button>Back to Login</button></a></div>");
    }
    else {
        echo "<h2>Warehouses:</h2>";
        $warehouses = $db->query("SELECT * FROM warehouses");
        echo "<div class='table_container'><table style='width:100%'>
            <tr>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Identification Number</th>
            </tr>";
        while($row = $warehouses->fetch_assoc()) 
        {
            echo "<tr>";
            echo "<td>". $row['wcity'] ."</td>";
            echo "<td>". $row['wstate'] ."</td>";
            echo "<td>". $row['wcountry'] ."</td>";
            echo "<td>". $row['wid'] ."</td>";
            echo "</tr>";
        }
        echo "</table></div>";
        echo "<h2>All Orders:</h2>";
        $orders = $db->query("SELECT * FROM orders");
        echo "<div class='table_container'><table style='width:100%'>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Day</th>
                <th>Time</th>
                <th>Totalcost</th>
                <th>Warehouse ID</th>
            </tr>";
        while($row = $orders->fetch_assoc()) 
        {
            echo "<tr>";
            echo "<td>". $row['oid'] ."</td>";
            echo "<td>". $row['odate'] ."</td>";
            echo "<td>". $row['oday'] ."</td>";
            echo "<td>". $row['otime'] ."</td>";
            echo "<td>". $row['totalcost'] ."</td>";
            echo "<td>". $row['wid'] ."</td>";
            echo "</tr>";
        }
        echo "</table></div>";
    }
    ?>
    <div class="button_container">
        <a href="index.html"><button>Logout</button></a>
    </div>
</body>
</html>