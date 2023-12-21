<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        button {
            transition-duration: 0.4s;
            cursor: pointer;
            background-color: darkgrey;
            color: white;
            width: 350px;
            height: 80px;
            font-weight: bold;
            border-radius: 8px;
            font-size: 24px;
        }
        button:hover {
            opacity: 0.8;
        }
        .button-container {
            height: 80px;
            position: relative;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .button-center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
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

        //Make sure we got data 
        if (!$_POST) {
            die ("<p>No information provided.</p>"); 
        }

        //Get username and password
        $username = $_POST['username'];
        $password = $_POST['password'];

        $level = "";
        $fname = "";
    
        //We need to create the customer
        if (isset($_POST['addr'])) {
            $level = $_POST['level'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $phone = $_POST['phone'];
            $addr = $_POST['addr'];
            $db->query("INSERT INTO customers VALUES ('$username', '$password', '$level', '$fname', '$lname', '$phone', '$addr')");
        }

        //User is already created
        else {
            $user = $db->query("SELECT * FROM customers WHERE customers.cusername = '$username' AND customers.password = '$password'");
            if (mysqli_num_rows($user) == 0) {
                die ("<h2>User does not exist.</h2><div class='button_container'><div class='button-center'><a href='userInfo.html'><button>Back to Login</button></a></div></div>");
            }
            $row = $user->fetch_assoc();
            $fname = $row['fname'];
            $level = $row['level'];
        }
        
        //Find the number of shoes we have so we know how many times to loop
        $numShoes = $db->query("SELECT COUNT(name) AS COUNT FROM shoes");
        $row = $numShoes->fetch_assoc();
        $numShoes = $row['COUNT'];

        //Find the oid of the order we are placing (it is one greater than the highest currently placed oid)
        $order = $db->query("SELECT * FROM orders ORDER BY orders.oid DESC LIMIT 1") ;
        $row = $order->fetch_assoc();
        $oid = $row['oid'] + 1;

        //For each shoe, if there is a qty, add the cost to the totalcost
        $totalcost = 0;
        for ($i = 1; $i <= $numShoes; $i++) {
            $qtyID = 'qty' . $i;  
            $qty = $_POST[$qtyID];
            $shoe =  $db->query("SELECT * FROM shoes WHERE shoes.sid = '$i'");
            $row = $shoe->fetch_assoc();
            $cost = $row['cost'];
            if ($qty > 0) 
            {
                $totalcost = $totalcost + $cost;
            }
        }
        
        //Lower totalcost based on user level
        if ($level == 'Silver')
            $totalcost = $totalcost - ($totalcost * 0.05);
        else if ($level == 'Gold')
            $totalcost = $totalcost - ($totalcost * 0.1);
        else if ($level == 'Platinum')
            $totalcost = $totalcost - ($totalcost * 0.20);



        //Add order and place_order to database
        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        // Fetch the current weekday from the database
        $weekdayQuery = $db->query("SELECT WEEKDAY(CURRENT_DATE()) as weekday");
        $weekdayResult = $weekdayQuery->fetch_assoc();
        $currentWeekday = $weekdayResult['weekday'];

        // Use the fetched weekday to get the corresponding day from the array
        $currentDay = $days[$currentWeekday];
        $db->query("INSERT INTO orders VALUES ('$oid', CURRENT_DATE(), '$currentDay', CURRENT_TIME(), '$totalcost', 1)");
        $db->query("INSERT INTO places_order VALUES ('$oid', '$username')");

        //For each shoe ordered, add it to the db
        for ($i = 1; $i <= $numShoes; $i++) {
            $qtyID = 'qty' . $i;  
            $qty = $_POST[$qtyID];
            $shoe =  $db->query("SELECT * FROM shoes WHERE shoes.sid = '$i'");
            $row = $shoe->fetch_assoc();
            if ($qty > 0) 
            {
                $result = $db->query("INSERT INTO order_of VALUES ('$i', '$oid', '$qty')");
            }
        }

        echo "<h2>Thank you for shopping with us, ". $fname .". Your order has been placed.</h2>";
    ?>
    <div class="button-container">
        <div class="button-center">
            <a href="userInfo.html"><button>Place Another Order</button></a>
        </div>
    </div>
</body>
</html>