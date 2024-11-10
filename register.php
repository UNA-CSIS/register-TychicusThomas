<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
</head>
<body>
    <?php
    require_once 'db_connection.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars(trim($_POST['user']));
        $password = trim($_POST['pwd']);
        $repeatPassword = trim($_POST['repeat']);

        if ($password !== $repeatPassword) {
            echo 'Passwords do not match. <a href="new_user.php">Try again</a>.';
            exit;
        }

        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo 'Username already taken. <a href="new_user.php">Choose another username</a>.';
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the users table
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);
        if ($stmt->execute()) {
            echo "Registration successful. You can now <a href='index.php'>login</a>.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo '<p>Invalid request method. Please use the <a href="new_user.php">registration form</a>.</p>';
    }
    ?>
</body>
</html>
