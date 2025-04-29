<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$auth = new Auth();

if (!$auth->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user = $auth->getUserInfo();
$db = new Database();
$conn = $db->getConnection();

// Obtener estadísticas
$stats = [
    'aspirantes' => 0,
    'activos' => 0,
    'asistencias_hoy' => 0
];

// Total aspirantes
$result = $conn->query("SELECT COUNT(*) as total FROM aspirantes");
$stats['aspirantes'] = $result->fetch_assoc()['total'];


// Asistencias hoy
$today = date('Y-m-d');
$result = $conn->query("SELECT COUNT(*) as total FROM asistencia WHERE fecha = '$today'");
$stats['asistencias_hoy'] = $result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Bienvenido <?php echo htmlspecialchars($user['nombre_completo']); ?></h1>

        <!-- Estadísticas -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Aspirantes</h3>
                <p><?php echo $stats['aspirantes']; ?></p>
            </div>

            <div class="stat-card">
                <h3>Aspirantes Activos</h3>
                <p><?php echo $stats['activos']; ?></p>
            </div>

            <div class="stat-card">
                <h3>Asistencias Hoy</h3>
                <p><?php echo $stats['asistencias_hoy']; ?></p>
            </div>
        </div>

        <!-- Módulos -->
        <div class="dashboard-cards">
            <div class="card">
                <h2>Aspirantes</h2>
                <p>Gestión de aspirantes</p>
                <a href="modules/aspirantes/" class="btn btn-primary">Acceder</a>
            </div>

            <div class="card">
                <h2>Asistencia</h2>
                <p>Control de asistencia</p>
                <a href="modules/asistencia/" class="btn btn-primary">Acceder</a>
            </div>

            <div class="card">
                <h2>Materias</h2>
                <p>Gestión de materias</p>
                <a href="modules/materias/" class="btn btn-primary">Acceder</a>
            </div>

            <?php if ($user['rol'] === 'admin'): ?>
                <div class="card">
                    <h2>Usuarios</h2>
                    <p>Gestión de usuarios</p>
                    <a href="modules/usuarios/" class="btn btn-primary">Acceder</a>
                </div>

                <div class="card">
                    <h2>Reportes</h2>
                    <p>Generar reportes</p>
                    <a href="modules/reportes/" class="btn btn-primary">Acceder</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
    <script src="../../assets/js/usuarios.js"></script>
</body>

</html>