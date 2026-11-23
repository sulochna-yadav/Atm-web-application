<?php
session_start();

// prevent browser cache
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

// login protection
if (!isset($_SESSION['acc_no'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ATM Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">ATM DASHBOARD</div>

<div class="container">
    <h2>Welcome</h2>

    <p><strong>Account:</strong> <?php echo $_SESSION['acc_no']; ?></p>

    <div class="menu">
        <a href="balance.php">💰 Check Balance</a>
        <a href="deposit.php">➕ Deposit Money</a>
        <a href="withdraw.php">➖ Withdraw Money</a>
        <a href="mini.php">🧾 Mini Statement</a>
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

</body>
</html>
