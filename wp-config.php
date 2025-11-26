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
define( 'AUTH_KEY',          'Bq5=:@iGkGx(!XhSr{n?0@7]1@y{iG~CV%z5uzEk8brLOk!|!6e>%mI}G`D8HT`?' );
define( 'SECURE_AUTH_KEY',   '41mKqWVUWq}#;5:6))plZC$<N>r=#i.RXBUnZKSl>T{-7>9Gb,E:/-{n?c$XFyz6' );
define( 'LOGGED_IN_KEY',     '-Nzrm3LRCNeu Jx[OSq%Z5Ik+NF06@Ru+(i8(TMf([G,lg479c>IDI]6MqXmEWCo' );
define( 'NONCE_KEY',         'zD,(K4{Kg5q aM_b6s2mFs+5[r[9.hkbm]2:~b:-Hw0S2JS-w*E,VuMBIlo-!wBx' );
define( 'AUTH_SALT',         'c4VISIUW= p^Z5b49:CaJME]FkZKv?<Z#42n&r_AHDy-p=IGp8Ym-u@c0*1^$~rz' );
define( 'SECURE_AUTH_SALT',  '77fm9aS<*I):}/}fRwxKS]-Pu`+I~8BkRB&>X*9-%(HWJ^NuJurw~V|tAy:.heP-' );
define( 'LOGGED_IN_SALT',    '=NeL`[ul.X6@jW1x2{J3Whv|UO2*d`sb I-qnK7%O[!t6,k=|AaF=m w@9)-GmU-' );
define( 'NONCE_SALT',        '+fkN 6E) auCuMg)aX$]*/Dy1~G#TMAl BXbI@m}]SRbGx^6WCGMk*U`xVPKhSMm' );
define( 'WP_CACHE_KEY_SALT', '|xea9Aq,Xb{AQYt7L252R;enK|yaU.XsL>L3NyU5h/&,| @DO;nIUYVC$+`}|ljG' );


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
