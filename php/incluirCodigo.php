<?php
session_start();
$weight = $height = $age = $gender = $activityLevel = '';
$role = '';

if (isset($_SESSION['user_id'])) {
    $conn = new mysqli("localhost", "root", "root", "fitness_db");
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT weight, height, age, gender, activity_level, role FROM users WHERE id = $user_id");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $weight = $user['weight'];
        $height = $user['height'];
        $age = $user['age'];
        $gender = $user['gender'];
        $activityLevel = $user['activity_level'];
        $role = $user['role'];
        $_SESSION['role'] = $role;
    }

    $conn->close();
}
?>
