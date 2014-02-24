<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ebrands');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '.LeGy!]>)oaV?+z6f-GAag*&}ISkvsFMA=AwxuZoWZV``GMT}~F;60-u*3xrcRB|');
define('SECURE_AUTH_KEY',  'Cy%*^1:^Pn!9<Ct?5P3:.5ki_D*Vlm%rz|*_SAnOn*|PW(f` J!6CAe`di<U/% C');
define('LOGGED_IN_KEY',    '=b](uu~ZQOr>_}=<aeW(_4cSZs3?0]JN1k{F?0I::5gQE;WbmP@|w4pWIv#W<Hv7');
define('NONCE_KEY',        'C+6kxi#|P.oCbpM?psv?PJ$9ipt/ A z4kx{`Yp|iZ4f^##w*M,,K#t;}$ ba_be');
define('AUTH_SALT',        'l+kyqX|s}G:q]D>0&~oh)?KS%-|?:LJdl./2jo$P. @Ow=Tc{-RwhJ|3BXQz{fC5');
define('SECURE_AUTH_SALT', 'm9#vwc0.(e,b&;a.`vF?jQ[E^0;Qs/~./Xw/yccI@J8FWO?1F97:J-9HG Eyy8,j');
define('LOGGED_IN_SALT',   'x<!hf4Nc5]i#U?+C]U3E>As<>5s-|(g%[-mUm1_fW2I1p>ba5I)Oip{-l1ex9!w%');
define('NONCE_SALT',       '?ilchv?1xhRcRYgU|?E|-o#,Xf+=@9|vl+-P$PML3CTD6Py8Qsi}Py!{|/b8|R|0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
