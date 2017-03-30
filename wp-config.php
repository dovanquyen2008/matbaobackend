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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'azmatbao');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
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
define('AUTH_KEY',         'Jl+=f^af1rI188ok:xk~%6{w=C}ihmg?W>%{e?*e_=8k1A3e(qf+EAsenoB9Iv$}');
define('SECURE_AUTH_KEY',  '(TPxr6LfqOpZ0O.@wTg}T|21p=jW<#z@E=q&BhKr_10A}K9nC{RUiPCqzPb4PvUc');
define('LOGGED_IN_KEY',    'k3P[$vI/]amE?Z9/{))p9)f,`~B@!Yl~,)w..+m5j09.GA>n,7narU*v2@H=g4Ky');
define('NONCE_KEY',        'TA>)vR0LNh}/(/T3(j1,qNA!zO$aU.4z7a48h.iLSOZ(+u;+vI+` Q*Pt kmNXa|');
define('AUTH_SALT',        'C?FPqDm{~Nq31y)Xm)_LCGP87?qX f65g  `v^WMLX$j6.pN5-2&C<=HSjZ%^G2N');
define('SECURE_AUTH_SALT', '{[{Ri_qUEQ`!_Fd~<7TgfE]Iq^D8Dq;xD|Lsd9>LYupg3,:@~FO#r;d:}yiS# %[');
define('LOGGED_IN_SALT',   'ovQcnEv8vbCUW29$fHb|$]x9Uzv%Gi~}%Uf}`UAP%12/%d5)~C-kJq=sF4[9<PPL');
define('NONCE_SALT',       'Njn(5^jrz0VHCb|O~iL`^wE1}EzI+R(Qh.Ra4CG!<Yv.8EqoLdz9|uby1T[iK3AH');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'st_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
