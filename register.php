<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } else if (registerUser($email, $password)) {
        header('Location: login.php');
        exit();
    } else {
        $error = 'Registration failed. Email might already be in use.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>FoodieBayan - Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="logo"></div>
            <div class="brand-name">FoodieBayan</div>
            <div class="tagline">Where Quality meets Expectations!</div>
        </div>
        <div class="right-panel">
            <div class="form-container">
                <h2 class="form-title">Sign-up</h2>
                <?php if ($error): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn-submit">Register</button>
                    <div class="form-footer">
                        <a href="login.php">Already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

