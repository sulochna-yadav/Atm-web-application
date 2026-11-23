<?php
if (!isset($_GET['acc'])) {
    header("Location: login.php");
    exit();
}
$acc = $_GET['acc'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">ACCOUNT CREATED SUCCESSFULLY</div>

<div class="container">
    <h2>Welcome to Our Bank 🎉</h2>

    <p>Your bank account has been created successfully.</p>

    <p style="font-size:18px; margin-top:15px;">
        <strong>Account Number:</strong><br>
        <span style="font-size:22px; color:#002b5c;"><?php echo $acc; ?></span>
    </p>

    <p style="margin-top:15px; color:#444;">
        Please remember your account number and PIN for future login.
    </p>

    <a href="login.php">
        <button style="margin-top:20px;">Go to Login</button>
    </a>
</div>

</body>
</html>
