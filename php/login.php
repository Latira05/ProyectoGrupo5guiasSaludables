<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php?error=Acceso no autorizado");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "root", "fitness_db");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_username, $db_password, $role);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;

            if ($role == 'admin') {
                header("Location: ../php/add_nutrition.php"); 
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            header("Location: ../login.php?error=Contraseña incorrecta");
            exit();
        }
    } else {
        header("Location: ../login.php?error=Usuario no encontrado");
        exit();
    }

    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
    
}
?>
