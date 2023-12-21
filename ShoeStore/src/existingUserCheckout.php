<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop ShoeNow</title>
    <link rel="stylesheet" href="style.css">
    <style>
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type=number] {
            width: 50px;
        }
        .table_container {
            margin: 20px auto auto auto;
            font-size: 18pt;
            width: 45%;
            text-align: center;
        }
        button {
            color: white;
            padding: 14px 20px;
            margin: 20px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 8px;
            background-color: green;
        }
        .login_container {
            font-size: 20px;
            padding: 16px;
            width: 45%;
            margin: auto auto auto auto;
        }
    </style>
</head>
<body>
    <img src="../assets/cartoonShoeLogo.png" alt="ShoeHub Logo" class="logo1">
    <img src="../assets/cartoonShoeLogo.png" alt="ShoeHub Logo" class="logo2">
    <h1>ShoeHub</h1>
    <div class="navbar">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="shop.php" class="active">Shop</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="loginform.html">Account</a></li>
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

    //Display each shoe and the user can choose the qty they want
    $shoes = $db->query("SELECT * FROM shoes ORDER BY brand_name");
    echo "<div class='table_container'><form action='processCheckout.php' method='post' name='existingUser'><table>
            <tr>
                <th>Brand</th>
                <th>Shoe Name</th>
                <th>Cost</th>
                <th>QTY</th>
                <th>Size</th>
            </tr>";
    while($row = $shoes->fetch_assoc()) 
    {
        $sizes = $db->query("SELECT * FROM sizes WHERE sizes.sid = ". $row['sid'] ."");
        echo "<tr>";
        echo "<td>". $row['brand_name'] ."</td>";
        echo "<td>". $row['name'] ."</td>";
        echo "<td>". $row['cost'] ."</td>";
        echo "<td><input type='number' name='qty". $row['sid'] ."'></td>";
        echo "<td><select>";
        while($row2 = $sizes->fetch_assoc()) 
        {
            echo "<option>". $row2['size'] ."</option>";
        }
        echo "</select></td>";

        echo "</tr>";
    } 
    echo "</table></div>";

    //User Information
    echo "<div class='login_container'><h3>Existing User Personal Information</h3>";
    echo "<p>Please enter your username and password</p>";
    echo "<label for='username'><b>Username</b></label>
            <input type='text' placeholder='Enter Username' name='username' required>
            <label for='password'><b>Password</b></label>
            <input type='password' placeholder='Enter Password' name='password' required>
            <button type='submit'>Proceed to Checkout</button></form></div>"
    ?>
    
</body>
</html>