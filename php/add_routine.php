<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "fitness_db");

if ($conn->connect_error) {
    header("Location: ../routines.php?error=Error de conexión a la base de datos");
    exit();
}

$routine_name = trim($_POST['routine_name'] ?? '');
$description = trim($_POST['description'] ?? '');
$exercises = trim($_POST['exercises'] ?? '');
$user_id = $_SESSION['user_id'];

if (empty($routine_name)) {
    header("Location: ../routines.php?error=El nombre de la rutina es obligatorio");
    exit();
}

$sql = "INSERT INTO routines (user_id, routine_name, description, exercises) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $routine_name, $description, $exercises);

if ($stmt->execute()) {
    header("Location: ../routines.php?success=Rutina creada exitosamente");
} else {
    header("Location: ../routines.php?error=Error al crear rutina: " . urlencode($conn->error));
}

$stmt->close();
$conn->close();
?>