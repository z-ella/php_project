<?php
include("dataBase.php");
$err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailValue = $_POST["email"] ?? '';
    $passwordValue = $_POST["password"] ?? '';

    if (!empty($emailValue) && !empty($passwordValue)) {
        $passwordHashed = password_hash($passwordValue, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (Email, Password) VALUES ('$emailValue', '$passwordHashed')";
        if (mysqli_query($connDb, $query)) {
            header("Location: main.php"); // Redirect on successful signup
            exit;
        } else {
            $err = "Error: " . mysqli_error($connDb);
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
    <title>Signup</title>
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
            border-bottom-color: #00d1b2; 
            outline: none;
        }
        .already-account {
            margin-top: 20px;
            font-size: 0.9rem;
            text-align: center;
        }
        .already-account a {
            color: #00d1b2;
            text-decoration: none;
        }
        .already-account a:hover {
            text-decoration: underline;
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
            <button class="button is-link" type="submit">Sign Up</button>
            <?php if ($err): ?>
                <p class="error"><?= htmlspecialchars($err) ?></p>
            <?php endif; ?>
        </form>
        <div class="already-account">
            Already have an account? <a href="login.php">Login here</a>.
        </div>
    </div>

    
    <div class="divider"></div>

    
    <div class="right-section">
        SIGN UP
    </div>
</body>
</html>
