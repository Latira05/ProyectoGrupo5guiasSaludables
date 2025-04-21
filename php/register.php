<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = new mysqli("localhost", "root", "root", "fitness_db");

if ($conn->connect_error) {
    header("Location: ../register.php?error=Error de conexión a la base de datos");
    exit();
}

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$weight = floatval($_POST['weight'] ?? 0);
$height = floatval($_POST['height'] ?? 0);
$age = intval($_POST['age'] ?? 0);
$gender = $_POST['gender'] ?? '';
$activityLevel = $_POST['activityLevel'] ?? '';

if (empty($username) || empty($email) || empty($password) || empty($weight) || empty($height) || empty($age) || empty($gender) || empty($activityLevel)) {
    header("Location: ../register.php?error=Todos los campos son obligatorios");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=Correo electrónico inválido");
    exit();
}

if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}/", $password)) {
    header("Location: ../register.php?error=La contraseña debe tener mínimo 8 caracteres, con mayúscula, minúscula, número y símbolo");
    exit();
}

$sql = "SELECT id FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    header("Location: ../register.php?error=El usuario o correo ya existe");
    exit();
}
$stmt->close();

$password_hash = password_hash($password, PASSWORD_BCRYPT);
$sql = "INSERT INTO users (username, email, password, role, weight, height, age, gender, activity_level) VALUES (?, ?, ?, 'user', ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssddiss", $username, $email, $password_hash, $weight, $height, $age, $gender, $activityLevel);

if ($stmt->execute()) {
    header("Location: ../login.php?success=Registro exitoso, inicia sesión");
} else {
    header("Location: ../register.php?error=Error al registrar: " . urlencode($conn->error));
}

$stmt->close();
$conn->close();
?>