<?php
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Inicio</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/inicio.css">
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo-section">
                <img src="assets/img/logo-policia.png" alt="Logo Policía de Tucumán" class="header-logo">
                <div class="title-section">
                    <h1>Policía de Tucumán</h1>
                    <h2>Jefatura de Educación y Capacitación</h2>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="welcome-section">
                <h1>Bienvenido al Sistema de Gestión</h1>
                <p>Seleccione el área a la que desea acceder</p>
            </div>

            <div class="navigation-cards">
                <div class="nav-card">
                    <div class="card-icon">
                        <i class="icon-education"></i>
                    </div>
                    <h3>Formación de Agentes</h3>
                    <p>Acceso al sistema de formación y capacitación de personal policial</p>
                    <a href="formacion_agentes.php" class="btn btn-primary btn-large">Ingresar</a>
                </div>

                <div class="nav-card">
                    <div class="card-icon">
                        <i class="icon-training"></i>
                    </div>
                    <h3>División Capacitaciones</h3>
                    <p>Sistema de gestión de capacitaciones y cursos especializados</p>
                    <a href="#" class="btn btn-secondary btn-large" onclick="return false;">Próximamente</a>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Efecto hover para las tarjetas
        document.querySelectorAll('.nav-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>

</html>