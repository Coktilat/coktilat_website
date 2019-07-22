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
define('DB_NAME', 'coktilat_wp1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Waazn@123$$');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD', 'direct');
define('WP_HOME','http://coktilat.com');
define('WP_SITEURL','http://coktilat.com');


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?ZcCEIN^55leA~N]84`*p(RB9t!/ qT2SK*3NG5)V3t=Yn|MA(GvF`oPbvN)yZ7K');
define('SECURE_AUTH_KEY',  '2%8 1(O7N/hrNcrI6/7@rev0^sh(vpsTC,uun+jM5KK&m8ZA^NbNY-,OqPTX]g[R');
define('LOGGED_IN_KEY',    '4&#Y]TOBm,$=CH&0=N&+b!}%KSI}Xowl<CV]1_,U[m#/T[aBE{[G9j:(J?zmHtH9');
define('NONCE_KEY',        'G0rP.Io5TD#AC]F+=*J/F3R;:<$d]Z]l}iLd(B6tc8$%BF<%=^(KEBG$t}#?T<dQ');
define('AUTH_SALT',        '6:Z=uX+h_2eD=!]xWEIM mAa#gKya<Oo`BLJj/mKL}WCcr|ILW4NQ8Nyn8pos_I0');
define('SECURE_AUTH_SALT', 'BgGg JH::*3JDv+vv,rv983J]Gtz##hoqWZM73SD,[O#$e+ls4qwp:h%aVevmT4T');
define('LOGGED_IN_SALT',   'Ife)$rsS1mFNVe=q_Rhq9r_%.YAbac6N6oJ2P B#0u%@g*a,vP2?g>ve$*Y-1O=f');
define('NONCE_SALT',       '=b/{yli5N6;nb5[8!B~(/|%S@(F;A{%<[(eC4px|u??<^D~Y?PW1pFVeAr]*1L:n');

/**#@-*/

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
