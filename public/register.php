<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../config/db.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, full_name) VALUES (:username, :password, :email, :full_name)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':full_name', $full_name);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error during registration.";
    }
}
?>
<!-- HTML form for registration -->
<form method="POST" action="process_register.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Register</button>
</form>

