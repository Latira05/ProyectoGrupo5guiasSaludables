<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "fitness_db");

if ($conn->connect_error) {
    header("Location: ../nutrition.php?error=Error de conexión a la base de datos");
    exit();
}

$food_name = trim($_POST['food_name'] ?? '');
$calories = intval($_POST['calories'] ?? 0);
$date = $_POST['date'] ?? '';
$user_id = $_SESSION['user_id'];

if (empty($food_name) || empty($calories) || empty($date)) {
    header("Location: ../nutrition.php?error=Todos los campos son obligatorios");
    exit();
}

$sql = "INSERT INTO nutrition (user_id, food_name, calories, date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isis", $user_id, $food_name, $calories, $date);

if ($stmt->execute()) {
    header("Location: ../nutrition.php?success=Alimento agregado exitosamente");
} else {
    header("Location: ../nutrition.php?error=Error al agregar alimento: " . urlencode($conn->error));
}

$stmt->close();
$conn->close();
?>