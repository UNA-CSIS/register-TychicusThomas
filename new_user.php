<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register New User</title>
</head>
<body>
    <form action="register.php" method="POST">
        <label for="user">Username:</label> 
        <input type="text" id="user" name="user" required><br>
        
        <label for="pwd">Password:</label> 
        <input type="password" id="pwd" name="pwd" minlength="6" required><br>
        
        <label for="repeat">Repeat Password:</label> 
        <input type="password" id="repeat" name="repeat" minlength="6" required><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
