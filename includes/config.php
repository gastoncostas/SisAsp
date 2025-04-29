<?php
// Configuración de sesión antes de iniciarla
ini_set('session.cookie_lifetime', 0);    // Cookie expira al cerrar navegador
ini_set('session.gc_maxlifetime', 1);     // 1 segundo de vida en servidor
session_set_cookie_params([
    'lifetime' => 0,                      // Expira inmediatamente
    'path' => '/',
    'domain' => '',
    'secure' => false,                    // Cambiar a true en producción con HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);

// Iniciar sesión
session_start();

// Configuración de la aplicación
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'esya');

define('APP_NAME', 'Sistema de Gestión de Aspirantes');
define('BASE_URL', 'http://localhost:8012/SisAsp/');

// Manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
