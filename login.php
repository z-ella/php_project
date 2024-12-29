<?php
include("dataBase.php");
$err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailValue = $_POST["email"] ?? '';
    $passwordValue = $_POST["password"] ?? '';

    if (!empty($emailValue) && !empty($passwordValue)) {
        $query = "SELECT Password FROM users WHERE Email = '$emailValue'";
        $result = mysqli_query($connDb, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($passwordValue, $row['Password'])) {
                header("Location: main.php"); // Redirect on successful login
                exit;
            } else {
                $err = "Incorrect email or password.";
            }
        } else {
            $err = "Incorrect email or password.";
        }
    } else {
        $err = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login - Business Link</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #001f3f; 
            color: white;
        }
        .left-section {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .left-section .field {
            margin-bottom: 20px;
        }
        .left-section label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .left-section input {
            background: transparent;
            border: none;
            border-bottom: 1px solid #ccc;
            color: white;
            width: 100%;
            padding: 5px;
            font-size: 1rem;
        }
        .left-section input:focus {
            border-bottom-color: #00d1b2; /* Bulma's link color */
            outline: none;
        }
        .divider {
            width: 1px;
            background: #ccc;
            height: 100%;
        }
        .right-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 5rem;
            font-weight: bold;
            text-transform: uppercase;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Left Section -->
    <div class="left-section">
        <form method="POST">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button class="button is-link" type="submit">Login</button>
            <?php if ($err): ?>
                <p class="error"><?= htmlspecialchars($err) ?></p>
            <?php endif; ?>
        </form>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Right Section -->
    <div class="right-section">
        LOGIN
    </div>
</body>
</html>
