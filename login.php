<?php
session_start();

// prevent cache
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

$conn = new mysqli("localhost", "root", "", "atm_db");
if ($conn->connect_error) {
    die("Database connection failed");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $acc = $_POST['acc'];
    $pin = $_POST['pin'];

    $checkAcc = $conn->query("SELECT * FROM accounts WHERE acc_no='$acc'");
    if ($checkAcc->num_rows == 0) {
        $error = "Invalid account number. Please contact bank.";
    } else {
        $checkPin = $conn->query("SELECT * FROM accounts WHERE acc_no='$acc' AND pin='$pin'");
if ($checkPin->num_rows == 1) {
    $row = $checkPin->fetch_assoc();
    $_SESSION['acc_no'] = $row['acc_no'];
    $_SESSION['name']   = $row['name'];
    header("Location: dashboard.php");
    exit();
}
else {
            $error = "Incorrect PIN.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ATM Login</title>

    <!-- ✅ THIS LINE IS CRITICAL -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">ATM LOGIN</div>

<div class="container">
    <h2>User Authentication</h2>

    <form method="post">
        <input type="text" name="acc" placeholder="Account Number" required>
        <input type="password" name="pin" placeholder="PIN" required>
        <button type="submit">LOGIN</button>
    </form>

    <?php if ($error != "") { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <hr style="margin:20px 0;">

    <a href="register.php">
        <button type="button">Create Bank Account</button>
    </a>
</div>

</body>
</html>
