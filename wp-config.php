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
define('DB_NAME', 'luxspa');

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
define('AUTH_KEY',         'k=xPh32an} d0KG[g/LU?z;~c~>_H/~6k&J*UAT!/V}so@[(UA7*!1H`hR1TD|&w');
define('SECURE_AUTH_KEY',  '*Z]ni>dH{&[w; #II!A*x0C5W%vb[`DaC9|L8b7prXt+DX4X8C}HR`IDg8CtCv;Z');
define('LOGGED_IN_KEY',    'Ag-9V[i)|Vsq]a;.{/e5O;c>&G97X)BG088?r+?LBV0PV:vXT<rjwhk%eT;YevRZ');
define('NONCE_KEY',        'ySv|pBWR},8`axY] =tOD^3NOjCg.^?xU>y7A+$U5LgN;jb0Qp)F.`}I4N3&=-Z^');
define('AUTH_SALT',        'Lw&1,4V|(D`g46Ojjh;O)B/h%4*f[RqG618]`zLYScnk1g.K0{xOG8~Xs:$|Qd^{');
define('SECURE_AUTH_SALT', '~K2S=J7htL&[[iu{|K43VlaxJP{+y4/RW;5]A2D| w?q`MNKM/^2 U38}{di$+~-');
define('LOGGED_IN_SALT',   '%]G4J}({R&i51Ysv3U3(gF:duR,HPK@$W+eJ>KIx&]}||9KS:b)#(Fbw rjaIc~Q');
define('NONCE_SALT',       'N}G/&5:;;7jh0lSE6pj9(P^8<AQeVe8!4I)Ks:0zS8sazU;8L5B{$uomx6GA:]8=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bdt_';

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
