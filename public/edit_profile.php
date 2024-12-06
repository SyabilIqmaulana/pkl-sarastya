<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];

    $stmt = $pdo->prepare("UPDATE users SET full_name = :full_name WHERE id = :id");
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':id', $user['id']);

    if ($stmt->execute()) {
        $_SESSION['user']['full_name'] = $full_name;
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile.";
    }
}
?>
<!-- HTML form for editing profile -->
<form method="POST">
    <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" required>
    <button type="submit">Update Profile</button>
</form>
