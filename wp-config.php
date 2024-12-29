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
define( 'DB_NAME', 'dokanbd' );

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
define( 'AUTH_KEY',         'uw:)F*p%/4=pC!n~j9bbVN;,O{!maWr BA;LiK6Oqx ;l9x%%mVE3If)CBci3VND' );
define( 'SECURE_AUTH_KEY',  ',d7enmoBhy%c*-i>9EGIK89SkPI( r7QAh[n{Ztwd*Hep<64O82VR}RCT-<DiCpn' );
define( 'LOGGED_IN_KEY',    '37IB[)&X]2zh-G7r4Cyrog_0YII06;TItvoVFPhCkvhoGTeled;@/{p%y$4@aAY?' );
define( 'NONCE_KEY',        'W:3.)qACt#?S-BVqQOVfU|lC1c.]1]XjA=xD5o}&}X1l<{Yt70}[4(OR<eK[Si8g' );
define( 'AUTH_SALT',        ':h]Xc,!dW?OK#3Z%|*yT{^t7@43,jV-sc|N0]//s8QFdb=Ncv{m@-Yi|=1qAITqY' );
define( 'SECURE_AUTH_SALT', '`[PN6AuAH[a0. 5YE>Z8e1pwB;rb+q2@!(a4JxqDFeqnNi3z}]G!Cepw : 13;3:' );
define( 'LOGGED_IN_SALT',   '&|9`2R_dvaBZsG_iA{Qv5?|5Ee1Vd#q,j@Ny.F]l9%E1j/z(R<VK#D0Az%wO<^e1' );
define( 'NONCE_SALT',       'T12.KW6]d$Tfw&,2{75B!V2S{YrBQR6Vz)h(S5@J.4|rUs.3QC+=S]zGC#[6_%l&' );

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
$table_prefix = 'dokan_';

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
