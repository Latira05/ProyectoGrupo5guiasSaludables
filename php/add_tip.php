<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "fitness_db");

if ($conn->connect_error) {
    header("Location: ../admin.php?error=Error de conexión a la base de datos");
    exit();
}

$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$created_by = $_SESSION['user_id'];

if (empty($title) || empty($content)) {
    header("Location: ../admin.php?error=Todos los campos son obligatorios");
    exit();
}

$sql = "INSERT INTO tips (title, content, created_by) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $title, $content, $created_by);

if ($stmt->execute()) {
    header("Location: ../admin.php?success=Consejo agregado exitosamente");
} else {
    header("Location: ../admin.php?error=Error al agregar consejo: " . urlencode($conn->error));
}

$stmt->close();
$conn->close();
?>