<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeHub Shop</title>
    <link rel="stylesheet" href="style.css">
    <style>
        button {
            transition-duration: 0.4s;
            cursor: pointer;
            background-color: lightgrey;
            color: black;
            width: 250px;
            height: 80px;
            font-weight: bold;
            border-radius: 8px;
            font-size: 24px;
        }
        button:hover {
            background-color: black;
            color: white;
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
    <div class="button-container">
        <div class="button-center">
            <a href="userInfo.html"><button type="submit">Shop Now</button></a>
        </div>
    </div>
    <?php
    //Connect to db 
    $db = new mysqli("localhost","root","","shoestore");
    if ($db->connect_errno) 
    {
        echo "Failed to connect to the DB server";
        die('Goodbye');
    }

    //Store all of the images for each shoe, ordered by sid
    //Note that when shoes are added to the database, this array needs to be updated
    //If a shoe is not given an image, a cartoon shoe will be the placeholder image (the img in the array)
    $shoeimages = array('../assets/574coreNBforest.png', '../assets/Retro4white.jpg', '../assets/airMax90white.jpg', '../assets/avCrystalLoafers.jpg', 
    '../assets/steelToeTimbs.jpg', '../assets/Retro5CarolinaBlue.webp', '../assets/dunkLows.jpg', '../assets/mb1Lows.jpg',
    '../assets/Rincon3.jpg', '../assets/ultraboostDNA.jpg', '../assets/uggs.jpg', '../assets/trevorLoafers.jpg',
    '../assets/pharaohCapToe.png', '../assets/authenticVans.png',  '../assets/carcartoonShoeLogo.png');

    echo "<div class='grid-container'>";
    $shoes = $db->query("SELECT * FROM shoes");
    $count = 0;
    while($row = $shoes->fetch_assoc()) 
    {
        echo "<div class='box'>
            <img src=". $shoeimages[$count] . ">
            <p>". $row['name'] ."</p>
        </div>";
        $count = $count + 1;
    }
    echo "</div>";
    ?> 
</body>
</html>