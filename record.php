<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "record";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $database, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$customerData = null;
$editSuccess = null;

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $cell = $_POST['cell'];
    $t_amount = $_POST['t_amount'];
    $g_amount = $_POST['g_amount'];
    $r_amount = $_POST['r_amount'];
    $installment = $_POST['installment'];

    $updateSql = "UPDATE customer SET `Name`=?, `Address`=?, `Cell no`=?, `T_amount`=?, `G_amount`=?, `R_amount`=?, `Installment Date`=? WHERE ID=?";
    $stmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $name, $address, $cell, $t_amount, $g_amount, $r_amount, $installment, $id);

    if (mysqli_stmt_execute($stmt)) {
        $editSuccess = "Customer record updated successfully!";
    } else {
        $editSuccess = "Failed to update record.";
    }
    mysqli_stmt_close($stmt);
}

// Handle search
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['number'])) {
    $id = $_POST['number'];
    $sql = "SELECT * FROM customer WHERE ID = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $customerData = mysqli_fetch_assoc($result);
    } else {
        $customerData = "No record found for ID $id.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Customer - Insaaf Traders</title>
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

        form {
            max-width: 400px;
            margin: 30px auto;
            background-color: #2c2c2c;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #000;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 15px;
            background-color: #444;
            color: white;
        }

        button {
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #c0392b;
        }

        .result {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            color: white;
        }

        .result p {
            margin: 8px 0;
        }

        .no-record {
            text-align: center;
            color: #e74c3c;
            font-weight: bold;
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
    <a href="add.php">Add Record</a>
    <a href="all.php">All Records</a>
</div>

<form method="post" action="">
    <label for="number">Enter ID:</label>
    <input type="number" id="number" name="number" required>
    <button type="submit">Search</button>
</form>

<?php if ($editSuccess): ?>
    <p class="result" style="text-align:center; color:lightgreen;"><?= $editSuccess ?></p>
<?php endif; ?>

<?php if ($customerData): ?>
    <?php if (is_array($customerData)): ?>
        <form class="result" method="post" action="">
            <h3>Edit Customer Info:</h3>
            <input type="hidden" name="id" value="<?= htmlspecialchars($customerData['ID']) ?>">

            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($customerData['Name']) ?>" required>

            <label>Address:</label>
            <input type="text" name="address" value="<?= htmlspecialchars($customerData['Address']) ?>" required>

            <label>Phone:</label>
            <input type="text" name="cell" value="<?= htmlspecialchars($customerData['Cell no']) ?>" required>

            <label>Total Amount:</label>
            <input type="text" name="t_amount" value="<?= htmlspecialchars($customerData['T_amount']) ?>" required>

            <label>Given Amount:</label>
            <input type="text" name="g_amount" value="<?= htmlspecialchars($customerData['G_amount']) ?>" required>

            <label>Remaining Amount:</label>
            <input type="text" name="r_amount" value="<?= htmlspecialchars($customerData['R_amount']) ?>" required>

            <label>Installment Date:</label>
            <input type="text" name="installment" value="<?= htmlspecialchars($customerData['Installment Date']) ?>" required>

            <button type="submit" name="update">Update</button>
        </form>
    <?php else: ?>
        <p class="no-record"><?= $customerData ?></p>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>


