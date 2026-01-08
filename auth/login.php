<?php require('../config/db.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Wazuh Security Lab</title>

    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h1>🛡️ Wazuh Lab</h1>
        <p class="subtitle">Authorized Access Only</p>

        <form method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <?php
        if ($_POST) {
            $user = $_POST['username'];
            $pass = $_POST['password'];

            // VULNERABLE (Lab Purpose)
            $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                header("Location: ../admin/index.php");
                exit;
            } else {
                echo '<div class="error">❌ Login gagal</div>';
            }
        }
        ?>
    </div>
</div>

</body>
</html>
