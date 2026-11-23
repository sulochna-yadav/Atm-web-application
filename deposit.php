<?php
session_start();
if (!isset($_SESSION['acc_no'])) {
    header("Location: login.html");
}

$conn = new mysqli("localhost", "root", "", "atm_db");
$acc = $_SESSION['acc_no'];
$msg = "";

if (isset($_POST['amount'])) {
    $amt = $_POST['amount'];
    if ($amt > 0) {
        $conn->query("UPDATE accounts SET balance = balance + $amt WHERE acc_no='$acc'");
        $conn->query("INSERT INTO transactions (acc_no,type,amount) VALUES ('$acc','Deposit',$amt)");
        $msg = "₹$amt deposited successfully";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Deposit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">DEPOSIT MONEY</div>

<div class="container">
    <h2>Deposit Amount</h2>
    <form method="post">
        <input type="number" name="amount" placeholder="Enter amount" required>
        <button>Deposit</button>
    </form>
    <p style="color:green;"><?php echo $msg; ?></p>
    <a href="dashboard.php">⬅ Back</a>
</div>

</body>
</html>
