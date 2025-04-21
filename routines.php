<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutinas - Guías Saludables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.php">Guías Saludables</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="nutrition.php">Alimentación</a></li>
                    <li class="nav-item"><a class="nav-link" href="exercises.php">Ejercicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="tips.php">Consejos</a></li>
                    <li class="nav-item"><a class="nav-link" href="calories.php">Calcular Calorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h2>Gestión de Rutinas</h2>
        <?php
        if (!isset($_SESSION['role'])) {
            echo "<p>Por favor, inicia sesión para ver las rutinas.</p>";
            exit;
        }

        $conn = new mysqli("localhost", "root", "root", "fitness_db");
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        if ($_SESSION['role'] == 'admin') {
        ?>         
            <form action="php/add_routine.php" method="POST" class="mb-4">
                <div class="mb-3">
                    <label for="routine_name" class="form-label">Nombre de la Rutina</label>
                    <input type="text" class="form-control" id="routine_name" name="routine_name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exercises" class="form-label">Ejercicios (separados por comas)</label>
                    <input type="text" class="form-control" id="exercises" name="exercises">
                </div>
                <button type="submit" class="btn btn-success">Crear Rutina</button>
            </form>
        <?php 
        }  

        if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin') {
            $routines = $conn->query("SELECT * FROM routines ORDER BY date DESC");
        ?>
            <h3>Tus Rutinas</h3>
            <div class="row">
                <?php while ($routine = $routines->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($routine['routine_name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($routine['description'] ?: 'Sin descripción'); ?></p>
                                <p><strong>Ejercicios:</strong> <?php echo htmlspecialchars($routine['exercises'] ?: 'Ninguno'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php 
            $conn->close();
        } 
        ?>
        
        <section class="row mt-5 align-items-center">
            <div class="col-md-6">
                <h3>Ejemplo de Rutina</h3>
                <p><strong>Rutina de Fuerza:</strong></p>
                <ul>                    
                    <li>Sentadillas: 3 series de 12 repeticiones</li>
                    <li>Flexiones: 3 series de 15 repeticiones</li>
                    <li>Peso muerto: 3 series de 10 repeticiones</li>
                </ul>
            </div>
            <div class="col-md-6 text-center">
                <img src="images/rutinas.jpg" alt="Rutina de Fuerza" class="img-fluid rounded shadow" style="max-height: 300px;">
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>© 2025 Guías Saludables. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>