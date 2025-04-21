<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "fitness_db");

if ($conn->connect_error) {
    header("Location: ../exercises.php?error=Error de conexión a la base de datos");
    exit();
}

$exercise_name = trim($_POST['exercise_name'] ?? '');
$duration = intval($_POST['duration'] ?? 0);
$calories_burned = !empty($_POST['calories_burned']) ? intval($_POST['calories_burned']) : null;
$date = $_POST['date'] ?? '';
$user_id = $_SESSION['user_id'];

if (empty($exercise_name) || empty($duration) || empty($date)) {
    header("Location: ../exercises.php?error=Todos los campos obligatorios deben completarse");
    exit();
}

$sql = "INSERT INTO exercises (user_id, exercise_name, duration, calories_burned, date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isiss", $user_id, $exercise_name, $duration, $calories_burned, $date);

if ($stmt->execute()) {
    header("Location: ../exercises.php?success=Ejercicio agregado exitosamente");
} else {
    header("Location: ../exercises.php?error=Error al agregar ejercicio: " . urlencode($conn->error));
}

$stmt->close();
$conn->close();
?>