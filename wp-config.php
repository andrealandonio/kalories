<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// Database settings
define('DB_NAME', 'kalories');
define('DB_USER', 'root');
define('DB_PASSWORD', 'admin');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6dB6m}fG)s&AYi+_2{h>FioET`|_z{!6?mS&A2kp5iF@##v68E4u]9|loHEj0nw*');
define('SECURE_AUTH_KEY',  'y}&[~z-P-&n @`:-Wjzb*TbeYqsy}Gmby-`P,w/*/`^:mzaGW%r2piOXaR8.R*Q)');
define('LOGGED_IN_KEY',    'A@}LhVBnN0zYA]alJ(Yq 38<kTv390pTS6de^;5]@j(>uWGkU/K`np*/ksEw>;nU');
define('NONCE_KEY',        'Neid573}obK@S%6l;3i@O?p3Kh jQMx71Hq;^~!|e-~-#sub(?FS:x^u8vcfZ[L5');
define('AUTH_SALT',        'rb[Oo%xuS+ePk{drpBX;E_!v}Dxr`QJ9m|:!m_nEL -[45d=#S-iRJFYbNMpJXGB');
define('SECURE_AUTH_SALT', 'BYfe@2?#N.$(XOz 9XA>q|0ajmhi2_qQAlHNqgnrS[&u&,F*p~]O`BacDmF& IvR');
define('LOGGED_IN_SALT',   'ReyM(>!r>r3Gy,n2:,Igs:[pErp(E]L!x>Z@HSfNC0X~v):K[#pr&_#2]g~iZ/a9');
define('NONCE_SALT',       'ezs*rW=*tvJ~#5~brpdGZ.F)]_wTZp|ArQ/wd[ynN(tRT|Vj S#LW%Btr#8RsEOH');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

// Custom settings
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_POST_REVISIONS', 0);
define('AUTOSAVE_INTERVAL', 1800);
define('WP_AUTO_UPDATE_CORE', false);

// Network settings
define('WP_ALLOW_MULTISITE', false);

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
