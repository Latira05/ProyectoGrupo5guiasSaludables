<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Calorías - Guías Saludables</title>
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
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h2>Calcular Calorías</h2>
        <?php
        session_start();
        $weight = $height = $age = $gender = $activityLevel = '';
        if (isset($_SESSION['user_id'])) {
            $conn = new mysqli("localhost", "root", "root", "fitness_db");
            $user_id = $_SESSION['user_id'];
            $result = $conn->query("SELECT weight, height, age, gender, activity_level FROM users WHERE id = $user_id");
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $weight = $user['weight'];
                $height = $user['height'];
                $age = $user['age'];
                $gender = $user['gender'];
                $activityLevel = $user['activity_level'];
            }
            $conn->close();
        }
        ?>
        <div class="row">
            <div class="col-md-6">
                <form id="calorieForm" class="mb-4">
                    <div class="mb-3">
                        <label for="weight" class="form-label">Peso (kg)</label>
                        <input type="number" step="0.1" class="form-control" id="weight" value="<?php echo htmlspecialchars($weight); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="height" class="form-label">Altura (cm)</label>
                        <input type="number" step="0.1" class="form-control" id="height" value="<?php echo htmlspecialchars($height); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Edad</label>
                        <input type="number" class="form-control" id="age" value="<?php echo htmlspecialchars($age); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Género</label>
                        <select class="form-control" id="gender" required>
                            <option value="male" <?php if ($gender == 'male') echo 'selected'; ?>>Masculino</option>
                            <option value="female" <?php if ($gender == 'female') echo 'selected'; ?>>Femenino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="activityLevel" class="form-label">Nivel de Actividad</label>
                        <select class="form-control" id="activityLevel" required>
                            <option value="sedentary" <?php if ($activityLevel == 'sedentary') echo 'selected'; ?>>Sedentario</option>
                            <option value="lightly_active" <?php if ($activityLevel == 'lightly_active') echo 'selected'; ?>>Ligeramente Activo</option>
                            <option value="moderately_active" <?php if ($activityLevel == 'moderately_active') echo 'selected'; ?>>Moderadamente Activo</option>
                            <option value="very_active" <?php if ($activityLevel == 'very_active') echo 'selected'; ?>>Muy Activo</option>
                            <option value="extra_active" <?php if ($activityLevel == 'extra_active') echo 'selected'; ?>>Extremadamente Activo</option>
                        </select>
                    </div>
                    <button type="button" onclick="calculateCalories()" class="btn btn-success">Calcular</button>
                </form>
                <div id="calorieResult" class="mt-4"></div>
            </div>
            <div class="col-md-6">
                <img src="images/calories.jpeg" class="img-fluid rounded" alt="Cálculo de Calorías">
                <p class="mt-3">Utiliza esta herramienta para estimar tus necesidades calóricas diarias según tu peso, altura, edad, género y nivel de actividad. Recibe recomendaciones personalizadas para alcanzar tus objetivos de salud.</p>
            </div>
        </div>
        <section class="mt-5">
            <h3>¿Qué son BMR y TDEE?</h3>
            <p><strong>BMR (Tasa Metabólica Basal):</strong> Es la cantidad de calorías que tu cuerpo necesita en reposo para mantener funciones básicas como respirar y mantener la temperatura corporal.</p>
            <p><strong>TDEE (Gasto Energético Diario Total):</strong> Es el total de calorías que quemas al día, incluyendo actividad física. Se calcula multiplicando el BMR por un factor según tu nivel de actividad.</p>
            <h3>Consejos para Usar los Resultados</h3>
            <ul>
                <li>Para <strong>mantener tu peso</strong>, consume aproximadamente tu TDEE.</li>
                <li>Para <strong>perder peso</strong>, reduce tu ingesta calórica en un 15-20% por debajo de tu TDEE.</li>
                <li>Para <strong>ganar peso</strong>, aumenta tu ingesta calórica en un 10-15% por encima de tu TDEE.</li>
                <li>Consulta a un nutricionista para un plan personalizado.</li>
            </ul>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>© 2025 Guías Saludables. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>