<?php
session_start();
if (!isset($_SESSION['acc_no'])) {
    header("Location: login.html");
}

$conn = new mysqli("localhost", "root", "", "atm_db");
$acc = $_SESSION['acc_no'];
$res = $conn->query("SELECT type,amount,time FROM transactions WHERE acc_no='$acc' ORDER BY time DESC LIMIT 5");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mini Statement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">MINI STATEMENT</div>

<div class="container">
    <table>
        <tr><th>Type</th><th>Amount</th><th>Date</th></tr>
        <?php while($row = $res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['type']; ?></td>
            <td>₹<?php echo $row['amount']; ?></td>
            <td><?php echo $row['time']; ?></td>
        </tr>
        <?php } ?>
    </table><br>
    <a href="dashboard.php">⬅ Back</a>
</div>

</body>
</html>
