<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'u,B#2vGLX0* .ppEdAz4%u<!cx8$qApH?ghgZ1+wkRP~M37IuBGsmQ0NE4WyS}oj' );
define( 'SECURE_AUTH_KEY',   '~BjW)rZbwtm|lvDfza2/zz4k:*`[RoInnrUP1vQRm=?kJS2q>puP{=Cb$SxzUQk(' );
define( 'LOGGED_IN_KEY',     'iHrR@|}sga?X~|LeN:LeR8a}vg=c*88j,wO+k:nh<M3:lGenAu*HO0=}]|`}|T c' );
define( 'NONCE_KEY',         'gvftW;{=$;]!#X$.9A4nw`lx>X /F67VrejQ]D?{n:UFN/Y-nqM*_QmlQ&7@va;]' );
define( 'AUTH_SALT',         'Bbz C#_436[ZL04WqoK<IZ|J4B f|Y<VKsTrfC S0GiViI~>2]ZU#;VufJ=|Fq}>' );
define( 'SECURE_AUTH_SALT',  '1Ho=q#(fAaZgsNf.<j#mU~E4H-@t<E=g>+BM`>Q$4TctMmjp`b2)#RY1_V4Ng-vU' );
define( 'LOGGED_IN_SALT',    'bX>JkST1[J(|ANdT3pyu61Rkr$!,3k+:KJrtI?%(U%h&oZxN[eD,vmh,;7TdzoAx' );
define( 'NONCE_SALT',        '2mu/D4U9zqvOv6Sd@Uc+A@`,TW2%7cQ{g=oG8 ri}BvFZ~)x*u|-kJTLxgV|wEi(' );
define( 'WP_CACHE_KEY_SALT', '6`pmRO7rn~7Wm3x_[L4hRB.PW:V-H,a^iHw4#%|Z{qFc/B&F/~3Ale8+zKb6{K3@' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
