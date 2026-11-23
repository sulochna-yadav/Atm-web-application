<?php
$conn = new mysqli("localhost", "root", "", "atm_db");
if ($conn->connect_error) {
    die("Database connection failed");
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // CHECK TERMS & CONDITIONS
    if (!isset($_POST['terms'])) {
        $msg = "❌ Please accept Terms & Conditions to continue.";
    } else {

        $name = $_POST['name'];
        $pin = $_POST['pin'];
        $balance = $_POST['balance'];

        // PIN validation (exactly 4 digits)
        if (!preg_match("/^[0-9]{4}$/", $pin)) {
            $msg = "❌ PIN must be exactly 4 digits.";
        }
        // Minimum balance validation
        else if ($balance < 500) {
            $msg = "❌ Minimum opening balance is ₹500.";
        } 
        else {

            // Generate random account number
            $acc_no = rand(100000, 999999);

            // Insert account
           $sql = "INSERT INTO accounts (acc_no, name, pin, balance)
        VALUES ('$acc_no', '$name', '$pin', '$balance')";

            if ($conn->query($sql)) {
                header("Location: register_success.php?acc=$acc_no");
                exit();
            } else {
                $msg = "❌ Error creating account.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Bank Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">CREATE BANK ACCOUNT</div>

<div class="container">
    <h2>New Account Registration</h2>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>

        <input type="password" name="pin" placeholder="Set 4-digit PIN" required>

        <input type="number" name="balance" placeholder="Initial Deposit (Min ₹500)" required>

        <label style="font-size:14px; display:block; margin:10px 0; text-align:left;">
            <input type="checkbox" name="terms">
            I agree to the <a href="#">Terms & Conditions</a>
        </label>

        <button type="submit">Create Account</button>
    </form>

    <?php if (!empty($msg)) { ?>
        <p style="margin-top:10px; font-weight:bold; color:red;">
            <?php echo $msg; ?>
        </p>
    <?php } ?>

    <br>
    <a href="login.php">⬅ Back to Login</a>
</div>

</body>
</html>
