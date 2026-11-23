<?php
session_start();
if (!isset($_SESSION['acc_no'])) {
    header("Location: login.html");
}

$conn = new mysqli("localhost", "root", "", "atm_db");
$acc = $_SESSION['acc_no'];
$result = $conn->query("SELECT balance FROM accounts WHERE acc_no='$acc'");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Balance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">ACCOUNT BALANCE</div>

<div class="container">
    <h2>Balance Details</h2>
    <p><strong>Account:</strong> <?php echo $acc; ?></p>
    <p><strong>Balance:</strong> ₹<?php echo $row['balance']; ?></p><br>
    <a href="dashboard.php">⬅ Back</a>
</div>

</body>
</html>
