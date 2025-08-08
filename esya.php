<?php
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Divisiones ESyA</title>
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
                    <h2>Escuela de Suboficiales y Agentes</h2>
                </div>
            </div>
            <nav class="breadcrumb">
                <a href="inicio.php">Inicio</a> > <a href="formacion_agentes.php">Formación de Agentes</a> > Sistema ESyA
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="welcome-section">
                <h1>Escuela de Suboficiales y Agentes</h1>
                <p>Seleccione la división a la que desea acceder</p>
            </div>

            <div class="navigation-cards divisions-grid">
                <div class="nav-card">
                    <div class="card-icon">
                        <i class="icon-command"></i>
                    </div>
                    <h3>Jefatura de Cuerpo</h3>
                    <p>Gestión administrativa y operativa del cuerpo de cadetes</p>
                    <a href="login.php?division=jefatura_cuerpo" class="btn btn-primary btn-large">Acceder</a>
                </div>

                <div class="nav-card">
                    <div class="card-icon">
                        <i class="icon-studies"></i>
                    </div>
                    <h3>Jefatura de Estudios</h3>
                    <p>Coordinación académica y planes de estudio</p>
                    <a href="login.php?division=jefatura_estudios" class="btn btn-primary btn-large">Acceder</a>
                </div>

                <div class="nav-card">
                    <div class="card-icon">
                        <i class="icon-medical"></i>
                    </div>
                    <h3>Servicios Médicos</h3>
                    <p>Atención médica y seguimiento sanitario</p>
                    <a href="login.php?division=servicios_medicos" class="btn btn-primary btn-large">Acceder</a>
                </div>

                <div class="nav-card">
                    <div class="card-icon">
                        <i class="icon-assistant"></i>
                    </div>
                    <h3>Ayudantía</h3>
                    <p>Servicios de apoyo y asistencia administrativa</p>
                    <a href="login.php?division=ayudantia" class="btn btn-primary btn-large">Acceder</a>
                </div>
            </div>

            <div class="back-section">
                <a href="formacion_agentes.php" class="btn btn-back">← Volver a Formación</a>
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