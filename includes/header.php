<?php
$user = (new Auth())->getUserInfo();
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header>
    <div class="header-container">
        <div class="logo">
            <h2><?php echo APP_NAME; ?></h2>
        </div>

        <nav>
            <ul class="main-nav">
                <li class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                    <a href="<?php echo BASE_URL; ?>dashboard.php">Inicio</a>
                </li>
                <li class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'aspirantes') !== false) ? 'active' : ''; ?>">
                    <a href="<?php echo BASE_URL; ?>modules/aspirantes/">Aspirantes</a>
                </li>
                <li class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'asistencia') !== false) ? 'active' : ''; ?>">
                    <a href="<?php echo BASE_URL; ?>modules/asistencia/">Asistencia</a>
                </li>
                <li class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'materias') !== false) ? 'active' : ''; ?>">
                    <a href="<?php echo BASE_URL; ?>modules/materias/">Materias</a>
                </li>


                <?php if ($user['rol'] === 'admin'): ?>
                    <li class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'usuarios') !== false) ? 'active' : ''; ?>">
                        <a href="<?php echo BASE_URL; ?>modules/usuarios/">Usuarios</a>
                    </li>
                <?php endif; ?>

                <div class="user-nav">
                    <div class="user-profile">
                        <span class="user-name"><?php echo htmlspecialchars($user['nombre_completo']); ?></span>
                        <div class="user-dropdown">
                            <a href="<?php echo BASE_URL; ?>perfil.php">Mi Perfil</a>
                            <a href="<?php echo BASE_URL; ?>logout.php">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </ul>


        </nav>
    </div>
</header>