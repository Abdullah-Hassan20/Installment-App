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

// Fetch all data
$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql);

// Handle deletion if delete parameter is set
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the record from the database
    $delete_sql = "DELETE FROM customer WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($stmt, 'i', $delete_id);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Customers - Insaaf Traders</title>
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

        h2 {
            text-align: center;
            color: #e74c3c;
            margin-top: 30px;
        }

        table {
            width: 95%;
            border-collapse: collapse;
            margin: 30px auto;
            background-color: #333;
            color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #e74c3c;
        }

        tr:nth-child(even) {
            background-color: #444;
        }

        tr:hover {
            background-color: #555;
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

        .no-record {
            text-align: center;
            color: #ccc;
            margin-top: 40px;
        }

        .delete-link {
            color: red;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        // JavaScript function to confirm deletion
        function confirmDelete(id) {
            var result = confirm("Are you sure you want to delete this record?");
            if (result) {
                window.location.href = "all.php?delete_id=" + id;  // Redirect to delete record
            }
        }
    </script>
</head>
<body>

<header>
    <h1>Insaaf Traders</h1>
    <small>Where you get everything on easy installment plans</small>
</header>

<div class="nav">
    <a href="home.php">Home</a>
    <a href="add.php">Add Record</a>
    <a href="record.php">Search Record</a>
</div>

<h2>All Customer Records</h2>

<?php if (mysqli_num_rows($result) > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Cell No</th>
            <th>Address</th>
            <th>Total Amount</th>
            <th>Given Amount</th>
            <th>Remaining Amount</th>
            <th>Installment Date</th>
            <th>Action</th> <!-- New column for delete action -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['ID']) ?></td>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                <td><?= htmlspecialchars($row['Cell no']) ?></td>
                <td><?= htmlspecialchars($row['Address']) ?></td>
                <td><?= htmlspecialchars($row['T_amount']) ?></td>
                <td><?= htmlspecialchars($row['G_amount']) ?></td>
                <td><?= htmlspecialchars($row['R_amount']) ?></td>
                <td><?= htmlspecialchars($row['Installment Date']) ?></td>
                <td>
                    <!-- Delete link with confirmation -->
                    <a href="javascript:void(0);" class="delete-link" onclick="confirmDelete(<?= $row['ID'] ?>)">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p class="no-record">No records found.</p>
<?php endif; ?>

<?php mysqli_close($conn); ?>

</body>
</html>


