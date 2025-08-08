<?php
// Iniciar/configurar sesión primero
require_once 'includes/config.php';

// Forzar limpieza de sesión previa
session_unset();
session_destroy();

// Luego cargar las demás dependencias
require_once 'includes/auth.php';
require_once 'includes/database.php';

$auth = new Auth();

// Si por alguna razón ya está logueado, redirigir
if ($auth->isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

// Obtener información de la división
$division = $_GET['division'] ?? '';
$division_names = [
    'jefatura_cuerpo' => 'Jefatura de Cuerpo',
    'jefatura_estudios' => 'Jefatura de Estudios',
    'servicios_medicos' => 'Servicios Médicos',
    'ayudantia' => 'Ayudantía'
];

$division_title = $division_names[$division] ?? 'Sistema ESyA';

$error = '';
$success = isset($_GET['logout']) ? 'Sesión cerrada correctamente' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Usuario y contraseña son requeridos";
    } else {
        if ($auth->login($username, $password)) {
            // Guardar información de la división en la sesión si está disponible
            if (!empty($division)) {
                $_SESSION['temp_auth']['division'] = $division;
                $_SESSION['temp_auth']['division_name'] = $division_title;
            }
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Credenciales incorrectas";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/inicio.css">
    <style>
        body {
            background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2980b9);
        }

        .division-info {
            text-align: center;
            margin-bottom: 30px;
            padding: 15px;
            background: linear-gradient(135deg, #e8f4f8, #d5e9f0);
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }

        .division-info h3 {
            color: #2c3e50;
            margin: 0 0 5px 0;
            font-size: 1.2rem;
        }

        .division-info p {
            color: #7f8c8d;
            margin: 0;
            font-size: 0.9rem;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #3498db;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .back-link a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #3498db;
            outline: none;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn:hover {
            background: linear-gradient(135deg, #2980b9, #1f4e79);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.3);
        }
    </style>
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo-section">
                <img src="assets/img/logo-policia.png" alt="Logo Policía de Tucumán" class="header-logo">
                <div class="title-section">
                    <h1>Policía de Tucumán</h1>
                    <h2>Escuela de Suboficiales y Agentes</h2>
                </div>
            </div>
            <?php if (!empty($division)): ?>
                <nav class="breadcrumb">
                    <a href="inicio.php">Inicio</a> > <a href="formacion_agentes.php">Formación de Agentes</a> > <a href="esya.php">Sistema ESyA</a> > <?php echo htmlspecialchars($division_title); ?>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <div class="login-wrapper">
        <div class="login-container">
            <?php if (!empty($division)): ?>
                <div class="division-info">
                    <h3><?php echo htmlspecialchars($division_title); ?></h3>
                    <p>Acceso al sistema de gestión</p>
                </div>
            <?php endif; ?>

            <div class="login-header">
                <h1><?php echo APP_NAME; ?></h1>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <?php if (!empty($division)): ?>
                    <input type="hidden" name="division" value="<?php echo htmlspecialchars($division); ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn">Ingresar</button>
            </form>

            <div class="back-link">
                <?php if (!empty($division)): ?>
                    <a href="esya.php">← Volver a Divisiones</a>
                <?php else: ?>
                    <a href="inicio.php">← Volver al Inicio</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>