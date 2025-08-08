<?php
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Formación de Agentes</title>
    <link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/unified_header_footer.css">
    <link rel="stylesheet" href="assets/css/inicio.css">
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo-section">
                <img src="assets/img/logo-policia.png" alt="Logo Policía de Tucumán" class="header-logo">
                <div class="title-section">
                    <h1>Policía de Tucumán</h1>
                    <h2>Formación de Agentes</h2>
                </div>
            </div>
            <nav class="breadcrumb">
                <a href="inicio.php">Inicio</a> > Formación de Agentes
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="welcome-section">
                <h1>Formación de Agentes</h1>
                <p>Seleccione el sistema al que desea acceder</p>
            </div>

            <div class="navigation-cards">
                <div class="nav-card">
                    <div class="card-icon">
                        <i class="icon-management"></i>
                    </div>
                    <h3>Sistema de Gestión de la ESyA</h3>
                    <p>Gestión integral de la Escuela de Suboficiales y Agentes - Control de aspirantes, materias y asistencias</p>
                    <a href="esya.php" class="btn btn-primary btn-large">Acceder</a>
                </div>

                <div class="nav-card disabled">
                    <div class="card-icon">
                        <i class="icon-virtual"></i>
                    </div>
                    <h3>Aula Virtual</h3>
                    <p>Plataforma de educación a distancia y recursos digitales para la formación</p>
                    <a href="#" class="btn btn-disabled btn-large" onclick="return false;">En Desarrollo</a>
                </div>
            </div>

            <div class="back-section">
                <a href="inicio.php" class="btn btn-back">← Volver al Inicio</a>
            </div>
        </div>
    </main>

    <?php include 'includes/unified_footer.php'; ?>

    <script>
        // Efecto hover para las tarjetas activas
        document.querySelectorAll('.nav-card:not(.disabled)').forEach(card => {
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