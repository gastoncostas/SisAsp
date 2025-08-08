<?php
require_once 'includes/config.php';

// Configuración específica para la página de inicio
$GLOBALS['page_subtitle'] = 'Jefatura de Educación y Capacitación';
// No hay breadcrumb en la página de inicio (es la raíz)
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Inicio</title>

    <!-- Estilos unificados -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/unified_header_footer.css">

    <!-- Estilos específicos para páginas de navegación -->
    <style>
        /* Mejoras para el diseño de navegación */
        body {
            background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            padding: 60px 0;
            position: relative;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 48, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 226, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        /* Sección de bienvenida mejorada */
        .welcome-section {
            text-align: center;
            margin-bottom: 60px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .welcome-section h1 {
            font-size: 3rem;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 300;
            position: relative;
        }

        .welcome-section h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2980b9);
            border-radius: 2px;
        }

        .welcome-section p {
            font-size: 1.3rem;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Tarjetas de navegación mejoradas */
        .navigation-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 40px;
            max-width: 900px;
            margin: 0 auto;
        }

        .nav-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .nav-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #3498db, #2980b9);
            transform: scaleX(0);
            transition: transform 0.4s ease;
            border-radius: 3px 3px 0 0;
        }

        .nav-card:hover::before {
            transform: scaleX(1);
        }

        .nav-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
        }

        /* Iconos de las tarjetas mejorados */
        .card-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            position: relative;
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }

        .card-icon::after {
            content: '';
            position: absolute;
            width: 120%;
            height: 120%;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #2980b9);
            opacity: 0.2;
            transform: scale(1);
            animation: pulse 2s infinite;
            z-index: -1;
        }

        .nav-card:hover .card-icon {
            transform: scale(1.1);
            box-shadow: 0 12px 30px rgba(52, 152, 219, 0.4);
        }

        /* Iconos específicos mejorados */
        .icon-education::before {
            content: '🎓';
            font-size: 2.5rem;
        }

        .icon-training::before {
            content: '📚';
            font-size: 2.5rem;
        }

        .nav-card h3 {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 600;
            line-height: 1.3;
        }

        .nav-card p {
            color: #7f8c8d;
            margin-bottom: 35px;
            line-height: 1.7;
            font-size: 1.1rem;
        }

        /* Botones mejorados */
        .btn-large {
            padding: 16px 35px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            min-width: 180px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9, #1f4e79);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            color: white;
            box-shadow: 0 6px 20px rgba(149, 165, 166, 0.3);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #7f8c8d, #6c7b7d);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(149, 165, 166, 0.4);
        }

        /* Tarjeta deshabilitada */
        .nav-card.disabled {
            opacity: 0.7;
            background: rgba(248, 249, 250, 0.8);
        }

        .nav-card.disabled:hover {
            transform: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .nav-card.disabled .card-icon {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
        }

        /* Animaciones */
        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.2;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-section {
            animation: fadeInUp 0.8s ease-out;
        }

        .nav-card:nth-child(1) {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .nav-card:nth-child(2) {
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        /* Responsive design mejorado */
        @media (max-width: 768px) {
            .welcome-section h1 {
                font-size: 2.2rem;
            }

            .welcome-section p {
                font-size: 1.1rem;
                padding: 0 20px;
            }

            .navigation-cards {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 0 20px;
            }

            .nav-card {
                padding: 40px 30px;
            }

            .card-icon {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }

            .nav-card h3 {
                font-size: 1.5rem;
            }

            .btn-large {
                padding: 14px 30px;
                font-size: 1.1rem;
                min-width: 150px;
            }

            .main-content {
                padding: 40px 0;
            }
        }

        @media (max-width: 480px) {
            .welcome-section {
                margin-bottom: 40px;
                padding: 30px 20px;
            }

            .welcome-section h1 {
                font-size: 2rem;
            }

            .nav-card {
                padding: 30px 20px;
            }

            .card-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }
        }

        /* Efectos visuales adicionales */
        .nav-card:hover .card-icon::after {
            animation-duration: 1s;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Mejora de accesibilidad */
        @media (prefers-reduced-motion: reduce) {

            .nav-card,
            .card-icon,
            .btn-large {
                transition: none;
                animation: none;
            }

            .card-icon::after {
                animation: none;
            }
        }

        /* Modo de alto contraste */
        @media (prefers-contrast: high) {
            .nav-card {
                border: 2px solid #000;
                background: #fff;
            }

            .nav-card h3,
            .nav-card p {
                color: #000;
            }

            .btn-primary {
                background: #000;
                color: #fff;
                border: 2px solid #fff;
            }
        }
    </style>
</head>

<body>
    <!-- Header unificado - detecta automáticamente que es una página de navegación -->
    <?php include 'includes/unified_header.php'; ?>

    <main class="main-content">
        <div class="container">
            <div class="welcome-section floating">
                <h1>Bienvenido al Sistema de Gestión</h1>
                <p>Seleccione el área a la que desea acceder para comenzar a navegar a través del sistema.</p>
            </div>

            <div class="navigation-cards">
                <div class="nav-card">
                    <div class="card-icon">
                        <i class="icon-education"></i>
                    </div>
                    <h3>Formación de Agentes</h3>
                    <p>Acceso completo a la gestión académica de la Escuela de Suboficiales y Agentes.</p>
                    <a href="formacion_agentes.php" class="btn btn-primary btn-large">Ingresar al Sistema</a>
                </div>

                <div class="nav-card disabled">
                    <div class="card-icon">
                        <i class="icon-training"></i>
                    </div>
                    <h3>División Capacitaciones</h3>
                    <p>Sistema avanzado de gestión de capacitaciones y cursos especializados para el desarrollo profesional continuo.</p>
                    <a href="#" class="btn btn-secondary btn-large" onclick="showComingSoon(); return false;">Próximamente</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer unificado - se adapta automáticamente al contexto de navegación -->
    <?php include 'includes/unified_footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Efecto hover mejorado para las tarjetas
            const navCards = document.querySelectorAll('.nav-card:not(.disabled)');

            navCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-15px) scale(1.02)';

                    // Efecto en el icono
                    const icon = this.querySelector('.card-icon');
                    if (icon) {
                        icon.style.transform = 'scale(1.1) rotate(5deg)';
                    }
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';

                    // Resetear icono
                    const icon = this.querySelector('.card-icon');
                    if (icon) {
                        icon.style.transform = 'scale(1) rotate(0deg)';
                    }
                });
            });

            // Función para mostrar mensaje de "próximamente"
            window.showComingSoon = function() {
                const modal = document.createElement('div');
                modal.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.6);
                    z-index: 9999;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                `;

                modal.innerHTML = `
                    <div style="
                        background: white;
                        padding: 40px;
                        border-radius: 15px;
                        text-align: center;
                        max-width: 400px;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                    ">
                        <div style="font-size: 3rem; margin-bottom: 20px;">🚧</div>
                        <h3 style="color: #2c3e50; margin-bottom: 15px;">Próximamente</h3>
                        <p style="color: #7f8c8d; margin-bottom: 25px;">Esta funcionalidad estará disponible en una próxima actualización del sistema.</p>
                        <button onclick="this.parentElement.parentElement.remove()" style="
                            background: #3498db;
                            color: white;
                            border: none;
                            padding: 12px 25px;
                            border-radius: 8px;
                            cursor: pointer;
                            font-weight: 600;
                        ">Entendido</button>
                    </div>
                `;

                document.body.appendChild(modal);
                modal.style.animation = 'fadeIn 0.3s ease';

                // Cerrar al hacer clic fuera
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.remove();
                    }
                });
            };

            // Añadir animación de entrada escalonada
            const cards = document.querySelectorAll('.nav-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(50px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200 * (index + 1));
            });
        });
    </script>
</body>

</html>