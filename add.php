<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "record";
$port = 3307;

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $database, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Customer ID manually entered by the user
    $name = $_POST['name'];
    $address = $_POST['address'];
    $cellno = $_POST['cellno'];
    $total = $_POST['t'];
    $given = $_POST['g'];
    $remaining = $_POST['r'];
    $installment_date = $_POST['installment_date'];

    if ($id && $name && $address && $cellno && $total && $given && $remaining && $installment_date) {
        $sql = "INSERT INTO customer (`ID`, `Name`, `Address`, `Cell no`, `T_amount`, `G_amount`, `R_amount`, `Installment Date`) 
                VALUES ('$id', '$name', '$address', '$cellno', '$total', '$given', '$remaining', '$installment_date')";

        if (mysqli_query($conn, $sql)) {
            $message = '<p class="success">Data inserted successfully! Customer ID: ' . $id . '</p>';
        } else {
            $message = '<p class="error">Error inserting data! Please check if the ID already exists.</p>';
        }
    } else {
        $message = '<p class="error">Please fill all fields!</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer - Insaaf Traders</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #e74c3c;
            padding: 30px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 36px;
        }

        header small {
            display: block;
            font-size: 16px;
            color: #f9f9f9;
            margin-top: 8px;
        }

        .nav {
            text-align: center;
            background-color: #111;
            padding: 15px 0;
        }

        .nav a {
            margin: 0 20px;
            text-decoration: none;
            color: #e74c3c;
            font-weight: bold;
            font-size: 16px;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        .form-card {
            width: 90%;
            max-width: 500px;
            margin: 50px auto;
            background-color: #2c2c2c;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #000;
        }

        .form-card label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-card input[type="text"],
        .form-card input[type="number"],
        .form-card input[type="date"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 15px;
            background-color: #444;
            color: white;
        }

        .form-card button {
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        .form-card button:hover {
            background-color: #c0392b;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
        }

        .message p {
            font-size: 18px;
        }

        .message .error {
            color: #c0392b;
        }

        .message .success {
            color: #27ae60;
        }

    </style>
</head>
<body>

<header>
    <h1>Insaaf Traders</h1>
    <small>Where you get everything on easy installment plans</small>
</header>

<div class="nav">
    <a href="home.php">Home</a>
    <a href="record.php">Search Record</a>
    <a href="all.php">All Records</a>
</div>

<main>
    <div class="form-card">
        <?php echo $message; ?>
        <form id="addForm" action="add.php" method="post">
            <label for="id">Customer ID</label>
            <input type="number" id="id" name="id" placeholder="Enter Customer ID" required>

            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter Name" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Enter Address" required>

            <label for="cellno">Phone</label>
            <input type="number" id="cellno" name="cellno" placeholder="Enter Phone" required>

            <label for="t">Total Amount</label>
            <input type="text" id="t" name="t" placeholder="Enter Total Amount" required>

            <label for="g">Given Amount</label>
            <input type="text" id="g" name="g" placeholder="Enter Given Amount" required>

            <label for="r">Remaining Amount</label>
            <input type="text" id="r" name="r" placeholder="Enter Remaining Amount" required>

            <label for="installment_date">Installment Date</label>
            <input type="text" id="installment_date" name="installment_date" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</main>

</body>
</html>


