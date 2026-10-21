<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_tourism_project' );

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
define( 'AUTH_KEY',         '#<Q/+B_7/]c+:O*7@PH1UEGrrX=Q7kgW6@fp7)?a2Emhhr)2+{19Er)BN`aC(fpW' );
define( 'SECURE_AUTH_KEY',  '<C*oheZz+mB7&C*Y8}!6iT[D2$)]UvZ9:1T/g5p(@`~7=a;@Srz]ELwKVS&3G:RL' );
define( 'LOGGED_IN_KEY',    'GIMR%[,Oi0PeHbccS)Y5 Qk*3h(E/Dc1^I!#Xr>|J%HDZUhu/R.2Q2h)m/eNQovo' );
define( 'NONCE_KEY',        'Buq.sG2RF 4[K6>585p^Wl0E>Fv=;VuVG9!r3<^t(CHiK;505BI|5O<Wj6j(/Ug4' );
define( 'AUTH_SALT',        'f]`TC.!AD!3=dLN$edB8vB)K7G.IH@z&v$RahCdhuft%+E#Q(Oq_Ejd0P=N]UzZi' );
define( 'SECURE_AUTH_SALT', '~]CAzLGa6W[^C4rYK8;UWDV>e3Jv5L36:bw(v-#kL*IxItU+zY_gdIhP{Am9MoI(' );
define( 'LOGGED_IN_SALT',   'zmZDb}%`uR^6F?kjphPJJ>!KPulR2`4{%JQH9lqYP{tez0 9lsf(+W/SJU/@U<;.' );
define( 'NONCE_SALT',       'C(c5k~Ec]j:`dU<{NIjqR[TCo6]Vkr#JnR8yN7ogZ%w}GuU5^gJ;P}{ntd4&B(oY' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
