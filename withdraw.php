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
    $res = $conn->query("SELECT balance FROM accounts WHERE acc_no='$acc'");
    $bal = $res->fetch_assoc()['balance'];

    if ($amt > 0 && $bal >= $amt) {
        $conn->query("UPDATE accounts SET balance = balance - $amt WHERE acc_no='$acc'");
        $conn->query("INSERT INTO transactions (acc_no,type,amount) VALUES ('$acc','Withdraw',$amt)");
        $msg = "₹$amt withdrawn successfully";
    } else {
        $msg = "Insufficient balance";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Withdraw</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">WITHDRAW MONEY</div>

<div class="container">
    <h2>Withdraw Amount</h2>
    <form method="post">
        <input type="number" name="amount" placeholder="Enter amount" required>
        <button>Withdraw</button>
    </form>
    <p style="color:red;"><?php echo $msg; ?></p>
    <a href="dashboard.php">⬅ Back</a>
</div>

</body>
</html>
