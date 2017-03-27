<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'perfilCV');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'F)X1|4pa$uhzVOJRfD86LpwQXboCH+4=PyoJ7_6c+GAH (dz.vqmD-vH~u:;CEUa');
define('SECURE_AUTH_KEY', '(dz ;Z:oj?ap<#5~+-r,saygV,X$[C<SD4QE?Bh{v{zHiGe/c%r{EUT$^}WM/1*W');
define('LOGGED_IN_KEY', 'JqLP#vBD,ooi/b9oB8Zap>lA74bAfkY#k(%?H/DjQ#IW xbtVVoc UpGR0N9S/B=');
define('NONCE_KEY', '+kAm_%Gg{G-8i;l`S{QDT@4GD-~6^c3}r!vrWxbEGZg-rV#;i)^8&a#m&ej`[5B9');
define('AUTH_SALT', 'h-d-kw>/zZA}0yw_Q4T1:X&>~/t#j[4q=[%[aM<*o<73SgvM07k-{:n)?iFk%HBN');
define('SECURE_AUTH_SALT', '*Zy2_h%nH[cy<yGF!4P{&!2_M_B5wQMmU`IomwfS[T._hP=pO)FqzoATqifj9e<C');
define('LOGGED_IN_SALT', 'pCz1V&Xui(01@:,y}qnneZQ%[)IDdSuz^47Zx -0_.v*+=(a<eOMQmPJ:ybFi19]');
define('NONCE_SALT', '_a,$gkF>whPf}r>^@bt?/pOP~IhA>gIFOM@6J5/jvSUtIZup rwsIocBuh7&w!ko');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

