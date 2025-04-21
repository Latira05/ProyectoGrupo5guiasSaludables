<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consejos - Guías Saludables</title>
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
                    <li class="nav-item"><a class="nav-link" href="routines.php">Rutinas</a></li>
                    <li class="nav-item"><a class="nav-link" href="calories.php">Calcular Calorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h2>Consejos Saludables</h2>
        <div class="text-center mb-4">
            <img src="images/consejos.jpg" alt="Consejo Saludable" class="img-fluid rounded shadow" style="max-height: 300px;">
        </div>
        <?php
        $conn = new mysqli("localhost", "root", "root", "fitness_db");
        $tips = $conn->query("SELECT t.*, u.username FROM tips t JOIN users u ON t.created_by = u.id");
        if ($tips->num_rows > 0) {
            while ($tip = $tips->fetch_assoc()) {
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($tip['title']) . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($tip['content']) . "</p>";
                echo "<p class='card-text'><small class='text-muted'>Por: " . htmlspecialchars($tip['username']) . "</small></p>";
                echo "</div></div>";
            }
        } else {
            echo "<div class='alert alert-info'>No hay consejos disponibles.</div>";
        }
        $conn->close();
        ?>
        <section>
            <h3>Consejo del Día</h3>
            <p><strong>Mantén la constancia:</strong> Pequeños cambios diarios en tu dieta y ejercicio pueden llevar a grandes resultados a largo plazo.</p>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>© 2025 Guías Saludables. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
