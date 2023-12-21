<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>
    <img src="../assets/cartoonShoeLogo.png" alt="ShoesNow Logo" class="logo1">
    <img src="../assets/cartoonShoeLogo.png" alt="ShoesNow Logo" class="logo2">
    <h1>About Us</h1>
    <div class="navbar">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about_us.php" class="active">About Us</a></li>
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

    //Queries
    $numEmps = $db->query("SELECT COUNT(*) AS COUNT FROM employees");
    $row = $numEmps->fetch_assoc();
    $numEmps = $row['COUNT'];

    $numCombs = $db->query("SELECT COUNT(*) AS COUNT FROM colorways");
    $row = $numCombs->fetch_assoc();
    $numCombs = $row['COUNT'];

    $numWares = $db->query("SELECT COUNT(*) AS COUNT  FROM warehouses");
    $row = $numWares->fetch_assoc();
    $numWares = $row['COUNT'];

    $numBrands = $db->query("SELECT COUNT(DISTINCT brand_name)  AS COUNT FROM shoes");
    $row = $numBrands->fetch_assoc();
    $numBrands = $row['COUNT'];

    
    echo "
    <div class='subpage_container'>
        <p style='text-align: center; font-size:22pt;'>At ShoeHub, we believe in more than just selling shoes; we're passionate about providing an experience that goes beyond the ordinary.
            As a team of dedicated footwear enthusiasts, we've curated a collection that reflects our commitment to quality, style, and customer satisfaction. 
        </p>
        <h3>Our Mission</h3>
        <p><b>Curated Selection:</b> Every shoe in our collection is handpicked for its quality, comfort, and unique style. We offer $numCombs different combinations of shoe style and colorway from a total of $numBrands different brands.</p>
        <p><b>Dedicated workforce:</b> We currently have $numEmps employees across $numWares warehouses across the globe, mainly based in the United States.</p>
        <p><b>Customer-Centric Approach:</b> Your satisfaction is our priority. From the moment you step into our virtual store, we're here to assist you. Our knowledgeable team is ready to help you find the perfect pair that suits your needs and preferences.</p>
    
    "
    ?>
        <h3 style="text-align:center" id="jump_here">Customer Levels</h3>
        <p>At ShoeHub, we believe in celebrating our valued customers by offering an exclusive Customer Loyalty Program designed to enhance your shopping experience. 
            We've crafted four distinctive tiers &#8212; Bronze, Silver, Gold, and Platinum &#8212; each tailored to reward your loyalty with special privileges and benefits.</p>
        <h4>Bronze Level:</h4>
        <ul>
            <li><b>Discount:</b> Enjoy the regular prices for our high-quality shoes.</li>
            <li><b>Membership Cost:</b> No additional cost.</li>
        </ul>
        <h4>Silver Level:</h4>
        <ul>
            <li><b>Discount:</b> 5% discount on all your purchases.</li>
            <li><b>Membership Cost:</b> $4.99 a month.</li>
        </ul>
        <h4>Gold Level:</h4>
        <ul>
            <li><b>Discount:</b> 10% discount on all your purchases.</li>
            <li><b>Membership Cost:</b> $9.99 a month.</li>
        </ul>
        <h4>Platinum Level:</h4>
        <ul>
            <li><b>Discount:</b> 20% discount on all your purchases.</li>
            <li><b>Membership Cost:</b> $14.99 a month.</li>
        </ul>
    </div>
</body>
</html>