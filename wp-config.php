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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ihc' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         ',]Yf:Ygbv v`~RQJ@TsO>qR<O[JvuEGiYpCo,xC7fl3&:bLCgD`h(+.WAEa)vaHB' );
define( 'SECURE_AUTH_KEY',  ' E4HUzEp4myK5t@sswm=K:;(0kogNv<G=W%@Ru@SJh~3le[[)AB^G7.aUC-BK}#f' );
define( 'LOGGED_IN_KEY',    '^FHKC!@j/n6,K5Gga!5sZ`U[+elQ6kD]LR<zu&V31*1o_U%5n#`dO IQ^Z.#[xw6' );
define( 'NONCE_KEY',        'DA>x[gLL%$G%CFc~EZh9Jcc`|mVy{4/G=;+@05X.)TzpWDnC(lV8o5`GaiGF7 )Z' );
define( 'AUTH_SALT',        'Mx$eR&MpJUAbd({sN[^YXs9aY(vJB?_&%BYr@<0sH0f6I`y1@y=R@r>h]e!UdMSI' );
define( 'SECURE_AUTH_SALT', ':6a} -i_DF&]C-h4DRJ H <1/3>}$E$#HK@<Z!AvW+3d},34ad^];6.j`F[baa1N' );
define( 'LOGGED_IN_SALT',   'Y7LI$BAkyk$Mdo!0%j>kR0m<%J?bb@`,DkQA*I{/jHz92;[m-!i-EQ4O>@,f[}JT' );
define( 'NONCE_SALT',       'c/|[{q+hkyFPY.AJl|vb4Xx;N8pwoZeZm%l_5$q|KS+_l)!oYNqAbx;gl| Y%y f' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
