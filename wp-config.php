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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'inviviendasrd' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$v=k*mDr%~x:-V-,8N(;4L3*l5(P#cgikAV/CJGsM?t5IB|?DLVL<)x,}ZEp|*xl' );
define( 'SECURE_AUTH_KEY',  '<+fWU,jUh_Y<y8{/sg:xH[JIJH4{[V+?2.2/V:rl+(jahzYO$Xw|K$L_j4l&UOH4' );
define( 'LOGGED_IN_KEY',    '/ah32XgE*5f)eT^bmQ.]JQa=G=H;>l$A!%z?P]z adbBnxJJGDo%f=EX$Zfnc_5%' );
define( 'NONCE_KEY',        'iFDkmL&2,iG,K^1z73(,PymGSw?jX60H+>I[Hu0R9n<c-xB$>TxWY~o;NVQr8<Kc' );
define( 'AUTH_SALT',        'biyLszY@zuCC54cbIKMDXt2xpn_tEch&%6`|dnnk3[<T*~w65?1X%_-w/tCf{8$@' );
define( 'SECURE_AUTH_SALT', 'paW^H7@$d5h?NBwye:aL#`O7lrqGwLG5UJiz1k<Xu(A.xw@oH=&X3t5)2g+lx;YH' );
define( 'LOGGED_IN_SALT',   '=u30F0@b&C.r@gjk(wGFE{0U(_CtN8^MYnsfdY2t{ri*:bF;(u@%z%a<1B({(D~9' );
define( 'NONCE_SALT',       '#mA !W_qGR-o|[C;5~pR3?Deb(Ikp[OkdAq@t8u6Y3B>wCGf/(6$_g,tzz7]PgGg' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
