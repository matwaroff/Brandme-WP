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
define('DB_NAME', 'wp_brandme');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'Sockumup22!');

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
define('AUTH_KEY',         'H/`>=@:K./HqHec91!ZCgo7%$H}}Fn.W4!*e7>c5~hNX.+>X~1>ck?YgS<~eYNw#');
define('SECURE_AUTH_KEY',  ':Qv!&igOu;B(T7DxQ*y*k-nrE$EtIv0E]&3H]DC: I )Sh+fLR73>0Dk/~Frx#x&');
define('LOGGED_IN_KEY',    'nC@ tqI`Zn2?&A}PMVQkJ*v~G{d@YIU7sEg<P<dM9)VK&A<CDMN,R98&!Iy*p|ML');
define('NONCE_KEY',        'm-n+yAx]dwE`9U,#_8-Kk4=Un)pMKREM8-^41I/l5|!P8g.O@vNxlt1tmFRcK!NY');
define('AUTH_SALT',        'hO~O}qW1>pb*RX]2n,[|/%&=+L=`gO7X;6`P&g$r6&-B!6tG8wX`,KWE6UW6W?!E');
define('SECURE_AUTH_SALT', 'P|=w{`6`eFM+K)Z5l^==q+62@C %3`6cTw+xgxTGp)hTwlzm5lZT>1xik~+)?7#X');
define('LOGGED_IN_SALT',   'AZ1A/T[|`vGikb|1^w<U&qVmI+y(ZH$zI!oH);AxSsrJ:C1omS:[+sVRRKlSOTlG');
define('NONCE_SALT',       '44vjz=?as`V<!EadFOe-!P~3vZ3-r`|.0l=*4i}wS>]K$k|_ze&y+e^`=XWm*.{6');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define('WP_DEBUG', TRUE);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
