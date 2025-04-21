<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "fitness_db");
$user_id = $_SESSION['user_id'];
$nutrition = $conn->query("SELECT * FROM nutrition WHERE user_id = $user_id ORDER BY date DESC LIMIT 5");
$exercises = $conn->query("SELECT * FROM exercises WHERE user_id = $user_id ORDER BY date DESC LIMIT 5");
$routines = $conn->query("SELECT * FROM routines WHERE user_id = $user_id LIMIT 5");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Guías Saludables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.php">Guías Saludables</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="nutrition.php">Alimentación</a></li>
                    <li class="nav-item"><a class="nav-link" href="exercises.php">Ejercicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="routines.php">Rutinas</a></li>
                    <li class="nav-item"><a class="nav-link" href="tips.php">Consejos</a></li>
                    <li class="nav-item"><a class="nav-link" href="calories.php">Calcular Calorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="php/logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <section class="mb-5">
            <h3>Resumen de Actividad</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/nutrition.jpg" class="card-img-top" alt="Nutrición">
                        <div class="card-body">
                            <h5 class="card-title">Últimos Alimentos</h5>
                            <ul>
                                <?php while ($item = $nutrition->fetch_assoc()): ?>
                                    <li><?php echo htmlspecialchars($item['food_name']) . " (" . $item['calories'] . " kcal, " . $item['date'] . ")"; ?></li>
                                <?php endwhile; ?>
                            </ul>
                            <a href="nutrition.php" class="btn btn-success">Ver Más</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/exercises.jpg" class="card-img-top" alt="Ejercicios">
                        <div class="card-body">
                            <h5 class="card-title">Últimos Ejercicios</h5>
                            <ul>
                                <?php while ($item = $exercises->fetch_assoc()): ?>
                                    <li><?php echo htmlspecialchars($item['exercise_name']) . " (" . $item['duration'] . " min, " . $item['date'] . ")"; ?></li>
                                <?php endwhile; ?>
                            </ul>
                            <a href="exercises.php" class="btn btn-success">Ver Más</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/dashboard.jpg" class="card-img-top" alt="Rutinas">
                        <div class="card-body">
                            <h5 class="card-title">Tus Rutinas</h5>
                            <ul>
                                <?php while ($item = $routines->fetch_assoc()): ?>
                                    <li><?php echo htmlspecialchars($item['routine_name']); ?></li>
                                <?php endwhile; ?>
                            </ul>
                            <a href="routines.php" class="btn btn-success">Ver Más</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>© 2025 Guías Saludables. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
<?php $conn->close(); ?>