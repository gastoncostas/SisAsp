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

// Obtener información de la división si está disponible
$division_info = '';
if (isset($user['division_name'])) {
    $division_info = $user['division_name'];
}

// Obtener estadísticas
$stats = [
    'aspirantes' => 0,
    'activos' => 0,
    'asistencias_hoy' => 0
];

// Total aspirantes
$result = $conn->query("SELECT COUNT(*) as total FROM aspirantes");
$stats['aspirantes'] = $result->fetch_assoc()['total'];

// Aspirantes activos
$result = $conn->query("SELECT COUNT(*) as total FROM aspirantes WHERE estado = 'activo'");
$stats['activos'] = $result->fetch_assoc()['total'];

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
        <div class="welcome-header">
            <h1>Bienvenido <?php echo htmlspecialchars($user['nombre_completo']); ?></h1>
            <?php if ($division_info): ?>
                <p class="division-badge">
                    <span class="badge badge-primary"><?php echo htmlspecialchars($division_info); ?></span>
                </p>
            <?php endif; ?>
            <p class="user-role">Rol: <?php echo ucfirst($user['rol']); ?></p>
        </div>

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
                <p>Gestión completa de aspirantes: registro, edición y seguimiento de su progreso académico</p>
                <a href="modules/aspirantes/" class="btn btn-primary">Acceder</a>
            </div>

            <div class="card">
                <h2>Asistencia</h2>
                <p>Control y registro de asistencia por materia y fecha, con observaciones personalizadas</p>
                <a href="modules/asistencia/" class="btn btn-primary">Acceder</a>
            </div>

            <div class="card">
                <h2>Materias</h2>
                <p>Administración de materias, profesores y carga horaria del plan de estudios</p>
                <a href="modules/materias/" class="btn btn-primary">Acceder</a>
            </div>

            <?php if ($user['rol'] === 'admin'): ?>
                <div class="card">
                    <h2>Usuarios</h2>
                    <p>Gestión de usuarios del sistema: creación, edición y asignación de roles</p>
                    <a href="modules/usuarios/" class="btn btn-primary">Acceder</a>
                </div>

                <div class="card">
                    <h2>Reportes</h2>
                    <p>Generación de reportes estadísticos y de seguimiento académico</p>
                    <a href="modules/reportes/" class="btn btn-primary">Acceder</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($division_info): ?>
            <div class="division-actions">
                <h3>Acciones de <?php echo htmlspecialchars($division_info); ?></h3>
                <div class="action-buttons">
                    <a href="modules/aspirantes/" class="btn btn-outline">Gestionar Aspirantes</a>
                    <a href="modules/asistencia/" class="btn btn-outline">Registrar Asistencia</a>
                    <a href="modules/materias/" class="btn btn-outline">Ver Materias</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>

    <style>
        .welcome-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .division-badge {
            margin: 10px 0;
        }

        .badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .division-actions {
            margin-top: 40px;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .division-actions h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #3498db;
            color: #3498db;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: #3498db;
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-outline {
                width: 100%;
                max-width: 250px;
            }
        }
    </style>
</body>

</html>