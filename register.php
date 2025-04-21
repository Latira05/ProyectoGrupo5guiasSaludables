<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Guías Saludables</title>
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
                    <li class="nav-item"><a class="nav-link" href="tips.php">Consejos</a></li>
                    <li class="nav-item"><a class="nav-link" href="calories.php">Calcular Calorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h2 class="text-center">Registrarse</h2>
        <?php
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
        }
        if (isset($_GET['success'])) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['success']) . "</div>";
        }
        ?>
        <form id="registerForm" action="php/register.php" method="POST" class="col-md-6 mx-auto">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}" title="Mínimo 8 caracteres, con mayúscula, minúscula, número y símbolo">
                <small class="form-text text-muted">Mínimo 8 caracteres, con mayúscula, minúscula, número y símbolo.</small>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Peso (kg)</label>
                <input type="number" step="0.1" class="form-control" id="weight" name="weight" required>
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Altura (cm)</label>
                <input type="number" step="0.1" class="form-control" id="height" name="height" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Edad</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Género</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="male">Masculino</option>
                    <option value="female">Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="activityLevel" class="form-label">Nivel de Actividad</label>
                <select class="form-control" id="activityLevel" name="activityLevel" required>
                    <option value="sedentary">Sedentario</option>
                    <option value="lightly_active">Ligeramente Activo</option>
                    <option value="moderately_active">Moderadamente Activo</option>
                    <option value="very_active">Muy Activo</option>
                    <option value="extra_active">Extremadamente Activo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Registrarse</button>
        </form>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>© 2025 Guías Saludables. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>